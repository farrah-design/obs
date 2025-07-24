<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sarlini Salon Manager Panel</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  <style>
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
    .main-content {
      margin-left: 240px;
      padding: 30px;
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .header h1 {
      font-size: 24px;
    }

    .btn {
      padding: 8px 16px;
      background-color: #27ae60;
      border: none;
      color: white;
      border-radius: 5px;
      cursor: pointer;
    }

    table {
      width: 100%;
      margin-top: 20px;
      border-collapse: collapse;
      background: #fff;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }

    th, td {
      padding: 12px;
      border-bottom: 1px solid #ddd;
      font-size: 14px;
      text-align: left;
    }

    th {
      background-color: #ecf0f1;
    }

    .badge {
      padding: 5px 10px;
      border-radius: 15px;
      font-size: 12px;
      font-weight: bold;
      color: white;
    }

    .confirmed { background: #2ecc71; }
    .upcoming { background: #f39c12; }
    .completed { background: #3498db; }

    .actions button {
      padding: 5px 10px;
      margin-right: 5px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      color: #fff;
    }

    .edit-btn { background: #3498db; }
    .delete-btn { background: #e74c3c; }
    .reply-btn { 
        background: #fff;
        border: 1px solid #ccc;
        padding: 4px 10px;
        border-radius: 5px;
        font-weight: 500;
        cursor: pointer;
    }

    .modal-overlay {
      display: none;
      position: fixed;
      top: 0; left: 0; right: 0; bottom: 0;
      background-color: rgba(0, 0, 0, 0.5);
      justify-content: center;
      align-items: center;
      z-index: 1000;
    }

    .modal-overlay.active { display: flex; }

    .modal-content {
      background: #fff;
      padding: 25px;
      width: 400px;
      border-radius: 8px;
      box-shadow: 0 0 15px rgba(0,0,0,0.2);
    }

    .modal-content textarea {
      width: 100%;
      height: 100px;
      padding: 10px;
      margin: 10px 0;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    .modal-buttons {
      display: flex;
      justify-content: space-between;
    }

    .cancel-btn {
      background: #7f8c8d;
    }

    .submit-btn {
      background: #27ae60;
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
      <a href="staff-feedback.html" class="menu-item"><i class="fas fa-tachometer-alt"></i> Feedback</a>
    </div>
  </div>
  <div class="sidebar-bottom">
    <button class="logout-btn">Logout</button>
  </div>
</div>

<div class="main-content">
  <div class="header">
    <h1>Customer Feedback</h1>
    <button class="btn" onclick="generateReport()">Generate Report</button>
  </div>

  <table>
    <thead>
      <tr>
        <th>Customer</th>
        <th>Service</th>
        <th>Feedback</th>
        <th>Date</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody id="feedbackTableBody">
      <!-- Feedback rows will be populated by JavaScript -->
    </tbody>
  </table>
</div>

<!-- Reply Modal -->
<div class="modal-overlay" id="replyModal">
  <div class="modal-content">
    <h3>Reply to Feedback</h3>
    <textarea id="replyText" placeholder="Write your response..."></textarea>
    <div class="modal-buttons">
      <button class="btn cancel-btn" onclick="closeModal()">Cancel</button>
      <button class="btn submit-btn" onclick="submitReply()">Send Reply</button>
    </div>
  </div>
</div>

<script>
  const feedbackData = [
    {
      customer: "Amira",
      service: "Haircut",
      feedback: "Loved the service!",
      date: "2025-06-23"
    },
    {
      customer: "Jason",
      service: "Facial",
      feedback: "It was good, but slow.",
      date: "2025-06-22"
    }
  ];

  function populateTable() {
    const tbody = document.getElementById("feedbackTableBody");
    feedbackData.forEach((item, index) => {
      const row = document.createElement("tr");
      row.innerHTML = `
        <td>${item.customer}</td>
        <td>${item.service}</td>
        <td>${item.feedback}</td>
        <td>${item.date}</td>
        <td>
          <button class="reply-btn" onclick="openModal(${index})">Reply</button>
        </td>
      `;
      tbody.appendChild(row);
    });
  }

  function openModal(index) {
    document.getElementById("replyModal").classList.add("active");
    document.getElementById("replyText").dataset.index = index;
  }

  function closeModal() {
    document.getElementById("replyModal").classList.remove("active");
    document.getElementById("replyText").value = "";
  }

  function submitReply() {
    const index = document.getElementById("replyText").dataset.index;
    const replyMessage = document.getElementById("replyText").value;
    if (replyMessage.trim()) {
      alert("Reply sent to " + feedbackData[index].customer + ": " + replyMessage);
      closeModal();
    } else {
      alert("Please enter a message.");
    }
  }

  function generateReport() {
    alert("Report generated as PDF (to be integrated with backend).");
  }

  // Initialize table on load
  window.onload = populateTable;
</script>

</body>
</html>
