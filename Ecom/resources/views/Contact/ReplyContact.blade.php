@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Send Reply') }}
                        <a href="/contact/showcontactdetails" class="btn btn-warning float-right">Show Contact Details</a>

                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form action="{{ route('send.reply') }}" method="post">
                            @csrf
                            <input type="hidden" name="cid" value="{{$contactinfo->id}}">
                            <input type="hidden" name="name" value="{{ $contactinfo->name }}">
                            <div class="row mb-3">
                                <label for="to" class="col-md-4 col-form-label text-md-end">To<span
                                        class="text-danger ml-2">*</span></label>
                                <div class="col-md-6">
                                    <input type="email" class="form-control @error('to') is-invalid @enderror" id="to"
                                        name="to" value="{{ $contactinfo->emai }}" autocomplete="to" autofocus>
                                    @error('to')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="msg" class="col-md-4 col-form-label text-md-end">Message<span
                                        class="text-danger ml-2">*</span></label>
                                <div class="col-md-6">
                                    <textarea name="msg"
                                        class="form-control @error('msg') is-invalid @enderror" id="msg"
                                        cols="30" rows="7" autocomplete="msg"
                                        autofocus>{{ old('msg') }}</textarea>
                                    @error('msg')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Send') }}
                                    </button>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-6 offset-md-4">
                                    <p class="text-success"><span class="text-danger ml-1"><b>*</b></span> fields are
                                        required</p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
