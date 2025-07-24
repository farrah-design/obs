<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
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
  background-color: #e7e3e6;
  border-radius: 10px;
  padding: 8px 12px;
  color: #343a40;
  font-size: 14px;
  cursor: pointer;
  font-weight: 600;
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

/* Action Buttons */
  .actions {
    display: flex;
    gap: 10px;
  }
  .edit-btn {
    background: #fff;
    border: 1px solid #ccc;
    padding: 4px 10px;
    border-radius: 5px;
    font-weight: 500;
    cursor: pointer;
  }
  .delete-btn {
    background: #f44336;
    color: #fff;
    border: none;
    padding: 4px 10px;
    border-radius: 5px;
    font-weight: 500;
    cursor: pointer;
  }

  .filter-section {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 15px;
  padding: 0 10px;
}

.filters {
  display: flex;
  gap: 10px;
  align-items: center;
}

.filters label {
  font-weight: 500;
}

.generate-report-btn {
  background-color: #4CAF50;
  color: white;
  border: none;
  margin: 20px;
  padding: 8px 16px;
  border-radius: 5px;
  cursor: pointer;
  font-weight: 500;
  transition: background-color 0.3s ease;
}

.generate-report-btn:hover {
  background-color: #3e8e41;
}


/* modal.css */

.modal {
  display: none;
  position: fixed;
  z-index: 999;
  left: 0; top: 0;
  width: 100%; height: 100%;
  background-color: rgba(0, 0, 0, 0.4);
  justify-content: center;
  align-items: center;
  padding: 20px;
}

.modal-content {
  background-color: #fff;
  padding: 20px;
  border-radius: 8px;
  width: 100%;
  max-width: 400px;
  box-shadow: 0 5px 15px rgba(0,0,0,0.3);
}

.modal-title {
  margin-top: 0;
  margin-bottom: 15px;
  font-size: 1.5em;
}

.current-appointment-details {
  margin-bottom: 15px;
  background-color: #eceded;
  padding: 10px;
  border-radius: 5px;
}

#rescheduleForm div {
  margin-bottom: 10px;
}

#rescheduleForm label {
  display: block;
  margin-bottom: 4px;
}

#rescheduleForm input,
#rescheduleForm select {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

.note-box {
  background-color: #fff3cd;
  color: #856404;
  padding: 20px;
  border-radius: 4px;
  margin-bottom: 15px;
}

.note-box ul {
  list-style-type: disc;
  padding-left: 20px;
}

.modal-buttons {
  display: flex;
  justify-content: space-between;
}

.cancel-btn {
  padding: 8px 16px;
  background-color: #f44336;
  color: #eee;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.confirm-btn {
  padding: 8px 16px;
  background-color: #4CAF50;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
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
    <h2>Staff Schedule</h2>
  </div>

  <!-- Schedule Section -->
  <div class="schedule-section">
    <div class="schedule-header">
      <div class="schedule-title"></div>
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
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>2025-05-15</td>
      <td>10:00</td>
      <td>Ida</td>
      <td>Haircut</td>
      <td><button class="edit-btn"  onclick="showRescheduleModal()">Reschedule</button>
        <button class="delete-btn">Delete</button></td>
    </tr>
    <tr>
      <td>2025-05-15</td>
      <td>14:00</td>
      <td>Era</td>
      <td>Hair coloring</td>
      <td><button class="edit-btn"  onclick="showRescheduleModal()">Reschedule</button>
        <button class="delete-btn">Delete</button></td>
    </tr>
    <tr>
      <td>2025-05-15</td>
      <td>14:00</td>
      <td>Suni</td>
      <td>Hair coloring</td>
      <td><button class="edit-btn"  onclick="showRescheduleModal()">Reschedule</button>
        <button class="delete-btn">Delete</button></td>
    </tr>
    <tr>
      <td>2025-05-15</td>
      <td>14:00</td>
      <td>Era</td>
      <td>Hair styling</td>
      <td><button class="edit-btn"  onclick="showRescheduleModal()">Reschedule</button>
        <button class="delete-btn">Delete</button></td>
    </tr>
  </tbody>
</table>

<div class="filter-section">
  <div class="filters">
    <label for="filterDate">Date:</label>
    <input type="date" id="filterDate" name="filterDate" />

    <label for="filterStaff">Staff:</label>
    <select id="filterStaff" name="filterStaff">
      <option value="">All</option>
      <option value="Ida">Ida</option>
      <option value="Era">Era</option>
      <option value="Suni">Suni</option>
    </select>
  </div>

  <button class="generate-report-btn" onclick="generateReport()">Generate Report</button>
</div>


<!-- reschedule modal -->
<div class="modal" id="rescheduleModal">
  <div class="modal-content">
    <h2 class="modal-title">Reschedule Appointment</h2>
    <div class="current-appointment-details">
      <p><strong>Service:</strong> Haircut</p>
      <p><strong>Date:</strong> Saturday, March 15, 2025</p>
      <p><strong>Time:</strong> 12:00 AM</p>
    </div>
    <form id="rescheduleForm">
      <div>
        <label for="newDate">New Date</label>
        <input type="date" id="newDate" name="newDate" required />
      </div>
      <div>
        <label for="newTime">New Time</label>
        <select id="newTime" name="newTime" required>
          <option value="">Select a time</option>
          <option value="09:00">09:00 AM</option>
          <option value="10:00">10:00 AM</option>
          <option value="11:00">11:00 AM</option>
          <option value="12:00">12:00 PM</option>
          <!-- Add more time options if needed -->
        </select>
      </div>
      <div class="note-box">
        <strong>⚠️ Please note:</strong>
        <ul>
          <li>Appointments can only be rescheduled at least 24 hours in advance</li>
          <li>Time slots are subject to availability</li>
          <li>You can reschedule up to 2 times per appointment</li>
        </ul>
      </div>
      <div class="modal-buttons">
        <button type="button" class="cancel-btn">Cancel</button>
        <button type="submit" class="confirm-btn">Confirm Reschedule</button>
      </div>
    </form>
  </div>
</div>

<script>
  // Optional: JavaScript for functionality like button clicks can be added here
  document.querySelectorAll('.delete-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      alert('Are you sure you want to delete?');
    });
  });

function showRescheduleModal() {
  rescheduleModal.style.display = 'flex';
}

function hideRescheduleModal() {
  rescheduleModal.style.display = 'none';
}

document.querySelector('.cancel-btn').addEventListener('click', hideRescheduleModal);

window.onclick = (event) => {
  if (event.target === rescheduleModal) {
    hideRescheduleModal();
  }
};

// Handle form submit
document.getElementById('rescheduleForm')?.addEventListener('submit', (e) => {
  e.preventDefault();
  alert('Appointment rescheduled!');
  hideRescheduleModal();
});

  // Filter logic
  const rows = document.querySelectorAll("table tbody tr");

  document.getElementById("filterDate").addEventListener("input", filterTable);
  document.getElementById("filterStaff").addEventListener("change", filterTable);

  function filterTable() {
    const date = document.getElementById("filterDate").value;
    const staff = document.getElementById("filterStaff").value.toLowerCase();

    rows.forEach(row => {
      const rowDate = row.children[0].textContent.trim();
      const rowStaff = row.children[2].textContent.trim().toLowerCase();

      const matchDate = !date || rowDate === date;
      const matchStaff = !staff || rowStaff === staff;

      row.style.display = matchDate && matchStaff ? "" : "none";
    });
  }

  // Generate report logic
  async function generateReport() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    doc.setFontSize(16);
    doc.text("Schedule Report", 14, 20);

    // Prepare table headers and data
    const headers = [["Date", "Time", "Customer", "Service"]];
    const data = [];

    document.querySelectorAll("table tbody tr").forEach(row => {
      if (row.style.display !== "none") {
        const rowData = Array.from(row.children).map(td => td.innerText.trim());
        data.push(rowData);
      }
    });

    if (data.length === 0) {
      alert("No data to generate report.");
      return;
    }

    doc.autoTable({
      head: headers,
      body: data,
      startY: 30,
      theme: 'grid',
      headStyles: { fillColor: [40, 167, 69] }, // green theme
    });

    doc.save("Schedule_Report.pdf");
  }
</script>

</body>
</html>