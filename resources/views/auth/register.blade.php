@extends('M-layout.app')

@section('content')

<link href="{{ asset('css/Registre.css') }}" rel="stylesheet">

<div class="card">
    <div class="card-body">
        <div class="container">
            <!-- Image at the top -->
            <div class="card">
                <img src="{{ asset('images/profile.png') }}" alt="Employee Registration" class="header-image">
            </div>
            <br>
            <br>
            <br>

            <h1>Register the New Employee</h1>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Position and User Name (One Row) -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="position">Position</label>
                        <select id="position" name="position" required onchange="setPositionId()">
                            <option value="" disabled selected>-- Select Position --</option>
                            <option value="Manager">Manager</option>
                            <option value="Stock Keeper">Stock Keeper</option>
                            <option value="Supermarket">Supermarket</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="user_name">User Name</label>
                        <input type="text" id="user_name" name="user_name" required>
                    </div>
                </div>

                <div class="form-row">
                <!-- Full Name -->
                <div class="form-group">
                    <label for="full_name">Full Name</label>
                    <input type="text" id="full_name" name="full_name" required>
                </div>

                <!-- Email Address -->
                <div class="form-group">
                    <label for="email">E-Mail Address</label>
                    <input type="email" id="email" name="email" required>
                </div>
                </div>

                <div class="form-row">
                <!-- Address -->
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" required>
                </div>

                <!-- Phone Number -->
                <div class="form-group">
                    <label for="phone_number">Phone Number</label>
                    <input type="tel" id="phone_number" name="phone_number" pattern="[0-9]{10}" required>
                </div>
                </div>

               
                <!-- Gender -->
                <div class="form-group">
                    <label>Gender</label>
                    <div class="radio-group">
                        <label><input type="radio" name="gender" value="Male" required> Male</label>
                        <label><input type="radio" name="gender" value="Female" required> Female</label>
                    </div>
                </div>

                <div class="form-row">
                <!-- Password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required>
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

<script>
    function setPositionId() {
        const position = document.getElementById('position').value;
        const positionIdField = document.getElementById('position_id');
        let positionId = '';

        switch (position) {
            case 'Manager':
                positionId = '1';
                break;
            case 'Stock Keeper':
                positionId = '2';
                break;
            case 'Supermarket':
                positionId = '3';
                break;
            default:
                positionId = '';
        }

        positionIdField.value = positionId;
    }
</script>

@endsection
