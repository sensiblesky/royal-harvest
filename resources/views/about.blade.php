<x-layouts.base title="About">
    <x-layouts.hero title="More About Us" />





    <section class="ftco-section ftco-no-pt ftc-no-pb">
        <div class="container">
            <div class="row d-flex">
                <div class="col-md-5 order-md-last wrap-about wrap-about d-flex align-items-stretch">
                    <div class="img" style="background-image: url({{ asset('static/images/about.jpg') }}); border">
                    </div>
                </div>
                <div class="col-md-7 wrap-about py-5 pr-md-4 ftco-animate">
                    <h2 class="mb-4">Pixies Bridal Saloon</h2>
                    <p>Pixies Bridal Saloon is a premium beauty destination dedicated to making every bride look and feel extraordinary on 
                     her special day. We specialize in elegant bridal makeup, hairstyling, and personalized beauty services that bring out 
                     your natural glow with style and perfection.</p>
                    <p>Pixies Bridal Saloon offers exquisite bridal beauty services crafted with passion, precision, and a touch of glamour. 
                     From flawless makeup to stunning hairstyles, we turn your dream bridal look into a beautiful reality</p>
                    <p>Pixies Bridal Saloon is where beauty meets artistry, creating timeless bridal looks for your most cherished moments. 
                     Our expert team delivers customized makeup and hairstyling that reflects your unique style and enhances your natural elegance</p>
                </div>
            </div>
        </div>
    </section>




    <section class="ftco-section ftco-no-pt ftco-no-pb contact-section">
        <div class="container">
            <div class="row d-flex align-items-stretch no-gutters">


                <div class="col-md-6 d-flex align-items-stretch">
                    <div class="container">


                        <div class="row d-flex contact-info">

                            <div class="d-flex">
                                <div class="bg-light align-self-stretch box p-4 text-center">
                                    <h3 class="mb-4">Contact Number</h3>
                                    <p><a href="tel://255762091911">+255 762 091 911</a></p>
                                </div>
                            </div>
                            <div class=" d-flex">
                                <div class="bg-light align-self-stretch box p-4 text-center">
                                    <h3 class="mb-4">Email Address</h3>
                                    <p><a href="mailto:info@royalharvest.co.tz">info@royalharvest.co.tz</a></p>
                                </div>
                            </div>
                            <div class=" d-flex">
                                <div class="bg-light align-self-stretch box p-4 text-center">
                                    <h3 class="mb-4">Location</h3>
                                    <p><a href="#">Arusha | Tanzania</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>










                <div class="col-md-6 p-4 p-md-5 order-md-last bg-light">
                    <form action="{{route('admin.contacts.store')}}" method="POST">
                     @csrf
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Your Name">
                        </div>
                        <div class="form-group">
                            <input type="text" name="email" class="form-control" placeholder="Your Email">
                        </div>
                        <div class="form-group">
                            <input type="text" name="subject" class="form-control" placeholder="Subject">
                        </div>
                        <div class="form-group">
                            <textarea id="" name="body" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
                        </div>
                    </form>
                </div>



            </div>
        </div>
    </section>






</x-layouts.base>
