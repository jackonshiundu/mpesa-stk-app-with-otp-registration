<!-- resources/views/your/success/page.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Success Page') }}</div>

                <div class="card-body">
                @if(isset($userDetails))
                    <h3>Parent Details:</h3>
                    <ul style="list-style-type: none; padding: 0;">
                        <li style="font-weight: bold;">Name: {{ $userDetails->name }}</li>
                        <li style="font-weight: bold;">Email: {{ $userDetails->email }}</li>
                        <li style="font-weight: bold;">Phone Number: {{ $userDetails->phonenumber }}</li>
                        <li style="font-weight: bold;">Parent Phone Number: {{ $userDetails->parentphonenumber }}</li>
                        <li style="font-weight: bold;">Fee payed: {{ $userDetails->	feepayed }}</li>
                        <li style="font-weight: bold;">Balance: {{ intval($userDetails->totalfee) - intval($userDetails->feepayed) }}</li>
                        <li style="font-weight: bold;">Payment Status: {{ $userDetails->status }}</li>
                        <!-- Add other details as needed -->
                    </ul>
                @endif
                <a href="{{ route('payment.chooseMethod') }}" class="btn btn-primary">Pay for Fees</a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
