@extends('layouts.app')
@section('content')
<link href="{{ asset('css/Registre.css') }}" rel="stylesheet">

<div class="card">
    <div class="card-body">
        <div class="container">

            <!-- Branch ID -->
            <div class="form-group">
                <input type="hidden" id="branch_id" value="{{ $branchId }}" readonly class="form-control">
            </div>
            <br>

            <!-- Top Icon -->
            <div class="card">
                <i class="bi bi-person-plus header-image"></i>
            </div>
            <br><br><br>

            <form method="POST" action="{{ route('supermarket.addItem') }}">
            @csrf

                <div class="form-group">
                    <input type="hidden" id="branch_id" name="branch_id" value="{{ $branchId }}"> <!-- Added hidden input -->
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="barcode_number">Barcode Number</label>
                        <input type="text" id="barcode_number" name="barcode_number" required>
                    </div>
                    <div class="form-group">
                        <label for="invoice">Invoice</label>
                        <input type="text" id="invoice" name="invoice" value="{{ $nextInvoiceNumber ?? '' }}" > <!-- Auto-generated -->
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="item_name">Item Name</label>
                        <input type="text" id="item_name" name="item_name" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" id="quantity" name="quantity" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="supermarket_purchase_price">Purchase Price</label>
                        <input type="number" id="supermarket_purchase_price" name="supermarket_purchase_price" step="0.01" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="number" id="phone_number" name="phone_number" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="loyalty_value">Loyalty Value</label>
                        <input type="number" id="loyalty_value" name="loyalty_value" step="0.01" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="total">Total</label>
                        <input type="number" id="total" name="total" step="0.01" required>
                    </div>
                </div>
                <!-- Show items one by one -->
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Barcode Number</th>
                                <th>Invoice</th>
                                <th>Item Name</th>
                                <th>Quantity</th>
                                <th>Purchase Price</th>
                                <th>Phone Number</th>
                                <th>Loyalty Value</th>
                                <th>Subtotal</th> <!-- Added Subtotal column -->
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($items as $item)
                                <tr>
                                    <td>{{ $item->barcode_number }}</td>
                                    <td>{{ $item->invoice }}</td>
                                    <td>{{ $item->item_name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->supermarket_purchase_price }}</td>
                                    <td>{{ $item->phone_number }}</td>
                                    <td>{{ $item->loyalty_value }}</td>
                                    <td>{{ $item->subtotal }}</td> <!-- Display subtotal -->
                                    <td>{{ $item->total }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">No items found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Display total value -->
                <div class="text-end">
                    <h5>Total Value: {{ $totalValue }}</h5>
                </div>

                <div class="form-actions">
                    <x-primary-button class="ms-4">
                        {{ __('Add Stock') }}
                    </x-primary-button>
                </div>
            </form>

            <!-- Separate form for Print Bill -->
            <form method="POST" action="{{ route('supermarket.printBill') }}" style="margin-top: 10px;">
                @csrf
                <button type="submit" class="btn btn-primary">Print Bill</button> <!-- Print Bill button -->
            </form>
        </div>
    </div>
</div>
<script>
    document.getElementById('barcode_number').addEventListener('input', function () {
        const barcode = this.value;
        const branchId = document.getElementById('branch_id').value;

        if (barcode.length === 13) {
            fetchItemDetails(barcode, branchId);
        }
    });

    function fetchItemDetails(barcode, branchId, retryCount = 0) {
        fetch(`/api/get-item-name?barcode_number=${barcode}&branch_id=${branchId}`)
            .then(response => {
                if (!response.ok) throw new Error(`HTTP error! ${response.status}`);
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    const item = data.item || data.items?.[0];
                    document.getElementById('item_name').value = item?.item_name || '';
                    document.getElementById('supermarket_purchase_price').value = item?.supermarket_purchase_price || '';
                    document.getElementById('loyalty_value').value = item?.loyalty_value || '';
                    calculateTotal(); // Recalculate total after autofill
                } else {
                    clearFields();
                    alert(data.message || 'Item not found.');
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
                if (retryCount < 2) {
                    fetchItemDetails(barcode, branchId, retryCount + 1);
                } else {
                    alert('Failed to fetch item details.');
                }
            });
    }

    function clearFields() {
        document.getElementById('item_name').value = '';
        document.getElementById('supermarket_purchase_price').value = '';
        document.getElementById('loyalty_value').value = '';
        document.getElementById('total').value = '';
    }

    function calculateTotal() {
        const quantity = parseFloat(document.getElementById('quantity').value);
        const price = parseFloat(document.getElementById('supermarket_purchase_price').value);
        const total = (!isNaN(quantity) && !isNaN(price)) ? (quantity * price).toFixed(2) : '';
        document.getElementById('total').value = total;
    }

    document.getElementById('quantity').addEventListener('input', calculateTotal);
</script>

@endsection
