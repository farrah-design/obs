@extends('layouts.admin')

@section('title', 'Manage Services')

@section('head')
  <link rel="stylesheet" href="/css/manageService.css">
@endsection

@section('content')
<div class="container">
    <h1>Manage Services</h1>
    <button class="btn btn-add" onclick="openModal('addServiceForm')">+ Add New Service</button>

    <div class="catalogue-grid">
      <div class="service-card">
      <h2><i class="fas fa-cut" id="service-icon"></i>Haircuts & Styling</h2>
        <p>Professional haircuts and styling tailored to your preferences for all hair types.</p>
        <h3>Details</h3>
        <ul>
            <li>Men & Women Cuts</li>
            <li>Bridal & Special Occasion Styling</li>
            <li>Kids Cuts</li>
        </ul>
        <h3>Price: From RM10</h3>
        <h3>Duration: ~20 minutes</h3>
        <div class="action-buttons">
          <button class="btn btn-edit">Edit</button>
          <form method="POST" action="{{ route('services.destroy', $service->serviceID) }}" onsubmit="return confirm('Delete this service?')">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
          </form>
        </div>
      </div>

      <div class="service-card">
      <div class="service-icon"></div>
      <h2><i class="fas fa-paint-brush" id="service-icon"></i>Hair Coloring</h2>
        <p>Transform your look with expert coloring techniques, from highlights to full color.</p>
        <h3>Methods</h3>
        <ul>
            <li>Highlights & Lowlights</li>
            <li>Balayage & Ombre</li>
        </ul>
        <h3>Price: From RM150</h3>
        <h3>Duration: ~1.5 hours</h3>
        <div class="action-buttons" style="margin-top: 39px;">
          <button class="btn btn-edit">Edit</button>
          <form method="POST" action="{{ route('services.destroy', $service->serviceID) }}" onsubmit="return confirm('Delete this service?')">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
          </form>
        </div>
      </div>

      <div class="service-card">
      <h2><i class="fas fa-plus-circle" id="service-icon"></i>Hair Extensions</h2>
        <p>Add length and volume with premium hair extension options.</p>
        <h3>Price: From RM100</h3>
        <h3>Types</h3>
        <ul>
            <li>Braids Extensions</li>
            <li>Fusion Extensions</li>
        </ul>
        <h3>Price: From RM200</h3>
        <h3>Duration: ~2 hours</h3>
        <div class="action-buttons" style="margin-top: 39px;">
          <button class="btn btn-edit">Edit</button>
          <form method="POST" action="{{ route('services.destroy', $service->serviceID) }}" onsubmit="return confirm('Delete this service?')">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
          </form>
        </div>
      </div>

      <div class="service-card">
      <h2><i class="fas fa-water" id="service-icon"></i>Perms & Texture Services</h2>
        <p>Achieve curls, waves, or sleek straight hair with our texture treatments.</p>
        <h3>Options</h3>
        <ul>
            <li>Perms</li>
            <li>Straightening</li>
            <li>Wave & Curl Enhancements</li>
        </ul>
        <h3>Price: From RM90</h3>
        <h3>Duration: ~2 hours</h3>
        <div class="action-buttons">
          <button class="btn btn-edit">Edit</button>
          <form method="POST" action="{{ route('services.destroy', $service->serviceID) }}" onsubmit="return confirm('Delete this service?')">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
          </form>
        </div>
      </div>

      <div class="service-card">
      <h2><i class="fas fa-star" id="service-icon"></i>Add-On Services</h2>
        <p>Extra care options including blow-dry, hair wash, shine treatments, and more.</p>
        <h3>Extras</h3>
        <ul>
            <li>Blow Dry & Styling</li>
        </ul>
        <h3>Price: From RM15</h3>
        <h3>Duration: ~20 minutes to 60 minutes</h3>
        <div class="action-buttons" style="margin-top: 39px;">
          <button class="btn btn-edit">Edit</button>
          <form method="POST" action="{{ route('services.destroy', $service->serviceID) }}" onsubmit="return confirm('Delete this service?')">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Edit Service Modal -->
<div class="modal-overlay" id="editModal">
  <div class="modal-content">
    <h2>Edit Service</h2>
    <form method="POST" action="{{ route('services.update', $service->serviceID) }}">
      @csrf
      @method('PUT')
      <label>Service Name</label>
      <input type="text" name="serviceName" value="{{ $service->serviceName }}" required>

      <label>Description</label>
      <textarea name="description" required>{{ $service->description }}</textarea>

      <label>Price</label>
      <input type="number" name="price" min="0" step="0.01" value="{{ $service->price }}" required>

      <label>Duration (minutes)</label>
      <input type="number" name="duration" min="1" value="{{ $service->duration }}" required>

      <label>Promotion (optional)</label>
      <select name="promoID">
          <option value="">None</option>
          @foreach($promotions as $promo)
              <option value="{{ $promo->promoID }}" @if($service->promoID == $promo->promoID) selected @endif>
                  {{ $promo->title }}
              </option>
          @endforeach
      </select>

      <div class="modal-actions">
        <button type="button" onclick="closeModal('editModal')">Cancel</button>
        <button type="submit">Update</button>
      </div>
    </form>
  </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal-overlay" id="deleteModal">
  <div class="modal-content">
    <h2>Delete Service</h2>
    <p>Are you sure you want to delete this service?</p>
    <div class="modal-actions">
      <button onclick="closeModal('deleteModal')">Cancel</button>
      <button onclick="confirmDelete()">Delete</button>
    </div>
  </div>
</div>

<!-- Add New Service Modal -->
<div class="modal-overlay" id="addModal">
  <div class="modal-content">
    <h2>Add New Service</h2>
    <form id="addServiceForm" method="POST" action="{{ route('services.store') }}">
      @csrf
      <label>Service Name</label>
      <input type="text" name="serviceName" required>

      <label>Description</label>
      <textarea name="description" required></textarea>

      <label>Price</label>
      <input type="number" name="price" min="0" step="0.01" required>

      <label>Duration (minutes)</label>
      <input type="number" name="duration" min="1" required>

      <label>Promotion (optional)</label>
      <select name="promoID">
          <option value="">None</option>
          @foreach($promotions as $promo)
              <option value="{{ $promo->promoID }}">{{ $promo->title }}</option>
          @endforeach
      </select>

      <div class="modal-actions">
        <button type="button" onclick="closeModal('addModal')">Cancel</button>
        <button type="submit">Add</button>
      </div>
    </form>
  </div>
</div>

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif
@endsection

@section('scripts')
<script>
 // Open specific modal
 function openModal(id) {
    document.getElementById(id).classList.add('show');
  }

  // Close modal
  function closeModal(id) {
    document.getElementById(id).classList.remove('show');
  }

  // Trigger Add Modal
  document.querySelector('.btn-add').addEventListener('click', () => openModal('addModal'));

  // Trigger Edit Modal for all .btn-edit
  document.querySelectorAll('.btn-edit').forEach(btn => {
    btn.addEventListener('click', () => openModal('editModal'));
  });

  // Trigger Delete Modal
  document.querySelectorAll('.btn-delete').forEach(btn => {
    btn.addEventListener('click', () => openModal('deleteModal'));
  });

  function confirmDelete() {
    alert('Service deleted!');
    closeModal('deleteModal');
  }

  // Handle Add Service
  document.getElementById('addServiceForm').addEventListener('submit', function(e) {
    e.preventDefault();
    alert('Service added successfully!');
    closeModal('addModal');
  });

  // Handle Edit Service
  document.getElementById('editServiceForm').addEventListener('submit', function(e) {
    e.preventDefault();
    alert('Service updated!');
    closeModal('editModal');
  });
</script>
@endsection

