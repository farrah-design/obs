<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  <title>Manage Promotions & Discounts</title>
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

    .promo-header {
      display: flex;
      justify-content: flex-end;
      margin-bottom: 20px;
    }

    .btn-add {
      background: #b21f66;
      color: white;
      padding: 10px 18px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-weight: 600;
      transition: background 0.3s ease;
    }

    .btn-add:hover {
      background: #a11c5d;
    }

    .promo-table {
      width: 100%;
      border-collapse: collapse;
    }

    .promo-table th,
    .promo-table td {
      padding: 14px;
      border-bottom: 1px solid #eee;
      text-align: left;
    }

    .promo-table th {
      background-color: #fafafa;
    }

    .badge {
      padding: 5px 10px;
      border-radius: 12px;
      font-size: 0.85rem;
    }

    .badge.active {
      background-color: #28a745;
      color: white;
    }

    .badge.expired {
      background-color: #dc3545;
      color: white;
    }

    .btn-edit,
    .btn-delete {
      padding: 6px 12px;
      border: none;
      border-radius: 4px;
      font-size: 0.9rem;
      cursor: pointer;
    }

    .btn-edit {
      background-color: #007bff;
      color: white;
      margin-right: 5px;
    }

    .btn-delete {
      background-color: #dc3545;
      color: white;
    }

    .modal-overlay {
    position: fixed;
    top: 0; left: 0;
    width: 100vw; height: 100vh;
    background: rgba(0, 0, 0, 0.5);
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
    padding: 25px;
    border-radius: 10px;
    width: 100%;
    max-width: 500px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    .modal-content h2 {
    margin-top: 0;
    }

    .modal-content label {
    display: block;
    margin-top: 12px;
    font-weight: 600;
    }

    .modal-content input,
    .modal-content textarea,
    .modal-content select {
    width: 100%;
    padding: 8px;
    margin-top: 4px;
    border: 1px solid #ccc;
    border-radius: 5px;
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
    border-radius: 6px;
    cursor: pointer;
    }

    .modal-actions button:last-child {
    background-color: #5cb85c;
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
    <h1>Manage Promotions & Discounts</h1>

    <div class="promo-header">
      <button class="btn btn-add" onclick="openModal('addPromoModal')">+ Add Promotion</button>
    </div>

    <table class="promo-table">
      <thead>
        <tr>
          <th>Title</th>
          <th>Description</th>
          <th>Discount</th>
          <th>Valid Until</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Ramadhan Glow Up</td>
          <td>30% off for hair styling during Ramadhan</td>
          <td>30%</td>
          <td>2025-06-30</td>
          <td><span class="badge active">Active</span></td>
          <td>
            <button class="btn-edit"  onclick="openModal('editPromoModal')">Edit</button>
            <button class="btn-delete" onclick="openModal('deletePromoModal')">Delete</button>
            </td>
        </tr>
        <tr>
          <td>New Year Special</td>
          <td>15% off for all hair straightening</td>
          <td>15%</td>
          <td>2025-01-05</td>
          <td><span class="badge expired">Expired</span></td>
          <td>
            <button class="btn-edit" onclick="openModal('editPromoModal')">Edit</button>
            <button class="btn-delete" onclick="openModal('deletePromoModal')">Delete</button>
            </td>

        </tr>
      </tbody>
    </table>
  </div>

  <!-- Add Promotion Modal -->
<div class="modal-overlay" id="addPromoModal">
  <div class="modal-content">
    <h2>Add Promotion</h2>
    <form id="addPromoForm">
      <label>Promotion Title</label>
      <input type="text" required />

      <label>Description</label>
      <textarea rows="3" required></textarea>

      <label>Discount (%)</label>
      <input type="number" min="0" max="100" required />

      <label>Start Date</label>
      <input type="date" required />

      <label>End Date</label>
      <input type="date" required />

      <label>Status</label>
      <select required>
        <option value="Active">Active</option>
        <option value="Expired">Expired</option>
      </select>

      <div class="modal-actions">
        <button type="button" onclick="closeModal('addPromoModal')">Cancel</button>
        <button type="submit">Save</button>
      </div>
    </form>
  </div>
</div>

<!-- Edit Promotion Modal -->
<div class="modal-overlay" id="editPromoModal">
  <div class="modal-content">
    <h2>Edit Promotion</h2>
    <form id="editPromoForm">
      <label>Promotion Title</label>
      <input type="text" value="Summer Glow Package" required />

      <label>Description</label>
      <textarea rows="3" required>Get 15% off any service in June!</textarea>

      <label>Discount (%)</label>
      <input type="number" value="15" min="0" max="100" required />

      <label>Start Date</label>
      <input type="date" value="2025-06-01" required />

      <label>End Date</label>
      <input type="date" value="2025-06-30" required />

      <label>Status</label>
      <select required>
        <option value="Active" selected>Active</option>
        <option value="Expired">Expired</option>
      </select>

      <div class="modal-actions">
        <button type="button" onclick="closeModal('editPromoModal')">Cancel</button>
        <button type="submit">Update</button>
      </div>
    </form>
  </div>
</div>

<!-- Delete Promotion Modal -->
<div class="modal-overlay" id="deletePromoModal">
  <div class="modal-content">
    <h2>Delete Promotion</h2>
    <p>Are you sure you want to delete this promotion?</p>
    <div class="modal-actions">
      <button onclick="closeModal('deletePromoModal')">Cancel</button>
      <button onclick="confirmDelete()">Delete</button>
    </div>
  </div>
</div>
<script>
  function openModal(id) {
    document.getElementById(id).classList.add('show');
  }

  function closeModal(id) {
    document.getElementById(id).classList.remove('show');
  }

  function confirmDelete() {
    alert("Promotion deleted!");
    closeModal('deletePromoModal');
  }

  // Hook forms
  document.getElementById('addPromoForm').addEventListener('submit', function(e) {
    e.preventDefault();
    alert("Promotion added successfully!");
    closeModal('addPromoModal');
  });

  document.getElementById('editPromoForm').addEventListener('submit', function(e) {
    e.preventDefault();
    alert("Promotion updated successfully!");
    closeModal('editPromoModal');
  });
</script>

</body>
</html>
