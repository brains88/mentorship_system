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
                        <h2 class="breadcrumb-title text-white">Dashboard</h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Breadcrumb -->

        <!-- Page Content -->
        <div class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">

                        <!-- Sidebar -->
                        @include('layout.mentor-sidebar')
                        <!-- /Sidebar -->

                    </div>

                    <div class="col-md-7 col-lg-8 col-xl-9">

                        <div class="row">
                            <div class="col-md-12 col-lg-4 dash-board-list blue">
                                <div class="dash-widget">
                                    <div class="circle-bar">
                                        <div class="icon-col">
                                            <i class="fas fa-calendar-check"></i>
                                        </div>
                                    </div>
                                    <a href="{{route('mentor.bookings')}}">
                                        <div class="dash-widget-info">
                                            <h3>{{$appointments}}</h3>
                                            <h6>Appointments</h6>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="mb-4">Mentee Request Lists</h4>

                                <div class="card card-table">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            @if($mentees->isEmpty())
                                            <!-- Check if there are no mentees -->
                                            <div class="alert alert-info text-center">
                                                You currently have no mentees. Please wait for mentees to request
                                                mentorship.
                                            </div>
                                            @else
                                            <table class="table table-hover table-center mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>BASIC INFO</th>
                                                        <th>Mentee Interest</th>
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($mentees as $mentorship)
                                                    @php
                                                    $mentee = $mentorship->mentee;
                                                    @endphp
                                                    <tr>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                <img src="{{ asset('storage/'.$mentee->image) }}"
                                                                    alt="Mentee Image" class="avatar-img rounded-circle"
                                                                    style="width:30px; height:30px; border-radius:50%;">
                                                                {{ $mentee->name }}
                                                            </h2>
                                                        </td>
                                                        <td>
                                                        @php
                                                            // Get mentee's interests (ensure it's an array)
                                                            $menteeInterests = is_array($mentorship->mentee->interests) 
                                                                ? $mentorship->mentee->interests 
                                                                : json_decode($mentorship->mentee->interests, true);
                                                            
                                                            // Find matching interests
                                                            $matchingInterests = array_intersect(
                                                                $menteeInterests ?? [],
                                                                $mentorInterests ?? []
                                                            );
                                                        @endphp
                                                        
                                                        @if(!empty($matchingInterests))
                                                            {{ implode(', ', $matchingInterests) }}
                                                        @else
                                                            No matching interests
                                                        @endif
                                                    </td>
                                                        <td>{{ ucfirst($mentorship->status) }}</td>
                                                        <td class="text-center">
                                                            <button class="btn btn-sm
                                                                @if ($mentorship->status == 'rejected')
                                                                    bg-info-light
                                                                @elseif ($mentorship->status == 'accepted')
                                                                    bg-danger-light
                                                                @elseif ($mentorship->status == 'pending')
                                                                    bg-warning-light
                                                                @endif
                                                                toggle-status" data-mentorship-id="{{ $mentorship->id }}">

                                                                <span
                                                                    class="spinner-border spinner-border-sm text-light d-none"
                                                                    role="status"></span>

                                                                <i class="far
                                                                    @if ($mentorship->status == 'rejected')
                                                                        fa-check-circle
                                                                    @elseif ($mentorship->status == 'accepted')
                                                                        fa-times-circle
                                                                    @else
                                                                        fa-check-circle
                                                                    @endif
                                                                    mentor-toggle-icon ml-2"></i>

                                                                <span class="button-text">
                                                                    @if ($mentorship->status == 'rejected')
                                                                    Accept
                                                                    @elseif ($mentorship->status == 'accepted')
                                                                    Reject
                                                                    @else
                                                                    Accept
                                                                    @endif
                                                                </span>
                                                            </button>
                                                        </td>

                                                    </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                            @endif
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>

                    </div>


                </div>

            </div>

        </div>
        <!-- /Page Content -->

    </div>
    <!-- /Main Wrapper -->

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const statusToggles = document.querySelectorAll('.toggle-status');

        statusToggles.forEach(button => {
            button.addEventListener('click', function() {
                const mentorshipId = this.getAttribute('data-mentorship-id');
                const icon = this.querySelector('.mentor-toggle-icon');
                const spinner = this.querySelector('.spinner-border');
                const buttonText = this.querySelector('.button-text');

                button.disabled = true;
                spinner.classList.remove('d-none');
                buttonText.textContent = 'Processing...';

                fetch('{{ route("mentor.toggleStatus", ":id") }}'.replace(':id',
                        mentorshipId), {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'accepted') {
                            button.classList.add('accepted');
                            icon.classList.replace('fa-times-circle', 'fa-check-circle');
                            buttonText.textContent = 'Accepted';
                        } else {
                            button.classList.remove('accepted');
                            icon.classList.replace('fa-check-circle', 'fa-times-circle');
                            buttonText.textContent = 'Rejected';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        buttonText.textContent = 'Error';
                    })
                    .finally(() => {
                        button.disabled = false;
                        spinner.classList.add('d-none');
                    });
            });
        });
    });
    </script>

</html>