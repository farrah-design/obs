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
    <div class="appointment-header">
      <button class="btn-remind" onclick="sendReminders()">Send Reminder Notifications</button>
    </div>
    
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
        <tr>
          <td>Sakinah</td>
          <td>Haircut</td>
          <td>2025-06-25</td>
          <td>10:00 AM</td>
          <td><span class="badge upcoming">Upcoming</span></td>
          <td><button class="btn-action btn-remind" onclick="remindCustomer('Sakinah', 'Haircut', '2025-06-25', '10:00 AM')">Remind</button></td>
        </tr>
        <tr>
          <td>Nordin</td>
          <td>Hair Color</td>
          <td>2025-06-26</td>
          <td>02:00 PM</td>
          <td><span class="badge upcoming">Upcoming</span></td>
          <td><button class="btn-action btn-remind" onclick="remindCustomer('Nordin', 'Hair Color', '2025-06-26', '02:00 PM')">Remind</button></td>
        </tr>
      </tbody>
    </table>
    
    <div class="notification-form">
      <h3>Send Reminder Notification</h3>
      <div class="form-group">
        <label for="reminder-customer">Customer</label>
        <select id="reminder-customer" onchange="generateReminderMessage()">
          <option value="Sakinah">Sakinah</option>
          <option value="Nordin">Nordin</option>
        </select>
      </div>
      <div class="form-group">
        <label for="reminder-message">Message <span class="auto-generate" onclick="generateReminderMessage()">(Auto-generate)</span></label>
        <textarea id="reminder-message" rows="3"></textarea>
      </div>
      <button class="send-btn" onclick="sendCustomReminder()">Send Reminder</button>
    </div>
  </div>
  
  <!-- Promotions Tab Content -->
  <div id="promotions-tab" class="tab-content hidden">
    <table class="appointment-table">
      <thead>
        <tr>
          <th>Customer</th>
          <th>Last Visit</th>
          <th>Services Used</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Sakinah</td>
          <td>2025-03-15</td>
          <td>Haircut, Blowout</td>
          <td><button class="btn-action btn-offer" onclick="sendPromotion('Sakinah', '20% off your next haircut!')">Send Offer</button></td>
        </tr>
        <tr>
          <td>Nordin</td>
          <td>2025-04-20</td>
          <td>Hair Color, Treatment</td>
          <td><button class="btn-action btn-offer" onclick="sendPromotion('Nordin', 'Free treatment with your next color service!')">Send Offer</button></td>
        </tr>
      </tbody>
    </table>
    
    <div class="notification-form">
      <h3>Send Promotional Offer</h3>
      <div class="form-group">
        <label for="promo-type">Offer Type</label>
        <select id="promo-type" onchange="generatePromoMessage()">
          <option value="discount">Percentage Discount</option>
          <option value="free">Free Service</option>
          <option value="package">Service Package</option>
        </select>
      </div>
      <div class="form-group">
        <label for="promo-customers">Target Customers</label>
        <select id="promo-customers" multiple onchange="generatePromoMessage()">
          <option value="all">All Customers</option>
          <option value="Sakinah">Sakinah</option>
          <option value="Nordin">Nordin</option>
        </select>
      </div>
      <div class="form-group">
        <label for="promo-message">Message <span class="auto-generate" onclick="generatePromoMessage()">(Auto-generate)</span></label>
        <textarea id="promo-message" rows="3"></textarea>
      </div>
      <button class="send-btn" onclick="sendCustomPromotion()">Send Promotion</button>
    </div>
  </div>
  
  <!-- Feedback Tab Content -->
  <div id="feedback-tab" class="tab-content hidden">
    <table class="appointment-table">
      <thead>
        <tr>
          <th>Customer</th>
          <th>Service</th>
          <th>Date</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Sakinah</td>
          <td>Haircut</td>
          <td>2025-06-10</td>
          <td><span class="badge completed">Completed</span></td>
          <td><button class="btn-action btn-feedback" onclick="sendFeedbackRequest('Sakinah', 'Haircut')">Request Feedback</button></td>
        </tr>
        <tr>
          <td>Nordin</td>
          <td>Hair Color</td>
          <td>2025-06-15</td>
          <td><span class="badge completed">Completed</span></td>
          <td><button class="btn-action btn-feedback" onclick="sendFeedbackRequest('Nordin', 'Hair Color')">Request Feedback</button></td>
        </tr>
      </tbody>
    </table>
    
    <div class="notification-form">
      <h3>Send Feedback Request</h3>
      <div class="form-group">
        <label for="feedback-customer">Customer</label>
        <select id="feedback-customer" onchange="generateFeedbackMessage()">
          <option value="Sakinah">Sakinah</option>
          <option value="Nordin">Nordin</option>
        </select>
      </div>
      <div class="form-group">
        <label for="feedback-message">Message <span class="auto-generate" onclick="generateFeedbackMessage()">(Auto-generate)</span></label>
        <textarea id="feedback-message" rows="3"></textarea>
      </div>
      <button class="send-btn" onclick="sendCustomFeedback()">Request Feedback</button>
    </div>
  </div>
</div>
@endsection

@section('scripts')
  <script> 
   // Database Simulation
   const customerData = {
    'Sakinah': {
      appointments: [
        { service: 'Haircut', date: '2025-06-25', time: '10:00 AM' }
      ],
      lastService: 'Haircut',
      lastVisit: 'June 10, 2025',
      history: ['Haircut', 'Blowout'],
      preferences: { contact: 'sms', favoriteService: 'Haircut' }
    },
    'Nordin': {
      appointments: [
        { service: 'Hair Color', date: '2025-06-26', time: '02:00 PM' }
      ],
      lastService: 'Hair Color',
      lastVisit: 'June 15, 2025',
      history: ['Hair Color', 'Treatment'],
      preferences: { contact: 'email', favoriteService: 'Hair Color' }
    }
  };

  // Tab Management
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

  // Message Generation Functions
  function generateReminderMessage() {
    const customer = document.getElementById('reminder-customer').value;
    const data = customerData[customer];
    const appointment = data.appointments[0];
    
    const templates = [
      `Hi ${customer}! Just a reminder about your ${appointment.service} appointment on ${formatDate(appointment.date)} at ${appointment.time}. See you then!`,
      `Dear ${customer}, don't forget your ${appointment.service} on ${formatDate(appointment.date)} at ${appointment.time}. Reply YES to confirm.`,
      `${customer}, your beauty appointment is coming up! ${appointment.service} on ${formatDate(appointment.date)} at ${appointment.time}. We look forward to seeing you!`
    ];
    
    document.getElementById('reminder-message').value = templates[Math.floor(Math.random() * templates.length)];
  }

  function generatePromoMessage() {
    const promoType = document.getElementById('promo-type').value;
    const customers = Array.from(document.getElementById('promo-customers').selectedOptions)
                         .map(option => option.value);
    const isAll = customers.includes('all');
    
    const expiryDate = new Date();
    expiryDate.setDate(expiryDate.getDate() + 14);
    const formattedDate = formatDate(expiryDate);
    
    let offer, templates;
    switch(promoType) {
      case 'discount':
        offer = "20% off your next service";
        templates = [
          `Summer treat! ${offer} when you book before ${formattedDate}. Use code GLOW20.`,
          `You deserve it! ${offer} just for our valued customers. Valid until ${formattedDate}.`,
          `Exclusive offer: ${offer} as our thank you for being a loyal client!`
        ];
        break;
      case 'free':
        offer = "a free hair treatment (worth $35)";
        templates = [
          `Book any color service and get ${offer}! Limited time until ${formattedDate}.`,
          `Special gift for you: ${offer} with your next visit. Book now!`,
          `We miss you! Come back for color services and enjoy ${offer} on us!`
        ];
        break;
      case 'package':
        offer = "Full Glam Package (cut + color + treatment) for $99";
        templates = [
          `VIP deal: ${offer} (regular $150)! Save big until ${formattedDate}.`,
          `Pamper yourself! ${offer} - our best deal this season!`,
          `Transform your look! Now only $99 for our complete luxury package.`
        ];
        break;
    }
    
    const greeting = isAll ? "Hello valued clients!" : `Hi ${customers.join(' and ')}!`;
    document.getElementById('promo-message').value = `${greeting} ${templates[Math.floor(Math.random() * templates.length)]}`;
  }

  function generateFeedbackMessage() {
    const customer = document.getElementById('feedback-customer').value;
    const data = customerData[customer];
    
    const templates = [
      `Hi ${customer}! How was your ${data.lastService} on ${data.lastVisit}? We'd love your feedback!`,
      `Dear ${customer}, hope you're loving your new look! Could you rate your recent ${data.lastService}?`,
      `${customer}, your opinion matters! How was your ${data.lastService} experience with us?`
    ];
    
    document.getElementById('feedback-message').value = templates[Math.floor(Math.random() * templates.length)];
  }

  // Notification Sending Functions
  function remindCustomer(customer, service, date, time) {
    const message = `Hi ${customer}, this is a reminder about your ${service} appointment on ${date} at ${time}.`;
    showNotification(`Reminder sent to ${customer}`, message);
  }
  
  function sendReminders() {
    const names = Array.from(document.querySelectorAll('#appointments-tab tbody tr')).map(row => row.cells[0].innerText);
    names.forEach(name => {
      const data = customerData[name];
      const appointment = data.appointments[0];
      remindCustomer(name, appointment.service, appointment.date, appointment.time);
    });
  }
  
  function sendCustomReminder() {
    const customer = document.getElementById('reminder-customer').value;
    const message = document.getElementById('reminder-message').value;
    showNotification(`Custom reminder sent to ${customer}`, message);
  }
  
  function sendPromotion(customer, offer) {
    const message = `Hi ${customer}! ${offer} Book now to take advantage of this special offer!`;
    showNotification(`Promotion sent to ${customer}`, message);
  }
  
  function sendCustomPromotion() {
    const message = document.getElementById('promo-message').value;
    showNotification(`Promotion sent`, message);
  }
  
  function sendFeedbackRequest(customer, service) {
    const message = `Hi ${customer}, how was your recent ${service} with us? We'd love your feedback!`;
    showNotification(`Feedback request sent to ${customer}`, message);
  }
  
  function sendCustomFeedback() {
    const customer = document.getElementById('feedback-customer').value;
    const message = document.getElementById('feedback-message').value;
    showNotification(`Feedback request sent to ${customer}`, message);
  }

  // Helper Functions
  function formatDate(dateString) {
    if (typeof dateString === 'string') {
      const date = new Date(dateString);
      return date.toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' });
    } else if (dateString instanceof Date) {
      return dateString.toLocaleDateString('en-US', { month: 'long', day: 'numeric' });
    }
    return dateString;
  }

  function showNotification(title, message) {
    alert(`${title}:\n\n${message}`);
  }
  </script>
@endsection

