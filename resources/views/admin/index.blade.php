@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3 class="text-center">{{ __('Welcome, :name, nice to see you', ['name' => Auth::user()->name]) }}</h3>
            </div>
        </div>
    </div>
@endsection
