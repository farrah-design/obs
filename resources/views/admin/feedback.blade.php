@extends('layouts.admin')

@section('title', 'Manage Feedback')

@section('head')
  <link rel="stylesheet" href="/css/admin-feedback.css">
  <style>
    .star-rating {
      color: gold;
      font-size: 1.2em;
      letter-spacing: 2px;
    }
  </style>
@endsection

@section('content')
<div class="main-content">
  <div class="header">
    <h1>Customer Feedback</h1>
  </div>

  <table class="feedback-table">
    <thead>
      <tr>
        <th>Customer</th>
        <th>Rating</th>
        <th>Feedback</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody id="feedbackTableBody">
      @foreach($feedback as $item)
      <tr>
        <td>{{ $item->customer->name }}</td>
        <td>
          <span class="star-rating">
            @for($i = 1; $i <= 5; $i++)
              @if($i <= $item->rating) ★ @else ☆ @endif
            @endfor
          </span>
        </td>
        <td>{{ $item->comment }}</td>
        <td>{{ $item->date->format('Y-m-d') }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection

@section('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // You can keep this for any additional functionality
    document.querySelectorAll('.feedback-table tr').forEach(row => {
      row.addEventListener('click', function() {
        // Handle row click if needed
      });
    });
  });
</script>
@endsection