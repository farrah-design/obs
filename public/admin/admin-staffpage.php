<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Sarlini Salon Appointments</title>
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


.add-btn {
    background-color: #bb3d87;
    color: #fff;
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    font-weight: 600;
    cursor: pointer;
  }
  /* Staff Table */
 .staff-table {
  margin-top: 20px;
  width: 100%;
  border-collapse: collapse;
  background-color: #fff;
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

.staff-table thead {
  background-color: #f2f2f2;
}

.staff-table th {
  padding: 15px;
  text-align: left;
  font-weight: 600;
  font-size: 14px;
}

.staff-table td {
  padding: 15px;
  font-size: 14px;
  border-bottom: 1px solid #eee;
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
  /* Responsive */
  @media(max-width: 768px) {
    .sidebar {
      width: 200px;
    }
    .main {
      margin-left: 200px;
    }
  }

/* Modal Styling */
.modal {
  display: none;
  position: fixed;
  z-index: 2000;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.5);
  justify-content: center;
  align-items: center;
  font-family: 'Segoe UI', sans-serif;
}

.modal-content {
  background-color: #fff;
  padding: 30px 40px;
  border-radius: 12px;
  width: 400px;
  max-width: 90%;
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
}

.modal-header {
  font-size: 20px;
  font-weight: 600;
  margin-bottom: 5px;
}

.modal-subtext {
  font-size: 13px;
  color: #555;
  margin-bottom: 20px;
}

.modal-content label {
  display: block;
  margin-top: 12px;
  font-weight: 500;
  font-size: 14px;
}

.modal-content input,
.modal-content select {
  width: 100%;
  padding: 10px;
  margin-top: 6px;
  border: 1px solid #ccc;
  border-radius: 8px;
  box-sizing: border-box;
  font-size: 14px;
  transition: border-color 0.3s ease;
}

.modal-content input:focus,
.modal-content select:focus {
  border-color: #bb3d87;
  outline: none;
}

.modal-buttons {
  display: flex;
  justify-content: flex-end;
  margin-top: 25px;
  gap: 10px;
}

.cancel-btn,
.save-btn {
  padding: 10px 18px;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  font-weight: 500;
  font-size: 14px;
}

.cancel-btn {
  background-color: #f3f3f3;
  color: #333;
}

.save-btn {
  background-color: #bb3d87;
  color: white;
}

.cancel-btn:hover {
  background-color: #ddd;
}

.save-btn:hover {
  background-color: #a63475;
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
    <h1>Staff Management</h1>
    <button class="add-btn">+ Add Staff</button>
  </div>
  
  <table class="staff-table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Username</th>
        <th>Role</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Maini</td>
        <td>admin@sarlinisalon.com</td>
        <td>admin</td>
        <td>Admin</td>
        <td>
          <div class="actions">
            <button class="edit-btn">Edit</button>
            <button class="delete-btn">Delete</button>
          </div>
        </td>
      </tr>
      <tr>
        <td>Era</td>
        <td>era@sarlinisalon.com</td>
        <td>era</td>
        <td>Staff</td>
        <td>
          <div class="actions">
            <button class="edit-btn">Edit</button>
            <button class="delete-btn">Delete</button>
          </div>
        </td>
      </tr>
      <tr>
        <td>Habib</td>
        <td>habib@sarlinisalon.com</td>
        <td>habib</td>
        <td>Staff</td>
        <td>
          <div class="actions">
            <button class="edit-btn">Edit</button>
            <button class="delete-btn">Delete</button>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</div>

<!-- Edit Staff Modal -->
<div class="modal" id="editModal">
  <div class="modal-content">
    <div class="modal-header">Edit Staff Member</div>
    <p class="modal-subtext">Update staff member details below.</p>
    <form id="editForm">
      <label for="fullName">Full Name</label>
      <input type="text" id="fullName" name="fullName" required />

      <label for="email">Email</label>
      <input type="email" id="email" name="email" required />

      <label for="username">Username</label>
      <input type="text" id="username" name="username" required />

      <label for="phone">Phone Number (Optional)</label>
      <input type="text" id="phone" name="phone" placeholder="0123456789" />

      <label for="role">Role</label>
      <select id="role" name="role" required>
        <option value="Admin">Admin</option>
        <option value="Staff">Staff</option>
      </select>

      <label for="newPassword">New Password (Leave blank to keep current)</label>
      <input type="password" id="newPassword" name="newPassword" />

      <label for="confirmPassword">Confirm Password</label>
      <input type="password" id="confirmPassword" name="confirmPassword" />

      <div class="modal-buttons">
        <button type="button" class="cancel-btn">Cancel</button>
        <button type="submit" class="save-btn">Update Staff</button>
      </div>
    </form>
  </div>
</div>

<!-- Add Staff Modal -->
<div class="modal" id="addModal">
  <div class="modal-content">
    <div class="modal-header">Add Staff Member</div>
    <p class="modal-subtext">Enter details to register a new staff member.</p>
    <form id="addForm">
      <label for="addFullName">Full Name</label>
      <input type="text" id="addFullName" name="fullName" required />

      <label for="addEmail">Email</label>
      <input type="email" id="addEmail" name="email" required />

      <label for="addUsername">Username</label>
      <input type="text" id="addUsername" name="username" required />

      <label for="addPhone">Phone Number (Optional)</label>
      <input type="text" id="addPhone" name="phone" placeholder="0123456789" />

      <label for="addRole">Role</label>
      <select id="addRole" name="role" required>
        <option value="Admin">Admin</option>
        <option value="Staff">Staff</option>
      </select>

      <label for="addPassword">Password</label>
      <input type="password" id="addPassword" name="password" required />

      <label for="addConfirmPassword">Confirm Password</label>
      <input type="password" id="addConfirmPassword" name="confirmPassword" required />

      <div class="modal-buttons">
        <button type="button" class="cancel-btn" id="cancelAdd">Cancel</button>
        <button type="submit" class="save-btn">Add Staff</button>
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
  document.querySelector('.add-btn').addEventListener('click', () => {
    alert('Add Staff button clicked!');
  });

  // Get modal element
  const modal = document.getElementById('editModal');

  // Open modal on Edit button click
  document.querySelectorAll('.edit-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      // Populate form
      document.getElementById('fullName').value = btn.dataset.name;
      document.getElementById('email').value = btn.dataset.email;
      document.getElementById('username').value = btn.dataset.username;
      document.getElementById('role').value = btn.dataset.role;

      // Show modal
      modal.style.display = 'flex';
    });
  });

  // Close modal on cancel button
document.querySelector('.cancel-btn').addEventListener('click', () => {
  modal.style.display = 'none';
});

// Close modal when clicking outside modal content
window.onclick = (event) => {
  if (event.target === modal) {
    modal.style.display = 'none';
  }
};

// Optional: Handle form submission
document.getElementById('editForm').addEventListener('submit', (e) => {
  e.preventDefault();
  alert('Staff member updated!');
  modal.style.display = 'none';
});

// Reference add modal
const addModal = document.getElementById('addModal');

// Show Add Staff Modal
document.querySelector('.add-btn').addEventListener('click', () => {
  addModal.style.display = 'flex';
});

// Close Add Modal
document.getElementById('cancelAdd').addEventListener('click', () => {
  addModal.style.display = 'none';
});

// Close Add Modal when clicking outside
window.addEventListener('click', (event) => {
  if (event.target === addModal) {
    addModal.style.display = 'none';
  }
});

// Handle Add Form Submission
document.getElementById('addForm').addEventListener('submit', (e) => {
  e.preventDefault();
  alert('New staff member added!');
  addModal.style.display = 'none';
  // TODO: Insert logic to send data to backend or update table dynamically
});

</script>
</body>
</html>