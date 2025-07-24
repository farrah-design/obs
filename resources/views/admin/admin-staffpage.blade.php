@extends('layouts.admin')

@section('title', 'Staff Page')

@section('head')
  <link rel="stylesheet" href="/css/admin-staffpage.css">
@endsection

@section('content') 
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
        <td>Manager</td>
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
        <option value="Manager">Manager</option>
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
@endsection

@section('scripts')
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
@endsection

