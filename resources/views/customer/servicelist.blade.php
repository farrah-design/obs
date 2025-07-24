@extends('layouts.customer')

@section('title', 'Service Lists')

@section('head')
  <link rel="stylesheet" href="/css/service-list.css">
@endsection

@section('content') 
<h1 class="catalog-title">Our Service Catalogue</h1>
<p class="catalog-intro">Explore our wide range of beauty services. Find the perfect treatment for you!</p>

<div class="service-container">
    <!-- Service 1 -->
    <div class="service-card">
        <h2><i class="fas fa-cut" id="service-icon"></i>Haircuts & Styling</h2>
        <p>Professional haircuts and styling tailored to your preferences for all hair types.</p>
        <h3>Details</h3>
        <ul>
            <li>Men & Women Cuts</li>
            <li>Bridal & Special Occasion Styling</li>
            <li>Kids Cuts</li>
        </ul>
        <h3>Price: From RM10</h3>
        <h3>Duration: ~20 minutes</h3>
    </div>
    
    <!-- Service 2 -->
    <div class="service-card">
        <h2><i class="fas fa-paint-brush" id="service-icon"></i>Hair Coloring</h2>
        <p>Transform your look with expert coloring techniques, from highlights to full color.</p>
        <h3>Methods</h3>
        <ul>
            <li>Highlights & Lowlights</li>
            <li>Balayage & Ombre</li>
        </ul>
        <h3>Price: From RM150</h3>
        <h3>Duration: ~1.5 hours</h3>
    </div>
    
    <!-- Service 3 -->
    <div class="service-card">
        <h2><i class="fas fa-plus-circle" id="service-icon"></i>Hair Extensions</h2>
        <p>Add length and volume with premium hair extension options.</p>
        <h3>Price: From RM100</h3>
        <h3>Types</h3>
        <ul>
            <li>Braids Extensions</li>
            <li>Fusion Extensions</li>
        </ul>
        <h3>Price: From RM200</h3>
        <h3>Duration: ~2 hours</h3>
    </div>
    
    <!-- Service 4 -->
    <div class="service-card">
        <h2><i class="fas fa-water" id="service-icon"></i>Perms & Texture Services</h2>
        <p>Achieve curls, waves, or sleek straight hair with our texture treatments.</p>
        <h3>Options</h3>
        <ul>
            <li>Perms</li>
            <li>Straightening</li>
            <li>Wave & Curl Enhancements</li>
        </ul>
        <h3>Price: From RM90</h3>
        <h3>Duration: ~2 hours</h3>
    </div>
    
    <!-- Service 5 -->
    <div class="service-card">
        <h2><i class="fas fa-star" id="service-icon"></i>Add-On Services</h2>
        <p>Extra care options including blow-dry, hair wash, shine treatments, and more.</p>
        <h3>Extras</h3>
        <ul>
            <li>Blow Dry & Styling</li>
        </ul>
        <h3>Price: From RM15</h3>
        <h3>Duration: ~20 minutes to 60 minutes</h3>
    </div>
</div>


<div class="container">
<h2>How to Book Your Service</h2>
<ol>
    <li><strong>Create Account:</strong> Sign up in minutes to access all services.</li>
    <li><strong>Choose Service:</strong> Explore and select your desired treatment.</li>
    <li><strong>Pick Date & Time:</strong> Schedule your appointment conveniently.</li>
    <li><strong>Confirm & Enjoy:</strong> Get instant confirmation and look forward to your appointment!</li>
</ol>
</div>
@endsection

@section('scripts')
<script>
// Example: Smooth scroll to sections
document.querySelectorAll('a[href^="#"]').forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({ behavior: 'smooth' });
    });
});
</script>
@endsection

