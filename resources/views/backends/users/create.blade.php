@extends('backends.layouts.master')

@section('title')
    {{__('Create user')}}
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="text-primary"><i class="bi bi-person"></i> {{__("Create user")}}</h2>
        </div>
        <div class="card-body">
            <a href="{{route('admin.user')}}" class="btn btn-danger"><i class="bi bi-reply"></i> {{__('Back')}}</a>

            <form action="{{route('admin.user.store')}}" class="my-2" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <label for="name">{{__('Name')}} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="username">{{__('Username')}} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="photo">{{__('Photo')}}</label>
                                <input type="file" class="form-control" name="photo" id="photo" accept="image/*">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                        <div class="mb-3">
                                <label for="email">{{__('Email')}}</label>
                                <input type="email" class="form-control" name="email" >
                            </div>
                            <div class="mb-3">
                                <label for="role">{{__('Role')}} <span class="text-danger">*</span></label>
                                <select name="role_id" id="role" class="form-select" required>
                                    <option value="">{{__('Please Select')}}</option>
                                    @foreach ($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="password">{{__('Password')}}<span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="password" required>
                            </div>


                        </div>

                            <div class="col-12">
                                <button class="btn btn-primary my-2 float-end" type="submit"><i class="bi bi-floppy"></i> {{__('Submit')}}</button>
                            </div>

                    </div>
            </form>
        </div>
    </div>

@endsection