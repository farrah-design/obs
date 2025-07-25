<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Sarlini')</title>
    <link rel="stylesheet" href="{{ asset('css/after-login.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    @yield('head') 
</head>
<body>
    @php
        use Illuminate\Support\Facades\Auth;

        $customer = Auth::guard('customer')->user();
        $staff = Auth::guard('staff')->user();
    @endphp

    <nav class="navbar">
        <div class="brand">Sarlini Salon</div>
        <ul class="nav-links">
            <li><a href="{{ route('service.list') }}">Services</a></li>
            <li><a href="{{ route('customer.promotions') }}">Promotions</a></li>
            <li><a href="{{ route('customer.bookingpage') }}">Book Now</a></li>
            <li><a href="{{ route('booking.schedule') }}">Booking</a></li>
        </ul>

        {{-- Customer Auth --}}
        @if($customer)
            @php
                $customerName = $customer->name;
                $initials = collect(explode(' ', $customerName))
                            ->map(fn($word) => strtoupper(substr($word, 0, 1)))
                            ->implode('');
            @endphp

            <div class="profile-menu">
                <div class="profile-icon" onclick="toggleDropdown()">
                    @if($customer->profile_pic)
                        <img src="{{ asset('storage/' . $customer->profile_pic) }}" alt="Profile" style="width:100%; height:100%; border-radius:50%; object-fit:cover;">
                    @else
                        {{ $initials }}
                    @endif
                </div>
                <div class="dropdown" id="dropdownMenu">
                    <a href="{{ url('/customer/profile') }}">Manage Profile</a>
                    <a href="{{ url('/customer/bookingschedule') }}">My Bookings</a>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>

        {{-- Staff Auth (manager/admin) --}}
        @elseif($staff)
            @php
                $staffName = $staff->name;
                $staffInitials = collect(explode(' ', $staffName))
                            ->map(fn($word) => strtoupper(substr($word, 0, 1)))
                            ->implode('');
            @endphp

            <div class="profile-menu">
                <div class="profile-icon" onclick="toggleDropdown()">
                    {{ $staffInitials }}
                </div>
                <div class="dropdown" id="dropdownMenu">
                    @if($staff->role === 'manager')
                        <a href="{{ url('/manager/dashboard') }}">Manager Dashboard</a>
                    @elseif($staff->role === 'admin')
                        <a href="{{ url('/admin/dashboard') }}">Admin Dashboard</a>
                    @endif
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>

        {{-- Guest --}}
        @else
            <div class="auth-buttons">
                <a href="{{ route('login') }}" class="btn-login">Login</a>
                <a href="{{ route('register') }}" class="btn-register">Register</a>
            </div>
        @endif
    </nav>


    @yield('content')

    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('dropdownMenu');
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        }

        // Close dropdown when clicking outside
        window.onclick = function(event) {
            const profileIcon = document.querySelector('.profile-icon');
            const dropdown = document.getElementById('dropdownMenu');
            
            if (dropdown && !event.target.matches('.profile-icon') && !event.target.closest('.dropdown')) {
                dropdown.style.display = 'none';
            }
        };

        // Close dropdown when pressing Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                const dropdown = document.getElementById('dropdownMenu');
                if (dropdown) {
                    dropdown.style.display = 'none';
                }
            }
        });
    </script>

    @yield('scripts')
</body>
</html>
