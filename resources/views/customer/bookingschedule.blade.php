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
              <button class="edit-btn" onclick="showRescheduleModal(
                '{{ $appointment->appointmentID }}',
                '{{ \Carbon\Carbon::parse($appointment->date)->format('Y-m-d') }}',
                '{{ \Carbon\Carbon::parse($appointment->time)->format('H:i') }}'
              )">
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
    <form id="rescheduleForm" action="{{ route('booking.reschedule') }}" method="POST">
      @csrf
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
    <form id="cancelForm" action="{{ route('admin.closeStatus') }}" method="POST">
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


function showRescheduleModal(appointmentId, date, time) {
  const modal = document.getElementById('rescheduleModal');
  const form = document.getElementById('rescheduleForm');
  
  // Validate inputs
  if (!appointmentId || !date || !time) {
    console.error('Missing required parameters');
    return;
  }

  // Set form values
  form.appointment_id.value = appointmentId;
  
  // Format time from "08:00" to "8:00 AM" if needed
  const formattedTime = formatTimeForDisplay(time);
  document.getElementById('currentDate').textContent = formatDateForDisplay(date);
  document.getElementById('currentTime').textContent = formattedTime;

  // Set minimum date (tomorrow)
  const tomorrow = new Date();
  tomorrow.setDate(tomorrow.getDate() + 1);
  document.getElementById('newDate').min = tomorrow.toISOString().split('T')[0];
  
  // Reset form and show modal
  form.reset();
  modal.style.display = 'flex';
  
  // Add escape key handler
  document.addEventListener('keydown', function escHandler(e) {
    if (e.key === 'Escape') hideRescheduleModal();
  });
}
// Helper function to format time for display
function formatTimeForDisplay(time) {
  if (time.includes('AM') || time.includes('PM')) return time;
  
  const [hours, minutes] = time.split(':');
  const period = hours >= 12 ? 'PM' : 'AM';
  const displayHours = hours % 12 || 12;
  
  return `${displayHours}:${minutes} ${period}`;
}
// Helper function to format date for display
function formatDateForDisplay(dateString) {
  const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
  return new Date(dateString).toLocaleDateString('en-US', options);
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

document.getElementById('newDate').addEventListener('change', loadAvailableTimes);

function loadAvailableTimes() {
  const date = document.getElementById('newDate').value;
  if (!date) return;

  fetch(`/customer/bookingpage/available-slots?date=${date}`)
    .then(response => response.json())
    .then(availableTimes => {
      const timeSelect = document.getElementById('newTime');
      
      // Clear existing options except the first one
      timeSelect.innerHTML = '<option value="">Select a time</option>';
      
      if (availableTimes.length === 0) {
        // Disable select and show message
        timeSelect.disabled = true;
        timeSelect.innerHTML += '<option value="" disabled>No available times for this date</option>';
        return;
      }
      
      // Enable select if it was disabled
      timeSelect.disabled = false;
      
      // Filter and sort the available times to match your design
      const formattedTimes = availableTimes
        .map(time => {
          // Convert "08:00" format to "8:00 AM" format
          const [hours, minutes] = time.split(':');
          const period = hours >= 12 ? 'PM' : 'AM';
          const displayHours = hours % 12 || 12;
          return `${displayHours}:${minutes} ${period}`;
        })
        .sort((a, b) => {
          // Sort times chronologically
          return new Date(`2000-01-01 ${a}`) - new Date(`2000-01-01 ${b}`);
        });
      
      // Add available times to select
      formattedTimes.forEach(time => {
        const option = document.createElement('option');
        option.value = time;
        option.textContent = time;
        timeSelect.appendChild(option);
      });
    })
    .catch(error => {
      console.error('Failed to load times:', error);
      const timeSelect = document.getElementById('newTime');
      timeSelect.innerHTML = '<option value="">Error loading times</option>';
      timeSelect.disabled = true;
    });
}

</script>
@endsection

