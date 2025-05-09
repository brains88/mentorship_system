<!DOCTYPE html>
<html lang="en">
@include('layout.header')
<!-- Main CSS -->
<link rel="stylesheet" href="../assets/css/style.css">

<body>
    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <!-- Breadcrumb -->
        <div class="breadcrumb-bar" style="background-color: #4CAF50;">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-12 col-12">
                        <h2 class="breadcrumb-title text-white">My Appointments</h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Breadcrumb -->


        <!-- Page Content -->
        <div class="content">
            <div class="container-fluid">

                <div class="row">

                    <!-- Sidebar -->

                    <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
                        @include('layout.mentee-sidebar')
                    </div>
                    <!-- /Sidebar -->

                    <!-- Booking summary -->
                    <div class="col-md-7 col-lg-8 col-xl-9">
                        <h3 class="pb-3">Appointments Summary</h3>
                        <!-- Mentee List Tab -->
                        <div class="tab-pane show" id="mentee-list">
                            <div class="card card-table">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Mentor Name</th>
                                                    <th>SCHEDULED DATE</th>
                                                    <th class="text-center">SCHEDULED TIMINGS</th>
                                                    <th class="text-center">ACTION</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($mentorships as $mentorship)
                                                <tr>
                                                    <!-- Mentor Details -->
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="#" class="avatar avatar-sm me-2">
                                                            <img src="{{ $mentorship->image && file_exists(public_path('storage/' . $mentorship->image)) 
                                                            ? asset('storage/' . $mentorship->image) 
                                                            : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ8XpWWRtPUjhZ7MuHF8i4KDIxQOxDfkGMxYw&s' }}"
                                                            alt="Mentor Image"
                                                            class="avatar-img rounded-circle mr-2"
                                                            style="width: 30px; height: 30px; object-fit: cover;">
                                                            </a>
                                                            <a href="#">{{ $mentorship->mentor_name }}</a>
                                                        </h2>
                                                    </td>

                                                    <!-- Scheduled Date and Time -->
                                                    <td>
                                                        @if ($mentorship->appointment_date &&
                                                        $mentorship->appointment_time)
                                                        @php
                                                        $appointmentDatetime = $mentorship->appointment_date . ' ' .
                                                        $mentorship->appointment_time;
                                                        $appointmentTimestamp = strtotime($appointmentDatetime);
                                                        $currentTimestamp = time();
                                                        @endphp

                                                        @if ($appointmentTimestamp < $currentTimestamp) <span
                                                            class="text-danger">Expired</span>
                                                            @else
                                                            {{ $mentorship->appointment_date }}
                                                            @endif
                                                            @else
                                                            <span class="text-warning">Not scheduled yet</span>
                                                            @endif
                                                    </td>
                                                    <td class="text-center">
                                                        @if ($mentorship->appointment_time)
                                                        @if ($appointmentTimestamp < $currentTimestamp) <span
                                                            class="text-danger">Expired</span>
                                                            @else
                                                            {{ $mentorship->appointment_time }}
                                                            @endif
                                                            @else
                                                            <span class="text-warning">Not scheduled yet</span>
                                                            @endif
                                                    </td>



                                                    <!-- Action buttons (Email & Call) based on status -->
                                                    <td class="text-center">
                                                        @if ($mentorship->status === 'accepted')
                                                        <a href="mailto:{{ $mentorship->mentor_email }}"
                                                            class="btn btn-sm bg-success-light">
                                                            <i class="far fa-envelope"></i> Email Mentor
                                                        </a>
                                                        <a href="tel:{{ $mentorship->mentor_mobile }}"
                                                            class="btn btn-sm bg-primary-light">
                                                            <i class="fas fa-phone-alt"></i> Call Mentor
                                                        </a>
                                                        <a href="https://wa.me/{{ $mentorship->mentor_mobile }}?text=Hello%20{{ urlencode($mentorship->mentor_name) }}!%20I%20have%20a%20question%20for%20you."
                                                            class="btn btn-sm bg-success-light">
                                                            <i class="fab fa-whatsapp"></i> Chat with Mentor
                                                        </a>
                                                        @elseif ($mentorship->status === 'rejected')
                                                        <span class="badge bg-danger">Rejected</span>
                                                        @else
                                                        <span class="badge bg-warning">Pending</span>
                                                        @endif
                                                    </td>

                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Mentee List Tab -->
                    </div>
                    <!-- /Booking summary -->

                </div>

            </div>
        </div>
        <!-- /Page Content -->

    </div>
    <!-- /Main Wrapper -->


</body>

</html>