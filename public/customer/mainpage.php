<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="data:image/x-icon;base64," />
    <title>Sarlini Salon</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 30px;
    background-color: white;
    border-bottom: 1px solid #ccc;
}

.brand {
    font-weight: bold;
    font-size: 24px;
}

.nav-links {
    list-style: none;
    display: flex;
    margin: 0;
    padding: 0;
}

.nav-links li {
    margin: 0 15px;
}

.nav-links a {
    text-decoration: none;
    color: #343a40;
}

  
  .top-banner {
    background-color: #222c45; 
    color: #fff;
    padding: 10px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 14px;
  }
  .banner-content {
    display: flex;
    align-items: center;
    gap: 15px;
  }
  .btn-book {
    background-color: #3b5269;
    color: #fff;
    padding: 6px 12px;
    border-radius: 4px;
    text-decoration: none;
    font-weight: bold;
  }
  .btn-book:hover {
    background-color: #4c6079;
  }

.auth-buttons {
    display: flex;
    align-items: center;
}

.btn {
    background-color: #f0f0f0;
    color: #202428;
    border: none;
    padding: 10px 15px;
    margin-left: 10px;
    cursor: pointer;
    font-size: 16px;
    border-radius: 4px;
}

.btn-register {
    background-color: #343a40;
    color: white;
}

.btn:hover {
    background-color: #e0e0e0;
}

.btn-register:hover {
    background-color: #555;
}

.hero {
    font-size: 20px;
    margin-bottom: 10px;
    padding: 20px;
    color: #343a40;
    background-color: #dbdee0;
    text-align: center;
}

.hero h1 {
    font-size: 36px;
    margin-bottom: 10px;
    color: #343a40;
    position: relative;
    right: px;
}

p {
    font-size: 18px;
    margin-bottom: 40px;
    color: #54595d;
}

.button {
    background-color: #282b2d;
    color: white;
    padding: 10px 20px;
    text-decoration: none;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
}

.button:hover {
    background-color: #495057;
}

.icon {
    margin-left: 5px;
}

h1 {
    margin-bottom: 20px;
    padding: 20px ;
}
.service-container {
    display: flex;
    justify-content: space-around;
    gap: 10px;
}
.service-card {
    border: 1px solid #ccc;
    border-radius: 8px;
    padding: 20px;
    width: 300px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    text-align: left;
    margin: 10px;
}
.service-icon {
    font-size: 40px;
    margin-bottom: 10px;
}
a {
    text-decoration: none;
    color: #7a7676;;
}

.container h1 {
    margin-bottom: 10px;
}

.steps {
    display: flex;
    justify-content: space-around;
    margin-top: 10px;
    padding : 30px;
}

.step {
    background-color: #ffffff;
    border-radius: 10px;
    padding: 20px;
    width: 200px;
}

.calendar-icon {
    margin-left: 5px;
    font-size: 20px;
}

.icon {
    font-size: 20px;
    margin-bottom: 10px;
    text-align: center;
    box-shadow: #495057;
    border: 2px solid #ccc;
    border-radius: 100px;
    padding: 10px;
    width: 60px;
}

.feedback-container {
  max-width: 600px;
  margin: 40px auto;
  padding: 30px;
  border-radius: 10px;
  background: #fff;
  box-shadow: 0 4px 16px rgba(0,0,0,0.1);
  font-family: 'Segoe UI', sans-serif;
}

.feedback-container h2,
.feedback-container h3 {
  margin-bottom: 20px;
  color: #333;
}

.feedback-container label {
  display: block;
  margin: 15px 0 5px;
  font-weight: 600;
}

.feedback-container select,
.feedback-container textarea {
  width: 100%;
  padding: 10px 12px;
  border: 1px solid #ccc;
  border-radius: 6px;
  resize: vertical;
}

.send-btn {
  margin-top: 20px;
  padding: 10px 16px;
  background-color: #3c91e6;
  color: white;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  font-weight: bold;
}

.send-btn:hover {
  background-color: #2b74c7;
}


/* Footer */
footer {
    background-color: #202428;
    color: #ffffff; 
    text-align: center; 
    padding: 20px 0; 
}

.footer-container {
    display: flex;
    justify-content: space-around; 
    align-items: flex-start; 
    padding: 20px;
}

.footer-section {
    flex: 1; 
    margin: 10px;
}

.footer-section h2, .footer-section h3 {
    margin-bottom: 10px; 
    color: #ffffff;
}

.footer-section h2{
    padding: 20px;
    margin-bottom: 5px;
    color: #ffffff;
}

.footer-section ul {
    list-style-type: none; 
    padding: 0; 
    color: #ffffff;
}

.footer-section li {
    margin: 5px 0; 
    padding: 10px;
    color: #ffffff;
}

.footer-section a {
    color: #ffffff; 
    text-decoration: none;
}

footer p {
    margin-top: 20px; 
    color: #ffffff;
}

/* Responsive typography and spacing */
@media(max-width: 768px) {
    .navbar {
        flex-direction: column;
        align-items: flex-start;
    }
    .auth-buttons {
        margin-top: 10px;
    }
}
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="brand">Sarlini Salon</div>
        <ul class="nav-links">
            <li><a href="service-list.html">Services</a></li>
            <li><a href="bookingpage.html">Book Now</a></li>
            <li><a href="bookingschedule.html">Booking</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
        <div class="auth-buttons">
            <a href="login.html" class="btn">Login</a>
            <a href="register-acc.html" class="btn btn-register">Register</a>
        </div>
    </nav>

    <!-- Top notification bar -->
<div class="top-banner">
  <div class="banner-content">
    <span>Summer Special Offer! <strong>Use code: RAYA15</strong> Valid until April 25, 2025</span>
    <a href="#" class="btn-book">Book Now</a>
  </div>
</div>

    <div class="hero">
    <h1>Book Your Styling Journey</h1>
    <p>Experience salon services with our easy online booking system.</p>
    <a href="bookingpage.html" class="button">
        Book Appointment 
        <span class="calendar-icon">🗓️</span>
    </a>
    </div>

    <h1>Our Services</h1>
    <div class="service-container">
        <div class="service-card">
            <div class="service-icon"><i class="fas fa-cut"></i></div>
            <h2>Haircuts & Styling</h2>
            <p>Haircuts and Styling for all hair types</p>
            <a href="bookingpage.html">Book Now →</a>
        </div>
        <div class="service-card">
            <div class="service-icon"><i class="fas fa-spa"></i></div>
            <h2>Hair Coloring</h2>
            <p>Enhance or transform your look with expert hair coloring services</p>
            <a href="bookingpage.html">Book Now →</a>
        </div>
        <div class="service-card">
            <div class="service-icon"><i class="fas fa-paint-brush"></i></div>
            <h2>Hair Extensions</h2>
            <p>Add volume and length with high-quality hair extensions</p>
            <a href="bookingpage.html">Book Now →</a>
        </div>
        <div class="service-card">
            <div class="service-icon"><i class="fas fa-paint-brush"></i></div>
            <h2>Perms & Texture Services</h2>
            <p>Achieve curls, waves, or sleek straight hair with professional treatments</p>
            <a href="bookingpage.html">Book Now →</a>
        </div>
        <div class="service-card">
            <div class="service-icon"><i class="fas fa-paint-brush"></i></div>
            <h2>Add-On Services</h2>
            <p>Extra care options like blow-dry, hair wash, and shine treatments</p>
            <a href="bookingpage.html">Book Now →</a>
        </div>
    </div>


    <div class="container">
        <h1>How to Book</h1>
        <div class="steps">
            <div class="step">
                <div class="icon">👤</div>
                <h3>Create Account</h3>
                <p>Sign up in minutes</p>
            </div>
            <div class="step">
                <div class="icon">📅</div>
                <h3>Choose Date</h3>
                <p>Select your preferred time</p>
            </div>
            <div class="step">
                <div class="icon">📝</div>
                <h3>Select Service</h3>
                <p>Pick your treatment</p>
            </div>
            <div class="step">
                <div class="icon">✔️</div>
                <h3>Confirm Booking</h3>
                <p>Get instant confirmation</p>
            </div>
        </div>
    </div>

<script>
    // Handle form submission
document.getElementById('feedbackForm').addEventListener('submit', function(e) {
  e.preventDefault();

  const role = document.getElementById('userRole').value;
  const message = document.getElementById('message').value;

  const feedback = {
    role,
    message,
    date: new Date().toLocaleString()
  };

  // Simulate save using localStorage
  const feedbacks = JSON.parse(localStorage.getItem('feedbacks') || '[]');
  feedbacks.push(feedback);
  localStorage.setItem('feedbacks', JSON.stringify(feedbacks));

  // Reset form
  e.target.reset();

  // Refresh display
  displayFeedback();
});

function displayFeedback() {
  const feedbacks = JSON.parse(localStorage.getItem('feedbacks') || '[]');
  const container = document.getElementById('feedbackList');
  container.innerHTML = '';

  feedbacks.reverse().forEach(fb => {
    const div = document.createElement('div');
    div.className = 'feedback-item';
    div.innerHTML = `
      <div class="role">${fb.role} - <small>${fb.date}</small></div>
      <div class="message">${fb.message}</div>
    `;
    container.appendChild(div);
  });
}

window.onload = displayFeedback;
</script>

</body>
</html>