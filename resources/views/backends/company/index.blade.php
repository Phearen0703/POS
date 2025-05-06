@extends('backends.layouts.master')

@section('title')
    Company Page
@endsection

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Company Profile</h2>
        @if (checkPermission('company', 'edit'))
            <a class="btn btn-outline-success" href="{{ route('admin.company.edit') }}">
                <i class="bi bi-pencil-square me-1"></i> {{ __('Edit') }}
            </a>
        @endif
    </div>

    <div class="card shadow rounded-4">
        <div class="row g-0">
            <!-- Logo Section -->
            <div class="col-lg-3 col-md-4 text-center p-4 border-end">
                <img src="{{ asset($company->photo ?: '/images/photo/no_pic.png') }}"
                     alt="Company Logo"
                     class="img-thumbnail rounded-circle shadow"
                     style="width: 120px; height: 120px; object-fit: cover;">
                <p class="mt-3 fw-bold text-secondary">{{ $company->name }}</p>
            </div>

            <!-- Company Info -->
            <div class="col-lg-9 col-md-8 p-4">
                <table class="table table-borderless mb-0">
                    <tbody>
                        <tr>
                            <th class="text-muted" width="20%">{{ __('Name') }}</th>
                            <td>{{ $company->name }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">{{ __('Email') }}</th>
                            <td>{{ $company->email }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">{{ __('Phone') }}</th>
                            <td>{{ $company->phone }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
