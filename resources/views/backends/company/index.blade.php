@extends('backends.layouts.master')

@section('title')
    company page
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-12">
                <div class="w-100">
                    <img src="{{asset($companies->photo)}}" alt="company logo" class="img-fluid rounded-circle" width="100px" height="100px">
                </div>
            </div>
            <div class="col-lg-8 col-12">
                
            </div>
        </div>
    </div>

@endsection