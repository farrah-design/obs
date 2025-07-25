@extends('layouts.customer')

@section('title', 'Service Lists')

@section('head')
  <link rel="stylesheet" href="/css/service-list.css">
@endsection

@section('content') 
<h1 class="catalog-title">Our Service Catalogue</h1>
<p class="catalog-intro">Explore our wide range of beauty services. Find the perfect treatment for you!</p>

<div class="service-container">
    @foreach($services as $service)
    <div class="service-card">
        <h2><i class="fas {{ $service->icon }}" id="service-icon"></i>{{ $service->serviceName }}</h2>
        <p>{{ $service->description }}</p>
        
        @if($service->details)
        <h3>Details</h3>
        <ul>
            @foreach(explode(',', $service->details) as $detail)
            <li>{{ trim($detail) }}</li>
            @endforeach
        </ul>
        @endif
        
        <h3>Price: RM{{ number_format($service->price, 2) }}</h3>
        <h3>Duration: ~{{ $service->duration }} minutes</h3>
    </div>
    @endforeach
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

