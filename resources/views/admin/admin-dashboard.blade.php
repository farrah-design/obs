@extends('layouts.admin')

@section('title', 'Dashboard')

@section('head')
    <link rel="stylesheet" href="/css/admin-dashboard.css">
@endsection

@section('content')
<div class="main-content">
  <form class="header" method="post" action="{{ route('reports.weekly.pdf') }}">
    @csrf
    <h2>Staff Dashboard</h2>
    <div class="welcome-msg">Welcome back, Admin User!</div>
    <button class="btn" >Generate Report</button>
  </form>

  <div class="dashboard-container">
    <div class="cards-container">
    <div class="card">
        <div class="icon"><i class="fas fa-calendar-alt"></i></div>
        <div class="title">Today's Appointments</div>
        <div class="value">0</div>
    </div>
    <div class="card">
        <div class="icon"><i class="fas fa-calendar-week"></i></div>
        <div class="title">This Week</div>
        <div class="value">0</div>
    </div>
    <div class="card">
        <div class="icon"><i class="fas fa-clock"></i></div>
        <div class="title">Available Slots</div>
        <div class="value">0</div>
    </div>
</div>

  <!-- Schedule Section -->
  <div class="schedule-section">
    <div class="schedule-header">
      <div class="schedule-title">Today's Schedule</div>
      <a href="{{ route('admin.schedule') }}" class="view-schedule-btn">0/a>
    </div>
    <div class="schedule-content">
      @if($todaySchedules->count() > 0)
        <ul>
          @foreach($todaysSchedules as $schedule)
            <li>{{ $schedule->customer_name }} - {{ $schedule->service }} ({{ $schedule->time }})</li>
          @endforeach
        </ul>
      @else
        No appointments scheduled for today.
      @endif
    </div>
  </div>

  <!-- Status Cards -->
  <div class="status-cards">
    <div class="status-card">
      <div class="status-info">
        <div class="number">0</div><br>
        <div class="text">View and Manage Appointments</div><br>
      </div>
      <a href="" class="action-btn">Review Bookings</a>
    </div>
    <div class="status-card">
      <div class="status-info">
        <div class="number">0</div><br>
        <div class="text">Registered Customer</div><br>
      </div>
      <a href="" class="action-btn">Contact</a>
    </div>
  </div>
</div>

<!-- Report Section (Hidden by default) -->
<div id="report-section" style="display:none;">
  <div id="report-content" style="padding: 20px; font-family: Arial, sans-serif;"></div>
</div>

<!-- PDF Generation Button -->
<button id="generate-pdf" class="btn btn-primary">Generate Weekly Report</button>

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
</script>
@endsection
