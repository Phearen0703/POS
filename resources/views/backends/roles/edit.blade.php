@extends('backends.layouts.master')

@section('title')
    {{__('Edit Role')}}
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="text-primary"><i class="bi bi-person-check"></i> {{__("Edit Role")}}</h2>
        </div>
        <div class="card-body">
            <a href="{{route('admin.role')}}" class="btn btn-danger"><i class="bi bi-reply"></i> {{__('Back')}}</a>

            <form action="{{route('admin.role.update', $role->id)}}" class="my-2" method="POST">
                @csrf
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label for="name">{{__('Name')}}</label>
                                <input type="text" class="form-control" name="name" value="{{$role->name}}" required>
                                <button class="btn btn-success my-2 float-end" type="submit"><i class="bi bi-floppy"></i> {{__('Update')}}</button>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>

@endsection