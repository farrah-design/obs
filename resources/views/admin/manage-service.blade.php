@extends('layouts.admin')

@section('title', 'Manage Services')

@section('head')
  <link rel="stylesheet" href="/css/manageService.css">
@endsection

@section('content')
<div class="container">
  <h1>Manage Services</h1>
  <button class="btn btn-add" onclick="openModal('addModal')">+ Add New Service</button>

  <div class="catalogue-grid">
    @foreach( $services as $service )
      <div class="service-card">
        <h2><i class="fas fa-cut" id="service-icon"></i> {{ $service->serviceName }}</h2>
        <p>{{ $service->description }}</p>

        <h3>Price: RM{{ number_format($service->price, 2) }}</h3>
        <h3>Duration: ~{{ $service->duration }} hour</h3>

        <div class="action-buttons">
          <button class="btn btn-edit"
                  data-id="{{ $service->serviceID }}"
                  data-name="{{ $service->serviceName }}"
                  data-description="{{ $service->description }}"
                  data-price="{{ $service->price }}"
                  data-duration="{{ $service->duration }}"
                  onclick="populateEditModal(this)">Edit</button>

          <form method="POST" action="{{ route('admin.delete-promo') }}" onsubmit="return confirm('Delete this service?')">
            @csrf
            <input type="hidden" name="serviceID" value="{{$service->serviceID}}">
            <button type="submit">Delete</button>
          </form>
        </div>
      </div>
    @endforeach
  </div>
</div>

<!-- Add Modal -->
<div class="modal-overlay" id="addModal">
  <div class="modal-content">
    <h2>Add New Service</h2>
    <form id="addServiceForm" method="POST" action="{{ route('admin.create-promo') }}">
      @csrf
      <label>Service Name</label>
      <input type="text" name="serviceName" required>

      <label>Description</label>
      <textarea name="description" required></textarea>

      <label>Price</label>
      <input type="number" name="price" min="0" step="0.01" required>

      <label>Duration (hour)</label>
      <input type="number" name="duration" min="1" required>

      <div class="modal-actions">
        <button type="button" onclick="closeModal('addModal')">Cancel</button>
        <button type="submit">Add</button>
      </div>
    </form>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal-overlay" id="editModal">
  <div class="modal-content">
    <h2>Edit Service</h2>
    <form id="editServiceForm" method="POST" action="{{ route('admin.update-promo') }}">
      @csrf
      <input type="hidden" name="serviceID" id="editServiceID">

      <label>Service Name</label>
      <input type="text" name="serviceName" id="editServiceName" required>

      <label>Description</label>
      <textarea name="description" id="editDescription" required></textarea>

      <label>Price</label>
      <input type="number" name="price" min="0" step="0.01" id="editPrice" required>

      <label>Duration (hour)</label>
      <input type="number" name="duration" min="1" id="editDuration" required>

      <div class="modal-actions">
        <button type="button" onclick="closeModal('editModal')">Cancel</button>
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
    const modal = document.getElementById('editModal');
    document.getElementById('editServiceID').value = button.dataset.id;
    document.getElementById('editServiceName').value = button.dataset.name;
    document.getElementById('editDescription').value = button.dataset.description;
    document.getElementById('editPrice').value = button.dataset.price;
    document.getElementById('editDuration').value = button.dataset.duration;

    // Set form action dynamically
    const form = document.getElementById('editServiceForm');

    openModal('editModal');
  }
</script>
@endsection
