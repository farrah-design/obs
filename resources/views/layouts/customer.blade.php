<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Sarlini')</title>
    <link rel="stylesheet" href="/css/bookingpage.css">
    <link rel="stylesheet" href="/css/bookingschedule.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    @yield('head') 
</head>
<body>
<header>
  <div class="logo">Sarlini Salon</div>
  <nav>
    <a href="{{ url('/main') }}">Home</a>
    <a href="{{ url('/customer/servicelist') }}">Services</a>
    <a href="{{ url('/customer/bookingschedule') }}">Booking</a>
    <a href="{{ url('/customer/bookingpage') }}">Book Now</a>
  </nav>
</header>
    @yield('content')
@yield('scripts')
</body>
</html>
