@extends('layouts.admin')

@section('title', 'Manage Appointment')

@section('head')
  <link rel="stylesheet" href="/css/admin-appointment.css">
  <meta name="csrf-token" content="{{ csrf_token() }}">
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

    <!-- Popup Modal -->
    <div id="detailsModal" class="modal">
      <div class="modal-content">
        <button class="close-btn" onclick="closeModal()">&times;</button>
        <h3>Booking Details</h3>
        
        <div class="modal-details">
          <p><strong>Date:</strong> <span id="modal-date"></span></p>
          <p><strong>Time:</strong> <span id="modal-time"></span></p>
          <p><strong>Customer:</strong> <span id="modal-customer"></span></p>
          <p><strong>Service(s):</strong> <span id="modal-services"></span></p>
          <p><strong>Notes:</strong> <span id="modal-notes"></span></p>
        </div>

        <form method="POST" action="{{ route('admin.updateStatus') }}">
          @csrf
          <input type="hidden" name="appointment_id" id="modal-appointment-id">
          
          <div class="form-group">
            <label><strong>Status:</strong></label>
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
  </div>
</div>
@endsection

@section('scripts')
<script>
  // Simple modal functions
  function openDetailsModal(button) {
    document.getElementById('modal-appointment-id').value = button.dataset.id;
    document.getElementById('modal-date').textContent = button.dataset.date;
    document.getElementById('modal-time').textContent = button.dataset.time;
    document.getElementById('modal-customer').textContent = button.dataset.customer;
    document.getElementById('modal-services').textContent = button.dataset.services;
    document.getElementById('modal-notes').textContent = button.dataset.notes;
    document.getElementById('modal-status').value = button.dataset.status;
    
    document.getElementById('detailsModal').style.display = 'block';
  }

  function closeModal() {
    document.getElementById('detailsModal').style.display = 'none';
  }

  // Close modal when clicking outside
  window.onclick = function(event) {
    if (event.target == document.getElementById('detailsModal')) {
      closeModal();
    }
  }

  document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.tab-btn');
});
</script>
@endsection