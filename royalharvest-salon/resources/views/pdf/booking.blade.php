<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        * { font-family: DejaVu Sans, sans-serif; }
        body { color: #1f1f1f; margin: 0; padding: 40px; }
        .head { border-bottom: 3px solid #d4af37; padding-bottom: 18px; margin-bottom: 28px; }
        .brand { font-size: 26px; font-weight: bold; color: #1a1a1a; }
        .brand span { color: #d4af37; }
        .sub { font-size: 10px; letter-spacing: 3px; text-transform: uppercase; color: #a67c24; }
        h1 { font-size: 18px; margin: 0 0 18px; }
        table { width: 100%; border-collapse: collapse; }
        td { padding: 10px 4px; border-bottom: 1px solid #eee; font-size: 13px; }
        td.label { color: #888; width: 40%; text-transform: uppercase; font-size: 11px; letter-spacing: 1px; }
        .code { background: #faf8f3; border: 1px dashed #d4af37; padding: 14px; text-align: center; margin: 22px 0; border-radius: 6px; }
        .code b { font-size: 22px; color: #a67c24; letter-spacing: 2px; }
        .foot { margin-top: 40px; font-size: 11px; color: #888; text-align: center; border-top: 1px solid #eee; padding-top: 16px; }
    </style>
</head>
<body>
    <div class="head">
        <div class="brand">Pixies <span>Bridal</span> Saloon</div>
        <div class="sub">Booking Confirmation</div>
    </div>

    <div class="code">Booking Code <br><b>#{{ $booking->code }}</b></div>

    <h1>Appointment details</h1>
    <table>
        <tr><td class="label">Name</td><td>{{ $booking->fullname }}</td></tr>
        <tr><td class="label">Service</td><td>{{ $booking->service }}</td></tr>
        <tr><td class="label">Date</td><td>{{ \Carbon\Carbon::parse($booking->date)->format('l, j M Y') }}</td></tr>
        <tr><td class="label">Time</td><td>{{ $booking->time }}</td></tr>
        <tr><td class="label">Phone</td><td>{{ $booking->phone }}</td></tr>
        @if ($booking->email)
            <tr><td class="label">Email</td><td>{{ $booking->email }}</td></tr>
        @endif
        @if ($booking->notes)
            <tr><td class="label">Notes</td><td>{{ $booking->notes }}</td></tr>
        @endif
    </table>

    <div class="foot">
        {{ config('site.address') }} &middot; {{ config('site.phone') }} &middot; {{ config('site.email') }}<br>
        Please present this confirmation on arrival. Thank you for choosing Pixies Bridal Saloon.
    </div>
</body>
</html>
