@extends('M-layout.app')

@section('content')

<div class="container">
    <h1>Suppliers List</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Supplier Name</th>
                <th>Item</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>Company</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($suppliers as $supplier)
                <tr>
                    <td>{{ $supplier->supplier_name }}</td>
                    <td>{{ $supplier->item }}</td>
                    <td>{{ $supplier->phone_number }}</td>
                    <td>{{ $supplier->email }}</td>
                    <td>{{ $supplier->company }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
