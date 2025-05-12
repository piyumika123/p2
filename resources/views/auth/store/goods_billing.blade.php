@extends('W-layout.app')
@section('content')
<link href="{{ asset('css/Registre.css') }}" rel="stylesheet">

<div class="card">
    <div class="card-body">
        <div class="container">
            <!-- Image at the top -->
            <div class="card">
                <img src="{{ asset('images/profile.png') }}" alt="Goods Billing" class="header-image">
            </div>
            <br>
            <br>
            <br>
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <form method="POST" action="{{ route('goods.billing.store') }}">
                @csrf
                <div class="form-row">
                    <!-- Barcode Number -->
                    <div class="form-group">
                        <label for="barcode_number">Search Item</label>
                        <div class="input-group">
                            <input type="text" id="barcode_number" name="barcode_number" class="form-control" required>
                        </div>
                    </div>

                    <!-- Branch -->
                    <div class="form-group">
                        <label for="branch">Branch</label>
                        <select id="branch" name="branch" class="form-control" required>
                            <option value="" disabled selected>Select Branch</option>
                            @php
                                $users = DB::table('users')->where('position_id', 3)->orderBy('address', 'ASC')->get();
                            @endphp
                            @if($users->isEmpty())
                                <option value="" disabled>No branches available</option>
                            @else
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->address }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <!-- Item Name -->
                    <div class="form-group">
                        <label for="item_name">Item Name</label>
                        <input type="text" id="item_name" name="item_name" class="form-control" required>
                    </div>

                    <!-- Quantity -->
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" id="quantity" name="quantity" class="form-control" required>
                    </div>
                </div>
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    const barcodeInput = document.getElementById('barcode_number');
    const itemNameInput = document.getElementById('item_name');

    if (barcodeInput) {
        barcodeInput.addEventListener('input', function() {
            if (this.value.length === 13) {
                fetch(`/search-item?barcode=${this.value}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok: ' + response.statusText);
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.item_name) {
                            itemNameInput.value = data.item_name;
                        } else {
                            itemNameInput.value = 'Item not found';
                        }
                    })
                    .catch(error => {
                        itemNameInput.value = 'Error fetching item: ' + error.message;
                    });
            } else {
                itemNameInput.value = '';
            }
        });
    }
});
</script>

@endsection
