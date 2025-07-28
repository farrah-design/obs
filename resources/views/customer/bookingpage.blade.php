@extends('layouts.customer')

@section('title', 'Booking Page')

@section('head')
  <link rel="stylesheet" href="/css/bookingpage.css">
@endsection

@section('content') 
<div class="container">
    <h1>Book Your Appointment</h1>
    
    <div class="booking-steps">
      <div class="step-line"></div>
      <div class="step active" id="step1">
        <div class="step-number">1</div>
        <div>Service</div>
      </div>
      <div class="step" id="step2">
        <div class="step-number">2</div>
        <div>Date & Time</div>
      </div>
      <div class="step" id="step3">
        <div class="step-number">3</div>
        <div>Details</div>
      </div>
      <div class="step" id="step4">
        <div class="step-number">4</div>
        <div>Confirm</div>
      </div>
    </div>

    <!-- Step 1: Service Selection -->
    <div id="serviceStep" class="booking-step">
      <div class="service-options">
        <h3>Select Your Service</h3>
        @foreach($services as $service)
        <div class="service-card" onclick="toggleService(this, '{{ $service->serviceID }}')" id="card_{{ $service->serviceID }}">
          <input type="checkbox" name="service_checkbox[]" value="{{ $service->serviceID }}" id="checkbox_{{ $service->serviceID }}" style="display:none;">
          <div class="service-title">{{ $service->serviceName }}</div>
          <div class="service-desc">{{ $service->description }}</div>
          <div class="service-price">RM{{ number_format($service->price, 2) }}</div>
        </div>
      @endforeach
      </div>
      <div class="button-group">
        <a href="{{ route ('main') }}" class="btn btn-home"><i class="fas fa-home"></i> Back to Home</a>
        <button class="btn btn-next" onclick="nextStep()">Next <i class="fas fa-arrow-right"></i></button>
      </div>
    </div>

    <!-- Step 2: Date & Time -->
    <div id="datetimeStep" class="booking-step" style="display:none">
      <div class="calendar">
        <h3>Select Date</h3>
        <input type="date" id="bookingDate" min="" class="form-control" onchange="loadAvailableTimes()">
        
        <h3 style="margin-top:20px">Available Times</h3>
        <div class="time-slots" id="timeSlots">
          <!-- Times will be loaded here -->
        </div>
      </div>
      
      <div class="button-group">
        <button class="btn btn-prev" onclick="prevStep()"><i class="fas fa-arrow-left"></i> Back</button>
        <button class="btn btn-next" onclick="nextStep()">Next <i class="fas fa-arrow-right"></i></button>
      </div>
    </div>

    <!-- Step 3: Personal Details -->
    <div id="detailsStep" class="booking-step" style="display:none">
      <div class="booking-form">
        <div class="form-group">
          <label for="name">Full Name *</label>
          <input type="text" id="name" value="{{ $customer->name }}" readonly>
        </div>
        
        <div class="form-group">
          <label for="phone">Phone Number *</label>
          <input type="tel" id="phone" value="{{ $customer->phone }}" readonly>
        </div>
        
                 <div class="form-group">
           <label for="stylist">Preferred Stylist (Optional)</label>
           <select id="stylist">
             <option value="Any Stylist">Any Stylist</option>
            @foreach ( $staffMembers as $staff )
            <option value="{{ $staff->name }}">
                {{ $staff->name }} 
                @if($staff->role === 'admin')
                    (Owner)
                @elseif($staff->role === 'manager')
                    (Manager)
                @else
                @endif
            </option>
             @endforeach
           </select>
           <div id="staffAvailabilityMessage" class="staff-availability-message" style="display: none;"></div>
           <div id="staffAvailabilityWarning" class="staff-availability-warning" style="display: none;">
             <i class="fas fa-exclamation-triangle"></i>
             <span>You cannot proceed with an unavailable stylist. Please choose "Any Stylist" or select a different time.</span>
             <button type="button" class="btn-any-stylist" onclick="selectAnyStylist()">Choose Any Stylist</button>
           </div>
         </div>
        
        <div class="form-group full-width">
          <label for="notes">Special Requests (Optional)</label>
          <textarea id="notes" rows="3" placeholder="Any special instructions or allergies we should know about..."></textarea>
        </div>
      </div>
      
      <div class="button-group">
        <button class="btn btn-prev" onclick="prevStep()"><i class="fas fa-arrow-left"></i> Back</button>
        <button class="btn btn-next" type="button" onclick="nextStep()">Review Booking <i class="fas fa-check"></i></button>
      </div>
    </div>

    <!-- Step 4: Confirmation with WhatsApp -->
    <div id="confirmStep" class="booking-step" style="display:none">
      <div class="confirmation">
        <div class="confirmation-icon"><i class="fas fa-calendar-check"></i></div>
        <h2>Ready to Confirm Your Booking?</h2>
        <p>Please review your appointment details below:</p>
        
        <div id="confirmationDetails" class="booking-summary">
          <!-- Booking details will be inserted here -->
        </div>
        
        <p>To complete your booking, please send these details via WhatsApp:</p>
        
        <div class="confirmation-actions">
          <button class="btn btn-success whatsapp-btn" type="submit" onclick="submitBookingToBackend()">
            <i class="fab fa-whatsapp"></i> Confirm Booking via WhatsApp
          </button>
          <button class="btn btn-prev" onclick="prevStep()"><i class="fas fa-edit"></i> Edit Details</button>
        </div>
        
        <p style="margin-top: 30px; font-size: 14px; color: #666;">
          <i class="fas fa-info-circle"></i> Your appointment will be confirmed once we receive your WhatsApp message.
        </p>
      </div>
    </div>
  </div>
  <!-- Hidden form for backend submission (cleaned up and moved here) -->
  <form id="bookingForm" action="{{ route('booking.store') }}" method="POST" style="display:none;">
    @csrf
    <input type="hidden" name="services[]" id="formService">
    <input type="hidden" name="appointment_date" id="formDate">
    <input type="hidden" name="appointment_time" id="formTime">
    <input type="hidden" name="name" id="formName">
    <input type="hidden" name="phone" id="formPhone">
    <input type="hidden" name="email" id="formEmail">
    <input type="hidden" name="stylist" id="formStylist">
    <input type="hidden" name="notes" id="formNotes">
    <a id="whatsappLink" style="display:none;"></a>
  </form>
@endsection

@section('scripts')
  <script>
    // Current step tracking
    let currentStep = 1;
    let selectedService = null;
    let selectedDateTime = null;
    let selectedServices = [];

    // Initialize date picker with minimum date as today
    document.addEventListener('DOMContentLoaded', function() {
      const today = new Date().toISOString().split('T')[0];
      document.getElementById('bookingDate').min = today;
      
      // Restore selected service if going back from step 2
      restoreSelectedService();
    });

    function toggleService(card, serviceID) {
      const checkbox = card.querySelector('input[type="checkbox"]');
      if (checkbox.checked) {
        checkbox.checked = false;
        card.classList.remove('selected');
        selectedServices = selectedServices.filter(s => s !== serviceID);
      } else {
        checkbox.checked = true;
        card.classList.add('selected');
        selectedServices.push(serviceID);
      }
    }

    function restoreSelectedService() {
      if (selectedService && selectedService.cardId) {
        const card = document.getElementById(selectedService.cardId);
        if (card) {
          card.classList.add('selected');
        }
      }
    }

function loadAvailableTimes() {
  const date = document.getElementById('bookingDate').value;
  if (!date) return;

  fetch(`/customer/bookingpage/available-slots?date=${date}`)
    .then(response => response.json())
    .then(times => {
      const container = document.getElementById('timeSlots');
      container.innerHTML = '';

      if (times.length === 0) {
        container.innerHTML = '<p>No available times for this date. Please choose another date.</p>';
        return;
      }

      times.forEach(time => {
        const slot = document.createElement('div');
        slot.className = 'time-slot';
        slot.textContent = time;
        slot.onclick = function () {
          document.querySelectorAll('.time-slot').forEach(s => s.classList.remove('selected'));
          this.classList.add('selected');
          selectedDateTime = `${date} ${time}`;
        };
        container.appendChild(slot);
      });
    })
    .catch(error => {
      console.error('Failed to load times:', error);
    });
}



    async function nextStep() {
       console.log('nextStep called, currentStep:', currentStep);
       // Validate current step before proceeding
       if (currentStep === 1 && selectedServices.length === 0) {
         alert('Please select at least one service');
         return;
       }
       if (currentStep === 2 && !selectedDateTime) {
         alert('Please select a date and time');
         return;
       }
             if (currentStep === 3) {
         try {
           const nameInput = document.getElementById('name');
           const phoneInput = document.getElementById('phone');
           const stylistInput = document.getElementById('stylist');
           const notesInput = document.getElementById('notes');

           const name = nameInput ? nameInput.value.trim() : '';
           const phone = phoneInput ? phoneInput.value.trim() : '';
           const stylist = stylistInput ? stylistInput.value : '';
           const notes = notesInput ? notesInput.value.trim() : '';

           if (!name || !phone) {
             alert('Please fill in all required fields (marked with *)');
             return;
           }
           if (!selectedDateTime) {
             alert('Please select a date and time');
             return;
           }
           if (isNaN(new Date(selectedDateTime).getTime())) {
             alert('Please select a valid date and time');
             return;
           }

           // Check if specific stylist is selected and validate availability
           if (stylist && stylist !== 'Any Stylist') {
             const selectedDate = document.getElementById('bookingDate').value;
             const selectedTime = document.querySelector('.time-slot.selected');
             
             if (selectedTime) {
               const time = selectedTime.textContent;
               
             }
           }
          // Prepare confirmation details
          console.log('selectedServices:', selectedServices);
          console.log('selectedDateTime:', selectedDateTime);
          console.log('name:', name);
          console.log('phone:', phone);
          console.log('stylist:', stylist);
          console.log('notes:', notes);
          if (!Array.isArray(selectedServices) || selectedServices.length === 0) {
            alert('Please select at least one service');
            return;
          }
          const serviceList = selectedServices.join(', ');
          const customerName = name;
          const phoneNumber = phone;
          const emailInput = document.getElementById('email');
          const email = emailInput ? emailInput.value.trim() : '';
          // Format confirmation details for display
          console.log('selectedServices:', selectedServices);
          console.log('selectedDateTime:', selectedDateTime);
          console.log('name:', name);
          console.log('phone:', phone);
          console.log('stylist:', stylist);
          console.log('notes:', notes);
          const detailsHTML = `
            <p><strong>Service IDs:</strong> ${serviceList}</p>
            <p><strong>Date & Time:</strong> ${formatDateTime(selectedDateTime)}</p>
            <p><strong>Name:</strong> ${customerName}</p>
            <p><strong>Phone:</strong> ${phoneNumber}</p>
            ${email ? `<p><strong>Email:</strong> ${email}</p>` : ''}
            <p><strong>Preferred Stylist:</strong> ${stylist}</p>
            ${notes ? `<p><strong>Special Requests:</strong> ${notes}</p>` : ''}
          `;
          document.getElementById('confirmationDetails').innerHTML = detailsHTML;
          // Prepare WhatsApp message
          const whatsappMessage = `
          Hello Sarlini Salon! I would like to book an appointment:\n\n
          *Service IDs:* ${serviceList}\n
          *Date & Time:* ${formatDateTime(selectedDateTime)}\n
          *Name:* ${customerName}\n
          *Phone:* ${phoneNumber}\n
          ${email ? `*Email:* ${email}\\n` : ''}
          *Preferred Stylist:* ${stylist}\n
          ${notes ? `*Special Requests:* ${notes}` : ''}\n\n
          Thank You for booking with us!`
            .replace(/\n        /g, '\n')
            .trim();
          const encodedMessage = encodeURIComponent(whatsappMessage);
          document.getElementById('whatsappLink').href = 
            `https://wa.me/60132918836?text=${encodedMessage}`;

            // Dynamically add selected service IDs as hidden inputs to the form
          const bookingForm = document.getElementById('bookingForm');
          selectedServices.forEach(serviceId => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'services[]';
            input.value = serviceId;
            bookingForm.appendChild(input);
          });

          // Add datetime values to form (split from selectedDateTime)
          const [date, time] = selectedDateTime.split(' ');
          document.getElementById('formDate').value = date;
          document.getElementById('formTime').value = time;

        } catch (err) {
        console.error('🛑 [Booking Error - Step 3] An error occurred while processing the booking step.', {
          message: err.message || 'No error message provided.',
          stack: err.stack || 'No stack trace available.',
          context: {
            selectedServices: selectedServices || 'No services selected',
            selectedDateTime: selectedDateTime || 'No datetime provided',
            customerName: name || 'No name entered',
            customerPhone: phone || 'No phone number entered',
            selectedStylist: stylist || 'No stylist selected',
            additionalNotes: notes || 'No notes provided'
          }
        });
      }
    }
      // Hide current step
      document.getElementById(getStepId(currentStep)).style.display = 'none';
      // Update step indicator
      document.getElementById('step' + currentStep).classList.remove('active');
      if (currentStep < 4) {
        document.getElementById('step' + currentStep).classList.add('completed');
      }
      // Show next step
      currentStep++;
      document.getElementById('step' + currentStep).classList.add('active');
      document.getElementById(getStepId(currentStep)).style.display = 'block';
      // Scroll to top of step
      window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function prevStep() {
      // Hide current step
      document.getElementById(getStepId(currentStep)).style.display = 'none';
      
      // Update step indicator
      document.getElementById('step' + currentStep).classList.remove('active');
      if (currentStep > 1) {
        document.getElementById('step' + (currentStep - 1)).classList.add('active');
      }
      
      // Show previous step
      currentStep--;
      document.getElementById(getStepId(currentStep)).style.display = 'block';
      
      // Restore selected service if going back to step 1
      if (currentStep === 1) {
        restoreSelectedService();
      }
      
      // Scroll to top of step
      window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function getStepId(step) {
      return ['serviceStep', 'datetimeStep', 'detailsStep', 'confirmStep'][step - 1];
    }

    function formatDateTime(dateTimeStr) {
      const options = { 
        weekday: 'long', 
        year: 'numeric', 
        month: 'long', 
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
      };
      return new Date(dateTimeStr).toLocaleDateString('en-US', options);
    }

    function submitBookingToBackend() {
        // Get form values
        const form = document.getElementById('bookingForm');
        const customerName = document.getElementById('name').value.trim();
        const phoneNumber = document.getElementById('phone').value.trim();
        const emailInput = document.getElementById('email');
        const email = emailInput ? emailInput.value.trim() : '';
        const stylist = document.getElementById('stylist').value || 'Any Stylist';
        const notes = document.getElementById('notes').value.trim();

        // Prepare WhatsApp message
        const whatsappMessage = `
            Hello Sarlini Salon! I would like to book an appointment:\n\n
            *Service IDs:* ${selectedServices.join(', ')}\n
            *Date & Time:* ${formatDateTime(selectedDateTime)}\n
            *Name:* ${customerName}\n
            *Phone:* ${phoneNumber}\n
            ${email ? `*Email:* ${email}\\n` : ''}
            *Preferred Stylist:* ${stylist}\n
            ${notes ? `*Special Requests:* ${notes}` : ''}\n\n
            Please confirm my appointment. Thank you!`
            .replace(/\n        /g, '\n')
            .trim();

        // Clear existing service inputs
        const existingServiceInputs = form.querySelectorAll('input[name="services[]"]');
        existingServiceInputs.forEach(input => input.remove());

        // Add selected services to form
        selectedServices.forEach(serviceId => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'services[]';
            input.value = serviceId;
            form.appendChild(input);
        });

        // Set form values
        const [date, time] = selectedDateTime.split(' ');
        document.getElementById('formDate').value = date;
        document.getElementById('formTime').value = time;
        document.getElementById('formName').value = customerName;
        document.getElementById('formPhone').value = phoneNumber;
        document.getElementById('formEmail').value = email;
        document.getElementById('formStylist').value = stylist;
        document.getElementById('formNotes').value = notes;

        // Store WhatsApp message in localStorage to use after submission
        localStorage.setItem('pendingWhatsappMessage', whatsappMessage);

        const message = localStorage.getItem('pendingWhatsappMessage');
        const encodedMessage = encodeURIComponent(message);
        const whatsappUrl = `https://wa.me/60132918836?text=${encodedMessage}`;
        window.open(whatsappUrl, '_blank');
        localStorage.removeItem('pendingWhatsappMessage');
        

        // Trigger form submission
        form.submit();
    }




   // Function to select "Any Stylist" option
   function selectAnyStylist() {
     document.getElementById('stylist').value = 'Any Stylist';
     document.getElementById('staffAvailabilityMessage').style.display = 'none';
     document.getElementById('staffAvailabilityWarning').style.display = 'none';
   }
</script>
@endsection


