@extends('layouts.customer')

@section('title', 'Booking Schedule')

@section('head')
  <link rel="stylesheet" href="/css/bookingschedule.css">
@endsection

@section('content') 
<h2 class="section-title">Appointment Schedule</h2>

<div class="schedule-section">
    <div class="schedule-content"></div>
    <!-- Schedule table -->
    <table class="appointments-table">
      <thead>
        <tr>
          <th>Date</th>
          <th>Time</th>
          <th>Service</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($appointments as $appointment)
        <tr>
          <td>{{ $appointment->date }}</td>
          <td>{{ $appointment->time }}</td>
          <td>
            @foreach ($appointment->services as $service)
              {{ $service->serviceName }}@if (!$loop->last), @endif
            @endforeach
          </td>
          <td>
            <div class="status-badge {{ $appointment->status }}">
              {{ ucfirst($appointment->status) }}
            </div>
          </td>
          <td>
            @if(in_array($appointment->status, ['confirmed', 'pending']))
              <button class="edit-btn" onclick="showRescheduleModal('{{ $appointment->appointmentID }}', '{{ $appointment->date }}', '{{ $appointment->time }}')">
                Reschedule
              </button>

              <button class="delete-btn" onclick="openCancelModal('{{ $appointment->appointmentID }}')">
                Cancel Booking
              </button>
            @else
              <button class="edit-btn" disabled style="opacity: 0.6; cursor: not-allowed;">
                Reschedule
              </button>

              <button class="delete-btn" disabled style="opacity: 0.6; cursor: not-allowed;">
                Cancel Booking
              </button>
            @endif

            @if($appointment->status === 'completed')
              @php
                $serviceNames = $appointment->services->pluck('serviceName')->implode(', ');
              @endphp
              <button class="feedback-btn" onclick="openFeedbackModal('{{ $serviceNames }}', '{{ $appointment->date }}')">
                Give Feedback
              </button>
            @else
              <button class="feedback-btn" disabled style="opacity: 0.6; cursor: not-allowed;">
                Give Feedback
              </button>
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
</div>

<!-- reschedule modal -->
<div class="modal" id="rescheduleModal">
  <div class="modal-content">
    <h2 class="modal-title">Reschedule Appointment</h2>
    <div class="current-appointment-details">
      <p><strong>Current Date:</strong> <span id="currentDate"></span></p>
      <p><strong>Current Time:</strong> <span id="currentTime"></span></p>
    </div>
    <form id="rescheduleForm" action="{{ route('admin.appointment') }}" method="POST">
      @csrf
      @method('PUT')
      <input type="hidden" id="appointmentId" name="appointment_id">
      <div>
        <label for="newDate">New Date</label>
        <input type="date" id="newDate" name="new_date" required min="{{ date('Y-m-d', strtotime('+1 day')) }}" />
      </div>
      <div>
        <label for="newTime">New Time</label>
        <select id="newTime" name="new_time" required>
          <option value="">Select a time</option>
          @foreach(['8:00 AM', '9:00 AM', '10:00 AM', '11:00 AM', '12:00 PM', '1:00 PM', 
        '2:00 PM', '3:00 PM', '4:00 PM', '5:00 PM', '6:00 PM', '7:00 PM', '8:00 PM'] as $time)
            <option value="{{ $time }}">{{ date('h:i A', strtotime($time)) }}</option>
          @endforeach
        </select>
      </div>
      <div class="note-box">
        <strong>⚠️ Please note:</strong>
        <ul>
          <li>Appointments can only be rescheduled at least 24 hours in advance</li>
          <li>Time slots are subject to availability</li>
        </ul>
      </div>
      <div class="modal-buttons">
        <button type="button" class="cancel-btn" onclick="hideRescheduleModal()">Cancel</button>
        <button type="submit" class="confirm-btn">Confirm Reschedule</button>
      </div>
    </form>
  </div>
</div>

<!-- feedback modal -->
<div class="modal" id="feedbackModal">
  <div class="modal-content">
    <h2 class="modal-title">Your Feedback</h2>
    <p id="feedbackServiceInfo" style="margin-bottom: 10px;"></p>
    <form id="feedbackForm" action="{{ route('feedback.submit') }}" method="POST">
      @csrf
      <label>Rate your experience:</label>
      <div class="star-rating">
        <input type="radio" name="rating" id="star5" value="5" required><label for="star5" title="Excellent"></label>
        <input type="radio" name="rating" id="star4" value="4"><label for="star4" title="Good"></label>
        <input type="radio" name="rating" id="star3" value="3"><label for="star3" title="Average"></label>
        <input type="radio" name="rating" id="star2" value="2"><label for="star2" title="Poor"></label>
        <input type="radio" name="rating" id="star1" value="1"><label for="star1" title="Terrible"></label>
      </div>
      
      <label for="feedbackText">Tell us how it went:</label>
      <textarea id="feedbackText" name="comments" required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ccc; height: 100px; margin: 10px 0;"></textarea>

      <div class="modal-buttons">
        <button type="button" class="cancel-btn" onclick="closeFeedbackModal()">Cancel</button>
        <button type="submit" class="confirm-btn">Submit Feedback</button>
      </div>
    </form>
  </div>
</div>

<!-- Cancellation Reason Modal -->
<div class="modal" id="cancelModal">
  <div class="modal-content">
    <h2 class="modal-title">Cancel Booking</h2>
    <p>Please tell us why you're cancelling:</p>
    <form id="cancelForm" action="{{ route('feedback.submit') }}" method="POST">
      @csrf
      <input type="hidden" id="cancelAppointmentId" name="appointment_id">
      <textarea id="cancelReason" name="cancellation_reason" required placeholder="Enter your reason..." style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ccc; height: 100px; margin: 10px 0;"></textarea>
      <div class="modal-buttons">
        <button type="button" class="cancel-btn" onclick="closeCancelModal()">Back</button>
        <button type="submit" class="confirm-btn">Confirm Cancellation</button>
      </div>
    </form>
  </div>
</div>
@endsection

@section('scripts')
<script>
// Reschedule modal handlers
function showRescheduleModal(appointmentId, date, time) {
  const modal = document.getElementById('rescheduleModal');
  document.getElementById('appointmentId').value = appointmentId;
  document.getElementById('currentDate').textContent = date;
  document.getElementById('currentTime').textContent = time;
  
  // Set minimum date to tomorrow
  const tomorrow = new Date();
  tomorrow.setDate(tomorrow.getDate() + 1);
  document.getElementById('newDate').min = tomorrow.toISOString().split('T')[0];
  
  modal.style.display = 'flex';
}

function hideRescheduleModal() {
  document.getElementById('rescheduleModal').style.display = 'none';
  document.getElementById('rescheduleForm').reset();
}

// Cancel modal handlers
function openCancelModal(appointmentId) {
  const modal = document.getElementById('cancelModal');
  document.getElementById('cancelAppointmentId').value = appointmentId;
  console.log(document.getElementById('cancelAppointmentId').value)
  modal.style.display = 'flex';
}

function closeCancelModal() {
  document.getElementById('cancelModal').style.display = 'none';
  document.getElementById('cancelForm').reset();
}

// Feedback modal handlers
function openFeedbackModal(service, date) {
  document.getElementById('feedbackModal').style.display = 'flex';
  document.getElementById('feedbackServiceInfo').textContent = `${service} on ${date}`;
}

function closeFeedbackModal() {
  document.getElementById('feedbackModal').style.display = 'none';
  document.getElementById('feedbackForm').reset();
}

// Close modals when clicking outside
window.onclick = function(event) {
  if (event.target.classList.contains('modal')) {
    hideRescheduleModal();
    closeCancelModal();
    closeFeedbackModal();
  }
};

// Form submissions
document.getElementById('rescheduleForm').addEventListener('submit', function(e) {
  e.preventDefault();
  const formData = new FormData(this);
  // Add AJAX call here to submit the reschedule request
  alert('Appointment rescheduled successfully!');
  hideRescheduleModal();
  // You might want to reload the page or update the table
});

document.getElementById('cancelForm').addEventListener('submit', function(e) {
  e.preventDefault();
  const formData = new FormData(this);
  // Add AJAX call here to submit the cancellation
  alert('Appointment cancelled successfully!');
  closeCancelModal();
  // You might want to reload the page or update the table
});
</script>
@endsection

