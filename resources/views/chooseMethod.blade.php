@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Africa Blue Webs Screening') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif 
                <div class="card-body">
                    <form method="POST" action="{{ route('payment.processMpesa') }}">
                        @csrf
                       <div class="form-group">
                            <label for="amount">Amount:</label>
                            <input type="text" class="form-control" name="amount" value="50" readonly>
                        </div> 
                        <div class="form-group">
                            <label for="phone_number">Phone Number:</label>
                            <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" placeholder='0755555555' name="phone_number" value="{{ old('phone_number') }}" required>
                            @error('phonenumber')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Pay via M-Pesa</button>
                    </form>
                </div>
</div>
</div>
</div>
</div>
@endsection
