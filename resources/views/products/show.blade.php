@extends('layouts.app')
@inject('wishlist', 'App\Services\Wishlist\WishlistService')
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
                    <p>{{__('Product Categories')}}: </p>
                    @each('categories/parts/category_view', $product->category()->get(), 'category')
                </div>
                @auth
                    @if($product->in_stock > 0)
                        <hr>
                        <div>
                            <p>Add to Cart: </p>
                            <form action="{{ route('lang.cart.add', $product) }}" method="POST" class="form-inline">
                                @csrf
                                @method('post')
                                <div class="form-group mx-sm-3 mb-2">
                                    <input type="hidden" name="price_with_discount" value="">
                                    <label for="product_count" class="sr-only">Count: </label>
                                    <input type="number"
                                           name="product_count"
                                           class="form-control"
                                           id="product_count"
                                           min="1"
                                           max="{{ $product->in_stock }}"
                                           value="1"
                                    >
                                </div>
                                <button type="submit" class="btn btn-primary mb-2">{{ __('Buy') }}</button>
                            </form>
                        </div>
                    @endif
                    <div class="form-horizontal poststars" data-route="{{ route('lang.rating.add', $product) }}" id="addStar">
                        <div class="form-group required">
                            <div class="col-sm-12 stars">
                                @if(!is_null($product->getUserRatingForCurrentProduct()))
                                    @for($i = 5; $i >= 1; $i--)
                                        <input class="star star-{{$i}}"
                                               value="{{$i}}"
                                               id="star-{{$i}}"
                                               type="radio"
                                               name="star"
                                            {{
                                            $i == $product->getUserRatingForCurrentProduct()->rating
                                            ? 'checked'
                                            : ''
                                            }}
                                        />
                                        <label class="star star-{{$i}}" for="star-{{$i}}"></label>
                                    @endfor
                                @else
                                    <input class="star star-5 " value="5" id="star-5" type="radio" name="star"/>
                                    <label class="star star-5" for="star-5"></label>
                                    <input class="star star-4" value="4" id="star-4" type="radio" name="star"/>
                                    <label class="star star-4" for="star-4"></label>
                                    <input class="star star-3" value="3" id="star-3" type="radio" name="star"/>
                                    <label class="star star-3" for="star-3"></label>
                                    <input class="star star-2" value="2" id="star-2" type="radio" name="star"/>
                                    <label class="star star-2" for="star-2"></label>
                                    <input class="star star-1" value="1" id="star-1" type="radio" name="star"/>
                                    <label class="star star-1" for="star-1"></label>
                                @endif
                            </div>
                        </div>
                    </div>
                    <hr>
                    @if($wishlist->isUserFollowed($product))
                        <form action="{{ route('lang.wishlist.delete', $product) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger" value="{{__('Remove from Wish List')}}">
                        </form>
                    @else
                        <a href="{{ route('lang.wishlist.add', $product) }}"
                           class="btn btn-success">{{ __('Add to Wish List') }}</a>
                    @endif
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
    <script src="{{ asset('js/product-rating.js') }}" type="text/javascript"></script>
@endsection
