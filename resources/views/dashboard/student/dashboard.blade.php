<x-master-layout :breadcrumbs="['Student', 'Dashboard']" sidebar="dashboard.student.partials.sidebar" navbar="dashboard.student.partials.navbar"
    footer="dashboard.student.partials.footer">

    <div class="az-dashboard-one-title">
        <div>
            <h2 class="az-dashboard-title">Hi , welcome back!</h2>
            <p class="az-dashboard-text">Here’s an overview of your clearance status and recent activity.</p>
        </div>
        <div class="az-content-header-right">
            <a href="" class="btn btn-purple">Request Clearance</a>
        </div>
    </div>

    <div class="row row-sm mg-b-20">
        <!-- Clearance Status -->
        <div class="col-lg-4">
            <div class="card card-dashboard-calendar">
                <h6 class="card-title">Clearance Status</h6>
                <div class="card-body">
                    <p class="mg-b-5">Latest Request:</p>
                    <h5 class="text-success">Approved</h5>
                    <p class="tx-12 text-muted">Last updated: {{ now()->format('M d, Y h:i A') }}</p>
                    <a href="" class="btn btn-sm btn-outline-primary mt-2">View Details</a>
                </div>
            </div>
        </div>

        <!-- Notifications -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Recent Notifications</h6>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Registrar approved your clearance
                            <span class="badge badge-success">New</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Guidance Office signed your form
                            <span class="badge badge-info">Today</span>
                        </li>
                        <li class="list-group-item">
                            <a href="" class="btn btn-link p-0">View all notifications</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Profile Quick Info -->
        <div class="col-lg-4">
            <div class="card card-dashboard-profile">
                <div class="card-body text-center">
                    <img src="{{ asset('img/faces/face1.jpg') }}" alt="Profile Picture"
                        class="wd-80 rounded-circle mb-3">
                    <h5 class="card-title mb-0"></h5>
                    <p class="tx-12 text-muted mb-3">Student ID: {{ Auth::user()->student_id ?? 'N/A' }}</p>
                    <a href="" class="btn btn-sm btn-outline-secondary">View Profile</a>
                </div>
            </div>
        </div>
    </div>

</x-master-layout>
