@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Word') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('words.update', $id) }}">
                            {{--<input name="_method" type="hidden" value="PATCH">--}}
                            @csrf

                            <div class="form-group row">
                                <label for="value" class="col-md-4 col-form-label text-md-right">{{ __('Word') }}</label>

                                <div class="col-md-6">
                                    <input id="value" type="text" class="form-control @error('value') is-invalid @enderror" name="value" value="{{ \App\Word::find($id)->value }}" required autofocus>

                                    @error('word')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
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
