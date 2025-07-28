@extends('layouts.admin')

@section('title', 'Manage Profile')

@section('head')
  <link rel="stylesheet" href="/css/admin-profile.css">
@endsection

@section('content') 

 <div class="container">
    <h1>Manage Your Profile</h1>

    <div class="success-msg" id="successMsg">Profile updated successfully!</div>

    {{-- Personal Information Form --}}
<form action="{{ route('admin.profile') }}" method="POST">
  @csrf
  @method('POST')
  <div class="profile-section" id="personal-info-section">
    <h2 class="section-title">
      Personal Information
      <button class="edit-btn edit-section-btn" type="button" onclick="toggleEditMode('personal-info-section')">Edit</button>
    </h2>
    <div class="detail-row">
      <label for="name">Full Name</label>
      <span class="static-value" id="name-static">{{ $staff->name }}</span>
      <input type="text" class="editable-field" id="name-edit" name="name" placeholder="Your full name" value="{{ $staff->name }}" required>
    </div>

    <div class="detail-row">
      <label for="email">Email Address</label>
      <span class="static-value" id="email-static">{{ $staff->email }}</span>
      <input type="email" class="editable-field" id="email-edit" name="email" placeholder="you@example.com" value="{{ $staff->email }}" required>
    </div>

    <div class="detail-row">
      <label for="phone">Phone Number</label>
      <span class="static-value" id="phone-static">{{ $staff->phone }}</span>
      <input type="text" class="editable-field" id="phone-edit" name="phone" placeholder="e.g. 012-3456789" value="{{ $staff->phone }}" required>
    </div>

    <div class="section-actions">
      <button type="submit" class="edit-btn save-btn">Save Changes</button>
      <button type="button" class="edit-btn cancel-btn" onclick="toggleEditMode('personal-info-section')">Cancel</button>
    </div>

  </div>
</form>

{{-- Password Update Form --}}
<form action="{{ route('admin.updatePassword') }}" method="POST">
  @csrf
  @method('POST')
  <div class="profile-section" id="password-section">
    <h2 class="section-title">
      Password
      <button class="edit-btn edit-section-btn" type="button" onclick="toggleEditMode('password-section')">Change Password</button>
    </h2>

    <div class="detail-row password-container">
      <label for="current-password">Current Password</label>
      <span class="static-value" id="current-password-static">
        <span id="current-password-display">••••••••</span>
      </span>
      <div class="editable-field password-edit-group">
        <input type="password" id="current-password" name="current_password" placeholder="Current password" required>
        <span class="toggle-password" onclick="togglePasswordInput('current-password', this)">Show</span>
      </div>
    </div>

    <div class="detail-row password-container">
      <label for="new-password">New Password</label>
      <span class="static-value" id="new-password-static">
        <span id="new-password-display">••••••••</span>
      </span>
      <div class="editable-field password-edit-group">
        <input type="password" id="new-password" name="password" placeholder="New password" required>
        <span class="toggle-password" onclick="togglePasswordInput('new-password', this)">Show</span>
      </div>
    </div>

    <div class="detail-row password-container">
      <label for="confirm-password">Confirm New Password</label>
      <span class="static-value" id="confirm-password-static">
        <span id="confirm-password-display">••••••••</span>
      </span>
      <div class="editable-field password-edit-group">
        <input type="password" id="confirm-password" name="password_confirmation" placeholder="Confirm new password" required>
        <span class="toggle-password" onclick="togglePasswordInput('confirm-password', this)">Show</span>
      </div>
    </div>

    <div class="section-actions">
      <button type="submit" class="edit-btn save-btn">Update Password</button>
      <button type="button" class="edit-btn cancel-btn" onclick="toggleEditMode('password-section')">Cancel</button>
    </div>

  </div>
</form>

    <div class="back-link">
      <a href="{{ route ('admin.dashboard') }}">← Back to Home</a>
    </div>
  </div>
@endsection

@section('scripts')
<script>
  function toggleEditMode(sectionId) {
    const section = document.getElementById(sectionId);
    const staticFields = section.querySelectorAll('.static-value');
    const editableFields = section.querySelectorAll('.editable-field');
    const isEditing = section.classList.toggle('editing');

    staticFields.forEach(el => {
      el.style.display = isEditing ? 'none' : 'inline-block';
    });
    editableFields.forEach(el => {
      el.style.display = isEditing ? 'flex' : 'none';
    });

    const actions = section.querySelector('.section-actions');
    if (actions) actions.style.display = isEditing ? 'flex' : 'none';
  }

  // Toggle password visibility in preview mode
  function togglePasswordPreview(type) {
    // No longer needed, but keep for reference if you want to restore static preview toggling
  }

  // Toggle password visibility in edit mode (real time)
  function togglePasswordInput(inputId, btn) {
    const input = document.getElementById(inputId);
    if (input.type === 'password') {
      input.type = 'text';
      btn.textContent = 'Hide';
    } else {
      input.type = 'password';
      btn.textContent = 'Show';
    }
  }

  // On page load: hide all editable fields
  document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.editable-field').forEach(el => el.style.display = 'none');
    document.querySelectorAll('.section-actions').forEach(el => el.style.display = 'none');
  });
</script>
@endsection

