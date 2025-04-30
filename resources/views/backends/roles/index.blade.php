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

            @if (checkPermission('role','create'))
                <a href="{{route('admin.role.create')}}" class="btn btn-primary "><i class="bi bi-plus"></i> {{__('Create')}}</a>
            @endif
           
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
                                    <a href="{{ route('admin.role.permission', $role->id) }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-key"></i> {{ __('Permission') }}
                                    </a>
                                    <a href="{{ route('admin.role.edit', $role->id) }}" class="btn btn-sm btn-success">
                                        <i class="bi bi-pencil-square"></i> {{ __('Edit') }}
                                    </a>

                                        @php
                                            $btnDelete = '<div class="d-flex justify-content-center gap-2">';
                                            $btnDelete .= '<a href="' . route('admin.role.delete', $role->id) . '" class="btn btn-sm btn-danger">' . __('Yes') . '</a>';
                                            $btnDelete .= '<span class="btn btn-sm btn-dark">' . __('No') . '</span>';
                                            $btnDelete .= '</div>';
                                        @endphp


                                    <button type="button" 
                                            class="btn btn-sm btn-danger text-center pop" 
                                            data-bs-toggle="popover"
                                            data-trigger="focus" 
                                            title="{{ __('Are you sure ?') }}" 
                                            data-bs-html="true" 
                                            data-bs-content="{{ $btnDelete }}"><i class="bi bi-trash"></i> 
                                        {{ __('Delete') }}
                                    </button>
                                </td>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="row">
                    <div class="col">
                        {{$roles->links('pagination::bootstrap-5')}}
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@push('js')
<script>
   document.addEventListener('DOMContentLoaded', function () {
       const popoverElements = document.querySelectorAll('.pop');
       popoverElements.forEach(function (popoverElement) {
           new bootstrap.Popover(popoverElement, {
               container: 'body',
               animation: true,
               trigger: 'click',
               placement: 'right',
               html: true
           });
       });

       document.addEventListener('click', function (event) {
           popoverElements.forEach(function (popoverElement) {
               if (!popoverElement.contains(event.target)) {
                   const popoverInstance = bootstrap.Popover.getInstance(popoverElement);
                   if (popoverInstance) popoverInstance.hide();
               }
           });
       });
   });
</script>
@endpush
@push('css')
<style>
    .pagination{
        justify-content: end;
    }

</style>
@endpush

