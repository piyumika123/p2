@extends('M-layout.app')

@section('content')

<link href="{{ asset('css/Registre.css') }}" rel="stylesheet">

<div class="card">
    <div class="card-body">
        <div class="container">
            <!-- Image at the top -->
            <div class="card">
                <img src="{{ asset('images/profile.png') }}" alt="Item Registration" class="header-image">
            </div>
            <br>
            <br>
            <br>

            <h1>Register New Item</h1>
            <form method="POST" action="{{ route('item.register') }}">
                @csrf

                <div class="form-row">
                    <!-- Barcode Number -->
                    <div class="form-group">
                        <label for="barcode_number">Barcode Number</label>
                        <input type="text" id="barcode_number" name="barcode_number" required>
                        </div>
                        <div class="form-group">

                        <label for="supplier_name">Supplier Name</label>
                        <input type="text" id="supplier_name" name="supplier_name" readonly>
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
                        <label for="quantity">how many Quantity can take at a one oder </label>
                        <input type="number" id="quantity" name="quantity" required>
                    </div>
                </div>

                <div class="form-row">
                    <!-- Selling Price -->
                    <div class="form-group">
                        <label for="selling_price">selling price from a distributor </label>
                        <input type="number" id="selling_price" name="selling_price" step="0.01" required>
                    </div>

                    <!-- Purchase Price -->
                    <div class="form-group">
                        <label for="purchase_price">Purchase Price from wherehose </label>
                        <input type="number" id="purchase_price" name="purchase_price" step="0.01" required>
                    </div>
                </div>

                <div class="form-row">
                    <!-- Supermarket Purchase Price -->
                    <div class="form-group">
                        <label for="supermarket_purchase_price">Supermarket seling price </label>
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
                    <x-primary-button class="ms-4">
                        {{ __('Register') }}
                    </x-primary-button>
                    <button type="reset" class="reset">Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/sidebar.js') }}"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const barcodeInput = document.getElementById('barcode_number');
    if (barcodeInput) {
        barcodeInput.addEventListener('input', function() {
            console.log('Barcode input changed:', this.value);
            if (this.value.length === 13) {
                console.log('Fetching supplier for barcode:', this.value);
                fetch(`/search-supplier?barcode=${this.value}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok: ' + response.statusText);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Supplier data received:', data);
                        if (data.supplier_name) {
                            document.getElementById('supplier_name').value = data.supplier_name;
                        } else {
                            document.getElementById('supplier_name').value = 'Please register the supplier first';
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching supplier:', error);
                        console.error('Error details:', error);
                        document.getElementById('supplier_name').value = 'Error fetching supplier: ' + error.message;
                    });
            } else {
                document.getElementById('supplier_name').value = '';
            }
        });
        console.log('Event listener attached to barcode input');
    } else {
        console.error('Element with ID "barcode_number" not found');
    }
});
</script>

@endsection
