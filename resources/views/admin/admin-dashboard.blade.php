@extends('layouts.admin')

@section('title', 'Dashboard')

@section('head')
    <link rel="stylesheet" href="/css/admin-dashboard.css">
@endsection

@section('content')
<div class="main-content">
  <div class="header">
    <h2>Staff Dashboard</h2>
    <div class="welcome-msg">Welcome back, Admin User!</div>
  </div>

  <!-- Cards -->
  <div class="cards-container">
    <div class="card">
      <div class="icon"><i class="fas fa-calendar-alt"></i></div>
      <div class="title">Today's Appointments</div>
      <div class="value">0</div>
    </div>
    <div class="card">
      <div class="icon"><i class="fas fa-calendar-week"></i></div>
      <div class="title">This Week</div>
      <div class="value">2</div>
    </div>
    <div class="card">
      <div class="icon"><i class="fas fa-clock"></i></div>
      <div class="title">Available Slots</div>
      <div class="value">12</div>
    </div>
  </div>

  <!-- Schedule Section -->
  <div class="schedule-section">
    <div class="schedule-header">
      <div class="schedule-title">Today’s Schedule</div>
      <a href="{{ route('admin.schedule') }}" class="view-schedule-btn">View Appointments</a>
    </div>
    <div class="schedule-content">No appointments scheduled for today.</div>
  </div>

  <!-- Status Cards -->
  <div class="status-cards">
    <div class="status-card">
      <div class="status-info">
        <div class="number">25</div><br>
        <div class="text">View and Manage Appointments</div><br>
      </div>
      <a href="{{ route('admin.appointment') }}" class="action-btn">Review Bookings</a>
    </div>
    <div class="status-card">
      <div class="status-info">
        <div class="number">8</div><br>
        <div class="text">Customer Details</div><br>
      </div>
      <a href="{{ route('admin.customerdetails') }}" class="action-btn">Contact</a>
    </div>
  </div>
</div>
@endsection

@section('scripts')
    <script>// Example: alert on action button clicks
    document.querySelectorAll('.action-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        alert('Button clicked: ' + btn.textContent);
    });
});
</script>
@endsection
