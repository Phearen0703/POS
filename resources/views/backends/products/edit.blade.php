@extends('backends.layouts.master')

@section('title')
    {{__('Edit Products')}}
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="text-primary"><i class="bi bi-folder-plus me-2"></i> {{__("Edit Products")}}</h2>
        </div>
        <div class="card-body">
            <a href="{{route('admin.product')}}" class="btn btn-danger"><i class="bi bi-reply"></i> {{__('Back')}}</a>

            <form action="{{route('admin.product.update',$product->id)}}" class="my-2" method="POST">
                @csrf
                    <div class="row">
                         <div class="col-md-6 mb-3">
                            <label for="name" class="form-label fw-semibold">{{ __('Name') }} <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control"  value="{{$product->name}}" required>
                        </div>
                         <div class="col-md-6 mb-3">
                            <label for="price" class="form-label fw-semibold">{{ __('Price') }} <span class="text-danger">*</span></label>
                            <input type="text" name="price" id="price" class="form-control" value="{{$product->price}}" required>
                        </div>
                         <div class="col-md-6 mb-3">
                            <label for="product_category" class="form-label fw-semibold">{{ __('Product Category') }} <span class="text-danger">*</span></label>
                            <select name="product_category_id" id="product_category_id" class="form-control" required>
                                <option value=""> {{__('Please Select')}}</option>
                                @foreach ($product_categories as $cat)
                                    <option value="{{$cat->id}}" {{$cat->id == $product->product_category_id ? 'selected' : ''}}> {{$cat->name}}</option>
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="note" class="form-label fw-semibold">{{ __('Note') }}</label>
                            <input type="text" name="note" id="note" class="form-control"  value="{{$product->note}}">
                        </div>

                            <div class="col-12">
                                <button class="btn btn-primary my-2 float-end" type="submit"><i class="bi bi-floppy"></i> {{__('Submit')}}</button>
                            </div>

                    </div>
            </form>
        </div>
    </div>

@endsection