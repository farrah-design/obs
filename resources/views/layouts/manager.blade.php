<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Sarlini')</title>
    <link rel="stylesheet" href="/css/staff-dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    @yield('head') 
</head>
<body>
    <div class="sidebar">
  <div class="sidebar-top">
    <div class="logo">Sarlini Salon</div>
    <div class="user-info">
    <div class="user-avatar">M</div>
      <div>
        <strong>Manager</strong>
        <div class="user-role">Staff</div>
      </div>
    </div><br><br>
    <div class="menu">
      <a href="{{ route('manager.dashboard') }}" class="menu-item"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
      <a href="{{ route('manager.schedule') }}" class="menu-item"><i class="fas fa-concierge-bell"></i> Schedule</a>
      <a href="{{ route('manager.appointment') }}" class="menu-item"><i class="fas fa-book-open"></i> Appointment</a>
      <a href="{{ route('manager.custlist') }}" class="menu-item"><i class="fas fa-user-friends"></i> Customer List</a>
      <a href="{{ route('manager.feedback') }}" class="menu-item"><i class="fas fa-tachometer-alt"></i> Feedback</a>
      <a href="{{ route('manager.profile') }}" class="menu-item"><i class="fas fa-user-friends"></i>Manage Profile</a>
    </div>
  </div>
  <div class="sidebar-bottom">
    <a href="#" class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
  </div>
  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>
@yield('content')
@yield('scripts')
</body>
</html>
