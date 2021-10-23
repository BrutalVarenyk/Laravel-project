@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <div class="col-md-12">
                <h3 class="text-center">{{ __('Products') }}</h3>
            </div>
            <div class="col-md-12">
                <table class="table align-self-center">
                    <thread>
                        <tr>
                            <th class="text-center" scope="col">{{ __('ID') }}</th>
                            <th class="text-center" scope="col">{{ __('Thumbnail') }}</th>
                            <th class="text-center" scope="col">{{ __('Name') }}</th>
                            <th class="text-center" scope="col">{{ __('Quantity') }}</th>
                            <th class="text-center" scope="col">{{ __('Category') }}</th>
                            <th class="text-center" scope="col">{{ __('Actions') }}</th>
                        </tr>
                    </thread>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td class="text-center" scope="col">{{ $product->id }}</td>
                                <td class="text-center" scope="col"><img src="{{ Storage::url($product->thumbnail) }}" width="90" alt="{{ $product->title }}"></td>
                                <td class="text-center" scope="col">{{ $product->title }}</td>
                                <td class="text-center" scope="col">{{ $product->in_stock }}</td>
                                <td class="text-center" scope="col">
                                    @if(!empty($product->category))
                                        @include('categories.parts.category_view', ['category' => $product->category])
                                    @else
                                        {{ __('Missing category') }}
                                    @endif
                                </td>
                                <td class="text-center" scope="col">
                                    <a href="{{ route('lang.admin.products.edit', $product->id) }}" class="btn btn-info form-control">{{__('Edit')}}</a>
                                    <form action="{{ route('lang.admin.products.delete', $product->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" class="btn btn-danger form-control" value="{{__('Remove')}}">
                                    </form>
                                    <a href="{{ route('lang.products.show', $product->id) }}" class="btn btn-outline-success form-control">{{__('View')}}</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="col-md-8">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
