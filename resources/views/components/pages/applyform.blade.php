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

<section
    class="ftco-section ftco-consult ftco-no-pt ftco-no-pb"
    style="background-image: url({{ asset('static/images/bg_5.jpg') }});"
    data-stellar-background-ratio="0.5"
>
    <div class="overlay"></div>

    <div class="container">
        <div class="row justify-content-end">
            <div class="col-md-6 py-5 px-md-5">
                <div class="py-md-5">

                    <div class="heading-section heading-section-white ftco-animate mb-5">
                        <h2 class="mb-4">{{ __('messages.apply_form') }}</h2>
                        <p>{{ __('messages.fill_form_below') }}</p>
                    </div>

                    <form
                        action="{{ route('booking.store') }}"
                        method="POST"
                        class="appointment-form ftco-animate" >
                        @csrf

                        <!-- Name -->
                        <div class="d-md-flex">
                            <div class="form-group ml-md-4">
                                <input
                                    type="text"
                                    name="fname"
                                    class="form-control"
                                    placeholder="{{ __('messages.first_name') }}"
                                >
                            </div>

                            <div class="form-group ml-md-4">
                                <input
                                    type="text"
                                    name="lname"
                                    class="form-control"
                                    placeholder="{{ __('messages.last_name') }}"
                                >
                            </div>
                        </div>

                        <!-- Contact -->
                        <div class="d-md-flex">
                            <div class="form-group ml-md-4">
                                <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    required
                                    placeholder="{{ __('messages.email') }}"
                                >
                            </div>

                            <div class="form-group ml-md-4">
                                <input
                                    type="text"
                                    name="phone"
                                    class="form-control"
                                    required
                                    placeholder="{{ __('messages.mobile_number') }}"
                                >
                            </div>
                        </div>

                       
                        <div class="d-md-flex">
                            <div class="form-group">
                                <label for="service">Programme</label>
                                <select id="service" name="service">
                                    <option value="null">Select a Programme</option>
                                    <option value="Starter_Dreadlocks">Starter Dreadlocks</option>
                                    <option value="Advanced_Dreadlocks">Advanced Dreadlocks</option>
                                    <option value="Underlock_Styling">Underlock Styling</option>
                                    <option value="Beginner-Dreadlocks">Beginner Dreadlocks</option>
                                    <option value="Weaving-Setup">Weaving Setup</option>
                                    <option value="Hair-Retouching">Hair Retouching</option>
                                    <option value="Natural-Hairstyles">Natural Hairstyles</option>
                                    <option value="Knotless-Braids">Knotless Braids</option>
                                    <option value="Crochet-Braids">Crochet Braids</option>
                                    <option value="Eyelash-Extensions">Eyelash Extensions</option>
                                    <option value="Bridal-Styling">Bridal Styling</option>
                                    <option value="Nail-Care-and-Design">Nail Care & Design</option>
                                    <option value="Barber-Services">Barber Services</option>
                                </select>
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="d-md-flex">
                            <div class="form-group ml-md-4">
                                <input
                                    type="submit"
                                    value="{{ __('messages.submit') }}"
                                    class="btn btn-secondary py-3 px-4"
                                >
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</section>



</x-layouts.base>
