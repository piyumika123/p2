@extends('layouts.app')
@section('content')
<link href="{{ asset('css/Registre.css') }}" rel="stylesheet">

<div class="card">
    <div class="card-body">
        <div class="container">
            <!-- Image at the top -->
            <div class="card">
                <img src="{{ asset('images/profile.png') }}" alt="Goods Inward" class="header-image">
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
            <form method="POST" action="{{ route('supermarket.stock.store') }}">
                @csrf
                <input type="hidden" name="branch_id" value="{{ $userId }}">
                <!-- Add form fields similar to sale.blade.php -->
                <div class="form-actions">
                    <x-primary-button class="ms-4">
                        {{ __('Submit') }}
                    </x-primary-button>
                    <button type="reset" class="reset">Reset</button>
                </div>
                <!-- Include selected items -->
                <div class="items-table">
                    <h3>Items</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Select</th>
                                <th>Barcode Number</th>
                                <th>Item Name</th>
                                <th>Quantity</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($items) && count($items) > 0)
                                @foreach($items->sortBy('branch_id') as $goodsBilling)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="selected_items[]" value="{{ $goodsBilling->barcode_number }}">
                                        </td>
                                        <td>{{ $goodsBilling->barcode_number }}</td>
                                        <td>{{ $goodsBilling->item ? $goodsBilling->item->item_name : 'N/A' }}</td>
                                        <td>{{ $goodsBilling->quantity }}</td>
                                        <td>{{ $goodsBilling->date }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5">No items found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </form>
            <br>
            <br>
            <!--
            <div class="branch-id">
                <h3>User ID {{ $userId }}</h3>
            </div> Display user ID -->
        </div>
    </div>
</div>

@endsection
