@extends('layouts.admin')

@section('title', 'Dashboard')

@section('head')
    <link rel="stylesheet" href="/css/admin-dashboard.css">
    <style>
  .dashboard-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 25px;
    background-color: #f5f5f5;
    border-bottom: 1px solid #ddd;
  }

  .dashboard-header h2 {
    font-size: 24px;
    margin: 0;
  }

  .btn {
    background-color: #4CAF50;
    color: white;
    padding: 10px 18px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  .btn:hover {
    background-color: #45a049;
  }

  .cards-wrapper {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 30px;
    margin: 20px 95px;
    flex-wrap: wrap;
    display: flex;
    flex-wrap: wrap;
    margin-bottom: 30px;
  }

  .card {
    background: white;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    text-align: center;
  }

  .card .icon {
    font-size: 28px;
    margin-bottom: 10px;
    color: #0e0e0eff;
  }

  .card .title {
    font-size: 14px;
    color: #888;
    margin-bottom: 5px;
  }

  .card .value {
    font-size: 24px;
    font-weight: bold;
  }

  .status-cards {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin: 0 25px 30px;
  }

  .status-card {
    background: #ffffff;
    flex: 1 1 300px;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    padding: 25px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  .status-info .number {
    font-size: 36px;
    font-weight: bold;
    color: #333;
  }

  .status-info .text {
    font-size: 14px;
    color: #555;
  }

  .action-btn {
    margin-top: 15px;
    padding: 10px 12px;
    background-color: #ae76b3ff;
    color: #fff;
    text-align: center;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
  }

  .action-btn:hover {
    background-color: #563960ff;
    color: whitesmoke;
  }

  .report-section {
    display: none;
    margin: 20px 25px;
    background: #fff;
    padding: 20px;
    border-radius: 12px;
  }
</style>
@endsection

@section('content')
<div class="main-content">

  <!-- Header & Report Generator -->
  <div class="dashboard-header">
    <div>
      <h2>Welcome, {{ Auth::user()->role === 'admin' ? 'Administrator' : 'Salon Manager' }}</h2>
      <p style="margin: 0; color: #666;">Here's a snapshot of current operations.</p>
    </div>
    @auth
    @if(auth()->user()->role === 'admin')
    <form method="POST" action="{{ route('reports.weekly.pdf') }}">
      @csrf
      <button type="submit" class="btn">📄 Generate Weekly Report</button>
    </form>
    @endif
    @endauth
  </div>

  <!-- KPIs Summary Cards -->
  <div class="cards-wrapper">
    <div class="card">
      <div class="icon"><i class="fas fa-calendar-day"></i></div>
      <div class="title">Today’s Appointments</div>
      <div class="value">{{ $todayAppointments ?? '0' }}</div>
    </div>
    <div class="card">
      <div class="icon"><i class="fas fa-calendar-week"></i></div>
      <div class="title">Appointments This Week</div>
      <div class="value">{{ $weekAppointments ?? '0' }}</div>
    </div>
    <div class="card">
      <div class="icon"><i class="fas fa-users"></i></div>
      <div class="title">Total Customers</div>
      <div class="value">{{ $totalCustomers ?? '0' }}</div>
    </div>
  </div>

  <!-- Functional Access Cards -->
  <div class="status-cards">
    <div class="status-card">
      <div class="status-info">
        <div class="number">{{ $totalAppointments ?? '0' }}</div>
        <div class="text">View and Manage Appointments</div>
      </div>
      <a href="{{ route('admin.appointment') }}" class="action-btn">Manage Bookings</a>
    </div>

    <div class="status-card">
      <div class="status-info">
        <div class="number">{{ $totalCustomers ?? '0' }}</div>
        <div class="text">List of Customers</div>
      </div>
      <a href="{{ route('admin.customerdetails') }}" class="action-btn">View Customers</a>
    </div>

    <div class="status-card">
      <div class="status-info">
        <div class="number">✓</div>
        <div class="text">Promotions & Discounts</div>
      </div>
      <a href="{{ route('admin.manage-promo') }}" class="action-btn">Manage Promotions</a>
    </div>

    <div class="status-card">
      <div class="status-info">
        <div class="number">✓</div>
        <div class="text">Service Catalogue</div>
      </div>
      <a href="{{ route('admin.manage-service') }}" class="action-btn">Edit Services</a>
    </div>
  </div>

</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
</script>
@endsection
