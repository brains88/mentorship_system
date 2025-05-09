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
            <img src="{{ auth()->user()->image && file_exists(public_path('storage/' . auth()->user()->image)) 
                                                            ? asset('storage/' . auth()->user()->image) 
                                                            : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ8XpWWRtPUjhZ7MuHF8i4KDIxQOxDfkGMxYw&s' }}" 
            
             class="img-responsive"
                alt="{{auth()->user()->name}}" style="width:100px; height:100px; border-radius:50%;">
        </div>
        <div class="user-info-cont">
            <h4 class="usr-name">{{auth()->user()->name}}</h4>
            <p class="mentor-type">{{auth()->user()->area_of_interest}}</p>
        </div>
    </div>
    <div class="custom-sidebar-nav">
        <ul>
            <li>
                <a href="{{ route('mentor.dashboard') }}"
                    class="{{ request()->routeIs('mentor.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home"></i>Dashboard
                    <span><i class="fas fa-chevron-right"></i></span>
                </a>
            </li>
            <li>
                <a href="{{ route('mentor.bookings') }}"
                    class="{{ request()->routeIs('mentor.bookings') ? 'active' : '' }}">
                    <i class="fas fa-clock"></i>Appointments
                    <span><i class="fas fa-chevron-right"></i></span>
                </a>
            </li>
            <!--
            <li>
                <a href="{{ route('mentor.chat') }}" class="{{ request()->routeIs('mentor.chat') ? 'active' : '' }}">
                    <i class="fas fa-comments"></i>Messages
                    <span><i class="fas fa-chevron-right"></i></span>
                </a>
            </li>
            -->
            <li>
                <a href="{{ route('mentor.profile') }}"
                    class="{{ request()->routeIs('mentor.profile') ? 'active' : '' }}">
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