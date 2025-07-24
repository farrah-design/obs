@extends('layouts.manager')

@section('title', 'Customer Details')

@section('head')
  <link rel="stylesheet" href="{{ asset('css/staff-custlist.css') }}">
@endsection

@section('content') 
<div class="main-content">
  <div class="header">
    <h2>Customer List</h2>
    <input type="text" placeholder="Search..">
  </div>

  <div class="section">
  <!-- Container for multiple customer cards -->
  <div class="cards-container">
    <!-- Customer Card 1 -->
    <div class="customer-card">
      <div class="customer-header">
        <div class="avatar">JD</div>
        <div class="customer-info">
          <div class="name">John Doe</div>
          <div class="email">john.doe@example.com</div>
        </div>
      </div>
      <a href="{{ route('manager.appointment')}}" class="view-appointments">View Appointments</a>
      <div class="contact-info">
        <div class="contact">
          <span>📞</span>
          <span>555-666-7777</span>
        </div>
        <div class="contact">
          <span>👤</span>
          <span>john.doe</span>
        </div>
      </div>
    </div>
    <!-- Customer Card 2 -->
    <div class="customer-card">
      <div class="customer-header">
        <div class="avatar">S</div>
        <div class="customer-info">
          <div class="name">Sakinah</div>
          <div class="email">Sakinah.h@example.com</div>
        </div>
      </div>
      <a href="{{ route('manager.appointment')}}" class="view-appointments">View Appointments</a>
      <div class="contact-info">
        <div class="contact">
          <span>📞</span>
          <span>012-345-6789</span>
        </div>
        <div class="contact">
          <span>👤</span>
          <span>sa.kinah</span>
        </div>
      </div>
    </div>
    <!-- Customer Card 3 -->
    <div class="customer-card">
      <div class="customer-header">
        <div class="avatar">N</div>
        <div class="customer-info">
          <div class="name">Nordin</div>
          <div class="email">Nordin.m@example.com</div>
        </div>
      </div>
      <a href="{{ route('manager.appointment')}}" class="view-appointments">View Appointments</a>
      <div class="contact-info">
        <div class="contact">
          <span>📞</span>
          <span>012-345-6789</span>
        </div>
        <div class="contact">
          <span>👤</span>
          <span>nordin</span>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection


