@extends('layouts.manager')

@section('title', 'Feedback')

@section('head')
  <link rel="stylesheet" href="{{ asset('css/staff-feedback.css') }}">
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
        <th>Service</th>
        <th>Feedback</th>
        <th>Date</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody id="feedbackTableBody">
      <!-- Feedback rows will be populated by JavaScript -->
    </tbody>
  </table>
</div>

<!-- Reply Modal -->
<div class="modal-overlay" id="replyModal">
  <div class="modal-content">
    <h3>Reply to Feedback</h3>
    <textarea id="replyText" placeholder="Write your response..."></textarea>
    <div class="modal-buttons">
      <button class="btn cancel-btn" onclick="closeModal()">Cancel</button>
      <button class="btn submit-btn" onclick="submitReply()">Send Reply</button>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
const feedbackData = [
    {
      customer: "Amira",
      service: "Haircut",
      feedback: "Loved the service!",
      date: "2025-06-23"
    },
    {
      customer: "Jason",
      service: "Facial",
      feedback: "It was good, but slow.",
      date: "2025-06-22"
    }
  ];

  function populateTable() {
    const tbody = document.getElementById("feedbackTableBody");
    feedbackData.forEach((item, index) => {
      const row = document.createElement("tr");
      row.innerHTML = `
        <td>${item.customer}</td>
        <td>${item.service}</td>
        <td>${item.feedback}</td>
        <td>${item.date}</td>
        <td>
          <button class="reply-btn" onclick="openModal(${index})">Reply</button>
        </td>
      `;
      tbody.appendChild(row);
    });
  }

  function openModal(index) {
    document.getElementById("replyModal").classList.add("active");
    document.getElementById("replyText").dataset.index = index;
  }

  function closeModal() {
    document.getElementById("replyModal").classList.remove("active");
    document.getElementById("replyText").value = "";
  }

  function submitReply() {
    const index = document.getElementById("replyText").dataset.index;
    const replyMessage = document.getElementById("replyText").value;
    if (replyMessage.trim()) {
      alert("Reply sent to " + feedbackData[index].customer + ": " + replyMessage);
      closeModal();
    } else {
      alert("Please enter a message.");
    }
  }


  // Initialize table on load
  window.onload = populateTable;
</script>
@endsection

