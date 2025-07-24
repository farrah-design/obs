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

.btn {
  background-color: #bb3d87;
  border-radius: 5px;
  border: none;
  padding: 8px 12px;
  color: #ffffff;
  font-size: 14px;
  cursor: pointer;
  font-weight: 600;
}

.btn:hover {
  background-color: #e22a95;
}


.schedule-content {
  text-align: center;
  font-size: 14px;
  color: #999;
  margin-top: 50px;
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
}

.action-btn:hover {
  background-color: #343a40;
  color: #fff;
}

#modalOverlay {
    display: none; /* Hidden by default */
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center;
    z-index: 9999;
  }

  #modalOverlay.show {
    display: flex;
  }

  .popup {
    background: #fff;
    border-radius: 8px;
    width: 400px;
    max-width: 90%;
    padding: 20px;
    font-family: Arial, sans-serif;
    box-shadow: 0 4px 20px rgba(0,0,0,0.2);
  }

  .popup h2 {
    margin-top: 0;
    font-size: 16px;
    font-weight: bold;
  }

  .popup form .form-group {
    margin-bottom: 15px;
  }

  .popup form .form-group label {
    display: block;
    font-weight: 600;
    font-size: 14px;
    margin-bottom: 6px;
  }

  .popup form select,
  .popup form input[type="text"],
  .popup form input[type="time"] {
    width: 100%;
    padding: 8px 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 14px;
    box-sizing: border-box;
  }

  .popup .btn-group {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 20px;
  }

  .popup button.cancel-btn {
    background-color: #e0e0e0;
    border: none;
    padding: 8px 16px;
    border-radius: 4px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.3s;
  }

  .popup button.cancel-btn:hover {
    background-color: #c8c8c8;
  }

  .popup button.save-btn {
    background-color: #343a40;
    color: #fff;
    border: none;
    padding: 8px 16px;
    border-radius: 4px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.3s;
  }

  .popup button.save-btn:hover {
    background-color: #343a40;
  }

 /* Table Styles */
.appointments-table {
  width: 100%;
  border-collapse: collapse;
  background-color: #fff;
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

.appointments-table thead {
  background-color: #f2f2f2;
}

.appointments-table th {
  padding: 15px;
  text-align: left;
  font-weight: 600;
  font-size: 14px;
}

.appointments-table td {
  padding: 15px;
  font-size: 14px;
  border-bottom: 1px solid #eee;
}

/* Status badge styles */
.status-badge {
  padding: 4px 10px;
  border-radius: 20px;
  font-size: 12px;
  font-weight: 600;
  color: white;
  display: inline-block;
}

.confirmed {
  background-color: #4CAF50; /* Green */
}

/* Actions button */
.details-btn {
  padding: 6px 12px;
  border: none;
  background-color: #b51f5d;
  color: #fff;
  border-radius: 4px;
  cursor: pointer;
  font-weight: 600;
  font-size: 14px;
  transition: background-color 0.3s;
}

.details-btn:hover {
  background-color: #8f1742;
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
    <h2>Schedule</h2>
    <div class="welcome-msg">Welcome back, Admin User!</div>
  </div>

  <!-- Schedule Section -->
  <div class="schedule-section">
    <div class="schedule-header">
      <div class="schedule-title">Today’s Schedule</div>
      <button onclick="showModal()" class="btn" id="addAvailabilityBtn">+ Add Availability</button>
    </div>
    <div class="schedule-content"></div>
    <!-- Schedule table -->
    <table class="appointments-table">
  <thead>
    <tr>
      <th>Date</th>
      <th>Time</th>
      <th>Customer</th>
      <th>Service</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>2025-05-23</td>
      <td>10:00</td>
      <td>Sakinah</td>
      <td>Haircut</td>
      <td><div class="status-badge confirmed">Confirmed</div></td>
    </tr>
    <tr>
      <td>2025-05-25</td>
      <td>14:00</td>
      <td>Nordin</td>
      <td>Hair coloring</td>
      <td><div class="status-badge confirmed">Confirmed</div></td>
    </tr>
  </tbody>
</table>


<!-- Modal Overlay -->
<div id="modalOverlay">
  <div class="popup">
    <h2>Add Availability</h2>
    <p>Set your availability for a specific day of the week.</p>
    <form id="availabilityForm">
      <div class="form-group">
        <label for="day">Day</label>
        <select id="day" name="day" required>
          <option value="Monday">Monday</option>
          <option value="Tuesday">Tuesday</option>
          <option value="Wednesday">Wednesday</option>
          <option value="Thursday">Thursday</option>
          <option value="Friday">Friday</option>
          <option value="Saturday">Saturday</option>
          <option value="Sunday">Sunday</option>
        </select>
      </div>
      <div class="form-group">
        <label for="status">Status</label>
        <select id="status" name="status" required>
          <option value="Available">Available</option>
          <option value="Unavailable">Unavailable</option>
        </select>
      </div>
      <div class="form-group">
        <label for="startTime">Start Time</label>
        <input type="time" id="startTime" name="startTime" required />
      </div>
      <div class="form-group">
        <label for="endTime">End Time</label>
        <input type="time" id="endTime" name="endTime" required />
      </div>
      <div class="btn-group">
        <button type="button" class="cancel-btn" onclick="closeModal()">Cancel</button>
        <button type="submit" class="save-btn">Save Availability</button>
      </div>
    </form>
  </div>
</div>


<script>
  // Show modal popup
  function showModal() {
    document.getElementById('modalOverlay').classList.add('show');
  }

  // Close modal popup
  function closeModal() {
    document.getElementById('modalOverlay').classList.remove('show');
  }

  // Handle form submit
  document.getElementById('availabilityForm').addEventListener('submit', function(e) {
    e.preventDefault();
    alert('Availability saved!');
    closeModal();
  });

  // Close modal when clicking outside
  document.getElementById('modalOverlay').addEventListener('click', function(e) {
    if (e.target === document.getElementById('modalOverlay')) {
      closeModal();
    }
  });

</script>

</body>
</html>