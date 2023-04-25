@extends('layouts.app')

@section('content')

    <div class="container">
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if(session('success'))
            <div class="alert alert-success alert-dismiss">
                {{ session('success') }}
            </div>
        @endif
        <h1>Borrow A Book</h1>

        <form method="POST" action="{{ route('transaction.borrow.submit') }}">
            @csrf

            <div class="row mb-3">
                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('ISBN') }}</label>

                <div class="col-md-6">
                    <input id="isbn" type="text" class="form-control @error('isbn') is-invalid @enderror" name="isbn" value="{{ old('isbn') }}" required autocomplete="isbn" autofocus>

                    @error('isbn')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Borrow') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
    
@endsection