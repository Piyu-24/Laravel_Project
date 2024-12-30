<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Vehicle Rental System</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>
        /* Add your styles here */
        body {
            font-family: 'Figtree', sans-serif;
            background-color: #E9E3D5;
            color: #033043;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }
        .top-nav {
            background-color: #033043;
            padding: 10px 20px;
            text-align: right;
        }
        .top-nav a {
            color: #E9E3D5;
            text-decoration: none;
            margin: 0 10px;
            font-weight: 600;
        }
        .top-nav a:hover {
            color: #FDA521;
        }
        .header {
            background: url('{{ asset('images/header-bg.png') }}') no-repeat center center;
            background-size: cover;
            color: #E9E3D5;
            height: 40vh;
            padding: 20px;
            text-align: center;
        }

        .main {
            width: 100%; /* Makes the main container span the full width of its parent */
            max-width: 1200px; /* Allows a larger maximum width for the content */
            margin: 0 auto; /* Centers the content */
            padding: 50px 20px;
        }

        .main h2 {
            color: #FDA521;
            font-size: 2rem;
            margin-bottom: 20px;
            margin-top: 5px;
            text-align: center;
        }
        .vehicle-card {
            background-color: #fff;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }
        .vehicle-card img {
            max-width: 100%;
            border-radius: 5px;
        }
        .form-group {
            margin-bottom: 10px;
        }
        .form-group label {
            font-size: 0.9rem;
        }
        .form-group select,
        .form-group input,
        .form-group button {
            padding: 8px;
            font-size: 0.9rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
        }
        .form-group button {
            background-color: #FDA521;
            color: #033043;
            font-weight: bold;
            cursor: pointer;
            border: none;
        }
        .form-group button:hover {
            background-color: #E58E2C;
        }

        /* New styling for the features section */
        .features {
            display: flex;
            justify-content: space-between; /* Equal space between boxes */
            margin-top: 40px;
            gap: 20px;
            width: 100%; /* Makes the feature section fill the entire width */
        }

        .feature {
            background-color: #fff;
            padding: 20px;
            flex-grow: 1; /* Allows boxes to take up available space equally */
            min-width: 250px; /* Ensures a minimum width for each box */
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }
        .feature h3 {
            color: #FDA521;
            font-size: 1.5rem;
            margin-bottom: 10px;
        }
        .feature p {
            font-size: 1rem;
            color: #033043;
        }


        .footer {
            background-color: #033043;
            color: #E9E3D5;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="top-nav">
    @if (Route::has('login'))
    @auth
    <a href="{{ url('/dashboard') }}">Dashboard</a>
    @else
    <a href="{{ route('login') }}">Log in</a>
    @if (Route::has('register'))
    <a href="{{ route('register') }}">Register</a>
    @endif
    @endauth
    @endif
</div>

<div class="header">
</div>

<div class="main">
    <h1 style="color:blue;text-align:center;">Welcome to Our Vehicle Rental Service!</h1>

    <!-- New section for the 3 features -->
    <div class="features">
        <div class="feature">
            <h3>Wide Range of Vehicles</h3>
            <p>Our extensive fleet of vehicles caters to all types of travelers, from solo adventurers to families and groups. Whether you need a compact car for city exploration or a spacious SUV for a scenic road trip, we’ve got you covered.</p>
        </div>
        <div class="feature">
            <h3>Affordable Rates</h3>
            <p>We take pride in offering the best car rental fees for foreigners. We understand that travel expenses can add up, and we’re committed to providing budget-friendly options that won’t break the bank. Our competitive pricing ensures you get the most value for your money.</p>
        </div>
        <div class="feature">
            <h3>Easy Booking Process</h3>
            <p>Booking your self-drive car rental in Sri Lanka with us is a breeze. Our user-friendly booking system allows you to reserve your vehicle via WhatsApp, saving you time and hassle.</p>
        </div>
    </div>
</div>



<div class="footer">
    &copy; {{ date('Y') }} Vehicle Rental System | Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
</div>
</body>
</html>
