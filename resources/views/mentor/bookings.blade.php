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
                        @include('layout.mentor-sidebar')
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
                                                    <th>Mentee Name</th>
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
                                                        try {
                                                        // Parse and format the date
                                                        $formattedDate = Carbon::createFromFormat('Y-m-d',
                                                        $mentorship->appointment_date)->format('d F Y');
                                                        } catch (Exception $e) {
                                                        $formattedDate = 'Invalid date';
                                                        }

                                                        // Check if the appointment is expired
                                                        try {
                                                        $appointmentTimestamp = Carbon::createFromFormat('Y-m-d H:i:s',
                                                        $mentorship->appointment_date . ' ' .
                                                        $mentorship->appointment_time);
                                                        } catch (Exception $e) {
                                                        $appointmentTimestamp = null;
                                                        }

                                                        $currentTimestamp = Carbon::now();
                                                        $isExpired = $appointmentTimestamp &&
                                                        $appointmentTimestamp->isPast();
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

                                                    <!-- Scheduled Time -->
                                                    <td
                                                        style="font-size: 16px; font-weight: normal; color: #555; text-align: center;">
                                                        @if ($mentorship->appointment_time && $mentorship->end_time)


                                                        <!-- Display the formatted times -->
                                                        @if ($isExpired)
                                                        <span style="color: red;">Expired</span>
                                                        @else
                                                        <span>{{$mentorship->appointment_time }}</span>
                                                        @endif
                                                        @else
                                                        <span style="color: orange;">Not scheduled yet</span>
                                                        @endif
                                                    </td>

                                                    <!-- Action Buttons -->
                                                    <td class="text-center">
                                                        @if (is_null($mentorship->appointment_date) ||
                                                        is_null($mentorship->appointment_time))
                                                        <button type="button" class="btn btn-link"
                                                            style="color:#4CAF50;" data-bs-toggle="modal"
                                                            data-bs-target="#add_time_slot">
                                                            <i class="fa fa-edit ml-2"></i> Set Appointment
                                                        </button>
                                                        @endif


                                                        @if ($mentorship->status === 'accepted')
                                                        <a href="mailto:{{ $mentorship->mentee->email }}"
                                                            class="btn btn-sm bg-success-light">
                                                            <i class="far fa-envelope"></i>
                                                        </a>
                                                        <a href="tel:{{ $mentorship->mentee->mobile }}"
                                                            class="btn btn-sm bg-primary-light">
                                                            <i class="fas fa-phone-alt"></i>
                                                        </a>
                                                        <a href="https://wa.me/{{ $mentorship->mentee->mobile }}?text=Hello%20{{ urlencode($mentorship->mentee->name) }}!%20I%20have%20a%20question%20for%20you."
                                                            class="btn btn-sm bg-success-light">
                                                            <i class="fab fa-whatsapp"></i>
                                                        </a>
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