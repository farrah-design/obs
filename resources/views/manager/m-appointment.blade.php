@extends('layouts.manager')

@section('title', 'Appointments')

@section('head')
  <link rel="stylesheet" href="{{ asset('css/staff-appointment.css') }}">
@endsection

@section('content') 
<div class="main-content">
  <div class="header">
    <h2>Appointments</h2>
  </div>

<div class="section">
<!-- Tabs container -->
<div class="tab-container">
  <a href="{{ route('manager.appointment')}}" class="tab-btn active" id="UpcomingBtn">Upcoming</a>
  <a href="{{ route ('manager.pastappointment')}}" class="tab-btn" id="PastBtn">Past</a>
  <a href="{{ route ('manager.allappointment')}}" class="tab-btn" id="AllBtn">All</a>
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
</div>
@endsection

@section('scripts')
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
@endsection

