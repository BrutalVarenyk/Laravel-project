@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3 class="text-center">{{ __($product->title) }}</h3>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                @if(Storage::has($product->thumbnail))
                    {{--                    <img src="{{ $product->thumbnail }}" class="card-img-top" style="max-width: 100%; height: 400px; margin: 0 auto; display: none">--}}
                    <img src="{{ Storage::url($product->thumbnail) }}" class="card-img-top"
                         style="max-width: 100%; height: 400px; width: auto; margin: 0 auto; display: block">
                @endif

{{-- For testing of images--}}
{{--                    @foreach($product->gallery()->get() as $image)--}}
{{--                        @if(Storage::has($image->path))--}}
{{--                                                <img src="{{ $product->thumbnail }}" class="card-img-top" style="max-width: 100%; height: 400px; margin: 0 auto; display: none">--}}
{{--                            <img src="{{ Storage::url($image->path) }}" class="card-img-top"--}}
{{--                                 style="max-width: 100%; height: 400px; margin: 0 auto; display: block">--}}
{{--                        @endif--}}
{{--                    @endforeach--}}

            </div>

            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-8">
                        @if(is_null($product->discount))
                            <p>Price: {{ $product->getPrice() }}$</p>
                        @else
                            <p>Price: <span
                                    style="text-decoration: line-through">{{ $product->price }}$</span> {{ $product->getPrice() }}
                                $ <span style="color: #761b18; margin-left:10px">-{{ $product->discount }}%</span></p>
                        @endif
                    </div>
                    <p>SKU: {{ $product->SKU }}</p>
                </div>
                <p>In stock: {{ $product->in_stock }}</p>
                <hr>
                <div>
                    <p>Product Categories: </p>
                    @each('categories.parts.category_view', $product->category()->get(), 'category')
                </div>
                @auth
                    @if($product->in_stock > 0)
                        <hr>
                        {{--                        <div>--}}
                        {{--                            <p>Add to Cart:</p>--}}
                        {{--                            <form action="{{ route('cart.add', $product) }}" method="POST" class="form-inline"></form>--}}
                        {{--                        @csrf--}}
                        {{--                        @method('post')--}}
                        {{--                            <div class="form-group mx-sm-3 nb-2">--}}
                        {{--                                <input type="hidden" name="price_with_discount" value="">--}}
                        {{--                                <label for="product_count" class="sr-only">Count: </label>--}}
                        {{--                                <input type="number"--}}
                        {{--                                       class="form-control"--}}
                        {{--                                       name="product_count"--}}
                        {{--                                       id="product_count"--}}
                        {{--                                       min="1"--}}
                        {{--                                       max="{{ $product->in_stock }}"--}}
                        {{--                                       value="1" >--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                    @endif
                    {{--                        <form>--}}
                    {{--                        @csrf--}}
                    {{--                            <div class="form-group required">--}}
                    {{--                                <div class="col-sm-12">--}}
                    {{--                                    @if(!is_null($product->getUserRatingForCurrencProduct()))--}}
                    {{--                                        @for($i = 5; $i >= 1; $i--)--}}
                    {{--                                        <input class="star star-{{$i}}"--}}
                    {{--                                               value="{{$i}}"--}}
                    {{--                                               id=""--}}
                    {{--                                               type=""--}}
                    {{--                                               name=""--}}
                    {{--                                                />--}}
                    {{--                                            <label class="star star-{{$i}}" for="star star-{{$i}}"></label>--}}
                    {{--                                        @endfor--}}
                    {{--                                    @else--}}
                    {{--                                        <input class="star star-5" value="5" id="star-5" type="radio" name="star">--}}
                    {{--                                        <label class="star star-5" for="star-5"></label>--}}
                    {{--                                    @endif--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                        </form>--}}
                    {{--                    <hr>--}}
                @endauth
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <h4>{{__('Description')}}:</h4>
                <p>{{ $product->description }}</p>
            </div>
        </div>
    </div>
@endsection
