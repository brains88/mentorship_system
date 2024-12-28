<!DOCTYPE html>
<html lang="en">
@include('layout.header')
<!-- Main CSS -->
<link rel="stylesheet" href="../assets/css/style.css">
<style>
.striped {
    background: repeating-linear-gradient(45deg,
            /* Angle of stripes */
            #d9edf7,
            /* Light blue color */
            #d9edf7 10px,
            /* Width of the first stripe */
            #ffffff 10px,
            /* Start of the second stripe */
            #ffffff 20px
            /* Width of the second stripe */
        );
}
</style>

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
                        @include('layout.admin-sidebar')
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
                                <h4 class="mb-4">Users List</h4>

                                <div class="card card-table">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            @if($users->isEmpty())
                                            <!-- Check if there are no users -->
                                            <div class="alert alert-info text-center">
                                                You currently have no users.
                                                user.
                                            </div>
                                            @else
                                            <table class="table table-hover table-center mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>BASIC INFO</th>
                                                        <th>Role</th>
                                                        <th>Specialty</th>
                                                        <th>Mobile</th>
                                                        <th>Email</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($users as $user)
                                                    <tr @if($user->role === 'mentor') class="striped" @endif>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                <img src="{{ asset('storage/'.$user->image) }}"
                                                                    alt="User Image" class="avatar-img rounded-circle"
                                                                    style="width:30px; height:30px; border-radius:50%;">
                                                                {{ $user->name }}
                                                            </h2>
                                                        </td>
                                                        <td>{{ $user->role }}</td>
                                                        <td>{{ $user->area_of_interest }}</td>
                                                        <td>{{ $user->mobile }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ ucfirst($user->status) }}</td>
                                                        <td class="text-center">
                                                            <!-- Delete Button -->
                                                            <form action="{{ route('admin.users.destroy', $user->id) }}"
                                                                method="POST"
                                                                onsubmit="return confirm('Are you sure you want to delete this user?');"
                                                                style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-sm bg-danger-light text-danger">
                                                                    <i class="fas fa-trash ml-2"></i>
                                                                </button>
                                                            </form>
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


</html>