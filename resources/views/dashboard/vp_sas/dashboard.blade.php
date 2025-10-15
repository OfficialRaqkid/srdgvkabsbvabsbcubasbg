<x-master-layout :breadcrumbs="['VP - Student Affairs & Development', 'Dashboard']" sidebar="dashboard.vp_sas.partials.sidebar" navbar="dashboard.vp_sas.partials.navbar"
    footer="dashboard.student.partials.footer">
    <div class="az-dashboard-one-title">
        <div>
            <h2 class="az-dashboard-title">Welcome, {{ Auth::user()->name ?? 'VP - Student Affairs' }}!</h2>
            <p class="az-dashboard-text">Manage dormitory and behavioral records for clearance.</p>
        </div>
        <div class="az-content-header-right">
            <a href="" class="btn btn-purple">Start Verifying</a>
        </div>
    </div>

    <div class="row row-sm mg-b-20">
        <!-- Dorm Verification -->
        <div class="col-lg-4">
            <div class="card card-dashboard-calendar">
                <div class="card-body">
                    <h6 class="card-title">Pending Dormitory Verification</h6>
                    <h3 class="text-warning">12 Students</h3>
                    <p class="text-muted">Awaiting financial clearance approval</p>
                    <a href="" class="btn btn-sm btn-outline-primary">Verify</a>
                </div>
            </div>
        </div>

        <!-- Notes Overview -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Recent Notes</h6>
                    <h3 class="text-info">7 Messages</h3>
                    <p class="text-muted">Left for deans or students</p>
                    <a href="" class="btn btn-sm btn-outline-info">View Notes</a>
                </div>
            </div>
        </div>

        <!-- Activity This Month -->
        <div class="col-lg-4">
            <div class="card card-dashboard-profile">
                <div class="card-body">
                    <h6 class="card-title">Monthly Summary</h6>
                    <ul class="list-group">
                        <li class="list-group-item">Dorm Verified: <strong>18</strong></li>
                        <li class="list-group-item">Notes Left: <strong>9</strong></li>
                        <li class="list-group-item">Sign-Offs: <strong>14</strong></li>
                    </ul>
                    <a href="" class="btn btn-sm btn-outline-secondary mt-2">Details</a>
                </div>
            </div>
        </div>
    </div>
</x-master-layout>
