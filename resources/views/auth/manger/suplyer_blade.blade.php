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

            <h1>Create the New Supplier</h1>
            <form method="POST" action="{{ route('suppliers.store') }}">
                @csrf

                <!-- Supplier Name -->
                <div class="form-row">

                <div class="form-group">
                    <label for="supplier_name">Supplier Name</label>
                    <input type="text" id="supplier_name" name="supplier_name" required>
                </div>
                <div class="form-group">
                    <label for="item">Item</label>
                    <input type="text" id="item" name="item" required>
                </div>
                </div>

                <!-- Contact Details (Phone Number and Email Address) -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="tel" id="phone_number" name="phone_number" pattern="[0-9]{10}" required>
                    </div>

                    <div class="form-group">
                        <label for="email">E-Mail Address</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                </div>

                <!-- Company -->
                <div class="form-group">
                    <label for="company">Company</label>
                    <input type="text" id="company" name="company" required>
                </div>

                <!-- Item -->
             

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

<script>
document.querySelector('form').addEventListener('submit', function(event) {
    event.preventDefault();
    const form = event.target;
    const email = document.getElementById('email').value;

    fetch('{{ route('supplier.send-email') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ email: email })
    })
    .then(response => response.json())
    .then(data => {
        if (data.message) {
            alert(data.message);
            form.submit(); // Submit the form after email is sent
        } else {
            alert(data.error);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
</script>

@endsection