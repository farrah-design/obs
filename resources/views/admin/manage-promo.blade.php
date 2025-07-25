@extends('layouts.admin')

@section('title', 'Manage Promotions & Discounts')

@section('head')
  <link rel="stylesheet" href="/css/managePromo.css">
@endsection

@section('content') 
<div class="container">
    <h1>Manage Promotions & Discounts</h1>

    <div class="promo-header">
      <button class="btn btn-add" onclick="openModal('addPromoModal')">+ Add Promotion</button>
    </div>

    <table class="promo-table">
      <thead>
        <tr>
          <th>Title</th>
          <th>Description</th>
          <th>Discount</th>
          <th>Valid Until</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($promotions as $promotion)
        <tr>
          <td>{{ $promotion->title }}</td>
          <td>{{ $promotion->description }}</td>
          <td>{{ $promotion->discountPrice }}%</td>
          <td>{{ $promotion->validUntil->format('Y-m-d') }}</td>
          <td>
            <button class="btn-edit" 
                    data-id="{{ $promotion->promoID }}"
                    data-title="{{ $promotion->title }}"
                    data-description="{{ $promotion->description }}"
                    data-discount="{{ $promotion->discountPrice }}"
                    data-end="{{ $promotion->validUntil->format('Y-m-d') }}"
                    onclick="populateEditModal(this)">Edit</button>
            
            <form method="POST" action="{{ route('admin.delete-promo')}}" class="d-inline">
              @csrf
              <input type="hidden" name="promoID" id="deletePromoID" value="{{ $promotion->promoID }}">
              <button type="submit" class="btn-delete" onclick="return confirm('Delete this promotion?')">Delete</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
</div>

<!-- Add Promotion Modal -->
<div class="modal-overlay" id="addPromoModal">
  <div class="modal-content">
    <h2>Add Promotion</h2>
    <form method="POST" action="{{ route('admin.create-promo') }}" id="addPromoForm">
      @csrf
      <label>Title</label>
      <input type="text" name="title" required maxlength="100">

      <label>Description</label>
      <textarea name="description" rows="3" required maxlength="500"></textarea>

      <label>Discount (%)</label>
      <input type="number" name="discountPrice" min="1" max="100" required>

      <label>End Date</label>
      <input type="date" name="validUntil" required min="{{ now()->format('Y-m-d') }}">

      <div class="modal-actions">
        <button type="button" onclick="closeModal('addPromoModal')">Cancel</button>
        <button type="submit">Save</button>
      </div>
    </form>
  </div>
</div>

<!-- Edit Promotion Modal -->
<div class="modal-overlay" id="editPromoModal">
  <div class="modal-content">
    <h2>Edit Promotion</h2>
    <form method="POST" action="{{ route('admin.update-promo') }}" id="editPromoForm">
      @csrf
      <input type="hidden" name="promoID" id="editPromoID">

      <label>Promotion Title</label>
      <input type="text" name="title" id="editTitle" required maxlength="100">

      <label>Description</label>
      <textarea name="description" id="editDescription" rows="3" required maxlength="500"></textarea>

      <label>Discount (%)</label>
      <input type="number" name="discountPrice" id="editDiscount" min="1" max="100" required>

      <label>End Date</label>
      <input type="date" name="validUntil" id="editEndDate" required>

      <div class="modal-actions">
        <button type="button" onclick="closeModal('editPromoModal')">Cancel</button>
        <button type="submit">Update</button>
      </div>
    </form>
  </div>
</div>
@endsection

@section('scripts')
<script>
  function openModal(id) {
    document.getElementById(id).classList.add('show');
  }

  function closeModal(id) {
    document.getElementById(id).classList.remove('show');
  }

  function populateEditModal(button) {
    const form = document.getElementById('editPromoForm');
    document.getElementById('editPromoID').value = button.dataset.id;
    document.getElementById('editTitle').value = button.dataset.title;
    document.getElementById('editDescription').value = button.dataset.description;
    document.getElementById('editDiscount').value = button.dataset.discount;
    document.getElementById('editEndDate').value = button.dataset.end;
    
    openModal('editPromoModal');
  }

  // Close modal when clicking outside
  document.querySelectorAll('.modal-overlay').forEach(modal => {
    modal.addEventListener('click', function(e) {
      if (e.target === modal) {
        closeModal(modal.id);
      }
    });
  });
</script>
@endsection