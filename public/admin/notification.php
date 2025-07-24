<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  <title>Manage Notifications</title>
  <style>
    body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f4f6f8;
      margin: 0;
      padding: 30px;
      color: #333;
    }

    .container {
      max-width: 960px;
      margin: auto;
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
    }

    h1 {
      text-align: center;
      margin-bottom: 30px;
      color: #222;
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

    .appointment-header {
      display: flex;
      justify-content: flex-end;
      margin-bottom: 20px;
    }

    .btn-remind {
      background: #b21f66;
      color: white;
      padding: 10px 18px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-weight: 600;
      transition: background 0.3s ease;
    }

    .btn-remind:hover {
      background: #a11c5d;
    }

    .appointment-table {
      width: 100%;
      border-collapse: collapse;
    }

    .appointment-table th,
    .appointment-table td {
      padding: 14px;
      border-bottom: 1px solid #eee;
      text-align: left;
    }

    .appointment-table th {
      background-color: #fafafa;
    }

    .badge {
      padding: 5px 10px;
      border-radius: 12px;
      font-size: 0.85rem;
    }

    .badge.upcoming {
      background-color: #ffc107;
      color: #333;
    }

    .btn-action {
      padding: 6px 12px;
      border: none;
      border-radius: 4px;
      font-size: 0.9rem;
      cursor: pointer;
      background-color: #17a2b8;
      color: white;
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

  <div class="container">
    <h1>Manage Notifications</h1>

    <div class="appointment-header">
      <button class="btn-remind" onclick="sendReminders()">Send Reminder Notifications</button>
    </div>

    <table class="appointment-table">
      <thead>
        <tr>
          <th>Customer</th>
          <th>Service</th>
          <th>Date</th>
          <th>Time</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody id="appointmentBody">
        <tr>
          <td>Sakinah</td>
          <td>Haircut</td>
          <td>2025-06-25</td>
          <td>10:00 AM</td>
          <td><span class="badge upcoming">Upcoming</span></td>
          <td><button class="btn-action" onclick="remindCustomer('Aisyah Rahim')">Remind</button></td>
        </tr>
        <tr>
          <td>Nordin</td>
          <td>Hair Color</td>
          <td>2025-06-26</td>
          <td>02:00 PM</td>
          <td><span class="badge upcoming">Upcoming</span></td>
          <td><button class="btn-action" onclick="remindCustomer('Farid Nordin')">Remind</button></td>
        </tr>
      </tbody>
    </table>
  </div>

  <script>
    function remindCustomer(name) {
      alert(`Reminder sent to ${name} about their upcoming appointment.`);
    }

    function sendReminders() {
      const names = Array.from(document.querySelectorAll('#appointmentBody tr')).map(row => row.cells[0].innerText);
      names.forEach(name => remindCustomer(name));
    }
  </script>
</body>
</html>

