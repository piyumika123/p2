@extends('M-layout.app')

@section('content')
<main class="container mt-4">
    <div class="card" style="max-width: 2000px; margin: auto;">
        <div class="card-body">
            @include('M-layout.chart') <!-- Include the chart view -->
        </div>
    </div>
</main>
@endsection