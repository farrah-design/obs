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

 /* Container for the tabs with a light background and rounded corners */
  .tab-container {
    background-color: #eaeaea; /* light gray background similar to image */
    display: flex;
    border-radius: 8px;
    padding: 5px;
    max-width: 224px;
    margin-bottom: 20px;
    text-decoration: none;
  }

  /* Common styles for all tab buttons */
  .tab-btn {
    background: transparent;
    color: #333;
    border: none;
    padding: 8px 16px;
    font-weight: 600;
    font-size: 14px;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.2s ease;
    outline: none;
    margin: 0 2px;
    text-decoration: none;
  }

  /* Style for the active tab button */
  .tab-btn.active {
    background-color: #fff;
  }

  /* Hover effect for all buttons */
  .tab-btn:hover {
    background-color: #ddd;
  }

  /* Responsive style: width adapts to container, optional */
  @media (max-width: 400px) {
    .tab-btn {
      flex: 1;
      width: 1fr;
    }
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
  background-color: #4CAF50; 
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

/* Overlay modal background */
.modal {
  display: none; /* Hidden by default */
  position: fixed; 
  top: 0;
  left: 0;
  width: 100%; 
  height: 100%; 
  background: rgba(0,0,0,0.5); /* semi-transparent background */
  justify-content: center; 
  align-items: center; 
  z-index: 1000;
}

/* Modal content box */
.modal-content {
  background-color: #fff;
  padding: 20px;
  width: 400px;
  max-width: 90%;
  border-radius: 8px;
  box-shadow: 0 2px 20px rgba(0,0,0,0.2);
  position: relative;
}

/* Close button styles */
.close-btn {
  position: absolute;
  top: 10px;
  right: 15px;
  background: none;
  border: none;
  font-size: 20px;
  cursor: pointer;
}

/* Status styles */
#status {
  padding: 4px 10px;
  border-radius: 20px;
  font-size: 12px;
  font-weight: 600;
  display: inline-block;
}

/* Style for "Update Booking" button */
.save-btn {
  padding: 8px 16px;
  background-color: #343a40;
  border: none;
  border-radius: 6px;
  color: #fff;
  font-weight: 600;
  cursor: pointer;
  transition: background-color 0.2s;
}
.save-btn:hover {
  background-color: #00cc58;
}

/* Style for "Cancel" button (matches existing styles) */
.cancel-btn {
  padding: 8px 16px;
  background-color: transparent;
  border: 1px solid #343a40;
  border-radius: 6px;
  color: #343a40;
  font-weight: 600;
  cursor: pointer;
  transition: background-color 0.2s;
}
.cancel-btn:hover {
  background-color: transparent;
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
    <h2>Appointments</h2>
    <div class="welcome-msg">Welcome back, Staff User!</div>
  </div>

<!-- Tabs container -->
<div class="tab-container">
  <a href="staff-appointment.html" class="tab-btn" id="UpcomingBtn">Upcoming</a>
  <a href="staff-past.html" class="tab-btn" id="PastBtn">Past</a>
  <a href="staff-all.html" class="tab-btn active" id="AllBtn">All</a>
</div>

<!-- Appointment Table -->
<table class="appointments-table">
  <thead>
    <tr>
      <th>Date</th>
      <th>Time</th>
      <th>Customer</th>
      <th>Service</th>
      <th>Status</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>2025-05-23</td>
      <td>10:00</td>
      <td>Sakinah</td>
      <td>Haircut</td>
      <td><div class="status-badge confirmed">Confirmed</div></td>
      <td><button class="details-btn" onclick="alert('Details for John Doe')">Details</button></td>
    </tr>
    <tr>
      <td>2025-05-25</td>
      <td>14:00</td>
      <td>Nordin</td>
      <td>Hair Color</td>
      <td><div class="status-badge confirmed">Confirmed</div></td>
      <td><button class="details-btn" onclick="alert('Details for John Doe')">Details</button></td>
    </tr>
    <tr>
      <td>2025-03-23</td>
      <td>10:00</td>
      <td>John Doe</td>
      <td>Haircut & Styling</td>
      <td><div class="status-badge confirmed">Completed</div></td>
      <td><button class="details-btn" onclick="alert('Details for John Doe')">Details</button></td>
    </tr>
    <tr>
      <td>2025-04-25</td>
      <td>14:00</td>
      <td>Jenny</td>
      <td>Haircut</td>
      <td><div class="status-badge confirmed">Completed</div></td>
      <td><button class="details-btn" onclick="alert('Details for John Doe')">Details</button></td>
    </tr>
  </tbody>
</table>

<!-- Popup Overlay for Details -->
<div id="detailsModal" class="modal">
  <div class="modal-content">
    <button class="close-btn" id="closeModal">&times;</button>
    <h3>Booking Details</h3>
    <p><strong>Date:</strong> 2025-05-23</p>
    <p><strong>Time:</strong> 10:00</p>
    <p><strong>Customer:</strong> John Doe</p>
    <p><strong>Service:</strong> Haircut & Styling</p>
    <div class="form-group">
      <label for="status"><strong>Status:</strong></label>
      <select id="status" name="status" required>
        <option value="confirmed">Confirmed</option>
        <option value="cancelled">Cancelled</option>
      </select>
    </div>
    <p><strong>Notes:</strong> First time client, prefers minimal styling.</p>
    <div style="margin-top:20px; display:flex; gap:10px; justify-content:flex-end;">
      <button class="save-btn">Update Booking</button>
      <button class="cancel-btn" onclick="closeModal()">Cancel</button>
    </div>
  </div>
</div>

<script>
  // Toggle active class for tabs
  const buttons = document.querySelectorAll('.tab-btn');

  buttons.forEach(btn => {
    btn.onclick = () => {
      buttons.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
    };
  });

  // For each "Details" button, set to show modal
const modal = document.getElementById('detailsModal');
const closeBtn = document.getElementById('closeModal');

document.querySelectorAll('.details-btn').forEach(btn => {
  btn.onclick = () => {
    modal.style.display = 'flex'; // Show modal
  };
});

// Close modal on clicking close button
closeBtn.onclick = () => {
  modal.style.display = 'none';
};

// Close modal when clicking outside content
window.onclick = (e) => {
  if (e.target === modal) {
    modal.style.display = 'none';
  }
};

// for the "Update Booking" button
document.querySelector('.save-btn').onclick = () => {
  alert('Booking updated!'); // can add save logic here
  closeModal(); // Close modal after saving
};

function closeModal() {
  document.getElementById('detailsModal').style.display = 'none';
}

</script>
</body>
</html>