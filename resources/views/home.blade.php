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
                     <form method="post" action="{{ route('payment.process') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Proceed to Payment</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
