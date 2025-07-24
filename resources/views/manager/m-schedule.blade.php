@extends('layouts.manager')

@section('title', 'Staff Schedule')

@section('head')
  <link rel="stylesheet" href="{{ asset('css/staff-schedule.css') }}">
@endsection

@section('content') 
<div class="main-content">
  <div class="header">
    <h2>Schedule</h2>
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
      <th>Staff</th>
      <th>Customer</th>
      <th>Service</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>2025-05-23</td>
      <td>10:00</td>
      <td>Habib</td>
      <td>Sakinah</td>
      <td>Haircut</td>
      <td>
          <select class="status-select" onchange="updateStatus(this)">
              <option value="Available" selected>Available</option>
              <option value="offday">Off-day</option>
            </select>
      </td>
    </tr>
    <tr>
      <td>2025-05-25</td>
      <td>14:00</td>
      <td>Ida</td>
      <td>Nordin</td>
      <td>Hair coloring</td>
      <td>
          <select class="status-select" onchange="updateStatus(this)">
              <option value="Available">Available</option>
              <option value="offday"  selected>Off-day</option>
          </select>
      </td>
    </tr>
  </tbody>
</table>

<div class="filter-section" style="margin-top: 20px;">
  <div class="filters">
    <label for="filterDate">Date:</label>
    <input type="date" id="filterDate" name="filterDate" /><br><br>

    <label for="filterStaff">Staff:</label>
    <select id="filterStaff" name="filterStaff">
      <option value="">All</option>
      <option value="Ida">Ida</option>
      <option value="Era">Era</option>
      <option value="Suni">Suni</option>
    </select>
  </div>

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
          <option value="Unavailable">Off-day</option>
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
@endsection

@section('scripts')
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
</script>
@endsection

