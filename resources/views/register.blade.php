@extends('layouts.app')

@section('title', 'Register')

@section('head')
  <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="container">
    <!-- Registration Section -->
    <div class="register-section">
      <div class="tabs">
        <a href="/login" class="tab active" id="loginTab">Login</a>
        <a href="/register" class="tab" id="registerTab">Register</a>
      </div>
      <h2 class="create-account-title">Create an Account</h2>
      <form class="register-form" method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
          <label for="fullName">Full Name</label>
          <input type="text" id="fullName" name="name" placeholder="Enter your full name" required />
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="Enter your email" required />
        </div>
        <div class="form-group">
          <label for="phone">Phone Number</label>
          <input type="text" id="phone" name="phone" placeholder="Enter your phone number" required />
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Create a password" required />
        </div>
        <div class="form-group">
          <label for="confirmPassword">Confirm Password</label>
          <input type="password" id="confirmPassword" name="password_confirmation" placeholder="Confirm your password" required />
        </div>
        <button class="btn" type="submit">Create Account</button>
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

