@extends('layouts.admin')

@section('title', 'Manage Notifications')

@section('head')
  <link rel="stylesheet" href="/css/manageNoti.css">
@endsection

@section('content')
<div class="container">
  <h1>Manage Notifications</h1>
  
  <div class="notification-tabs">
    <div class="tab active" data-tab="appointments">Appointments</div>
    <div class="tab" data-tab="promotions">Promotions</div>
    <div class="tab" data-tab="feedback">Feedback</div>
  </div>
  
  <!-- Appointments Tab Content -->
<div id="appointments-tab" class="tab-content">
  <table class="appointment-table">
    <thead>
      <tr>
        <th>Customer</th>
        <th>Service</th>
        <th>Date</th>
        <th>Time</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($appointments as $appointment)
      <tr>
        <td>{{ ucwords($appointment->customer->name) }}</td>
        <td>
          <ul>
            @foreach($appointment->services as $service)
              <li>{{ $service->serviceName }}</li>
            @endforeach
          </ul>
        </td>
        <td>{{ \Carbon\Carbon::parse($appointment->date)->format('Y-m-d') }}</td>
        <td>{{ \Carbon\Carbon::parse($appointment->time)->format('H:i') }}</td>
        @if ($appointment->status === 'confirmed')
        <td>{{ ucfirst($appointment->status) }}</td>
        <td>
          <!-- Individual form for each row -->
          <form method="POST" action="{{ route('admin.appointment-reminder')}}" style="display: inline;">
            @csrf
            <input type="hidden" name="customerName" value="{{ $appointment->customer->name }}">
            <input type="hidden" name="appointmentDate" value="{{ \Carbon\Carbon::parse($appointment->date)->format('Y-m-d') }}">
            <input type="hidden" name="appointmentTime" value="{{ \Carbon\Carbon::parse($appointment->time)->format('H:i') }}">
            <input type="hidden" name="phone" value="{{ $appointment->customer->phone }}">
            <button type="submit" class="btn-action btn-offer">
              Remind via WhatsApp
            </button>
          </form>
        </td>
        @endif
      </tr>
      @endforeach
    </tbody>
  </table>
</div> <!-- This was the missing closing div -->
  
  <!-- Promotions Tab Content -->
  <div id="promotions-tab" class="tab-content hidden">
    <table class="appointment-table">
      <thead>
        <tr>
          <th>Promotion Name</th>
          <th>Description</th>
          <th>Valid Until</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
            @foreach($promotions as $promotion)
            <tr>
              <td>{{ $promotion->title }}</td>
              <td>{{ $promotion->description }}</td>
              <td>
                {{ $promotion->validUntil->format('Y-m-d') }}
              </td>
              <td>
                <form method='post' action='{{ route("admin.promotion-reminder") }}'>
                  @csrf
                  <input type="hidden" name="promoTitle" value="{{ $promotion->title }}">
                  <input type="hidden" name="promoDescription" value="{{ $promotion->description }}">
                  <input type="hidden" name="promoValidDate" value="{{ $promotion->validUntil->format('Y-m-d') }}">
                  <button type='submit' class="btn-action btn-offer">
                    Send Offer
                  </button>
                </form>
              </td>
          </tr>
        @endforeach
      </tbody>

    </table>
  </div>
  
  <!-- Feedback Tab Content -->
  <div id="feedback-tab" class="tab-content hidden">
    <table class="appointment-table">
      <thead>
        <tr>
          <th>Customer Name</th>
          <th>Phone Number</th>
          <th>Email</th>
          <th>Total Pass Booking</th>
          <th>Actions</th>
        </tr>
      </thead>
      
      <tbody>
      @foreach ( $usedToBeCustomers as $customer)
        <tr>
          <td>{{ ucfirst($customer->name) }}</td>
          <td>{{ $customer->phone }}</td>
          <td>{{ $customer->email }}</td>
          <td>{{ $customer->appointments_count }}</td>
          <td>
            <form action='{{ route('admin.feedback-reminder') }}' method='POST'>
              @csrf
              <input type="hidden" name="customerName" value="{{ ucfirst($customer->name) }}">
              <button type='submit' class="btn-action btn-feedback">Request Feedback</button>
            </form>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>

</div>
@endsection

@section('scripts')
  <script> 
  // Tab Management ---dont delete
  document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.tab');
    tabs.forEach(tab => {
      tab.addEventListener('click', function() {
        tabs.forEach(t => t.classList.remove('active'));
        this.classList.add('active');
        
        document.querySelectorAll('.tab-content').forEach(content => {
          content.classList.add('hidden');
        });
        
        const tabId = this.getAttribute('data-tab') + '-tab';
        document.getElementById(tabId).classList.remove('hidden');
      });
    });
    
    // Initialize messages
    generateReminderMessage();
    generatePromoMessage();
    generateFeedbackMessage();
  });
  // Helper Functions -- dont delete
  function formatDate(dateString) {
    if (typeof dateString === 'string') {
      const date = new Date(dateString);
      return date.toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' });
    } else if (dateString instanceof Date) {
      return dateString.toLocaleDateString('en-US', { month: 'long', day: 'numeric' });
    }
    return dateString;
  }

  </script>
@endsection

