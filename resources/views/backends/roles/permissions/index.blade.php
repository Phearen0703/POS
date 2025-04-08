@extends('backends.layouts.master')

@section('title')
    Role Permission
@endsection

@section('content')
    <div class="card">
        <div class="card-header text-primary">
            <h2><i class="bi bi-person-check"></i> {{__('Role Permission')}}</h2>
        </div>
        <div class="card-header">
            <a href="{{route('admin.permissions')}}" class="btn btn-danger "><i class="bi bi-reply"></i> {{__('Back')}}</a>

        </div>
    </div>

@endsection



