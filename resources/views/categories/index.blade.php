@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3 class="text-center">{{ __('All Categories') }}</h3>
            </div>
            <div class="col-md-12">
                <div class="album py-5 bg-light">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table align-self-center">
                                    <thead>
                                    <tr>
                                        <th class="text-center" scope="col"> {{ __('Category Name') }}</th>
                                        <th class="text-center" scope="col"> {{ __('Category Description') }}</th>
                                        <th class="text-center" scope="col"> {{ __('Products count') }}</th>
                                        @if(is_admin(auth()->user()))
                                            <th class="text-center" scope="col"> {{ __('Actions') }}</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($categories as $category)
                                        <tr>
                                            <td class="text-center"> @include('categories.parts.category_view', ['category' => $category])</td>
                                            <td class="text-center"> {{ $category->description}}</td>
                                            <td class="text-center"> {{ $category->products_count}}</td>

                                            @if(is_admin(auth()->user()))
                                                <td class="text-center" scope="col">
                                                    <a href="{{ route('lang.admin.categories.edit', $category->id) }}" class="btn btn-info form-control">{{__('Edit')}}</a>
                                                    <form action="{{ route('lang.admin.categories.delete', $category->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="submit" class="btn btn-danger form-control" value="{{__('Remove')}}">
                                                    </form>
                                                    <a href="{{ route('lang.categories.show', $category->id) }}" class="btn btn-outline-success form-control">{{__('View')}}</a>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
@endsection

