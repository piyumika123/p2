@extends('layouts.app')
@section('content')
<link href="{{ asset('css/Registre.css') }}" rel="stylesheet">

<div class="card">
    <div class="card-body">
        <div class="container">
            <!-- Image at the top -->
            <div class="card">
            <i class="bi bi-person-plus header-image"></i>
            </div>
            <br>
            <br>
            <br>
            <form method="POST" action="{{ route('soup.add') }}">
                @csrf
                <div class="form-row">
                    <!-- Item Name -->
                    <div class="form-group">
                        <label for="item_name">Item Name</label>
                        <input type="text" id="item_name" name="item_name" required>
                    </div>

                    <!-- Quantity -->
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" id="quantity" name="quantity" required>
                    </div>
                </div>

                <div class="form-row">
                    <!-- Selling Price -->
                    <div class="form-group">
                        <label for="selling_price">Selling Price</label>
                        <input type="number" id="selling_price" name="selling_price" step="0.01" required>
                    </div>

                    <!-- Purchase Price -->
                    <div class="form-group">
                        <label for="purchase_price">Purchase Price</label>
                        <input type="number" id="purchase_price" name="purchase_price" step="0.01" required>
                    </div>
                </div>

                <div class="form-row">
                    <!-- Supermarket Purchase Price -->
                    <div class="form-group">
                        <label for="supermarket_purchase_price">Supermarket Purchase Price</label>
                        <input type="number" id="supermarket_purchase_price" name="supermarket_purchase_price" step="0.01" required>
                    </div>

                    <!-- Highest Range -->
                    <div class="form-group">
                        <label for="highest_range">Highest Range</label>
                        <input type="number" id="highest_range" name="highest_range" required>
                    </div>
                </div>

                <div class="form-row">
                    <!-- Lowest Range -->
                    <div class="form-group">
                        <label for="lowest_range">Lowest Range</label>
                        <input type="number" id="lowest_range" name="lowest_range" required>
                    </div>

                    <!-- Loyalty Value -->
                    <div class="form-group">
                        <label for="loyalty_value">Loyalty Value</label>
                        <input type="number" id="loyalty_value" name="loyalty_value" step="0.01" required>
                    </div>
                </div>

                <div class="form-row">
                    <!-- Barcode Number -->
                    <div class="form-group">
                        <label for="barcode_number">Barcode Number</label>
                        <input type="text" id="barcode_number" name="barcode_number" required>
                    </div>
                </div>

                <div class="form-actions">
                    <x-primary-button class="ms-4">
                        {{ __('Add Stock') }}
                    </x-primary-button>
                    <button type="reset" class="reset">Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection