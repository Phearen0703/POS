@extends('backends.layouts.master')

@section('title')
    no permission
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header text-danger">
                {{__('No Permission')}}
            </div>
            <div class="card-body">
                <h3 class="text-danger"><i class="bi bi-exclamation-triangle"></i> {{__('You have no permission to access this page')}}</h3>
                <p>{{__('Please Contact to admin !!!')}}</p>
            </div>
        </div>
    </div>
@endsection