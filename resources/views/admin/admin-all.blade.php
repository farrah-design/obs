@extends('layouts.admin')

@section('title', 'All Appointment')

@section('head')
  <link rel="stylesheet" href="/css/admin-all.css">
@endsection

@section('content') 
< class="main-content">
  <div class="header">
    <h2>Appointments</h2>
  </div>

<div class="section">
<!-- Tabs container -->
<div class="tab-container">
   <a href="{{ route('admin.allappointment') }}" 
        class="tab-btn {{ request()->routeIs('admin.allappointment') ? 'active' : '' }}" 
        id="AllBtn">All</a>
        
  <a href="{{ route('admin.appointment') }}" 
        class="tab-btn {{ request()->routeIs('admin.appointment') ? 'active' : '' }}" 
        id="UpcomingBtn">Upcoming</a>
        
      <a href="{{ route('admin.pastappointment') }}" 
        class="tab-btn {{ request()->routeIs('admin.pastappointment') ? 'active' : '' }}" 
        id="PastBtn">Past</a>
</div>

<!-- Appointment Table -->
<table class="appointments-table">
      <thead>
        <tr>
          <th>Date</th>
          <th>Time</th>
          <th>Staff</th>
          <th>Customer</th>
          <th>Service(s)</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($appointments as $appointment)
        <tr>
          <td>{{ $appointment->date }}</td>
          <td>{{ $appointment->time }}</td>
          <td>{{ $appointment->staff->name ?? '-' }}</td>
          <td>{{ $appointment->customer->name ?? '-' }}</td>
          <td>
            @foreach ($appointment->services as $service)
              <strong>{{ $service->serviceName }}</strong>
              @if (!$loop->last)<hr style="margin: 5px 0;">@endif
            @endforeach
          </td>
          <td>
            <div class="status-badge {{ $appointment->status }}">
              {{ ucfirst($appointment->status) }}
            </div>
          </td>
          <td>
            <a href="javascript:void(0);" class="edit-btn" onclick="openDetailsModal(this)"
              data-id="{{ $appointment->appointmentID }}"
              data-date="{{ $appointment->date }}"
              data-time="{{ $appointment->time }}"
              data-customer="{{ $appointment->customer->name ?? '-' }}"
              data-services="{{ $appointment->services->pluck('serviceName')->implode(', ') }}"
              data-notes="{{ $appointment->services->first()->pivot->serviceNotes ?? '-' }}"
              data-status="{{ $appointment->status }}">
              Edit
            </a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

<!-- Modal for Confirmed/pending Appointments (Booking Details) -->
<div id="detailsModal" class="modal">
  <div class="modal-content">
    <button class="close-btn" id="closeModalDetails">&times;</button>
    <h3>Booking Details</h3>
    <p><strong>Date:</strong> <span id="details-date">2025-05-23</span></p>
    <p><strong>Time:</strong> <span id="details-time">10:00</span></p>
    <p><strong>Customer:</strong> <span id="details-customer">John Doe</span></p>
    <p><strong>Service:</strong> <span id="details-service">Haircut & Styling</span></p>

    <form method="POST" action="{{ route('admin.updateStatus') }}">
          @csrf
          <input type="hidden" name="appointment_id" id="modal-appointment-id">

    <div class="form-group">
      <label for="status"><strong>Status:</strong></label>
            <select name="status" id="modal-status" required>
              <option value="confirmed">Confirmed</option>
              <option value="cancelled">Cancelled</option>
              <option value="completed">Completed</option>
            </select>
    </div>
    
          <div class="modal-actions">
            <button type="submit" class="save-btn">Update Booking</button>
            <button type="button" class="cancel-btn" onclick="closeModal()">Cancel</button>
          </div>
        </form>
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

      <form method="POST" action="{{ route('admin.updateStatus') }}">
          @csrf
          <input type="hidden" name="appointment_id" id="modal-appointment-id">

        <div class="modal-section">
          <h4>Send Thank You Message</h4>
          <textarea id="thankYouMessage" class="thankyou-textarea" rows="4">Hi, thank you for visiting Sarlini Salon! We hope you loved your Haircut & Styling session. Looking forward to seeing you again soon! 😊</textarea>
          <button type="submit" class="send-btn" onclick="sendThankYou()">Send Message</button>
          <button class="cancel-btn" onclick="closeModal('summaryModal')">Close</button>
        </div>
      </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
// Function to open the appropriate modal based on status
function openDetailsModal(element) {
  const status = element.getAttribute('data-status');
  const appointmentId = element.getAttribute('data-id');
  
  if (status === 'completed') {
    // Populate and show summary modal
    document.getElementById('summary-date').textContent = element.getAttribute('data-date');
    document.getElementById('summary-time').textContent = element.getAttribute('data-time');
    document.getElementById('summary-service').textContent = element.getAttribute('data-services');
    document.getElementById('modal-appointment-id').value = appointmentId;
    
    // Set default thank you message
    const customerName = element.getAttribute('data-customer').split(' ')[0];
    const services = element.getAttribute('data-services');
    document.getElementById('thankYouMessage').value = 
      `Hi ${customerName}, thank you for visiting our salon! ` +
      `We hope you enjoyed your ${services}. ` +
      `Looking forward to seeing you again soon! 😊`;
      
    document.getElementById('summaryModal').style.display = 'flex';
  } else {
    // Populate and show details modal
    document.getElementById('details-date').textContent = element.getAttribute('data-date');
    document.getElementById('details-time').textContent = element.getAttribute('data-time');
    document.getElementById('details-customer').textContent = element.getAttribute('data-customer');
    document.getElementById('details-service').textContent = element.getAttribute('data-services');
    document.getElementById('modal-appointment-id').value = appointmentId;
    
    // Set the current status in select
    const statusSelect = document.getElementById('modal-status');
    statusSelect.value = status;
    
    document.getElementById('detailsModal').style.display = 'flex';
  }
}

// Close modal function
function closeModal(modalId) {
  document.getElementById(modalId).style.display = 'none';
}

// Send thank you message via WhatsApp
function sendThankYou() {
  const message = document.getElementById('thankYouMessage').value;
  // In a real implementation, you would get the phone number from your data attributes
  const phoneNumber = ''; // You should add data-phone to your edit button
  if (phoneNumber) {
    const waUrl = `https://wa.me/${phoneNumber.replace(/[^\d]/g, '')}?text=${encodeURIComponent(message)}`;
    window.open(waUrl, '_blank');
  } else {
    alert('Customer phone number not available');
  }
}

// Close modals when clicking outside
window.onclick = function(event) {
  if (event.target.classList.contains('modal')) {
    event.target.style.display = 'none';
  }
};

// Tab switching functionality
document.addEventListener('DOMContentLoaded', function() {
  const buttons = document.querySelectorAll('.tab-btn');
  buttons.forEach(btn => {
    btn.addEventListener('click', function() {
      buttons.forEach(b => b.classList.remove('active'));
      this.classList.add('active');
    });
  });
});
</script>
@endsection

