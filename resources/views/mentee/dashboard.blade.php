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
                        @include('layout.mentee-sidebar')
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
                                    <a href="{{route('mentee.bookings')}}">
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
            <h4 class="mb-4">Matched Mentors</h4>

        <div class="card card-table">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-center mb-0">
                        <thead>
                            <tr>
                                <th>BASIC INFO</th>
                                <th>Mentor Specialty</th>
                                <th>Matched Interest</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse ($mentors as $mentor)
                        <tr>
                        <td>
                            <h2 class="table-avatar d-flex align-items-center">
                                <img src="{{ $mentor->image && file_exists(public_path('storage/' . $mentor->image)) 
                                    ? asset('storage/' . $mentor->image) 
                                    : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ8XpWWRtPUjhZ7MuHF8i4KDIxQOxDfkGMxYw&s' }}"
                                    alt="Mentor Image"
                                    class="avatar-img rounded-circle mr-2"
                                    style="width: 30px; height: 30px; object-fit: cover;">
                                {{ $mentor->name }}
                            </h2>
                        </td>
                        <td>
                            {{ is_array($mentor->interests) ? implode(', ', $mentor->interests) : $mentor->interests }}
                        </td>
                        <td>
                            {{ $mentor->matched_interest ?? 'N/A' }}
                        </td>
                        <td>
                            @php
                                $status = $mentor->mentorship_status ?? 'pending';
                                $badgeClass = match($status) {
                                    'accepted' => 'badge-success',
                                    'pending' => 'badge-warning',
                                    'rejected' => 'badge-danger',
                                    default => 'badge-secondary'
                                };
                            @endphp
                            <span class="badge {{ $badgeClass }}">{{ ucfirst($status) }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">No mentors matched yet.</td>
                    </tr>
                    @endforelse

                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>


    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const mentorToggles = document.querySelectorAll('.toggle-mentor');

        mentorToggles.forEach(button => {
            button.addEventListener('click', function() {
                const mentorId = this.getAttribute('data-mentor-id');
                const icon = this.querySelector('.mentor-toggle-icon');
                const spinner = this.querySelector('.spinner-border');
                const buttonText = this.querySelector('.button-text');

                button.disabled = true;
                spinner.classList.remove('d-none');
                buttonText.textContent = 'Processing...';

                fetch('{{ route("mentee.toggle", ":id") }}'.replace(':id', mentorId), {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'selected') {
                            button.classList.add('selected');
                            icon.classList.replace('fa-eye', 'fa-eye-slash');
                            buttonText.textContent = 'Unselect';
                        } else {
                            button.classList.remove('selected');
                            icon.classList.replace('fa-eye-slash', 'fa-eye');
                            buttonText.textContent = 'Choose Mentor';
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