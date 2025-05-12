@extends('M-layout.app')

@section('content')

<link href="{{ asset('css/Registre.css') }}" rel="stylesheet">

<div class="card">
    <div class="card-body">
        <div class="container">
            <!-- Image at the top -->
            <div class="card">
                <img src="{{ asset('images/profile.png') }}" alt="Supplier Registration" class="header-image">
            </div>
            <br>
            <br>
            <br>

            <h1>Register New Supplier</h1>
            <form method="POST" action="{{ route('supplier.register') }}">
                @csrf

                <div class="form-row">
                    <!-- Supplier Name -->
                    <div class="form-group">
                        <label for="supplier_name">Supplier Name</label>
                        <input type="text" id="supplier_name" name="supplier_name" required>
                    </div>

                    <!-- Phone Number -->
                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" id="phone_number" name="phone_number" required>
                    </div>
                </div>

                <div class="form-row">
                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <!-- Company -->
                    <div class="form-group">
                        <label for="company">Company</label>
                        <input type="text" id="company" name="company" required>
                    </div>
                </div>

                <div class="form-row">
                    <!-- Item -->
                    <div class="form-group">
                        <label for="item">Item</label>
                        <input type="text" id="item" name="item" required>
                    </div>
                </div>

                <div class="form-actions">
                    <x-primary-button class="ms-4">
                        {{ __('Register') }}
                    </x-primary-button>
                    <button type="reset" class="reset">Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
