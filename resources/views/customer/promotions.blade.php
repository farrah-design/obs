@extends('layouts.customer')

@section('title', 'Promotions')

@section('head')
  <link rel="stylesheet" href="/css/promotions.css">
@endsection

@section('content') 
<div class="container">
    <h1>Current Promotions</h1>
    
    @if($promotions->isEmpty())
        <p class="no-promos">No promotions are currently available. Please check back later!</p>
    @else
        <div class="promo-list">
            @foreach($promotions as $promo)
                <div class="promo-card">
                    <h1 class="promo-badge">{{ $promo->title }}</h1>
                    <p class="promo-desc">{{ $promo->description }}</p>
                    <p class="promo-discount">Discount: <strong>{{ $promo->discountPrice }}%</strong></p>
                    <div class="promo-meta">
                        <span class="promo-dates">
                            <i class="fas fa-clock"></i> 
                            Valid until: {{ \Carbon\Carbon::parse($promo->validUntil)->format('d M Y') }}
                        </span>
                            <button class="btn-claim" onclick="showPromoCode('{{ $promo->id }}')">Claim Offer
                          </button>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<!-- Standard Promo Code Modal -->
<div class="modal" id="promoModal">
    <div class="modal-content">
        <h3>Your Promotion Code</h3>
        <p>Show this code to staff during your visit:</p>
        <div style="background: #f8f8f8; padding: 15px; text-align: center; margin: 15px 0; border-radius: 4px;">
            <strong id="promoCode" style="font-size: 18px;"></strong>
        </div>
        <div class="modal-actions">
            <button class="btn-claim" onclick="closeModal()">Close</button>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
      // Function to generate random promo code
    function generatePromoCode(promotionId) {
        const letters = 'ABCDEFGHJKLMNPQRSTUVWXYZ'; // Removed I and O for clarity
        const numbers = '23456789'; // Removed 0 and 1 for clarity
        
        // Get first 3 letters of promotion title (or use default)
        let prefix = 'SS';
        if (promotionId && promotionId.length >= 3) {
            prefix = promotionId.substring(0, 3).toUpperCase();
        }
        
        // Generate random 6-character code
        let code = '';
        for (let i = 0; i < 2; i++) {
            code += letters.charAt(Math.floor(Math.random() * letters.length));
            code += numbers.charAt(Math.floor(Math.random() * numbers.length));
        }
        
        return `${prefix}${code}`;
    }

    function showPromoCode(promotionId) {
        // Generate the code when showing the modal
        const code = generatePromoCode(promotionId);
        document.getElementById('promoCode').textContent = code;
        document.getElementById('promoModal').style.display = 'flex';
    }

    function closeModal() {
        // Close both modals if they're open
        document.getElementById('promoModal').style.display = 'none';
        document.getElementById('socialModal').style.display = 'none';
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        if (event.target.className === 'modal') {
            closeModal();
        }
    }
</script>
@endsection

