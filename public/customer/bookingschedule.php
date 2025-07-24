<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Sarlini Salon Appointments</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
<style>
  * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family: 'Helvetica Neue', Arial, sans-serif;
    line-height: 1.4;
  }
  
  
  body {
    background-color: #f0f4f8; 
    color: #333;
  }

  header {
    display: flex;
    justify-content: space-between;
    padding: 15px 40px;
    background-color: #fff;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
  }
  header .logo {
    font-size: 20px;
    font-weight: bold;
    color: #222c45;
  }
  nav a {
    margin-left: 25px;
    text-decoration: none;
    color: #55657a;
    font-weight: 600;
  }
  nav a:hover {
    color: #343a40;
  }

.section-title {
    font-size: 24px;
    font-weight: bold;
    margin: 20px;
    text-align: center;
    color: #222;
  }

  /* Schedule section */
.schedule-section {
  background-color: #fff;
  border-radius: 15px;
  padding: 20px;
  width: 90%;
  margin: 0 auto;
  box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.schedule-content {
  text-align: center;
  font-size: 14px;
  color: #999;
}

  /* Action Buttons */
  .actions {
    display: flex;
    gap: 10px;
  }
  .edit-btn {
    background: #fff;
    border: 1px solid #ccc;
    padding: 4px 10px;
    border-radius: 5px;
    font-weight: 500;
    cursor: pointer;
  }
  .delete-btn {
    background: #f44336;
    color: #fff;
    border: none;
    padding: 4px 10px;
    border-radius: 5px;
    font-weight: 500;
    cursor: pointer;
  }

  /* Status badge styles */
.status-badge {
  padding: 4px 10px;
  border-radius: 20px;
  font-size: 12px;
  font-weight: 600;
  color: white;
  display: inline-block;
}

.confirmed {
  background-color: #4CAF50; /* Green */
}

/* modal.css */

.modal {
  display: none;
  position: fixed;
  z-index: 999;
  left: 0; top: 0;
  width: 100%; height: 100%;
  background-color: rgba(0, 0, 0, 0.4);
  justify-content: center;
  align-items: center;
  padding: 20px;
}

.modal-content {
  background-color: #fff;
  padding: 20px;
  border-radius: 8px;
  width: 100%;
  max-width: 400px;
  box-shadow: 0 5px 15px rgba(0,0,0,0.3);
}

.modal-title {
  margin-top: 0;
  margin-bottom: 15px;
  font-size: 1.5em;
}

.current-appointment-details {
  margin-bottom: 15px;
  background-color: #eceded;
  padding: 10px;
  border-radius: 5px;
}

#rescheduleForm div {
  margin-bottom: 10px;
}

#rescheduleForm label {
  display: block;
  margin-bottom: 4px;
}

#rescheduleForm input,
#rescheduleForm select {
  width: 100%;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

.note-box {
  background-color: #fff3cd;
  color: #856404;
  padding: 20px;
  border-radius: 4px;
  margin-bottom: 15px;
}

.note-box ul {
  list-style-type: disc;
  padding-left: 20px;
}

.modal-buttons {
  display: flex;
  justify-content: space-between;
}

.cancel-btn {
  padding: 8px 16px;
  background-color: #f44336;
  color: #eee;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.confirm-btn {
  padding: 8px 16px;
  background-color: #4CAF50;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

 /* Table Styles */
.appointments-table {
  width: 100%;
  border-collapse: collapse;
  background-color: #fff;
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

.appointments-table thead {
  background-color: #f2f2f2;
}

.appointments-table th {
  padding: 15px;
  text-align: left;
  font-weight: 600;
  font-size: 14px;
}

.appointments-table td {
  padding: 15px;
  font-size: 14px;
  border-bottom: 1px solid #eee;
}

/* Status badge styles */
.status-badge {
  padding: 4px 10px;
  border-radius: 20px;
  font-size: 12px;
  font-weight: 600;
  color: white;
  display: inline-block;
}

.confirmed {
  background-color: #4CAF50; /* Green */
}

/* Actions button */
.details-btn {
  padding: 6px 12px;
  border: none;
  background-color: #b51f5d;
  color: #fff;
  border-radius: 4px;
  cursor: pointer;
  font-weight: 600;
  font-size: 14px;
  transition: background-color 0.3s;
}

.details-btn:hover {
  background-color: #8f1742;
}

.feedback-btn {
  background-color: #ffc107;
  color: #222;
  border: none;
  padding: 5px 10px;
  border-radius: 6px;
  font-weight: 600;
  cursor: pointer;
}

.feedback-btn:hover {
  background-color: #e0a800;
}

.upcoming {
  background-color: #ff9800; /* Orange */
}

</style>
</head>
<body>

  <!-- Header Navigation -->
<header>
  <div class="logo">Sarlini Salon</div>
  <nav>
    <a href="mainpage.html">Home</a>
    <a href="service-list.html">Services</a>
    <a href="bookingschedule.html">Booking</a>
    <a href="bookingpage.html">Book Now</a>
  </nav>
</header>

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
<tr>
  <td>2025-05-28</td>
  <td>13:00</td>
  <td>Hair Wash & Blow</td>
  <td><div class="status-badge confirmed">Completed</div></td>
  <td>
    <button class="edit-btn" onclick="showRescheduleModal()">Reschedule</button>
    <button class="delete-btn">Delete</button>
    <button class="feedback-btn" onclick="openFeedbackModal('Hair Wash & Blow', '2025-05-28')">Give Feedback</button>
  </td>
</tr>
  <tr>
  <td>2025-06-30</td>
  <td>11:30</td>
  <td>Facial Treatment</td>
  <td><div class="status-badge upcoming">Upcoming</div></td>
  <td>
    <button class="edit-btn" onclick="showRescheduleModal()">Reschedule</button>
    <button class="delete-btn">Delete</button>
    <button class="feedback-btn" disabled style="opacity: 0.6; cursor: not-allowed;">Give Feedback</button>
  </td>
</tr>
  </tbody>
</table>


<!-- reschedule modal -->
<div class="modal" id="rescheduleModal">
  <div class="modal-content">
    <h2 class="modal-title">Reschedule Appointment</h2>
    <div class="current-appointment-details">
      <p><strong>Service:</strong> Haircut</p>
      <p><strong>Date:</strong> Saturday, March 15, 2025</p>
      <p><strong>Time:</strong> 12:00 AM</p>
    </div>
    <form id="rescheduleForm">
      <div>
        <label for="newDate">New Date</label>
        <input type="date" id="newDate" name="newDate" required />
      </div>
      <div>
        <label for="newTime">New Time</label>
        <select id="newTime" name="newTime" required>
          <option value="">Select a time</option>
          <option value="09:00">09:00 AM</option>
          <option value="10:00">10:00 AM</option>
          <option value="11:00">11:00 AM</option>
          <option value="12:00">12:00 PM</option>
          <!-- Add more time options if needed -->
        </select>
      </div>
      <div class="note-box">
        <strong>⚠️ Please note:</strong>
        <ul>
          <li>Appointments can only be rescheduled at least 24 hours in advance</li>
          <li>Time slots are subject to availability</li>
          <li>You can reschedule up to 2 times per appointment</li>
        </ul>
      </div>
      <div class="modal-buttons">
        <button type="button" class="cancel-btn">Cancel</button>
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
    <form id="feedbackForm">
      <label for="feedbackText">Tell us how it went:</label>
      <textarea id="feedbackText" required style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ccc; height: 100px; margin: 10px 0;"></textarea>
      <div class="modal-buttons">
        <button type="button" class="cancel-btn" onclick="closeFeedbackModal()">Cancel</button>
        <button type="submit" class="confirm-btn">Submit Feedback</button>
      </div>
    </form>
  </div>
</div>

<script>
  // Optional: JavaScript for functionality like button clicks can be added here
  document.querySelectorAll('.delete-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      alert('Are you sure you want to delete?');
    });
  });

function showRescheduleModal() {
  rescheduleModal.style.display = 'flex';
}

function hideRescheduleModal() {
  rescheduleModal.style.display = 'none';
}

document.querySelector('.cancel-btn').addEventListener('click', hideRescheduleModal);

window.onclick = (event) => {
  if (event.target === rescheduleModal) {
    hideRescheduleModal();
  }
};

// Handle form submit
document.getElementById('rescheduleForm')?.addEventListener('submit', (e) => {
  e.preventDefault();
  alert('Appointment rescheduled!');
  hideRescheduleModal();
});

// Feedback modal handlers
function openFeedbackModal(service, date) {
  document.getElementById('feedbackModal').style.display = 'flex';
  document.getElementById('feedbackServiceInfo').innerText = `${service} on ${date}`;
}

function closeFeedbackModal() {
  document.getElementById('feedbackModal').style.display = 'none';
  document.getElementById('feedbackForm').reset();
}

// Feedback form submission
document.getElementById('feedbackForm').addEventListener('submit', function(e) {
  e.preventDefault();
  const feedback = {
    service: document.getElementById('feedbackServiceInfo').innerText,
    message: document.getElementById('feedbackText').value,
    date: new Date().toLocaleString()
  };

  // Store feedback locally (simulate backend)
  const list = JSON.parse(localStorage.getItem('customer_feedbacks') || '[]');
  list.push(feedback);
  localStorage.setItem('customer_feedbacks', JSON.stringify(list));

  alert('Thank you for your feedback!');
  closeFeedbackModal();
});

fetch('/api/feedbacks', {
  method: 'POST',
  headers: {'Content-Type': 'application/json'},
  body: JSON.stringify({date: '2024-06-24', rating: 5, comment: 'Great!', customerID: 1})
})
.then(res => res.json())
.then(data => console.log(data));

</script>

</body>
</html>