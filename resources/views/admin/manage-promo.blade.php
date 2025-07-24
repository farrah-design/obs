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
        <tr>
          <td>Ramadhan Glow Up</td>
          <td>30% off for hair styling during Ramadhan</td>
          <td>30%</td>
          <td>2025-06-30</td>
          <td>
            <button class="btn-edit"  onclick="openModal('editPromoModal')">Edit</button>
            <button class="btn-delete" onclick="openModal('deletePromoModal')">Delete</button>
            </td>
        </tr>
        <tr>
          <td>New Year Special</td>
          <td>15% off for all hair straightening</td>
          <td>15%</td>
          <td>2025-01-05</td>
          <td>
            <button class="btn-edit" onclick="openModal('editPromoModal')">Edit</button>
            <button class="btn-delete" onclick="openModal('deletePromoModal')">Delete</button>
            </td>

        </tr>
      </tbody>
    </table>
  </div>

  <!-- Add Promotion Modal -->
<div class="modal-overlay" id="addPromoModal">
  <div class="modal-content">
    <h2>Add Promotion</h2>
    <form method="POST" action="{{ route('admin.manage-promo') }}">
      @csrf
      <label>Title</label>
      <input type="text" name="title" required>
      <label>Description</label>
      <textarea rows="3" required></textarea>

      <label>Discount (%)</label>
      <input type="number" min="0" max="100" required />

      <label>Start Date</label>
      <input type="date" required />

      <label>End Date</label>
      <input type="date" required />

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
    <form id="editPromoForm">
      <label>Promotion Title</label>
      <input type="text" value="Summer Glow Package" required />

      <label>Description</label>
      <textarea rows="3" required>Get 15% off any service in June!</textarea>

      <label>Discount (%)</label>
      <input type="number" value="15" min="0" max="100" required />

      <label>Start Date</label>
      <input type="date" value="2025-06-01" required />

      <label>End Date</label>
      <input type="date" value="2025-06-30" required />

      <div class="modal-actions">
        <button type="button" onclick="closeModal('editPromoModal')">Cancel</button>
        <button type="submit">Update</button>
      </div>
    </form>
  </div>
</div>

<!-- Delete Promotion Modal -->
<div class="modal-overlay" id="deletePromoModal">
  <div class="modal-content">
    <h2>Delete Promotion</h2>
    <p>Are you sure you want to delete this promotion?</p>
    <div class="modal-actions">
      <button onclick="closeModal('deletePromoModal')">Cancel</button>
      <button onclick="confirmDelete()">Delete</button>
    </div>
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

  function confirmDelete() {
    alert("Promotion deleted!");
    closeModal('deletePromoModal');
  }

  // Hook forms
  document.getElementById('addPromoForm').addEventListener('submit', function(e) {
    e.preventDefault();
    alert("Promotion added successfully!");
    closeModal('addPromoModal');
  });

  document.getElementById('editPromoForm').addEventListener('submit', function(e) {
    e.preventDefault();
    alert("Promotion updated successfully!");
    closeModal('editPromoModal');
  });
</script>
@endsection

