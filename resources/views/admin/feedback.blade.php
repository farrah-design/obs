@extends('layouts.admin')

@section('title', 'Manage Feedback')

@section('head')
  <link rel="stylesheet" href="/css/admin-feedback.css">
@endsection

@section('content') 
<div class="main-content">
  <div class="header">
    <h1>Customer Feedback</h1>
  </div>

  <table>
    <thead>
      <tr>
        <th>Customer</th>
        <th>Rating</th>
        <th>Feedback</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody id="feedbackTableBody">
      <!-- Feedback rows will be populated by JavaScript -->
    </tbody>
  </table>
</div>
@endsection

@section('scripts')
<script>
  const feedbackData = [
    {
      customer: "Amira",
      rating: 4,  // Changed to number
      feedback: "Loved the service!",
      date: "2025-06-23"
    },
    {
      customer: "Jason",
      rating: 5,  // Changed to number and fixed property name (was 'service')
      feedback: "It was good, but slow.",
      date: "2025-06-22"
    }
  ];

  function renderStarRating(rating) {
    let stars = '';
    for (let i = 1; i <= 5; i++) {
      stars += i <= rating ? '★' : '☆';
    }
    return `<span class="star-rating">${stars}</span>`;
  }
    
  function populateTable() {
    const tbody = document.getElementById("feedbackTableBody");
    tbody.innerHTML = ''; // Clear existing rows
    
    feedbackData.forEach((item) => {
      const row = document.createElement("tr");
      row.innerHTML = `
        <td>${item.customer}</td>
        <td>${renderStarRating(item.rating)}</td>
        <td>${item.feedback}</td>
        <td>${item.date}</td>
      `;
      tbody.appendChild(row);
    });
  }

  // Initialize table on load
  document.addEventListener('DOMContentLoaded', populateTable);
</script>
@endsection

