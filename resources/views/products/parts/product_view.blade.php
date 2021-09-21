<div class="col-md-4">
    <div class="card mb-4 shadow-sm">
            @if($product->thumbnail)
{{--                <img src="{{ $product->thumbnail }}" height="200" class="card-img-top">--}}
            <img src="{{ $product->thumbnail }}" class="card-img-top">
            @endif
        <div class="card-body">
            <p class="card-title">{{ __($product->title) }}</p>
            <hr>
            <p class="card-text">{{ __($product->short_description) }}</p>
            <div class="d-flex flex-column justify-content-center align-items-center">
                <small class="text-muted">Categories: </small>
                <div class="btn-group align-self-end">
{{--                    @if(!empty($product->category))--}}
{{--                        @each('categories.parts.product_category', $product->category, 'category')--}}
{{--                    @endif--}}
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('products.show', $product->id) }}"
                   class="text-muted btn btn-outline-dark">
                    {{ __('Show') }}
                </a>
            </div>
            @if(is_null($product->discount))
                <span class="text-muted">{{ $product->getPrice() }}</span>
            @else
                <span style="text-decoration: line-through; margin-right: 10px">{{ $product->price }}$</span>
                <span class="text-muted">{{ $product->getPrice() }}$</span>
                <span style="color: #761b18; margin-left:10px">-{{ $product->discount }}%</span>
            @endif
        </div>
    </div>
</div>
