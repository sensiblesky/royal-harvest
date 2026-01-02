<x-layouts.base title="Confimation">


        <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .header { text-align: center; margin-bottom: 30px; }
        .booking-info { 
             text-align: center;
            margin: 20px 0; }
        .info-row { margin: 10px 0; }
        .label { font-weight: bold; width: 150px; display: inline-block; }
        .unique-code { 
            font-size: 18px; 
            font-weight: bold; 
            color: #2c5282;
            background-color: #f7fafc;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            margin: 20px 0;
        }
        .footer { 
            margin-top: 50px; 
            text-align: center; 
            font-size: 12px; 
            color: #718096;
        }
        
    </style>

    <div class="header">
        <h1>Booking Confirmation</h1>
        <p>Thank you for your booking!</p>
    </div>

    <div class="unique-code">
        Your Booking Code: {{ $booking->code }}
    </div>

    <div class="booking-info" >
        <div class="info-row">
            <span class="label">Client Name:</span>
            <span>{{ $booking->fname }}</span>
        </div>
        <div class="info-row">
            <span class="label">Email:</span>
            <span>{{ $booking->email }}</span>
        </div>
        {{-- <div class="info-row">
            <span class="label">Service Type:</span>
            <span>{{ $booking->service_type }}</span>
        </div> --}}
        <div class="info-row">
            <span class="label">Booking Date:</span>
            <span>{{ \Carbon\Carbon::parse($booking->date)->format('F d, Y') }}</span>
        </div>
        <div class="info-row">
            <span class="label">Booking Time:</span>
            <span>{{ \Carbon\Carbon::parse($booking->time)->format('h:i A') }}</span>
        </div>

        <div class="info-row">
            <img src="{{asset("static/nmb.png")}}" alt="" width="200">
            <img src="{{asset("static/mpesa.png")}}" alt=""  width="200">
            <img src="{{asset("static/crdblipa.png")}}" alt=""  width="200">
            <img src="{{asset("static/crdb.png")}}" alt=""  width="200">
        </div>
        
        {{-- <div class="info-row">
            <span class="label">Status:</span>
            <span style="color: {{ $booking->status === 'confirmed' ? 'green' : 'orange' }};">
                {{ ucfirst($booking->status) }}
            </span>
        </div> --}}
        <div class="info-row text-center">
            <a href="{{ route('booking.download', ['id'=>$booking->id]) }}" class="btn btn-primary nav-item nav-link text-center" style="max-width: 10%;margin:auto">Download PDF</a>
        </div>


    </div>

  

</x-layouts.base>