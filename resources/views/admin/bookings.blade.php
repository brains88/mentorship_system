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
                        @include('layout.admin-sidebar')
                    </div>
                    <!-- /Sidebar -->

                    <!-- Booking summary -->
                    <div class="col-md-7 col-lg-8 col-xl-9">
                        <h3 class="pb-3">Appointments Summary</h3>
                        <!-- Mentee List Tab -->
                        <div class="" id="mentee-list">
                            <div class="card ">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <?php use Carbon\Carbon;?>

                                        <table class="table table-hover table-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Mentor Name</th>
                                                    <th>Mentee Name</th>
                                                    <th>SCHEDULED DATE</th>
                                                    <th class="text-center">SCHEDULED TIMINGS</th>
                                                    <th class="text-center">STATUS</th>
                                                    <th class="text-center">ACTION</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($mentorships as $mentorship)
                                                <tr>
                                                    <!-- Mentor Name -->
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="#" class="avatar avatar-sm me-2">
                                                                <img src="{{ asset('storage/'.$mentorship->mentor->image) }}"
                                                                    alt="Mentor Image" class="avatar-img rounded-circle"
                                                                    style="width:30px; height:30px; border-radius:50%;">
                                                            </a>
                                                            <a href="#">{{ $mentorship->mentor->name }}</a>
                                                        </h2>
                                                    </td>

                                                    <!-- Mentee Name -->
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="#" class="avatar avatar-sm me-2">
                                                                <img src="{{ asset('storage/'.$mentorship->mentee->image) }}"
                                                                    alt="Mentee Image" class="avatar-img rounded-circle"
                                                                    style="width:30px; height:30px; border-radius:50%;">
                                                            </a>
                                                            <a href="#">{{ $mentorship->mentee->name }}</a>
                                                        </h2>
                                                    </td>

                                                    <!-- Scheduled Date -->
                                                    <td
                                                        style="font-size: 16px; font-weight: bold; color: #333; text-align: left;">
                                                        @if ($mentorship->appointment_date &&
                                                        $mentorship->appointment_time)
                                                        @php
                                                        $formattedDate =
                                                        \Carbon\Carbon::parse($mentorship->appointment_date)->format('d
                                                        F Y');
                                                        $isExpired = \Carbon\Carbon::parse($mentorship->appointment_date
                                                        . ' ' . $mentorship->appointment_time)->isPast();
                                                        @endphp
                                                        @if ($isExpired)
                                                        <span style="color: red;">Expired</span>
                                                        @else
                                                        <span style="color: #4CAF50;">{{ $formattedDate }}</span>
                                                        @endif
                                                        @else
                                                        <span style="color: orange;">Not scheduled yet</span>
                                                        @endif
                                                    </td>

                                                    <!-- Scheduled Timings -->
                                                    <td
                                                        style="font-size: 16px; font-weight: normal; color: #555; text-align: center;">
                                                        @if ($mentorship->appointment_time && $mentorship->end_time)
                                                        @if ($isExpired)
                                                        <span style="color: red;">Expired</span>
                                                        @else
                                                        <span>{{ $mentorship->appointment_time }}</span>
                                                        @endif
                                                        @else
                                                        <span style="color: orange;">Not scheduled yet</span>
                                                        @endif
                                                    </td>
                                                    <!--Status-->
                                                    <td style="font-weight: bold; color: #fff; text-align: center;
                                                        @if($mentorship->status === 'rejected') background-color: #f44336;
                                                        @elseif($mentorship->status === 'accepted') background-color: #4CAF50;
                                                        @elseif($mentorship->status === 'pending') background-color: #FFC107;
                                                        @endif">
                                                        {{ ucfirst($mentorship->status) }}
                                                    </td <!-- Action -->
                                                    <td class="text-center">
                                                        <!-- Delete Button -->
                                                        <form
                                                            action="{{ route('admin.mentorships.destroy', $mentorship->id) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Are you sure you want to delete this mentorship?');"
                                                            style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm bg-danger-light text-danger">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
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

    <!-- Add Time Slot Modal -->
    <div class="modal fade custom-modal" id="add_time_slot" tabindex="-1" aria-labelledby="add_time_slotLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add_time_slotLabel">
                        @if($mentorship) Edit Time Slot @else Add Time Slot @endif
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('mentor.setTimeSlot') }}">
                        @csrf
                        <div class="form-group">
                            <label for="appointment_date">Appointment Date</label>
                            <input type="date" name="appointment_date" class="form-control"
                                value="{{ $mentorship->appointment_date ?? old('appointment_date') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="start_time">Start Time</label>
                            <input type="time" name="start_time" class="form-control"
                                value="{{ $mentorship->appointment_time ?? old('start_time') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="end_time">End Time</label>
                            <input type="time" name="end_time" class="form-control"
                                value="{{ $mentorship->end_time ?? old('end_time') }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Save Time Slot</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Edit Time Slot Modal -->
    <div class="modal fade custom-modal" id="edit_time_slot" tabindex="-1" aria-labelledby="edit_time_slotLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_time_slotLabel">Edit Time Slots</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('mentor.editTimeSlot', $mentorship->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="appointment_date">Appointment Date</label>
                            <input type="date" name="appointment_date" class="form-control"
                                value="{{ $mentorship->appointment_date }}" required>
                        </div>

                        <div class="form-group">
                            <label for="start_time">Start Time</label>
                            <select class="form-control form-select" name="start_time" required>
                                <option>{{ $mentorship->appointment_time }}</option>
                                <option>12:00 AM</option>
                                <option>1:00 AM</option>
                                <option>2:00 AM</option>
                                <option>3:00 AM</option>
                                <!-- Add other options -->
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="end_time">End Time</label>
                            <select class="form-control form-select" name="end_time" required>
                                <option>{{ $mentorship->end_time ?? 'Select' }}</option>
                                <option>12:00 AM</option>
                                <option>1:00 AM</option>
                                <option>2:00 AM</option>
                                <option>3:00 AM</option>
                                <!-- Add other options -->
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Time Slot</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Include Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>