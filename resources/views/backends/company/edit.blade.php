@extends('backends.layouts.master')

@section('title')
    Edit Company
@endsection

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Edit Company</h2>
        <a class="btn btn-outline-danger" href="{{ route('admin.company') }}">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>

    <div class="card shadow rounded-4">
        <form action="{{ route('admin.company.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-0">
                <!-- Company Logo -->
                <div class="col-md-3 p-4 text-center border-end">
                    <img src="{{ asset($company->photo ? $company->photo : '/images/photo/no_pic.png') }}" 
                         alt="Company Logo" 
                         class="img-thumbnail rounded-circle mb-3" 
                         style="width: 120px; height: 120px; object-fit: cover;">
                    
                    <!--File input inside the form -->
                    <input type="file" class="form-control" name="photo" id="photo" accept="image/*">
                </div>

                <!-- Company Details -->
                <div class="col-md-9 p-4">
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Company Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ $company->name }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{ $company->email }}">
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label fw-semibold">Phone</label>
                        <input type="text" class="form-control" name="phone" id="phone" value="{{ $company->phone }}">
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-save me-1"></i> Save Changes
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
