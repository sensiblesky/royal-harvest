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
                        <h2 class="mb-4">Book Now</h2>
                        <p>Fill the table below and submit.</p>
                    </div>
                    <form action="{{ route('booking.store') }}" method="POST" class="appointment-form ftco-animate">
                        @csrf
                        <div class="d-md-flex">
                            <div class="form-group">
                                <input required name="fullname" type="text" class="form-control"
                                    placeholder="First Full name ">
                            </div>

                        </div>
                        {{-- <div class="d-md-flex">
                                <div class="form-group">
                                    <div class="form-field">
                                        <div class="select-wrap">
                                            <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                            <select name="" id="" class="form-control">
                                                <option value="">Select Your Course</option>
                                                <option value="">Art Lesson</option>
                                                <option value="">Language Lesson</option>
                                                <option value="">Music Lesson</option>
                                                <option value="">Sports</option>
                                                <option value="">Other Services</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ml-md-4">
                                    <input type="text" class="form-control" placeholder="Phone">
                                </div>
                            </div> --}}

                        <div class="d-md-flex">
                            <div class="form-group ml-md-4">
                                <input name="email" type="email" class="form-control" placeholder="Email">
                            </div>
                            <div class="form-group ml-md-4">
                                <input required name="phone" type="text" class="form-control" placeholder="Phone">
                            </div>

                        </div>
                        <div class="d-md-flex">

                            <div class="form-group ml-md-6">
                                <label for="" style="color: white">Select Date</label>
                                <input required name="date" type="date" class="form-control">
                            </div>


                        </div>

                        <div class="d-md-flex">
                            <div class="form-group">
                                <label for="service">Service Type</label>
                                <select id="service" name="service">
                                    @foreach ($programmes as $key => $programme)
                                        <option value="{{ $programme->name }}">{{ $programme->name }}</option>
                                    @endforeach

                                </select>

                               
                            </div>
                        </div>

                        <div class="d-md-flex">

                            <div class="form-group ml-md-6">
                                <label for="" style="color: white">Select Time</label>
                                <input required name="time" type="time" class="form-control">
                            </div>


                        </div>
                        <div class="d-md-flex">


                            <div class="form-group ml-md-4">
                                <input type="submit" value="Submit Now" class="btn btn-secondary py-3 px-4">
                            </div>

                        </div>



                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
