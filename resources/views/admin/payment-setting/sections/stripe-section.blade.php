<div class="tab-pane fade" id="profile4" role="tabpanel" aria-labelledby="profile-tab4">
    <div class="card">
        <form action="{{ route('admin.stripe-settings.update') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="stripe_status">Stripe Status</label>
                        <select class="form-control {{ hasError($errors, 'stripe_status') }}" name="stripe_status">
                            <option @selected(config('getewaySettings.stripe_status') == 'active') value="active">Active</option>
                            <option @selected(config('getewaySettings.stripe_status') == 'inactive') value="inactive">Inactive</option>
                        </select>
                        <x-input-error :messages="$errors->get('stripe_status')" class="mt-2" />
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="stripe_country_name">Stripe Country Name</label>
                        <select class="form-control {{ hasError($errors, 'stripe_country_name') }} select2"
                            name="stripe_country_name">
                            <option value="">Select Country</option>
                            @foreach (config('countries') as $key => $country)
                                <option @selected($key === config('getewaySettings.stripe_country_name')) value="{{ $key }}">{{ $country }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('stripe_country_name')" class="mt-2" />
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="stripe_currency_name">Stripe Currency Name</label>
                        <select class="form-control {{ hasError($errors, 'stripe_currency_name') }} select2"
                            name="stripe_currency_name">
                            <option value="">Select Currency</option>
                            @foreach (config('currencies.currency_list') as $key => $currency)
                                <option @selected($currency === config('getewaySettings.stripe_currency_name')) value="{{ $currency }}">{{ $currency }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('stripe_currency_name')" class="mt-2" />
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="stripe_currency_rate">Stripe Currency Rate</label>
                        <input type="text" class="form-control {{ hasError($errors, 'stripe_currency_rate') }}"
                            name="stripe_currency_rate" value="{{ config('getewaySettings.stripe_currency_rate') }}">
                        <x-input-error :messages="$errors->get('stripe_currency_rate')" class="mt-2" />
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="stripe_publishable_key">Stripe Publishable Key</label>
                        <input type="text" class="form-control {{ hasError($errors, 'stripe_publishable_key') }}"
                            name="stripe_publishable_key"
                            value="{{ config('getewaySettings.stripe_publishable_key') }}">
                        <x-input-error :messages="$errors->get('stripe_publishable_key')" class="mt-2" />
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="stripe_secret_key">Stripe Secret Key</label>
                        <input type="text" class="form-control {{ hasError($errors, 'stripe_secret_key') }}"
                            name="stripe_secret_key" value="{{ config('getewaySettings.stripe_secret_key') }}">
                        <x-input-error :messages="$errors->get('stripe_secret_key')" class="mt-2" />
                    </div>
                </div>


            </div>
            <div class="form-group">
                <button class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
