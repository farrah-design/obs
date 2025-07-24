<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="icon" type="image/x-icon" href="data:image/x-icon;base64," />
<title>Sarilini Salon - Service Catalogue</title>
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

  /* Title & Intro */
h1.catalog-title {
    text-align: center;
    margin-top: 30px;
    font-size: 2.5em;
    color: #444;
}
.catalog-intro {
    text-align: center;
    max-width: 800px;
    margin: 10px auto 30px;
    font-size: 1.2em;
    color: #666;
}

/* Service Container */
.service-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    padding: 0 20px 40px;
}

/* Service Card */
.service-card {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    padding: 20px;
    transition: transform 0.2s, box-shadow 0.2s;
}
.service-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0,0,0,0.2);
}
.service-icon {
    font-size: 2em;
    margin-bottom: 10px;
    color: #ff4b2b; /* Example color, can customize */
}
h2 {
    margin-top: 0;
    font-size: 1.5em;
    color: #222;
}
p {
    font-size: 1em;
    margin: 10px 0;
}
h3 {
    margin-top: 20px;
    font-size: 1.2em;
    color: #444;
}
ul {
    list-style-type: disc;
    margin-left: 20px;
}
ul li {
    margin: 8px 0;
}

/* How to Book Section */
.container {
    max-width: 800px;
    margin: 40px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}
h2 {
    text-align: center;
    color: #222;
}
ol {
    margin: 20px 0;
    padding-left: 20px;
}
li {
    margin: 10px 0;
    font-size: 1.1em;
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
    text-decoration: none;
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

<!-- Hero section can be removed or adjusted for catalog -->
<h1 class="catalog-title">Our Service Catalogue</h1>
<p class="catalog-intro">Explore our wide range of beauty services. Find the perfect treatment for you!</p>

<div class="service-container">
    <!-- Service 1 -->
    <div class="service-card">
        <div class="service-icon"><i class="fas fa-cut"></i></div>
        <h2>Haircuts & Styling</h2>
        <p>Professional haircuts and styling tailored to your preferences for all hair types.</p>
        <h3>Details</h3>
        <ul>
            <li>Men & Women Cuts</li>
            <li>Bridal & Special Occasion Styling</li>
            <li>Kids Cuts</li>
        </ul>
    </div>
    
    <!-- Service 2 -->
    <div class="service-card">
        <div class="service-icon"><i class="fas fa-spa"></i></div>
        <h2>Hair Coloring</h2>
        <p>Transform your look with expert coloring techniques, from highlights to full color.</p>
        <h3>Methods</h3>
        <ul>
            <li>Highlights & Lowlights</li>
            <li>Balayage & Ombre</li>
        </ul>
    </div>
    
    <!-- Service 3 -->
    <div class="service-card">
        <div class="service-icon"><i class="fas fa-paint-brush"></i></div>
        <h2>Hair Extensions</h2>
        <p>Add length and volume with premium hair extension options.</p>
        <h3>Types</h3>
        <ul>
            <li>Braids Extensions</li>
            <li>Fusion Extensions</li>
        </ul>
    </div>
    
    <!-- Service 4 -->
    <div class="service-card">
        <div class="service-icon"><i class="fas fa-perm"></i></div>
        <h2>Perms & Texture Services</h2>
        <p>Achieve curls, waves, or sleek straight hair with our texture treatments.</p>
        <h3>Options</h3>
        <ul>
            <li>Perms</li>
            <li>Straightening</li>
            <li>Wave & Curl Enhancements</li>
        </ul>
    </div>
    
    <!-- Service 5 -->
    <div class="service-card">
        <div class="service-icon"><i class="fas fa-sparkles"></i></div>
        <h2>Add-On Services</h2>
        <p>Extra care options including blow-dry, hair wash, shine treatments, and more.</p>
        <h3>Extras</h3>
        <ul>
            <li>Blow Dry & Styling</li>
        </ul>
    </div>
</div>


<div class="container">
<h2>How to Book Your Service</h2>
<ol>
    <li><strong>Create Account:</strong> Sign up in minutes to access all services.</li>
    <li><strong>Choose Service:</strong> Explore and select your desired treatment.</li>
    <li><strong>Pick Date & Time:</strong> Schedule your appointment conveniently.</li>
    <li><strong>Confirm & Enjoy:</strong> Get instant confirmation and look forward to your appointment!</li>
</ol>
</div>

<!-- Footer stays the same -->


<script>
    // Example: Smooth scroll to sections
document.querySelectorAll('a[href^="#"]').forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({ behavior: 'smooth' });
    });
});

fetch('/api/services')
    .then(res => res.json())
    .then(data => console.log(data));
</script>
</body>
</html>