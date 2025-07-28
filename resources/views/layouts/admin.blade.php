<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sarlini')</title>
    <link rel="stylesheet" href="/css/admin-dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    @yield('head') 
</head>
<body>
    <div class="sidebar">
  <div class="sidebar-top">
    <div class="logo">Sarlini Salon</div>
    <div class="user-info">
    @auth
    @if(auth()->user()->role === 'admin')
    <div class="user-avatar">AU</div>
    @elseif(auth()->user()->role === 'manager')
    <div class="user-avatar">MU</div>
    @endif
    @endauth
    <div>
    @auth
    @if(auth()->user()->role === 'admin')
    <strong>Admin User</strong>
    <div class="user-role">Admin</div>
    @elseif(auth()->user()->role === 'manager')
    <strong>Manager User</strong>
    <div class="user-role">Manager</div>
    @endif
    @endauth
    </div>
    </div><br><br>
    <div class="menu">
      @auth
        
      <a href="{{ route('admin.dashboard') }}" class="menu-item"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
      <a href="{{ route('admin.manage-schedule') }}" class="menu-item"><i class="fas fa-concierge-bell"></i> Schedule</a>
      <a href="{{ route('admin.appointment') }}" class="menu-item"><i class="fas fa-book-open"></i> Appointment</a>
      <a href="{{ route('admin.customerdetails') }}" class="menu-item"><i class="fas fa-user-friends"></i> Customer List</a>
      <a href="{{ route('admin.feedback') }}" class="menu-item"><i class="fas fa-tachometer-alt"></i> Feedback</a>
      <a href="{{ route('admin.profile') }}" class="menu-item"><i class="fas fa-user-friends"></i>Manage Profile</a>

      @if(auth()->user()->role === 'admin')
      <a href="{{ route('admin.manage-service') }}" class="menu-item"><i class="fas fa-book-open"></i> Manage Services</a>
      <a href="{{ route('admin.notification') }}" class="menu-item"><i class="fas fa-tachometer-alt"></i> Manage Notifications</a>
      <a href="{{ route('admin.manage-promo') }}" class="menu-item"><i class="fas fa-book-open"></i> Manage Promotions & Discounts</a>
      @endif

      @endauth
    </div>
  </div>
  <div class="sidebar-bottom">
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      @csrf
    </form>
    <a href="{{ route('logout') }}" class="logout-btn"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
      Logout
    </a>
  </div>
</div>
@yield('content')
@yield('scripts')
</body>
</html>
