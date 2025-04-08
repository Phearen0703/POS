@extends('backends.layouts.master')

@section('title')
    User page
@endsection

@section('content')
    <div class="card">
        <div class="card-header text-primary">
            <h2><i class="bi bi-person"></i> {{__('user')}}</h2>
        </div>
        <div class="card-header">
            <a href="{{route('admin.user.create')}}" class="btn btn-primary "><i class="bi bi-plus"></i> {{__('Create')}}</a>
            <div class="table-responsive my-2">
                <table class="table table-sm table-hover table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Role')}}</th>
                            <th>{{__('Username')}}</th>
                            <th>{{__('Email')}}</th>
                            <th>{{__('Status')}}</th>
                            <th>{{__('Action')}}</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $index => $user)
                            <tr>
                                <td>{{$index + 1}}</td>
                                <td class="text-start">{{$user -> name}}</td>
                                <td>{{$user -> role_name}}</td>
                                <td>{{$user -> username}}</td>
                                <td>{{$user -> email}}</td>
                                <td>
                                    @if ($user->status == 1)
                                        <span class="badge bg-success">{{__('Active')}}</span>
                                    @else
                                        <span class="badge bg-danger">{{__('Inactive')}}</span>
                                    
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-sm btn-success">
                                        <i class="bi bi-pencil-square"></i> {{ __('Edit') }}
                                    </a>

                                        @php
                                            $btnDelete = '<div class="d-flex justify-content-center gap-2">';
                                            $btnDelete .= '<a href="' . route('admin.user.delete', $user->id) . '" class="btn btn-sm btn-danger">' . __('Yes') . '</a>';
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
                        {{$users->links('pagination::bootstrap-5')}}
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

