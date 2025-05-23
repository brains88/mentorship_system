﻿<!DOCTYPE html>
<html lang="en">
@include('layout.header')
<!-- Main CSS -->
<link rel="stylesheet" href="../assets/css/style.css">

<body>
    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <!-- Breadcrumb -->
        <div class="breadcrumb-bar">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-12 col-12 d-flex justify-content-start">
                        <h2 class="breadcrumb-title">Admin Profile</h2>
                    </div>
                    <div class="settings-back mb-3">
                        <a href="{{route('admin.dashboard')}}">
                            <i class="fas fa-long-arrow-alt-left"></i> <span>Dashboard</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Breadcrumb -->

        <!-- Page Content -->
        <div class="content">
            <div class="container">
                <div class="row">
                    {{-- Mentor Widget with Authenticated User Details --}}
                    <div class="card col-12 col-md-6  p-0">
                        <div class="card-body">
                            <div class="">
                                <div class=" text-center mb-3">
                                <div>
                                        <img src="{{ auth()->user()->image && file_exists(public_path('storage/' . auth()->user()->image)) 
                                                            ? asset('storage/' . auth()->user()->image) 
                                                            : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ8XpWWRtPUjhZ7MuHF8i4KDIxQOxDfkGMxYw&s' }}"  alt="Mentee Image"
                                            class="avatar-img"
                                            style="width:50%; height:20%; border: 2px solid #4CAF50 object-fit: cover;">
                                    </div>
                                </div>
                                <div class=" text-center mt-3">
                                <div class="card p-3" style="border-color:#4CAF50">
                                <h4 class="usr-name">{{ auth()->user()->name }}</h4>
                                <p class="user-email text-muted mb-1">{{ auth()->user()->mobile }}</p>
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
                        </div>
                    </div>


                    {{-- Password Change Form --}}
                    <div class="card col-12 col-md-6 mt-3 p-0">
                        <div class="card-body">
                            <h5 class="text-center mb-4">Change Password</h5>
                            <form id="password-change-form">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="current_password">Current Password</label>
                                    <input type="password" name="current_password" id="current_password"
                                        class="form-control" placeholder="Enter current password" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="new_password">New Password</label>
                                    <input type="password" name="new_password" id="new_password" class="form-control"
                                        placeholder="Enter new password" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="new_password_confirmation">Confirm New Password</label>
                                    <input type="password" name="new_password_confirmation"
                                        id="new_password_confirmation" class="form-control"
                                        placeholder="Confirm new password" required>
                                </div>

                                <div id="password-change-alert" class="alert d-none mt-3" role="alert"></div>
                                <button type="submit" class="btn w-100 text-white" style="background-color:#4CAF50" >Change Password</button>
                                <div class="mt-3 text-center text-muted" id="loading-message" style="display: none;">
                                    Updating...</div>
                            </form>
                        </div>
                    </div>

                    <script>
                    document.getElementById('password-change-form').addEventListener('submit', function(e) {
                        e.preventDefault();

                        const formData = new FormData(this);
                        const alertDiv = document.getElementById('password-change-alert');

                        alertDiv.className = 'alert alert-info';
                        alertDiv.innerHTML = 'Updating...';

                        fetch("{{ route('mentee.password.change') }}", {
                                method: 'POST',
                                body: formData,
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    alertDiv.className = 'alert alert-success';
                                    alertDiv.innerHTML = data.message;
                                    this.reset();
                                } else if (data.errors) {
                                    alertDiv.className = 'alert alert-danger';
                                    alertDiv.innerHTML = Object.values(data.errors).join('<br>');
                                } else {
                                    alertDiv.className = 'alert alert-danger';
                                    alertDiv.innerHTML = data.message;
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alertDiv.className = 'alert alert-danger';
                                alertDiv.innerHTML = 'Something went wrong. Please try again later.';
                            });
                    });
                    </script>

                    <body>

</html>