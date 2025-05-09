<style>
.active {
    font-weight: bold;
    background-color: #4CAF50 !important;
    color: #fff !important;
    padding: 10px;
    /* Example color */
}
</style>

<!-- Sidebar -->
<div class="profile-sidebar">
    <div class="user-widget">
        <div class="pro-avatar">
            <img src="{{ asset('storage/'.auth()->user()->image) }}" class="img-responsive"
                alt="{{auth()->user()->name}}" style="width:100px; height:100px; border-radius:50%;">
        </div>
        <div class="user-info-cont">
        <div class="card p-3" style="border-color:#4CAF50">
        <h4 class="usr-name">{{ auth()->user()->name }}</h4>
        <p class="user-email text-muted mb-1">{{ auth()->user()->email }}</p>
        <p class="user-interests"  style="color:#4CAF50" >
            Interests: 
            @if (is_array(auth()->user()->interests))
                {{ implode(', ', auth()->user()->interests) }}
            @else
                {{ auth()->user()->interests ?? 'N/A' }}
            @endif
        </p>
    </div>

        </div>
    </div>
    <div class="custom-sidebar-nav">
        <ul>
            <li>
                <a href="{{ route('mentee.dashboard') }}"
                    class="{{ request()->routeIs('mentee.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home"></i>Dashboard
                    <span><i class="fas fa-chevron-right"></i></span>
                </a>
            </li>
            <li>
                <a href="{{ route('mentee.bookings') }}"
                    class="{{ request()->routeIs('mentee.bookings') ? 'active' : '' }}">
                    <i class="fas fa-clock"></i>Appointments
                    <span><i class="fas fa-chevron-right"></i></span>
                </a>
            </li>
            <!--
            <li>
                <a href="{{ route('mentee.chat') }}" class="{{ request()->routeIs('mentee.chat') ? 'active' : '' }}">
                    <i class="fas fa-comments"></i>Messages
                    <span><i class="fas fa-chevron-right"></i></span>
                </a>
            </li>
            -->
            <li>
                <a href="{{ route('mentee.profile') }}"
                    class="{{ request()->routeIs('mentee.profile') ? 'active' : '' }}">
                    <i class="fas fa-user-cog"></i>Profile
                    <span><i class="fas fa-chevron-right"></i></span>
                </a>
            </li>
            <li>
                <a href="{{ route('logout') }}">
                    <i class="fas fa-sign-out-alt"></i>Logout
                    <span><i class="fas fa-chevron-right"></i></span>
                </a>
            </li>
        </ul>

    </div>
</div>
<!-- /Sidebar -->