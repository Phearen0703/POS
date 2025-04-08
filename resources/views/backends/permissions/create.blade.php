@extends('backends.layouts.master')

@section('title')
    {{__('Create Permission')}}
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="text-primary"><i class="bi bi-person-check"></i> {{__("Create Permission")}}</h2>
        </div>
        <div class="card-body">
            <a href="{{route('admin.permission')}}" class="btn btn-danger"><i class="bi bi-reply"></i> {{__('Back')}}</a>

            <form action="{{route('admin.permission.store')}}" class="my-2" method="POST">
                @csrf
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label for="name">{{__('Name')}}</label>
                                <input type="text" class="form-control" name="name" required>
                                <button class="btn btn-primary my-2 float-end" type="submit"><i class="bi bi-floppy"></i> {{__('Submit')}}</button>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>

@endsection