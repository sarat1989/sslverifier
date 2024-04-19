@extends('layouts.user_type.auth')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Add Domain') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('domains.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="domain_friendly_name" class="col-md-4 col-form-label text-md-right">{{ __('Friendly Name') }}</label>

                                <div class="col-md-8">
                                    <input id="domain_friendly_name" type="text" class="form-control @error('name') is-invalid @enderror" name="domain_friendly_name" value="{{ old('name') }}" required autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="domain_name" class="col-md-4 col-form-label text-md-right">{{ __('Domain NAME') }}</label>

                                <div class="col-md-8">
                                    <input id="domain_name" type="text" class="form-control @error('email') is-invalid @enderror" name="domain_name" value="{{ old('email') }}" placeholder="Enter with out https:// " required>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Add Domain') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
