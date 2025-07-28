@extends('layouts.admin')

@section('title', 'Customer Details')

@section('head')
  <link rel="stylesheet" href="/css/admin-customerdetails.css">
@endsection

@section('content') 
<div class="main-content">
  <div class="header">
    <h2>Customer List</h2>
    <input type="text" placeholder="Search by customer name..">
  </div>

  <div class="section">
    <div class="cards-container">
      @foreach ($customers as $customer)
        <div class="customer-card">
          <div class="customer-header">
            <div class="avatar">{{ strtoupper(substr($customer->name, 0, 1)) }}</div>
            <div class="customer-info">
              <div class="name">{{ $customer->name }}</div>
              <div class="email">{{ $customer->email }}</div>
            </div>
          </div>
          
          
          <div class="contact-info">
            <div class="contact">
              <span>📞</span>
              <span>{{ $customer->phone ?? '-' }}</span>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
  document.getElementById('appointmentSearch').addEventListener('input', function() {
  const search = this.value.toLowerCase();
  const rows = document.querySelectorAll('.appointments-table tbody tr');
  rows.forEach(row => {
    // Customer name is in the 4th column (index 3)
    const customerCell = row.cells[3];
    if (!customerCell) return; // skip if row is malformed
    const customerName = customerCell.textContent.toLowerCase();
    row.style.display = customerName.includes(search) ? '' : 'none';
  });
});
</script>
@endsection
