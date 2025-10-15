<x-master-layout 
    :breadcrumbs="['Dean', 'Department Clearance Requests']"
    sidebar="dashboard.dean.partials.sidebar"
    navbar="dashboard.dean.partials.navbar"
    footer="dashboard.dean.partials.footer">

    <div class="container mt-4">
        <h2 class="mb-4 fw-bold">Department Clearance Requests</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('warning'))
            <div class="alert alert-warning">{{ session('warning') }}</div>
        @endif

        @if ($requests->isEmpty())
            <div class="alert alert-info">No clearance requests found for your department.</div>
        @else
            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Student Name</th>
                                <th>Program</th>
                                <th>Year Level</th>
                                <th>Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($requests as $key => $req)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $req->studentProfile->first_name }} {{ $req->studentProfile->last_name }}</td>
                                    <td>{{ $req->studentProfile->program->name ?? 'N/A' }}</td>
                                    <td>{{ $req->studentProfile->yearLevel->name ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge 
                                            @if($req->status == 'pending') bg-warning 
                                            @elseif($req->status == 'accepted') bg-success 
                                            @elseif($req->status == 'held') bg-danger 
                                            @else bg-secondary @endif">
                                            {{ ucfirst($req->status) }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route('dean.clearances.accept', $req->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">Accept</button>
                                        </form>

                                        <form action="{{ route('dean.clearances.hold', $req->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-warning btn-sm">Hold</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</x-master-layout>
