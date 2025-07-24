@extends('layouts.manager')

@section('title', 'All Appointments')

@section('head')
  <link rel="stylesheet" href="{{ asset('css/staff-all.css') }}">
@endsection

@section('content') 
<div class="main-content">
  <div class="header">
    <h2>Appointments</h2>
  </div>

<div class="section">
<!-- Tabs container -->
<div class="tab-container">
  <a href="{{ route('manager.appointment')}}" class="tab-btn" id="UpcomingBtn">Upcoming</a>
  <a href="{{ route ('manager.pastappointment')}}" class="tab-btn" id="PastBtn">Past</a>
  <a href="{{ route ('manager.allappointment')}}" class="tab-btn active" id="AllBtn">All</a>
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
    <tr>
      <td>2025-03-23</td>
      <td>10:00</td>
      <td>John Doe</td>
      <td>Haircut & Styling</td>
      <td><div class="status-badge confirmed">Completed</div></td>
      <td><button class="details-btn" onclick="alert('Details for John Doe')">Details</button></td>
    </tr>
    <tr>
      <td>2025-04-25</td>
      <td>14:00</td>
      <td>Jenny</td>
      <td>Haircut</td>
      <td><div class="status-badge confirmed">Completed</div></td>
      <td><button class="details-btn" onclick="alert('Details for John Doe')">Details</button></td>
    </tr>
  </tbody>
</table>

<!-- Modal for Confirmed Appointments (Booking Details) -->
<div id="detailsModal" class="modal">
  <div class="modal-content">
    <button class="close-btn" id="closeModalDetails">&times;</button>
    <h3>Booking Details</h3>
    <p><strong>Date:</strong> <span id="details-date">2025-05-23</span></p>
    <p><strong>Time:</strong> <span id="details-time">10:00</span></p>
    <p><strong>Customer:</strong> <span id="details-customer">John Doe</span></p>
    <p><strong>Service:</strong> <span id="details-service">Haircut & Styling</span></p>
    <div class="form-group">
      <label for="status"><strong>Status:</strong></label>
      <select id="status" name="status" required>
        <option value="confirmed">Confirmed</option>
        <option value="cancelled">Cancelled</option>
      </select>
    </div>
    <p><strong>Notes:</strong> <span id="details-notes">First time client, prefers minimal styling.</span></p>
    <div style="margin-top:20px; display:flex; gap:10px; justify-content:flex-end;">
      <button class="save-btn">Update Booking</button>
      <button class="cancel-btn" onclick="closeModal('detailsModal')">Cancel</button>
    </div>
  </div>
</div>

<!-- Modal for Completed Appointments (Appointment Summary) -->
<div id="summaryModal" class="modal">
  <div class="modal-content">
    <button class="close-btn" id="closeModalSummary">&times;</button>
    <h3>Appointment Summary</h3>
    <div class="modal-section">
      <p><strong>Date:</strong> <span id="summary-date">2025-03-23</span></p>
      <p><strong>Time:</strong> <span id="summary-time">10:00 AM</span></p>
      <p><strong>Duration:</strong> <span id="summary-duration">1 Hour</span></p>
      <p><strong>Service:</strong> <span id="summary-service">Haircut & Styling</span></p>
      <p><strong>Status:</strong> <span class="badge green" id="summary-status">Completed</span></p>
    </div>
    <div class="modal-section">
      <h4>Send Thank You Message</h4>
      <textarea id="thankYouMessage" class="thankyou-textarea" rows="4">Hi, thank you for visiting Sarlini Salon! We hope you loved your Haircut & Styling session. Looking forward to seeing you again soon! 😊</textarea>
      <button class="send-btn" onclick="sendThankYou()">Send Message</button>
    </div>
    <div style="margin-top:20px; display:flex; gap:10px; justify-content:flex-end;">
      <button class="cancel-btn" onclick="closeModal('summaryModal')">Close</button>
    </div>
  </div>
</div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Toggle active class for tabs
  const buttons = document.querySelectorAll('.tab-btn');
  buttons.forEach(btn => {
    btn.onclick = () => {
      buttons.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
    };
  });

  // Modal elements
  const detailsModal = document.getElementById('detailsModal');
  const summaryModal = document.getElementById('summaryModal');
  const closeModalDetailsBtn = document.getElementById('closeModalDetails');
  const closeModalSummaryBtn = document.getElementById('closeModalSummary');

  // Store the current phone number for WhatsApp
  let currentCustomerPhone = null;

  // Attach event listeners to all "Details" buttons
  document.querySelectorAll('.details-btn').forEach(btn => {
    btn.onclick = function(e) {
      // If this is a completed appointment, show summary modal
      // (You may want to use a data-status attribute to distinguish)
      // For now, we check the row's status text
      const row = btn.closest('tr');
      const statusDiv = row.querySelector('.status-badge');
      const statusText = statusDiv ? statusDiv.textContent.trim().toLowerCase() : '';
      if (statusText === 'completed') {
        // Populate summary modal fields if needed
        // Example: document.getElementById('summary-date').textContent = ...
        summaryModal.style.display = 'flex';
      } else {
        // Populate details modal fields if needed
        // Example: document.getElementById('details-date').textContent = ...
        detailsModal.style.display = 'flex';
        // Set current customer phone if available
        currentCustomerPhone = btn.getAttribute('data-phone') || null;
      }
    };
  });

  // Close Details Modal
  closeModalDetailsBtn.onclick = function() {
    detailsModal.style.display = 'none';
    currentCustomerPhone = null;
  };

  // Close Summary Modal
  closeModalSummaryBtn.onclick = function() {
    summaryModal.style.display = 'none';
  };

  // Close modals when clicking outside modal content
  window.onclick = function(event) {
    if (event.target === detailsModal) {
      detailsModal.style.display = 'none';
      currentCustomerPhone = null;
    }
    if (event.target === summaryModal) {
      summaryModal.style.display = 'none';
    }
  };

  // "Update Booking" button in details modal
  const saveBtn = detailsModal.querySelector('.save-btn');
  if (saveBtn) {
    saveBtn.onclick = function() {
      alert('Booking updated!'); // Add save logic here
      detailsModal.style.display = 'none';
      currentCustomerPhone = null;
    };
  }

  // "Cancel" button in details modal
  const cancelBtn = detailsModal.querySelector('.cancel-btn');
  if (cancelBtn) {
    cancelBtn.onclick = function() {
      detailsModal.style.display = 'none';
      currentCustomerPhone = null;
    };
  }

  // "Close" button in summary modal (cancel-btn)
  const summaryCancelBtn = summaryModal.querySelector('.cancel-btn');
  if (summaryCancelBtn) {
    summaryCancelBtn.onclick = function() {
      summaryModal.style.display = 'none';
    };
  }

  // Function to send WhatsApp message from summary modal
  window.sendThankYou = function() {
    const message = document.getElementById('thankYouMessage').value;
    // Fallback phone number if not set (replace with a default or show error)
    let phone = currentCustomerPhone || '';
    if (!phone) {
      alert('No customer phone number found for WhatsApp.');
      return;
    }
    // Remove any non-digit characters except '+'
    phone = phone.replace(/[^+\d]/g, '');
    // Remove leading '+' for wa.me
    const waPhone = phone.replace(/^\+/, '');
    const waUrl = `https://wa.me/${waPhone}?text=${encodeURIComponent(message)}`;
    window.open(waUrl, '_blank');
  };
});
</script>
@endsection

