<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use Illuminate\View\View;
use Illuminate\Http\Request;
use LaravelDaily\Invoices\Invoice;
use App\Http\Controllers\Controller;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;

class CompanyOrderController extends Controller
{
    function index(): View
    {
        $orders = Order::where('company_id', auth()->user()->company->id)->paginate(20);
        return view('frontend.company-dashboard.order.index', compact('orders'));
    }

    function show(string $id): View
    {
        $order = Order::where('company_id', auth()->user()->company->id)->where('id', $id)->first();
        return view('frontend.company-dashboard.order.show', compact('order'));
    }

    function invoice(string $id)
    {
        $order = Order::findOrFail($id);
        $customer = new Buyer([
            'name'          => $order->company->name,
            'custom_fields' => [
                'email' => $order->company->email,
                'transaction' => $order->transaction_id,
                'payment via' => $order->payment_provider,
            ],
        ]);

        $seller = new Party([
            'name'          => config('settings.site_name'),
            'phone'         => config('settings.site_phone'),
            'custom_fields' => [
                'email' => config('settings.site_email'),
                'note' => 'Thank you purchasing from us, we appreciate you in CareerNest!',
            ],
        ]);

        $item = InvoiceItem::make($order->package_name . ' Plan')->pricePerUnit($order->amount);

        $invoice = Invoice::make()
            ->series('CN' . $order->order_id)
            ->currencyCode($order->paid_in_currency)
            ->currencySymbol($order->paid_in_currency)
            ->buyer($customer)
            ->seller($seller)
            ->status('Payment Received')
            ->addItem($item);

        return $invoice->stream();
    }
}
