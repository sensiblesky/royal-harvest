<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Confirmation</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #c2b32e 0%, #f9f341 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            width: 100%;
            max-width: 500px;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(to right, #c2b32e, #939027);
            color: white;
            padding: 25px 30px;
            text-align: center;
        }

        .header h1 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .header p {
            opacity: 0.9;
            font-size: 14px;
        }

        .form-container {
            padding: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
        }

        input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
            transition: all 0.3s;
        }

        input:focus {
            outline: none;
            border-color: #c2b32e;
            box-shadow: 0 0 0 3px rgba(106, 17, 203, 0.1);
        }

        .row {
            display: flex;
            gap: 15px;
        }

        .row .form-group {
            flex: 1;
        }

        .error {
            color: #e74c3c;
            font-size: 14px;
            margin-top: 5px;
            display: none;
        }

        .btn {
            background: linear-gradient(to right, #c2b32e, #939027);
            color: white;
            border: none;
            padding: 14px 20px;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            transition: all 0.3s;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .confirmation {
            display: block;
            padding: 30px;
            text-align: center;
        }

        .confirmation h2 {
            color: #2ecc71;
            margin-bottom: 15px;
        }

        .confirmation-details {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            text-align: left;
        }

        .detail-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .detail-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .detail-label {
            font-weight: 500;
            color: #555;
        }

        .detail-value {
            color: #333;
        }

        .back-btn {
            background: #95a5a6;
            margin-top: 10px;
        }

        .back-btn:hover {
            background: #7f8c8d;
        }

        @media (max-width: 480px) {
            .row {
                flex-direction: column;
                gap: 0;
            }

            .header,
            .form-container {
                padding: 20px;
            }
        }
    </style>
</head>

<body
    style="background: linear-gradient(135deg, #c2b32e 0%, #f9f341 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;">
    <div class="container" style="margin:auto">


        <div class="confirmation">

            <h1>Pixies Bridal Saloon</h1>
            <h2>Booking <strong>{{ $booking->code }}</strong> Confirmed!</h2>
            <p>Your appointment has been successfully scheduled. Details are below:</p>

            <div class="confirmation-details">
                <div class="detail-item">
                    <span class="detail-label">Code:</span>
                    <span class="detail-value" id="confirmName">{{ $booking->code }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Name:</span>
                    <span class="detail-value" id="confirmName">{{ $booking->fname }} {{ $booking->lname }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Email:</span>
                    <span class="detail-value" id="confirmEmail">{{ $booking->email }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Date:</span>
                    <span class="detail-value" id="confirmDate">{{ $booking->date }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Service:</span>
                    <span class="detail-value" id="confirmDate">{{ $booking->service }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Time:</span>
                    <span class="detail-value" id="confirmTime">{{ $booking->time }}</span>
                </div>
            </div>

            <div class="info-row">
                <span class="label">Our Accounts <small>
                        (Fanya Malipo ya awali kupitia account zetu na utume screenshot kwa namba
                        <strong>WHATSAP: +255 762 091 911)</strong>
                    </small>
                </span>
            </div>

            <div class="info-row">
                <span class="label"> NMB 20502401034<small>
                <span class="label"> CRDB 0152970004000<small>
                <span class="label"> CRDB LIPA 11022880<small>
                <span class="label"> VODA LIPA 54353460<small>

            </div>

            <!-- <p>We've sent a confirmation email to your address.</p> -->
            <p>Visit our Website Today!</p>
            <button class="btn back-btn" id="backBtn">www.pixiesbridalsaloon.royalharvest.co.tz</button>
        </div>
    </div>


</body>

</html>
