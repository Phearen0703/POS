@extends('backends.layouts.master')

@section('title')
    role page
@endsection

@section('content')
    <div class="card">
        <div class="card-header text-primary">
            <h2><i class="bi bi-person-check"></i> {{__('Role')}}</h2>
        </div>
        <div class="card-header">
            <a href="{{route('admin.role.create')}}" class="btn btn-primary "><i class="bi bi-plus"></i> {{__('Create')}}</a>
            <div class="table-responsive my-2">
                <table class="table table-sm table-hover table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Action')}}</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $index => $role)
                            <tr>
                                <td>{{$index + 1}}</td>
                                <td>{{$role -> name}}</td>
                                <td>
                                    <a href="{{ route('admin.role.edit', $role->id)}}" class="btn btn-sm btn-success"><i class="bi bi-pencil-square"></i> {{__(__('Edit'))}}</a>
                                    <a href="{{ route('admin.role.delete', $role->id)}}" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></i> {{__(__('Delete'))}}</a>
                                    
                                    <button type="button" 
                                            class="btn btn-danger" 
                                            data-bs-toggle="popover" 
                                            data-bs-html="true" 
                                            data-bs-content='
                                                <p>Are you sure you want to delete this item?</p>
                                                <button class="btn btn-danger btn-sm confirm-delete">Yes</button>
                                                <button class="btn btn-secondary btn-sm cancel-delete">No</button>'>
                                        Delete
                                    </button>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@push('js')
<script>
   $(function(){
    $'.pop'
   })

</script>
@endpush