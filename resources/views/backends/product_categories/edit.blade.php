@extends('backends.layouts.master')

@section('title')
    {{__('Edit Product Category')}}
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="text-primary"><i class="bi bi-folder2-open me-2"></i></i> {{__("Edit Product Category")}}</h2>
        </div>
        <div class="card-body">
            <a href="{{route('admin.product_category')}}" class="btn btn-danger"><i class="bi bi-reply"></i> {{__('Back')}}</a>

            <form action="{{route('admin.product_category.update',$product_category->id)}}" class="my-2" method="POST">
                @csrf
                    <div class="row">
                         <div class="col-md-6 mb-3">
                            <label for="name" class="form-label fw-semibold">{{ __('Name') }} <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control" value="{{$product_category->name}}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="note" class="form-label fw-semibold">{{ __('Note') }}</label>
                            <input type="text" name="note" id="note" class="form-control" value="{{$product_category->note}}">
                        </div>

                            <div class="col-12">
                                <button class="btn btn-primary my-2 float-end" type="submit"><i class="bi bi-floppy"></i> {{__('Submit')}}</button>
                            </div>

                    </div>
            </form>
        </div>
    </div>

@endsection