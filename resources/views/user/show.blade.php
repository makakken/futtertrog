@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="mb-3">
                    @include('order_history')
                </div>

                @include('deposit_history')
            </div>
            <div class="col-md-8 col-lg-6">

                <div class="card mb-sm-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        {{ $user->name }}

                        <a href="{{ route('users.edit', $user) }}"
                           title="{{ __('Edit user', ['name' => $user->name]) }}"
                           aria-label="{{ __('Edit user', ['name' => $user->name]) }}"
                        >
                            <i class="fas fa-edit" aria-hidden="true"></i>
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">{{__('Balance')}}</div>
                            <div class="col-sm-9">
                                <span class="{{ $user->balance > 0 ? 'text-success' : 'text-danger' }}">
                                    {{ number_format($user->balance, 2, ',','.') }} €
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-sm-3">
                    <div class="card-header">{{ __('New deposit') }}</div>

                    <div class="card-body">
                        <form action="{{route('deposits.store')}}" method="post" role="form">
                            @csrf()
                            <input type="hidden" name="user_id" value="{{$user->id}}">

                            <div class="form-group">
                                <label for="value" class="col-form-label-sm">{{ __('Value') }}</label>
                                <div>
                                    <input type="number" class="form-control" name="value" id="value">
                                    @if ($errors->has('value'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('value') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>


@endsection