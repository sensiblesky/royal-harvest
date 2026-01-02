<x-layouts.base title="Apply">

    <style>
        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #2c3e50;
        }

        input,
        select {
            width: 100%;
            padding: 14px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s;
            background-color: #f9f9f9;
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: #D4AF37;
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.2);
        }

        .row .form-group {
            flex: 1;
        }
    </style>

    <section class="ftco-section ftco-consult ftco-no-pt ftco-no-pb"
        style="background-image: url({{ asset('static/images/bg_5.jpg') }});" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>

        <div class="container">
            <div class="row justify-content-end">
                <div class="col-md-6 py-5 px-md-5">
                    <div class="py-md-5">

                        <div class="heading-section heading-section-white ftco-animate mb-5">
                            <h2 class="mb-4">{{ __('messages.apply_form') }}</h2>
                            <p>{{ __('messages.fill_form_below') }}</p>
                        </div>

                        <form action="{{ route('candidate.apply') }}" method="POST"
                            class="appointment-form ftco-animate">
                            @csrf

                            <!-- Name -->
                            <div class="d-md-flex">
                                <div class="form-group ml-md-4">
                                    <input type="text" name="first" class="form-control"
                                        placeholder="{{ __('messages.first_name') }}">
                                </div>

                                <div class="form-group ml-md-4">
                                    <input type="text" name="last" class="form-control"
                                        placeholder="{{ __('messages.last_name') }}">
                                </div>
                            </div>

                            <!-- Contact -->
                            <div class="d-md-flex">
                                <div class="form-group ml-md-4">
                                    <input type="email" name="email" class="form-control" required
                                        placeholder="{{ __('messages.email') }}">
                                </div>

                                <div class="form-group ml-md-4">
                                    <input type="text" name="phone" class="form-control" required
                                        placeholder="{{ __('messages.mobile_number') }}">
                                </div>
                            </div>


                            <div class="d-md-flex">
                                <div class="form-group">
                                    <label for="service">Programme</label>
                                    <select id="service" name="programme_id">
                                        {{-- <option value="1" disabled selected>Select a Programme</option> --}}
                                        @foreach ($programmes as $key => $programme)
                                         <option  value="{{$programme->id}}">{{$programme->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <!-- Submit -->
                            <div class="d-md-flex">
                                <div class="form-group ml-md-4">
                                    <input type="submit" value="{{ __('messages.submit') }}"
                                        class="btn btn-secondary py-3 px-4">
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>



</x-layouts.base>
