@extends('backends.layouts.master')

@section('title')
    product page
@endsection

@section('content')
    <div class="card">
        <div class="card-header text-primary">
            <h2><i class="bi bi-folder me-2"></i> {{__('Product')}}</h2>
        </div>
        <div class="card-header">
            @if (checkPermission('product', 'create'))
                <a href="{{route('admin.product.create')}}" class="btn btn-primary "><i class="bi bi-plus"></i>
                    {{__('Create')}}</a>
            @endif

            <div class="table-responsive my-2">
                <table class="table table-sm table-hover table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{__('Category')}}</th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Note')}}</th>
                            <th>{{__('Action')}}</th>

                        </tr>
                    </thead>
                    <tbody style="vertical-align: middle">
                        @foreach ($product_categories as $index => $product_cat)
                            <tr>
                                <td>{{$index + 1}}</td>
                                <td class="text-start">{{$product_cat->name}}</td>
                                <td>{{$product_cat->note}}</td>

                                <td>
                                    @if (checkPermission('prodcuct_category', 'edit'))
                                        <a href="{{ route('admin.product_category.edit', $product_cat->id) }}"
                                            class="btn btn-sm btn-success">
                                            <i class="bi bi-pencil-square"></i> {{ __('Edit') }}
                                        </a>
                                    @endif

                                    @if (checkPermission('prodcuct_category', 'delete'))

                                        @php
                                            $btnDelete = '<div class="d-flex justify-content-center gap-2">';
                                            $btnDelete .= '<a href="' . route('admin.product_category.delete', $product_cat->id) . '" class="btn btn-sm btn-danger">' . __('Yes') . '</a>';
                                            $btnDelete .= '<span class="btn btn-sm btn-dark">' . __('No') . '</span>';
                                            $btnDelete .= '</div>';
                                        @endphp


                                        <button type="button" class="btn btn-sm btn-danger text-center pop" data-bs-toggle="popover"
                                            data-trigger="focus" title="{{ __('Are you sure ?') }}" data-bs-html="true"
                                            data-bs-content="{{ $btnDelete }}"><i class="bi bi-trash"></i>
                                            {{ __('Delete') }}
                                        </button>

                                    @endif


                                </td>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="row">
                    <div class="col">
                        {{$product_categories->links('pagination::bootstrap-5')}}
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
        .pagination {
            justify-content: end;
        }
    </style>
@endpush