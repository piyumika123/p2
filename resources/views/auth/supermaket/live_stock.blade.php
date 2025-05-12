@extends('layouts.app')
@section('content')
<link href="{{ asset('css/Registre.css') }}" rel="stylesheet">

<div class="card">
    <div class="card-body">
        <div class="container">
            <!-- Image at the top -->
            <div class="card">
                <img src="{{ asset('images/profile.png') }}" alt="Live Stock" class="header-image">
            </div>
            <br>
            <br>
            <br>
            <form method="GET" action="{{ route('supermarket.live_stock') }}">
                @csrf
                <div class="form-group">
                    <input type="hidden" name="branch_id" id="branch_id" class="form-control" value="{{ Auth::user()->userId }}" readonly>
                </div>
                <div class="form-group">
                    <label for="barcode_number">Barcode Number</label>
                    <input type="text" name="barcode_number" id="barcode_number" class="form-control">
                </div>
                <div class="form-actions">
                    <x-primary-button class="ms-4">
                        {{ __('Submit') }}
                    </x-primary-button>
                    <button type="reset" class="reset">Reset</button>
                </div>
            </form>
            @if(isset($liveStock))
                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>Supermarket Purchase Price</th>
                            <th>Loyalty Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($liveStock as $stock)
                            <tr>
                                <td>{{ $stock->item_name }}</td>
                                <td>{{ $stock->quantity }}</td>
                                <td>{{ $stock->supermarket_purchase_price }}</td>
                                <td>{{ $stock->loyalty_value }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>

@endsection
