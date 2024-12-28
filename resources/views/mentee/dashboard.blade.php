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
                                <h4 class="mb-4">Mentor Lists</h4>

                                <div class="card card-table">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-center mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>BASIC INFO</th>
                                                        <th>Specialty</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($mentors as $mentor)
                                                    @php
                                                    $mentorshipExists = \App\Models\Mentorship::where('mentor_id',
                                                    $mentor->id)
                                                    ->where('mentee_id', auth()->id())
                                                    ->exists();
                                                    @endphp
                                                    <tr>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                <img src="{{ asset('storage/'.$mentor->image) }}"
                                                                    alt="Mentor Image" class="avatar-img rounded-circle"
                                                                    style="width:30px; height:30px; border-radius:50%;">
                                                                {{ $mentor->name }}
                                                            </h2>
                                                        </td>
                                                        <td>{{ $mentor->area_of_interest }}</td>
                                                        <td class="text-center">
                                                            <button
                                                                class="btn btn-sm bg-info-light toggle-mentor {{ $mentorshipExists ? 'selected' : '' }}"
                                                                data-mentor-id="{{ $mentor->id }}">
                                                                <span
                                                                    class="spinner-border spinner-border-sm text-light d-none"
                                                                    role="status"></span>
                                                                <i
                                                                    class="far {{ $mentorshipExists ? 'fa-eye-slash' : 'fa-eye' }} mentor-toggle-icon ml-2"></i>
                                                                <span class="button-text">
                                                                    {{ $mentorshipExists ? 'Unselect' : 'Choose Mentor' }}
                                                                </span>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>


                                            </table>
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