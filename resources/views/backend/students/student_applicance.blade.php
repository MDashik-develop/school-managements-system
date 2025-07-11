@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card shadow border-0">
                <div class="card-header bg-gradient-primary text-white d-flex align-items-center justify-content-between">
                    <h4 class="mb-0"><i class="fa fa-users me-2"></i>All Student Applicants (Pending)</h4>
                    <span class="badge bg-light text-primary fs-6">{{ $students->count() }} Applicants</span>
                </div>
                <div class="card-body bg-light">
                    @if($students->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle table-bordered rounded" style="overflow: hidden;">
                                <thead class="table-primary">
                                    <tr>
                                        <th>#</th>
                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th>Student ID</th>
                                        <th>Class</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Date of Birth</th>
                                        <th>Address</th>
                                        <th>Status</th>
                                        <th>Applied At</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($students as $key => $student)
                                        <tr>
                                            <td class="fw-bold text-secondary">{{ $key + 1 }}</td>
                                            <td>
                                                @if($student->photo)
                                                    <img src="{{ asset('storage/' . $student->photo) }}" alt="Photo" width="45" height="45" class="rounded-circle border border-2 border-primary shadow-sm">
                                                @else
                                                    <span class="text-muted"><i class="fa fa-user-circle fa-2x"></i></span>
                                                @endif
                                            </td>
                                            <td class="fw-semibold">{{ $student->name }}</td>
                                            <td><span class="badge bg-info text-dark">{{ $student->student_id }}</span></td>
                                            <td>{{ $student->class }}</td>
                                            <td>{{ $student->phone }}</td>
                                            <td>{{ $student->user->email ?? '-' }}</td>
                                            <td>{{ $student->dob ?? '-' }}</td>
                                            <td>{{ $student->address ?? '-' }}</td>
                                            <td>
                                                <span class="badge bg-warning text-dark px-3 py-2">{{ ucfirst($student->status) }}</span>
                                            </td>
                                            <td>
                                                {{ $student->created_at ? $student->created_at->format('d M Y, h:i A') : '-' }}
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    {{-- Approve Button --}}
                                                    <form action="#" method="POST" style="display:inline;">
                                                        @csrf
                                                        {{-- <input type="hidden" name="action" value="approve"> --}}
                                                        <button type="button" class="btn btn-success btn-sm rounded-circle" title="Approve">
                                                            <i class="fa fa-paper-plane"></i>
                                                        </button>
                                                    </form>
                                                    {{-- Reject Button --}}
                                                    <form action="#" method="POST" style="display:inline;">
                                                        @csrf
                                                        {{-- <input type="hidden" name="action" value="reject"> --}}
                                                        <button type="button" class="btn btn-danger btn-sm rounded-circle" title="Reject">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info mb-0 text-center">
                            <i class="fa fa-info-circle me-2"></i>No student applicants found.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .bg-gradient-primary {
        background: linear-gradient(90deg, #4e73df 0%, #224abe 100%) !important;
    }
    .table thead th {
        vertical-align: middle;
        text-align: center;
    }
    .table tbody td {
        vertical-align: middle;
    }
</style>
{{-- FontAwesome CDN for icons (if not already included in your layout) --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>


@endsection