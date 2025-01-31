@extends('W-layout.app')
@section('content')
<link href="{{ asset('css/Registre.css') }}" rel="stylesheet">

<div class="card">
    <div class="card-body">
        <div class="container">
            <!-- Image at the top -->
            <div class="card">
                <img src="{{ asset('images/profile.png') }}" alt="Wastage Stock" class="header-image">
            </div>
            <br>
            <br>
            <br>
            <form method="POST" action="{{ route('wastage.stock') }}">
                @csrf
                <!-- Add form fields similar to addstock.blade.php -->
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
