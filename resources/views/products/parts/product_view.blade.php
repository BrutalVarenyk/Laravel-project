<div class="col-md-4 show_product" onclick="window.location.href = '{{ route('lang.products.show', $product->id) }}';">
    <div class="card mb-4 shadow-sm">
        @if(Storage::has($product->thumbnail))
            <img src="{{ Storage::url($product->thumbnail) }}" class="card-img-top">
        @endif
        <div class="card-body">
            <p class="card-title">{{ __($product->title) }}</p>
            <hr>
            <p class="card-text">{{ __($product->short_description) }}</p>
            <div class="d-flex flex-column justify-content-center align-items-center">
                <small class="text-muted">{{ __('Categories') }}: </small>
                <div class="btn-group align-self-end">
                    @if(!empty($product->category))
                        @include('categories.parts.category_view', ['category' => $product->category])
                    @endif
                </div>
            </div>
            <hr>
            @if($product->discount == 0 || is_null($product->discount))
                <span class="text-muted">{{ $product->getPrice() }}$</span>
            @else
                <span style="text-decoration: line-through; margin-right: 10px">{{ $product->price }}$</span>
                <span class="text-muted">{{ $product->getPrice() }}$</span>
                <span style="color: #761b18; margin-left:10px">-{{ $product->discount }}%</span>
            @endif
        </div>
    </div>
</div>
