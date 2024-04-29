<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
    <form action="{{ route('candidate.profile.profile-info.update') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group select-style">
                    <label class="font-sm color-text-mutted mb-10">Gender *</label>
                    <select
                        class="form-control form-icons select-active {{ $errors->has('gender') ? 'is-invalid' : '' }}"
                        name="gender">
                        <option value="">Select One</option>
                        <option @selected($candidate?->gender === 'male') value="male">
                            Male</option>
                        <option @selected($candidate?->gender === 'female') value="female">
                            Female</option>
                        <option @selected($candidate?->gender === 'other') value="other">
                            Other</option>
                    </select>
                    <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group select-style">
                    <label class="font-sm color-text-mutted mb-10">Marital Status *</label>
                    <select
                        class="form-control form-icons select-active {{ $errors->has('marital_status') ? 'is-invalid' : '' }}"
                        name="marital_status">
                        <option value="">Select One</option>
                        <option @selected($candidate?->marital_status === 'single') value="single">
                            Single</option>
                        <option @selected($candidate?->marital_status === 'married') value="married">
                            Married</option>
                    </select>
                    <x-input-error :messages="$errors->get('marital_status')" class="mt-2" />
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group select-style">
                    <label class="font-sm color-text-mutted mb-10">Profession *</label>
                    <select
                        class="form-control form-icons select-active {{ $errors->has('profession') ? 'is-invalid' : '' }}"
                        name="profession">
                        <option value="">Select One</option>
                        @foreach ($professions as $profession)
                            <option @selected($profession?->id === $candidate?->profession_id) value="{{ $profession?->id }}">
                                {{ $profession?->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('profession')" class="mt-2" />
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group select-style">
                    <label class="font-sm color-text-mutted mb-10">Your Availability *</label>
                    <select
                        class="form-control form-icons select-active {{ $errors->has('availability') ? 'is-invalid' : '' }}"
                        name="availability">
                        <option value="">Select One</option>
                        <option @selected($candidate?->status === 'available') value="available">
                            Available</option>
                        <option @selected($candidate?->status === 'unavailable') value="unavailable">
                            Unavailable</option>
                    </select>
                    <x-input-error :messages="$errors->get('availability')" class="mt-2" />
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group select-style">
                    <label class="font-sm color-text-mutted mb-10">Your Skills *</label>
                    <select
                        class="form-control form-icons select-active {{ $errors->has('your_skills') ? 'is-invalid' : '' }}"
                        name="your_skills[]" multiple="">
                        <option value="">Select One</option>
                        @foreach ($skills as $skill)
                            <option @selected(in_array($skill->id, $candidate?->skill->pluck('skill_id')->toArray()) ?? []) value="{{ $skill->id }}">
                                {{ $skill->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('your_skills')" class="mt-2" />
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group select-style">
                    <label class="font-sm color-text-mutted mb-10">Your Languages *</label>
                    <select
                        class="form-control form-icons select-active {{ $errors->has('your_languages') ? 'is-invalid' : '' }}"
                        name="your_languages[]" multiple="">
                        <option value="">Select One</option>
                        @foreach ($languages as $language)
                            <option @selected(in_array($language->id, $candidate?->language->pluck('language_id')->toArray()) ?? []) value="{{ $language->id }}">
                                {{ $language->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('your_languages')" class="mt-2" />
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label class="font-sm color-text-mutted mb-10"> Bio *</label>
                    <textarea name="bio" id="editor" class="form-control {{ $errors->has('bio') ? 'is-invalid' : '' }}"
                        cols="30" rows="10">{!! $candidate?->bio !!}</textarea>
                    <x-input-error :messages="$errors->get('bio')" class="mt-2" />
                </div>
            </div>

            <div class="box-button mt-15">
                <button class="btn btn-apply-big font-md font-bold">Save All Changes</button>
            </div>
        </div>

    </form>
</div>
