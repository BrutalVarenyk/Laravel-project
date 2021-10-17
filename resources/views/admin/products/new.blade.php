@extends('layouts.app')
@inject('get_all_categories', 'App\Services\GetAllCategories\GetAllCategoriesService')
@php($categories = $get_all_categories::getAllCategories())
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3 class="text-center">{{ __('Create Product') }}</h3>
            </div>
            <div class="col-md-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="col-md-12">
                <form action="{{ route('lang.admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="form-group row">
                        <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>
                        <div class="col-md-6">
                            <input id="title"
                                   type="text"
                                   class="form-control @error('title') is-invalid @enderror"
                                   name="title"
                                   value="{{ old('title') }}"
                                   autocomplete="title"
                                   autofocus
                            >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="SKU" class="col-md-4 col-form-label text-md-right">{{ __('SKU') }}</label>
                        <div class="col-md-6">
                            <input id="SKU"
                                   type="text"
                                   class="form-control @error('SKU') is-invalid @enderror"
                                   name="SKU"
                                   value="{{ old('SKU') }}"
                                   autocomplete="SKU"
                                   autofocus
                            >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>
                        <div class="col-md-6">
                            <input id="price"
                                   type="text"
                                   class="form-control @error('price') is-invalid @enderror"
                                   name="price"
                                   value="{{ old('price') }}"
                                   autocomplete="price"
                                   autofocus
                            >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="discount" class="col-md-4 col-form-label text-md-right">{{ __('Discount') }}</label>
                        <div class="col-md-6">
                            <input id="discount"
                                   type="text"
                                   class="form-control @error('description') is-invalid @enderror"
                                   name="discount"
                                   value="{{ old('discount') ? old('discount') : 0 }}"
                                   autocomplete="discount"
                                   autofocus
                            >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="in_stock"
                               class="col-md-4 col-form-label text-md-right">{{ __('In Stock (Quantity)') }}</label>
                        <div class="col-md-6">
                            <input id="in_stock"
                                   type="number"
                                   class="form-control @error('in_stock') is-invalid @enderror"
                                   name="in_stock"
                                   value="{{ old('in_stock') }}"
                                   autocomplete="in_stock"
                                   autofocus
                            >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="short_description"
                               class="col-md-4 col-form-label text-md-right">{{ __('Short Description') }}</label>
                        <div class="col-md-6">
                            <textarea name="short_description"
                                      id="short_description"
                                      class="form-control @error('short_description') is-invalid @enderror"
                                      cols="30"
                                      rows="10">{{ old('short_description') }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description"
                               class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                        <div class="col-md-6">
                            <textarea name="description"
                                      id="description"
                                      class="form-control @error('description') is-invalid @enderror"
                                      cols="30"
                                      rows="10">{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="categories"
                               class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>
                        <div class="col-md-6">
                            <select name="category"
                                    id="category"
                                    class="form-control @error('category') is-invalid @enderror">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="categories"
                               class="col-md-4 col-form-label text-md-right">{{ __('Thumbnail') }}</label>
                        <div class="col-md-6">
                            <div class="row">
                                {{--                                <div class="col-md-6">--}}
                                {{--                                    @if(Storage::has($product->thumbnail))--}}
                                {{--                                        <img src="{{Storage::url($product->thumbnail)}}" class="card-img-top"--}}
                                {{--                                             style="max-width: 100%; height: 400px; margin: 0 auto; display: block">--}}
                                {{--                                    @endif--}}
                                {{--                                </div>--}}
                                <div class="col-md-6">
                                    <img src="" id="thumbnail-preview" style="max-height: 250px; max-width: 250px">
                                </div>
                                <div class="col-md-6">
                                    <input type="file" name="thumbnail" id="thumbnail">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="images" class="col-md-4 col-form-label text-md-right">{{ __('Images') }}</label>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row images-wrapper d-flex justify-content-center align-items-center"></div>
                                </div>
                                <div class="col-md-6">
                                    <input type="file" name="images[]" id="images" multiple>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-10 text-right">
                            <input type="submit" class="btn btn-info" value="{{ __('Create Product') }}">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{--    <div class="col-sm-12 d-flex justify-content-center align-items-center">--}}
    {{--        <img src="" class="card-img-top" style="max-width: 80%; margin: 0 auto; display: block">--}}
    {{--        <a data-image_id="{{ $image->id }}"--}}
    {{--           data-route="{{'ajax.lang.products.images.delete'}}"--}}
    {{--        >x</a>--}}

    {{--    </div>--}}


    {{--    <script src="https://ajax.google"></script>--}}
    {{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>--}}
    {{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>--}}
    {{--    <script src="{{ asset('public/js/product-images.js') }}"></script>--}}
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function (e) {

            //for preview of images load multiple
            if (window.FileReader) {
                document.getElementById("images").onchange = function () {
                    let counter = -1,
                        file;

                    $('.images-wrapper').html('');

                    let template = `<div class="col-sm-12 d-flex justify-content-center align-items-center">
                                        <img src="__url__" class="card-img-top" style="max-height: 60%; margin: 0 auto; display: block">
                                 </div>`;

                    while (file = this.files[++counter]) {
                        let reader = new FileReader();

                        reader.onloadend = (function () {
                            let img = template.replace('__url__', this.result);
                            $('.images-wrapper').append(img);
                        });
                        reader.readAsDataURL(file);
                    }
                }
            }

            // for preview thumbnail
            $('#thumbnail').change(function () {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#thumbnail-preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });
    </script>
@endsection
