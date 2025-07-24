<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Manage Services</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      padding: 0;
      background: #f3f7fa;
    }

    .container {
      max-width: 960px;
      margin: auto;
      margin-top: 30px;
      background: #fff;
      padding: 10px;
      border-radius: 10px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
    }

    h1 {
      text-align: center;
      margin-bottom: 30px;
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

    .catalogue-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
      gap: 20px;
      margin-top: 20px;
    }
    .service-card {
      background: white;
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.08);
      transition: 0.3s;
      position: relative;
    }
    .service-card:hover {
      transform: translateY(-3px);
    }
    .service-card h3 {
      margin-top: 0;
      color: #333;
    }
    .service-card ul {
      padding-left: 20px;
    }
    .action-buttons {
      margin-top: 15px;
      display: flex;
      justify-content: flex-end;
      gap: 10px;
    }
    .btn {
      padding: 6px 12px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-weight: 500;
    }
    .btn-edit {
      background-color: #17a2b8;
      color: white;
    }
    .btn-delete {
      background-color: #d9534f;
      color: white;
    }
    .btn-add {
      background-color: #b21f66;
      color: white;
      padding: 10px 16px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-weight: 500;
      font-weight: bold;
}

.modal-overlay {
  position: fixed;
  top: 0; left: 0;
  width: 100vw; height: 100vh;
  background: rgba(0,0,0,0.5);
  display: none;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}
.modal-overlay.show {
  display: flex;
}
.modal-content {
  background: white;
  border-radius: 10px;
  padding: 25px;
  width: 100%;
  max-width: 500px;
  box-shadow: 0 5px 15px rgba(0,0,0,0.3);
}
.modal-content h2 {
  margin-top: 0;
}
.modal-content label {
  display: block;
  margin-top: 10px;
  font-weight: 500;
}
.modal-content input,
.modal-content textarea {
  width: 100%;
  padding: 8px;
  margin-top: 5px;
  border-radius: 5px;
  border: 1px solid #ccc;
}
.modal-actions {
  margin-top: 20px;
  display: flex;
  justify-content: flex-end;
  gap: 10px;
}
.modal-actions button {
  padding: 8px 14px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}
.modal-actions button:last-child {
  background-color: #b21f66;;
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
    <h1>Manage Services</h1>
    <button class="btn btn-add" onclick="openModal('addServiceForm')">+ Add New Service</button>

    <div class="catalogue-grid">
      <div class="service-card">
        <h3>Haircuts & Styling</h3>
        <p>Professional haircuts tailored to preferences.</p>
        <ul>
          <li>Men & Women Cuts</li>
          <li>Bridal & Special Occasion</li>
          <li>Kids Cuts</li>
        </ul>
        <div class="action-buttons">
          <button class="btn btn-edit">Edit</button>
          <button class="btn btn-delete">Delete</button>
        </div>
      </div>

      <div class="service-card">
        <h3>Hair Coloring</h3>
        <p>Expert color techniques from highlights to balayage.</p>
        <ul>
          <li>Highlights & Lowlights</li>
          <li>Balayage & Ombre</li>
        </ul>
        <div class="action-buttons">
          <button class="btn btn-edit">Edit</button>
          <button class="btn btn-delete">Delete</button>
        </div>
      </div>

      <div class="service-card">
        <h3>Hair Extensions</h3>
        <p>Add volume with premium extensions.</p>
        <ul>
          <li>Braids Extensions</li>
          <li>Fusion Extensions</li>
        </ul>
        <div class="action-buttons">
          <button class="btn btn-edit">Edit</button>
          <button class="btn btn-delete">Delete</button>
        </div>
      </div>

      <div class="service-card">
        <h3>Perms & Texture Services</h3>
        <p>Achieve curls, waves, or straightening.</p>
        <ul>
          <li>Perms</li>
          <li>Straightening</li>
          <li>Wave & Curl Enhancements</li>
        </ul>
        <div class="action-buttons">
          <button class="btn btn-edit">Edit</button>
          <button class="btn btn-delete">Delete</button>
        </div>
      </div>

      <div class="service-card">
        <h3>Add-On Services</h3>
        <p>Extras for finishing touch like blow dry & masks.</p>
        <ul>
          <li>Blow Dry & Styling</li>
        </ul>
        <div class="action-buttons">
          <button class="btn btn-edit">Edit</button>
          <button class="btn btn-delete">Delete</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Edit Service Modal -->
<div class="modal-overlay" id="editModal">
  <div class="modal-content">
    <h2>Edit Service</h2>
    <form id="editServiceForm">
      <label>Service Name</label>
      <input type="text" id="editName" required />

      <label>Description</label>
      <textarea id="editDescription" rows="3" required></textarea>

      <label>Details / Options</label>
      <textarea id="editDetails" rows="4"></textarea>

      <div class="modal-actions">
        <button type="button" onclick="closeModal('editModal')">Cancel</button>
        <button type="submit">Update</button>
      </div>
    </form>
  </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal-overlay" id="deleteModal">
  <div class="modal-content">
    <h2>Delete Service</h2>
    <p>Are you sure you want to delete this service?</p>
    <div class="modal-actions">
      <button onclick="closeModal('deleteModal')">Cancel</button>
      <button onclick="confirmDelete()">Delete</button>
    </div>
  </div>
</div>

<!-- Add New Service Modal -->
<div class="modal-overlay" id="addModal">
  <div class="modal-content">
    <h2>Add New Service</h2>
    <form id="addServiceForm">
      <label>Service Name</label>
      <input type="text" id="addName" required />

      <label>Description</label>
      <textarea id="addDescription" rows="3" required></textarea>

      <label>Details / Options</label>
      <textarea id="addDetails" rows="4"></textarea>

      <div class="modal-actions">
        <button type="button" onclick="closeModal('addModal')">Cancel</button>
        <button type="submit">Add</button>
      </div>
    </form>
  </div>
</div>

<script>
  // Open specific modal
  function openModal(id) {
    document.getElementById(id).classList.add('show');
  }

  // Close modal
  function closeModal(id) {
    document.getElementById(id).classList.remove('show');
  }

  // Trigger Add Modal
  document.querySelector('.btn-add').addEventListener('click', () => openModal('addModal'));

  // Trigger Edit Modal for all .btn-edit
  document.querySelectorAll('.btn-edit').forEach(btn => {
    btn.addEventListener('click', () => openModal('editModal'));
  });

  // Trigger Delete Modal
  document.querySelectorAll('.btn-delete').forEach(btn => {
    btn.addEventListener('click', () => openModal('deleteModal'));
  });

  function confirmDelete() {
    alert('Service deleted!');
    closeModal('deleteModal');
  }

  // Handle Add Service
  document.getElementById('addServiceForm').addEventListener('submit', function(e) {
    e.preventDefault();
    alert('Service added successfully!');
    closeModal('addModal');
  });

  // Handle Edit Service
  document.getElementById('editServiceForm').addEventListener('submit', function(e) {
    e.preventDefault();
    alert('Service updated!');
    closeModal('editModal');
  });
</script>

</body>
</html>
