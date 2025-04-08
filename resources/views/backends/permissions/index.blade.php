@extends('backends.layouts.master')

@section('title')
    Permission Page
@endsection

@section('content')
    <div class="card">
        <div class="card-header text-primary">
            <h2><i class="bi bi-person-check"></i> {{__('Permission')}}</h2>
        </div>
        <div class="card-header">
            <a href="{{route('admin.permission.create')}}" class="btn btn-primary btn-sm"><i class="bi bi-plus"></i> {{__('Create')}}</a>

        </div>
        <div class="card-body">
            <table class="table table-sm table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{__('Name')}}</th>
                        <th>{{__('Key')}}</th>
                        <th>{{__('Action')}}</th>
                    </tr>
                </thead>
                <tbody >
                    @forelse($permissions as $index => $per)
                        <tr>
                            <td>{{$index + 1}}</td>
                            <td>{{$permission->name}}</td>
                            <td>{{$permission->key}}</td>
                        </tr>
                    @empty  
                        <tr>
                            <td colspan="4">{{__('No data found')}}</td>
                        </tr>
                    @endforelse
                </tbody>

                
            </table>
    </div>

@endsection



