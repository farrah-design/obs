<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Sarlini Salon Dashboard</title>
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
<style>
    /* Reset & Basic Styles */
body {
  margin: 0;
  font-family: 'Arial', sans-serif;
  background-color: #f8f9fa;
  color: #333;
}

/* Sidebar */
.sidebar {
  width: 250px;
  height: 100vh;
  background-color: #fff;
  position: fixed;
  top: 0;
  left: 0;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  padding: 20px;
  box-shadow: 2px 0 10px rgba(0,0,0,0.05);
  box-sizing: border-box;
}

.sidebar-top {
  display: flex;
  flex-direction: column;
}

.logo {
  font-weight: bold;
  font-size: 18px;
  margin-bottom: 40px;
  color: #222;
  text-align: center;
}

.menu {
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.menu-item {
  display: flex;
  align-items: center;
  padding: 10px 15px;
  border-radius: 8px;
  cursor: pointer;
  font-size: 14px;
  transition: background 0.2s;
}

.menu-item:hover {
  background-color: #f1f1f1;
}

.menu-item i {
  margin-right: 12px;
  font-size: 18px;
  color: #555;
}

.menu a {
    text-decoration: none;
    color: #343a40;
}

/* Logout button at bottom */
.sidebar-bottom {
  display: flex;
  justify-content: flex-start;
}

.logout-btn {
  padding: 8px 16px;
  border: 1px solid #343a40;
  background-color: transparent;
  color: #343a40;
  border-radius: 6px;
  font-weight: 600;
  cursor: pointer;
  transition: background-color 0.2s, color 0.2s;
}

.logout-btn:hover {
  background-color: #343a40;
  color: #fff;
}

/* Main content */
.main-content {
  margin-left: 250px;
  padding: 20px 30px 40px 30px;
  box-sizing: border-box;
}

/* Header section */
.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
}

.header h2 {
  font-size: 24px;
  font-weight: 600;
  margin: 0;
}

.welcome-msg {
  font-size: 14px;
  color: #999;
}

/* Cards container */
.cards-container {
  display: flex;
  gap: 20px;
  flex-wrap: wrap;
  margin-bottom: 30px;
}

/* Individual cards */
.card {
  background-color: #fff;
  width: 250px;
  border-radius: 15px;
  padding: 20px;
  box-shadow: 0 5px 10px rgba(0,0,0,0.010);
  display: flex;
  flex-direction: column;
  align-items: center;
  transition: box-shadow 0.2s;
}

.card:hover {
  box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.icon {
  font-size: 20px;
  color: #343a40;
  margin-bottom: 10px;
}

.title {
  font-size: 14px;
  color: #999;
  text-align: center;
  margin-bottom: 8px;
}

.value {
  font-size: 24px;
  font-weight: 600;
  color: #222;
}

/*profile*/
.user-info {
  display: flex;
  margin-left: 10px;
  align-items: center;
  gap: 10px;
  cursor: pointer;
}

.user-avatar {
  width: 40px;
  height: 40px;
  background: #343a40;
  color: #fff;
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 50%;
  font-weight: bold;
}

.user-role {
  font-size: 12px;
  color: #777;
}


/* Schedule section */
.schedule-section {
  background-color: #fff;
  border-radius: 15px;
  padding: 20px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.05);
  margin-bottom: 30px;
}

.schedule-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 15px;
}

.schedule-title {
  font-size: 16px;
  font-weight: 600;
  color: #333;
}

.view-schedule-btn {
  background-color: #e7e3e6;
  border-radius: 10px;
  padding: 8px 12px;
  color: #343a40;
  font-size: 14px;
  cursor: pointer;
  font-weight: 600;
  text-decoration: none;
}

.view-schedule-btn:hover {
  background-color: #92497a;
  color: #f1f1f1;
}


.schedule-content {
  text-align: center;
  font-size: 14px;
  color: #999;
  margin-top: 50px;
}

/* Status cards */
.status-cards {
  display: flex;
  gap: 20px;
  margin-top: 20px;
  border-radius: 15px;
}

.status-card {
    background-color: #e8e8e8;
  width: 250px;
  border-radius: 15px;
  padding: 20px;
  box-shadow: 0 5px 10px rgba(0,0,0,0.010);
  display: flex;
  flex-direction: column;
  align-items: center;
  transition: box-shadow 0.2s;
}

.status-info {
  display: flex;
  align-items: center;
  flex-direction: column;
  margin-bottom: 10px;
  font-weight: 600;
}

.number {
  font-size: 16px;
  font-weight: 600;
  color: #222;
}

.text {
  font-size: 12px;
  color: #090909;
}

/* Action buttons in status cards (similar style) */
.action-btn {
  padding: 8px 12px;
  background-color: #fff;
  border: 1px solid #343a40;
  border-radius: 6px;
  font-weight: 600;
  font-size: 12px;
  color: #343a40;
  cursor: pointer;
  transition: background-color 0.2s, color 0.2s;
  text-decoration: none;
}

.action-btn:hover {
  background-color: #343a40;
  color: #fff;
}
</style>
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
      <a href="staff-dashboard.html" class="menu-item"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
      <a href="staff-schedule.html" class="menu-item"><i class="fas fa-concierge-bell"></i> Schedule</a>
      <a href="staff-appointment.html" class="menu-item"><i class="fas fa-book-open"></i> Appointment</a>
      <a href="staff-custlist.html" class="menu-item"><i class="fas fa-user-friends"></i> Customer List</a>
      <a href="staff-feedback.html" class="menu-item"><i class="fas fa-tachometer-alt"></i> Feedback</a>
    </div>
  </div>
  <div class="sidebar-bottom">
    <button class="logout-btn">Logout</button>
  </div>
</div>

<div class="main-content">
  <div class="header">
    <h2>Staff Dashboard</h2>
    <div class="welcome-msg">Welcome back, Staff User!</div>
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
      <a href="staff-schedule.html" class="view-schedule-btn">View Appointments</a>
    </div>
    <div class="schedule-content">No appointments scheduled for today.</div>
  </div>

  <!-- Status Cards -->
  <div class="status-cards">
    <div class="status-card">
      <div class="status-info">
        <div class="number">25</div><br>
        <div class="text">View Appointments</div><br>
      </div>
      <a href="staff-appointment.html" class="action-btn">Review Bookings</a>
    </div>
    <div class="status-card">
      <div class="status-info">
        <div class="number">8</div><br>
        <div class="text">Customer Details</div><br>
      </div>
      <a href="staff-custlist.html" class="action-btn">Contact</a>
    </div>
  </div>
</div>

<!-- JavaScript for button interactions if needed -->
<script>
    // Example: alert on action button clicks
document.querySelectorAll('.action-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        alert('Button clicked: ' + btn.textContent);
    });
});
</script>

</body>
</html>