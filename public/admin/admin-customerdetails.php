<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Sarlini Salon Appointments</title>
<!-- Font Awesome for icons (if needed) -->
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

.header input[type=text] {
  float: right;
  padding: 6px;
  border: none;
  margin-top: 8px;
  margin-right: 16px;
  font-size: 17px;
}

/* When the screen is less than 600px wide, stack the links and the search field vertically instead of horizontally */
@media screen and (max-width: 600px) {
  .header a, .header input[type=text] {
    float: none;
    display: block;
    text-align: left;
    width: 100%;
    margin: 0;
    padding: 14px;
  }
  .header input[type=text] {
    border: 1px solid #ccc;
  }
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

 /* Container for multiple customer cards */
  .cards-container {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    margin-bottom: 30px;
  }

  /* Customer card styles */
  .customer-card {
    background-color: #fdf0f4;
    border-radius: 10px;
    padding: 20px;
    display: flex;
    flex-direction: column;  
    flex-wrap: wrap;
    max-width: 300px;
    width: 300px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    margin-left: 0px;
  }


  /* Customer info styles */
  .customer-header {
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .avatar {
    width: 50px;
    height: 50px;
    background-color: transparent; /* Same as before */
    color: #4b3d4a;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-weight: 600;
    font-size: 1.2em;
    border: 2px solid #4b3d4a;
  }

  .customer-info {
    display: flex;
    flex-direction: column;
  }

  .name {
    font-weight: 600;
    font-size: 1.2em;
  }

  .email {
    color: #555;
    font-size: 0.9em;
  }

  /* Contact info styles */
  .contact-info {
    margin-top: 15px;
    display: flex;
    flex-direction: column;
    gap: 10px;
  }

  .contact {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 0.95em;
  }

  /* Button styles */
  .view-appointments {
    margin-top: 20px;
    padding: 10px 15px;
    border: none;
    background-color: #4b3d4a;
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.2s;
  }

  .view-appointments:hover {
    background-color: #695358;
  }
</style>
</head>
<body>

  <div class="sidebar">
  <div class="sidebar-top">
    <div class="logo">Sarlini Salon</div>
    <div class="user-info">
      <div class="user-avatar">AU</div>
      <div>
        <strong>Admin User</strong>
        <div class="user-role">Admin</div>
      </div>
    </div><br><br>
    <div class="menu">
      <a href="admin-dashboard.html" class="menu-item"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
      <a href="manageService.html" class="menu-item"><i class="fas fa-book-open"></i> Manage Services</a>
      <a href="admin-schedule.html" class="menu-item"><i class="fas fa-concierge-bell"></i> Schedule</a>
      <a href="admin-appointment.html" class="menu-item"><i class="fas fa-book-open"></i> Appointment</a>
      <a href="admin-customerdetails.html" class="menu-item"><i class="fas fa-user-friends"></i> Customer List</a>
      <a href="admin-staffpage.html" class="menu-item"><i class="fas fa-user-friends"></i> Staff Area</a>
      <a href="manageNoti.html" class="menu-item"><i class="fas fa-tachometer-alt"></i> Manage Notifications</a>
      <a href="admin-feedback.html" class="menu-item"><i class="fas fa-tachometer-alt"></i> Feedback</a>
      <a href="managePromo.html" class="menu-item"><i class="fas fa-book-open"></i> Manage Promotions & Discounts</a>
    </div>
  </div>
  <div class="sidebar-bottom">
    <button class="logout-btn">Logout</button>
  </div>
</div>

<div class="main-content">
  <div class="header">
    <h2>Customer List</h2>
    <input type="text" placeholder="Search..">
  </div>

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
      <a href="admin-appointment.html" class="view-appointments">View Appointments</a>
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
      <a href="admin-appointment.html" class="view-appointments">View Appointments</a>
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
      <a href="admin-appointment.html" class="view-appointments">View Appointments</a>
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

</body>
</html>