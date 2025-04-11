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
                            <td>{{$per->name}}</td>
                            <td>{{$per->alias}}</td>
                            <td>
                                <a href="{{ route('admin.permission.edit', base64_encode($per->id)) }}" class="btn btn-sm btn-success">
                                    <i class="bi bi-pencil-square"></i> {{ __('Edit') }}
                                </a>

                                    @php
                                        $btnDelete = '<div class="d-flex justify-content-center gap-2">';
                                        $btnDelete .= '<a href="' . route('admin.permission.delete', $per->id) . '" class="btn btn-sm btn-danger">' . __('Yes') . '</a>';
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
