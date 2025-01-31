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
            <form method="POST" action="{{ route('goods.billing') }}">
            <div class="form-row">
                    <!-- Item Name -->
                    <div class="form-group">
                        <label for="serch">serch item </label>
                        <div class="input-group">
                            <input type="text" id="serch" name="serch" class="form-control" required>
                        </div>
                    </div>

                    <!-- Quantity -->
                    <div class="form-group">
                        <label for="branch">Branch</label>
                        <select id="branch" name="branch" class="form-control" required>
                            <option value="" disabled selected>Select Branch</option>
                            @foreach(DB::table('users')->where('position', 2)->orderBy('user_name', 'ASC')->get() as $user)
                                <option value="{{ $user->id }}">{{ $user->user_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @csrf
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

@endsection
