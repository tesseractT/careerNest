<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaymentController extends Controller
{
    function paymentSuccess(): View
    {
        return view('frontend.pages.payment-success');
    }

    function paymentError(): View
    {
        return view('frontend.pages.payment-error');
    }
    function setPaypalConfig(): array
    {
        return [
            'mode'    => config('getewaySettings.paypal_account_mode'), // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
            'sandbox' => [
                'client_id'         => config('getewaySettings.paypal_client_id'),
                'client_secret'     => config('getewaySettings.paypal_secret_key'),
                'app_id'            => 'APP-80W284485P519543T',
            ],
            'live' => [
                'client_id'         => config('getewaySettings.paypal_client_id'),
                'client_secret'     => config('getewaySettings.paypal_client_secret'),
                'app_id'            => config('getewaySettings.paypal_app_id'),
            ],

            'payment_action' => 'Sale', // Can only be 'Sale', 'Authorization' or 'Order'
            'currency'       => config('getewaySettings.paypal_currency_name'),
            'notify_url'     => '', // Change this accordingly for your application.
            'locale'         => 'en_US', // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
            'validate_ssl'   => env('PAYPAL_VALIDATE_SSL', true), // Validate SSL when creating api client.
        ];
    }


    //Paypal Payment
    function payWithPaypal()
    {
        $config = $this->setPaypalConfig();

        $provider = new PayPalClient($config);
        $provider->getAccessToken();

        //calculate payable amount
        $payableAmount = round(Session::get('selected_plan')['price'] * config('getewaySettings.paypal_currency_rate'));

        $response = $provider->createOrder(
            [
                'intent' => 'CAPTURE',
                'application_context' => [
                    'return_url' => route('company.paypal.success'),
                    'cancel_url' => route('company.paypal.cancel'),
                ],
                'purchase_units' => [
                    [
                        'amount' => [
                            'currency_code' => config('getewaySettings.paypal_currency_name'),
                            'value' => $payableAmount,
                        ]
                    ]
                ]
            ]
        );

        if (isset($response['id']) && $response['id'] !== NULL) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        }
    }

    function paypalSuccess(Request $request): RedirectResponse
    {
        $config = $this->setPaypalConfig();

        $provider = new PayPalClient($config);
        $provider->getAccessToken();

        $reponse = $provider->capturePaymentOrder($request->token);

        if (isset($reponse['status']) && $reponse['status'] === 'COMPLETED') {
            $capture = $reponse['purchase_units'][0]['payments']['captures'][0];

            try {
                OrderService::storeOrder($capture['id'], 'PayPal', $capture['amount']['value'], $capture['amount']['currency_code'], 'completed');
                OrderService::setUserPlan();
                Session::forget('selected_plan');
                return redirect()->route('company.payment.success');
            } catch (\Exception $e) {
                logger('Payment ERROR >> ' . $e);
                // return redirect()->route('company.dashboard')->with('error', $e->getMessage());
            }
        }

        return redirect()->route('company.payment.error')->withErrors(['error' => $reponse['error']['message']]);
    }

    function paypalCancel()
    {
        return redirect()->route('company.payment.error')->withErrors(['error' => 'Payment Cancelled or Failed, Please try again.']);
    }
}
