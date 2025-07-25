@extends('layouts.admin')

@section('title', 'Schedule')

@section('head')
  <link rel="stylesheet" href="/css/admin-schedule.css">
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
    
    <!-- Schedule table -->
    <table class="appointments-table">
      <thead>
        <tr>
          <th>Date</th>
          <th>Time</th>
          <th>Staff</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        @foreach($schedules as $schedule)
        <tr>
          <td>{{ $schedule->date }}</td>
          <td>{{ $schedule->start_time }}</td>
          <td>{{ $schedule->staff->name }}</td>
          <td>
            <form action="{{ route('admin.update-schedule', $schedule->id) }}" method="POST" class="status-form">
              @csrf
              @method('PATCH')
              <select name="status" class="status-select" onchange="this.form.submit()">
                <option value="Available" {{ $schedule->status == 'Available' ? 'selected' : '' }}>Available</option>
                <option value="Available" {{ $schedule->status == 'Unavailable' ? 'selected' : '' }}>Unavailable</option>
                <option value="offday" {{ $schedule->status == 'offday' ? 'selected' : '' }}>Off-day</option>
              </select>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <!-- Modal Overlay -->
  <div id="modalOverlay">
    <div class="popup">
      <h2>Add Availability</h2>
      <p>Set your availability for a specific day of the week.</p>
      <form id="availabilityForm" method="POST" action="{{ route('admin.create-schedule') }}">
        @csrf
        <div class="form-group">
          <label for="staff_id">Staff</label>
          <select id="staff_id" name="staff_id" class="form-control" required>
            @foreach($staffMembers as $staff)
              <option value="{{ $staff->staffID }}">{{ $staff->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="date">Date</label>
          <input name="date" type="date" id="date" min="{{ now()->format('Y-m-d') }}" class="form-control" onchange="loadAvailableTimes()">
        </div>
        <div class="form-group">
          <label for="status">Status</label>
          <select id="status" name="status" class="form-control" required>
            <option value="Available">Available</option>
            <option value="Unavailable">Unavailable</option>
            <option value="offday">Off-day</option>
          </select> 
        </div>
        <div class="form-group">
          <label for="start_time">Start Time</label>
          <input type="time" id="start_time" name="start_time" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="end_time">End Time</label>
          <input type="time" id="end_time" name="end_time" class="form-control" required>
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
  function loadAvailableTimes() {
      const date = document.getElementById('date').value;
      if (!date) return;
  }

  function loadAvailableTimes() {
  const dateInput = document.getElementById('date');
  const selectedDate = dateInput.value;
  
  if (!selectedDate) return;
  
  // Get current date in YYYY-MM-DD format
  const today = new Date().toISOString().split('T')[0];
  
  // Validate date is not in the past
  if (selectedDate < today) {
    alert('Please select today or a future date');
    dateInput.value = today; // Reset to today
    return;
  }
  
  // Continue with your time loading logic
  console.log('Loading available times for:', selectedDate);
  // Add your AJAX call or time slot generation here
}

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
    this.submit(); // Now submits properly to Laravel route
  });

  // Close modal when clicking outside
  document.getElementById('modalOverlay').addEventListener('click', function(e) {
    if (e.target === document.getElementById('modalOverlay')) {
      closeModal();
    }
  });

  // Filter logic
  document.addEventListener('DOMContentLoaded', function() {
    const rows = document.querySelectorAll("table tbody tr");
    const filterDate = document.getElementById("filterDate");
    const filterStaff = document.getElementById("filterStaff");
    
    if (filterDate && filterStaff) {
      filterDate.addEventListener("input", filterTable);
      filterStaff.addEventListener("change", filterTable);
    }

    function filterTable() {
      const date = filterDate.value;
      const staff = filterStaff.value.toLowerCase();

      rows.forEach(row => {
        const rowDate = row.children[0].textContent.trim();
        const rowStaff = row.children[2].textContent.trim().toLowerCase();

        const matchDate = !date || rowDate === date;
        const matchStaff = !staff || rowStaff === staff;

        row.style.display = matchDate && matchStaff ? "" : "none";
      });
    }
  });
</script>
@endsection

