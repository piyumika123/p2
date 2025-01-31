@extends('layouts.app')
@section('content')
<link href="{{ asset('css/Registre.css') }}" rel="stylesheet">

<div class="card">
    <div class="card-body">
        <div class="container">
            <!-- Image at the top -->
            <div class="card">
                <img src="{{ asset('images/profile.png') }}" alt="Goods Order" class="header-image">
            </div>
            <br>
            <br>
            <br>
            <form method="POST" action="{{ route('goods.order') }}">
                @csrf
                <!-- Add form fields similar to sale.blade.php -->
                <div class="form-actions">
                    <x-primary-button class="ms-4">
                        {{ __('Submit') }}
                    </x-primary-button>
                    <button type="reset" class="reset">Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
