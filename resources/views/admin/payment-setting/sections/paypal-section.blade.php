<div class="tab-pane fade show active" id="home4" role="tabpanel" aria-labelledby="home-tab4">
    <div class="card">
        <form action="{{ route('admin.paypal-settings.update') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="paypal_status">Paypal Status</label>
                        <select class="form-control {{ hasError($errors, 'paypal_status') }}" name="paypal_status">
                            <option @selected(config('getewaySettings.paypal_status') == 'active') value="active">Active</option>
                            <option @selected(config('getewaySettings.paypal_status') == 'inactive') value="inactive">Inactive</option>
                        </select>
                        <x-input-error :messages="$errors->get('paypal_status')" class="mt-2" />
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="paypal_account_mode">Paypal Account Mode</label>
                        <select class="form-control {{ hasError($errors, 'paypal_account_mode') }}"
                            name="paypal_account_mode">
                            <option @selected(config('getewaySettings.paypal_account_mode') === 'sandbox')) value="sandbox">Sandbox</option>
                            <option @selected(config('getewaySettings.paypal_account_mode') === 'live')) value="live">Live</option>
                        </select>
                        <x-input-error :messages="$errors->get('paypal_account_mode')" class="mt-2" />
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="paypal_country_name">Paypal Country Name</label>
                        <select class="form-control {{ hasError($errors, 'paypal_country_name') }} select2"
                            name="paypal_country_name">
                            <option value="">Select Country</option>
                            @foreach (config('countries') as $key => $country)
                                <option @selected($key === config('getewaySettings.paypal_country_name')) value="{{ $key }}">{{ $country }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('paypal_country_name')" class="mt-2" />
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="paypal_currency_name">Paypal Currency Name</label>
                        <select class="form-control {{ hasError($errors, 'paypal_currency_name') }} select2"
                            name="paypal_currency_name">
                            <option value="">Select Currency</option>
                            @foreach (config('currencies.currency_list') as $key => $currency)
                                <option @selected($currency === config('getewaySettings.paypal_currency_name')) value="{{ $currency }}">{{ $currency }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('paypal_currency_name')" class="mt-2" />
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="paypal_currency_rate">Paypal Currency Rate</label>
                        <input type="text" class="form-control {{ hasError($errors, 'paypal_currency_rate') }}"
                            name="paypal_currency_rate" value="{{ config('getewaySettings.paypal_currency_rate') }}">
                        <x-input-error :messages="$errors->get('paypal_currency_rate')" class="mt-2" />
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="paypal_client_id">Paypal Client ID</label>
                        <input type="text" class="form-control {{ hasError($errors, 'paypal_client_id') }}"
                            name="paypal_client_id" value="{{ config('getewaySettings.paypal_client_id') }}">
                        <x-input-error :messages="$errors->get('paypal_client_id')" class="mt-2" />
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="paypal_secret_key">Paypal Secret Key</label>
                        <input type="text" class="form-control {{ hasError($errors, 'paypal_secret_key') }}"
                            name="paypal_secret_key" value="{{ config('getewaySettings.paypal_secret_key') }}">
                        <x-input-error :messages="$errors->get('paypal_secret_key')" class="mt-2" />
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="paypal_app_id">Paypal App ID</label>
                        <input type="text" class="form-control {{ hasError($errors, 'paypal_app_id') }}"
                            name="paypal_app_id" value="{{ config('getewaySettings.paypal_app_id') }}">
                        <x-input-error :messages="$errors->get('paypal_app_id')" class="mt-2" />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
