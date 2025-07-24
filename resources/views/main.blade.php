@extends('layouts.mainpage')
@section('title', 'Main Page')

@section('head')
  <link rel="stylesheet" href="/css/after-login.css">
@endsection

@section('content')

<div class="hero">
    <h1>Book Your Styling Journey</h1>
    <p>Experience salon services with our easy online booking system.</p>
    <a href="{{ route('booking.form') }}" class="button">
        Book Appointment 
        <span class="calendar-icon">🗓️</span>
    </a>
    </div>

    <h1>Our Services</h1>
    <div class="service-container">
        <div class="service-card">
            <div class="service-icon"><i class=""></i></div>
            <h2>Haircuts & Styling</h2>
            <p>Haircuts and Styling for all hair types</p>
            <a href="{{ route('booking.form') }}">Book Now →</a>
        </div>
        <div class="service-card">
            <div class="service-icon"><i class=""></i></div>
            <h2>Hair Coloring</h2>
            <p>Enhance or transform your look with expert hair coloring services</p>
            <a href="{{ route('booking.form') }}">Book Now →</a>
        </div>
        <div class="service-card">
            <div class="service-icon"><i class=""></i></div>
            <h2>Hair Extensions</h2>
            <p>Add volume and length with high-quality hair extensions</p>
            <a href="{{ route('booking.form') }}">Book Now →</a>
        </div>
        <div class="service-card">
            <div class="service-icon"><i class=""></i></div>
            <h2>Perms & Texture Services</h2>
            <p>Achieve curls, waves, or sleek straight hair with professional treatments</p>
            <a href="{{ route('booking.form') }}">Book Now →</a>
        </div>
        <div class="service-card">
            <div class="service-icon"><i class=""></i></div>
            <h2>Add-On Services</h2>
            <p>Extra care options like blow-dry, hair wash, and shine treatments</p>
            <a href="{{ route('booking.form') }}">Book Now →</a>
        </div>
    </div>


    <div class="container">
        <h1>How to Book</h1>
        <div class="steps">
            <div class="step">
                <div class="icon">👤</div>
                <h3>Create Account</h3>
                <p>Sign up in minutes</p>
            </div>
            <div class="step">
                <div class="icon">📅</div>
                <h3>Choose Date</h3>
                <p>Select your preferred time</p>
            </div>
            <div class="step">
                <div class="icon">📝</div>
                <h3>Select Service</h3>
                <p>Pick your treatment</p>
            </div>
            <div class="step">
                <div class="icon">✔️</div>
                <h3>Confirm Booking</h3>
                <p>Get instant confirmation</p>
            </div>
        </div>
    </div>

    <footer>
        <div class="footer-container">
            <div class="footer-column">
                <h3>Our Location</h3>
                <p><i class="fas fa-map-marker-alt"></i> Sarlini Salon, 2014, Lorong Telekom, Bandar Tawau,<br>
                91000 Tawau, Sabah<br>
                Malaysia</p>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3978.8714395301213!2d117.88084307473594!3d4.245272895728609!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x32159f1af88f5ddd%3A0x9eff014d1e70375c!2sSarlini%20Salon!5e0!3m2!1sen!2smy!4v1752329629821!5m2!1sen!2smy" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            
            <div class="footer-column">
                <h3>Contact Us</h3>
                <div class="contact-info">
                    <p><i class="fas fa-phone"></i> +6014-562 8065</p>
                    <p><i class="fas fa-clock"></i> Open Daily: 8am - 8pm</p>
                </div>
            </div>
            
            <div class="footer-column">
                <h3>Quick Links</h3>
                <a href="{{ route('service.list') }}">Our Services</a>
                <a href="{{ route('customer.promotions') }}">Promotions</a>
                <a href="{{ route('booking.form') }}">Book Appointment</a>
            </div>
            
            <div class="footer-column">
                <h3>Follow Us</h3>
                <p>Stay connected for latest updates and offers</p>
                <div class="social-links">
                    <a href="https://facebook.com/sarlinisalon" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://instagram.com/sarlinisalon" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="https://tiktok.com/@sarlinisalon" target="_blank"><i class="fab fa-tiktok"></i></a>
                    <a href="https://wa.me/60145628056" target="_blank"><i class="fab fa-whatsapp"></i></a>
                </div>
                
            </div>
        </div>
        
        <div class="copyright">
            &copy; 2025 Sarlini Salon. All Rights Reserved.
        </div>
    </footer>
@endsection

@section('scripts')
<script>
    function toggleDropdown() {
      const dropdown = document.getElementById('dropdownMenu');
      dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
    }

    // Optional: Close dropdown when clicking outside
    window.onclick = function(e) {
      if (!e.target.matches('.profile-icon')) {
        const dropdown = document.getElementById('dropdownMenu');
        if (dropdown.style.display === 'block') {
          dropdown.style.display = 'none';
        }
      }
    };
</script>
@endsection

