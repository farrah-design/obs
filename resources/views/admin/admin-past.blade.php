@extends('layouts.admin')

@section('title', 'Past Appointment')

@section('head')
  <link rel="stylesheet" href="/css/admin-past.css">
@endsection

@section('content') 
<div class="main-content">
  <div class="header">
    <h2>Appointments</h2>
    <div class="welcome-msg">Welcome back, Admin User!</div>
  </div>

<div class="section">
<!-- Tabs container -->
<div class="tab-container">
  <a href="{{ route('admin.appointment') }}" 
        class="tab-btn {{ request()->routeIs('admin.appointment') ? 'active' : '' }}" 
        id="UpcomingBtn">Upcoming</a>
        
      <a href="{{ route('admin.pastappointment') }}" 
        class="tab-btn {{ request()->routeIs('admin.pastappointment') ? 'active' : '' }}" 
        id="PastBtn">Past</a>
        
      <a href="{{ route('admin.allappointment') }}" 
        class="tab-btn {{ request()->routeIs('admin.allappointment') ? 'active' : '' }}" 
        id="AllBtn">All</a>
</div>

<!-- Appointment Table -->
<table class="appointments-table">
  <thead>
  <tr>
      <th>Date</th>
      <th>Time</th>
      <th>Staff</th>
      <th>Customer</th>
      <th>Service</th>
      <th>Status</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>2025-03-23</td>
      <td>10:00</td>
      <td>Suni</td>
      <td>John Doe</td>
      <td>Haircut & Styling</td>
      <td><div class="status-badge confirmed">Completed</div></td>
      <td><button class="details-btn" onclick="alert('Details for John Doe')">Details</button></td>
    </tr>
    <tr>
      <td>2025-04-25</td>
      <td>14:00</td>
      <td>Nana</td>
      <td>Jenny</td>
      <td>Haircut</td>
      <td><div class="status-badge confirmed">Completed</div></td>
      <td><button class="details-btn" onclick="alert('Details for John Doe')">Details</button></td>
    </tr>
  </tbody>
</table>


<!-- Popup Overlay for Details -->
<div id="detailsModal" class="modal">
  <div class="modal-content">
    <button class="close-btn" id="closeModal">&times;</button>
    <h3>Appointment Summary</h3>

    <div class="modal-section">
      <p><strong>Date:</strong> 2025-05-23</p>
      <p><strong>Time:</strong> 10:00 AM</p>
      <p><strong>Duration:</strong> 1 Hour</p>
      <p><strong>Service:</strong> Haircut & Styling</p>
      <p><strong>Status:</strong> <span class="badge green">Completed</span></p>
    </div>

    <div class="modal-section">
      <h4>Send Thank You Message</h4>
      <textarea id="thankYouMessage" class="thankyou-textarea" rows="4">Hi, thank you for visiting Sarlini Salon! We hope you loved your Haircut & Styling session. Looking forward to seeing you again soon! 😊</textarea>
      <button class="send-btn" onclick="sendThankYou()">Send Message</button>
    </div>
    
{{-- 
<form method="POST" action="{{ route('admin.appointment', $appointment->id) }}">
    @csrf
    <button type="submit" class="btn btn-success">Send WhatsApp Thank You</button>
</form> 
--}}


    <div style="margin-top:20px; display:flex; gap:10px; justify-content:flex-end;">
      <button class="cancel-btn" onclick="closeModal()">Close</button>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
/**
 * Sends the thank you message to the customer's WhatsApp number.
 * Assumes each "Details" button has a data-phone attribute with the customer's phone number.
 * If not, you can adjust the selector or logic accordingly.
 */

// Store the current phone number when opening the modal
let currentCustomerPhone = null;

// Attach event listeners to all "Details" buttons
document.querySelectorAll('.details-btn').forEach(btn => {
  btn.onclick = function() {
    // Get the phone number from data attribute (e.g., data-phone="+60123456789")
    currentCustomerPhone = btn.getAttribute('data-phone');
    document.getElementById('detailsModal').style.display = 'flex';
  };
});

// Close modal when close button is clicked
document.getElementById('closeModal').onclick = function() {
  closeModal();
};

// Close modal when clicking outside modal content
window.onclick = function(event) {
  const modal = document.getElementById('detailsModal');
  if (event.target === modal) {
    closeModal();
  }
};

// Function to send WhatsApp message
function sendThankYou() {
  const message = document.getElementById('thankYouMessage').value;
  // Fallback phone number if not set (replace with a default or show error)
  let phone = currentCustomerPhone || '';
  if (!phone) {
    alert('No customer phone number found for WhatsApp.');
    return;
  }
  // Remove any non-digit characters except '+'
  phone = phone.replace(/[^+\d]/g, '');
  // WhatsApp API expects phone in international format without leading zeros
  // Example: +60123456789 or 60123456789
  // Remove leading '+' for wa.me
  const waPhone = phone.replace(/^\+/, '');
  const waUrl = `https://wa.me/${waPhone}?text=${encodeURIComponent(message)}`;
  window.open(waUrl, '_blank');
}

// Optionally, you can attach sendThankYou to the global window for inline onclick
window.sendThankYou = sendThankYou;

function closeModal() {
  document.getElementById('detailsModal').style.display = 'none';
  currentCustomerPhone = null;
}
</script>
@endsection


