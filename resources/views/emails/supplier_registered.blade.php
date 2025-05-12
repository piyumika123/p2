<!DOCTYPE html>
<html>
<head>
    <title>Supplier Registration Confirmation</title>
</head>
<body>
    <h1>Supplier Registration Confirmation</h1>
    @if($supplier)
        <p>Dear {{ $supplier->supplier_name }},</p>
        <p>Thank you for registering as a supplier. Here are your details:</p>
        <ul>
            <li>Supplier Name: {{ $supplier->supplier_name }}</li>
            <li>Item: {{ $supplier->item }}</li>
            <li>Phone Number: {{ $supplier->phone_number }}</li>
            <li>Email: {{ $supplier->email }}</li>
            <li>Company: {{ $supplier->company }}</li>
        </ul>
    @else
        <p>Thank you for registering as a supplier.</p>
    @endif
    <p>Best regards,</p>
    <p>{{ config('app.name') }}</p>
</body>
</html>
