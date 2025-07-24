@extends('layouts.customer')

@section('title', 'Promotions')

@section('head')
  <link rel="stylesheet" href="/css/promotions.css">
@endsection

@section('content') 
<div class="container">
    <h1>Current Promotions</h1>
    
    <div class="promo-grid">
      <!-- Facebook Promotion -->
      <div class="promo-card">
        <span class="promo-badge social-badge"><i class="fab fa-facebook"></i> Facebook</span>
        <h3 class="promo-title">Check-In Discount</h3>
        <p class="promo-desc">10% off when you check in at our salon on Facebook!</p>
        <div class="promo-meta">
          <span class="promo-expiry"><i class="fas fa-clock"></i> Ongoing</span>
          <button class="btn-claim" onclick="showSocialInstructions('facebook')">How To Claim</button>
        </div>
      </div>
      
      <!-- Instagram Promotion -->
      <div class="promo-card">
        <span class="promo-badge insta-badge"><i class="fab fa-instagram"></i> Instagram</span>
        <h3 class="promo-title">Tag & Save</h3>
        <p class="promo-desc">15% off when you post your new look and tag us @SarliniSalon!</p>
        <div class="promo-meta">
          <span class="promo-expiry"><i class="fas fa-clock"></i> Ongoing</span>
          <button class="btn-claim" onclick="showSocialInstructions('instagram')">How To Claim</button>
        </div>
      </div>
      
      <!-- TikTok Promotion -->
      <div class="promo-card">
        <span class="promo-badge tiktok-badge"><i class="fab fa-tiktok"></i> TikTok</span>
        <h3 class="promo-title">Viral Discount</h3>
        <p class="promo-desc">Get 20% off when you make a TikTok video at our salon!</p>
        <div class="promo-meta">
          <span class="promo-expiry"><i class="fas fa-clock"></i> Until: 31/12/2025</span>
          <button class="btn-claim" onclick="showSocialInstructions('tiktok')">How To Claim</button>
        </div>
      </div>
      
      <!-- Standard Promotion -->
      <div class="promo-card">
        <span class="promo-badge">Ramadhan Special</span>
        <h3 class="promo-title">Ramadhan Glow Up</h3>
        <p class="promo-desc">30% off for hair styling during Ramadhan month.</p>
        <div class="promo-meta">
          <span class="promo-expiry"><i class="fas fa-clock"></i> Until: 30/06/2025</span>
          <button class="btn-claim" onclick="showPromoCode('RAMADHAN30')">Claim Offer</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Social Media Instructions Modal -->
  <div class="modal" id="socialModal">
    <div class="modal-content">
      <h3 id="socialModalTitle">Social Media Offer</h3>
      <div id="socialModalContent">
        <p>Follow these steps to claim your discount:</p>
        <ol id="socialSteps"></ol>
        <div class="social-icons">
          <div class="social-icon facebook"><i class="fab fa-facebook-f"></i></div>
          <div class="social-icon instagram"><i class="fab fa-instagram"></i></div>
          <div class="social-icon tiktok"><i class="fab fa-tiktok"></i></div>
        </div>
      </div>
      <div class="modal-actions">
        <button class="btn-claim" onclick="closeModal()">Got It!</button>
      </div>
    </div>
  </div>

  <!-- Standard Promo Code Modal -->
  <div class="modal" id="promoModal">
    <div class="modal-content">
      <h3>Your Promotion Code</h3>
      <p>Show this code when booking or at checkout:</p>
      <div style="background: #f8f8f8; padding: 15px; text-align: center; margin: 15px 0; border-radius: 4px;">
        <strong id="promoCode" style="font-size: 18px;">PROMOCODE</strong>
      </div>
      <div class="modal-actions">
        <button class="btn-claim" onclick="closeModal()">Close</button>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
<script>
function showSocialInstructions(platform) {
      const modal = document.getElementById('socialModal');
      const title = document.getElementById('socialModalTitle');
      const steps = document.getElementById('socialSteps');
      
      if(platform === 'facebook') {
        title.textContent = 'Facebook Check-In Offer';
        steps.innerHTML = `
          <li>Check in at Sarlini Salon on Facebook during your visit</li>
          <li>Show your check-in to our staff</li>
          <li>Receive 10% off immediately!</li>
        `;
      } 
      else if(platform === 'instagram') {
        title.textContent = 'Instagram Tag Offer';
        steps.innerHTML = `
          <li>Post your new look on Instagram</li>
          <li>Tag @SarliniSalon in your post</li>
          <li>Show the post to staff on your next visit</li>
          <li>Get 15% off that service!</li>
        `;
      }
      else if(platform === 'tiktok') {
        title.textContent = 'TikTok Video Offer';
        steps.innerHTML = `
          <li>Create a fun TikTok video at our salon</li>
          <li>Use hashtag #SarliniSalon</li>
          <li>Show your video to staff before paying</li>
          <li>Enjoy 20% off your service!</li>
        `;
      }
      
      modal.style.display = 'flex';
    }

    function showPromoCode(code) {
      document.getElementById('promoCode').textContent = code;
      document.getElementById('promoModal').style.display = 'flex';
    }

    function closeModal() {
      document.getElementById('socialModal').style.display = 'none';
      document.getElementById('promoModal').style.display = 'none';
    }

    window.onclick = function(event) {
      if (event.target.className === 'modal') {
        closeModal();
      }
    }
</script>
@endsection

