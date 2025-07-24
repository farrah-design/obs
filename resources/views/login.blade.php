@extends('layouts.app')

@section('title', 'Login')

@section('head')
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="container">
    <!-- Login Section -->
    <div class="login-section">
      <div class="tabs">
        <a href="{{ route('login') }}" class="tab active" id="loginTab">Login</a>
        <a href="{{ route('register') }}" class="tab" id="registerTab">Register</a>
      </div>
      <form method="POST" action="{{ route('login') }}">
          @csrf
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required />
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required />
          </div>
          <button class="btn" type="submit">Log In</button>
      </form>
    </div>

    <!-- Features Section -->
    <div class="features-section">
      <h2 class="section-title">Sarlini Salon Booking</h2>
      <p class="subtitle">Experience premium beauty services with our convenient online booking system.</p>
      <div class="cards-container">
        <div class="card">
          <div class="icon">🔄</div>
          <h3 class="card-title">Quick Booking</h3>
          <p class="card-desc">Book your appointments in just a few clicks</p>
        </div>
        <div class="card">
          <div class="icon">⏰</div>
          <h3 class="card-title">Reminders</h3>
          <p class="card-desc">Never miss an appointment with automatic reminders</p>
        </div>
        <div class="card">
          <div class="icon">📚</div>
          <h3 class="card-title">Service Catalog</h3>
          <p class="card-desc">Browse our wide range of beauty services</p>
        </div>
        <div class="card">
          <div class="icon">👤</div>
          <h3 class="card-title">Personalized</h3>
          <p class="card-desc">Choose your preferred stylist and service</p>
        </div>
      </div>
    </div>
  </div>
@endsection

