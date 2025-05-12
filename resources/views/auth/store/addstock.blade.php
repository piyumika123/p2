@extends('W-layout.app')
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
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form method="POST" action="{{ route('stock.add') }}">
                @csrf
                <div class="form-row">
                    <!-- Barcode Number -->
                    <div class="form-group">
                        <label for="barcode_number">Barcode Number</label>
                        <input type="text" id="barcode_number" name="barcode_number" required style="width: 50%;">
                    </div>
                    <div class="form-group">
                        <label for="new_quantity">New Quantity</label>
                        <input type="number" id="new_quantity" name="new_quantity" required>
                    </div>
                </div>
                <div class="form-row">
                    <!-- Item Name -->
                    <div class="form-group">
                        <label for="item_name">Item Name</label>
                        <input type="text" id="item_name" name="item_name" required>
                    </div>

                    <!-- Quantity -->
                    <div class="form-group">
                        <label for="quantity">avilable Quantity</label>
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

                <div class="form-actions">
                    <x-primary-button class="ms-4" id="add-stock-button">
                        {{ __('Add Stock') }}
                    </x-primary-button>
                    <button type="reset" class="reset">Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const barcodeInput = document.getElementById('barcode_number');
    const addStockButton = document.getElementById('add-stock-button');
    const highestRangeInput = document.getElementById('highest_range');
    const quantityInput = document.getElementById('quantity');
    const newQuantityInput = document.getElementById('new_quantity');

    if (barcodeInput) {
        barcodeInput.addEventListener('input', function() {
            console.log('Barcode input changed:', this.value);
            if (this.value.length === 13) {
                console.log('Fetching item for barcode:', this.value);
                fetch(`/search-item?barcode=${this.value}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok: ' + response.statusText);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Item data received:', data);
                        if (data.item_name) {
                            document.getElementById('item_name').value = data.item_name;
                            quantityInput.value = data.quantity;
                            document.getElementById('selling_price').value = data.selling_price;
                            document.getElementById('purchase_price').value = data.purchase_price;
                            document.getElementById('supermarket_purchase_price').value = data.supermarket_purchase_price;
                            highestRangeInput.value = data.highest_range;
                            document.getElementById('lowest_range').value = data.lowest_range;
                            document.getElementById('loyalty_value').value = data.loyalty_value;
                        } else {
                            document.getElementById('item_name').value = 'Item not found';
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching item:', error);
                        document.getElementById('item_name').value = 'Error fetching item: ' + error.message;
                    });
            } else {
                document.getElementById('item_name').value = '';
            }
        });
        console.log('Event listener attached to barcode input');
    } else {
        console.error('Element with ID "barcode_number" not found');
    }

    if (addStockButton) {
        addStockButton.addEventListener('click', function(event) {
            const newQuantity = parseInt(newQuantityInput.value);
            const currentQuantity = parseInt(quantityInput.value);
            const highestRange = parseInt(highestRangeInput.value);

            if (currentQuantity + newQuantity > highestRange) {
                event.preventDefault();
                alert('Danger: The total quantity exceeds the highest range!');
            }
        });
    }
});
</script>

@endsection