
@extends('user.layouts.master')

@section('title','Contact Page')

@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-8">
                    <a href="{{ route('user#home')}}">
                        <button class="btn bg-dark text-white my-3"><i class="fa-solid fa-arrow-left mr-2"></i>Back</button>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Contact Form</h3>
                        </div>
                        {{-- password change alert message --}}
                        @if (session('changeSuccess'))
                        <div class="col-12">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong><i class="fa-solid fa-cloud-arrow-up mr-2"></i>{{ session('changeSuccess')}}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                        </div>
                        @endif
                        {{-- password not match alert message --}}
                        @if (session('notMatch'))
                        <div class="col-12">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong><i class="fa-solid fa-circle-exclamation mr-2"></i>{{ session('notMatch')}}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                        </div>
                        @endif
                        <hr>
                        <form action="{{ route('user#send')}}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="form-group col-10 offset-1">
                                <label for="cc-payment" class="control-label mb-1">Name</label>
                                <input id="cc-pament" name="name" type="text" class="form-control  @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Name...">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group  col-10 offset-1">
                                <label for="cc-payment" class="control-label mb-1">Email</label>
                                <input id="cc-pament" name="email" type="email" class="form-control @error('email') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Email...">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group  col-10 offset-1">
                                <label for="cc-payment" class="control-label mb-1">Message</label>
                                <textarea name="message" class="form-control @error('message') is-invalid @enderror" id="" cols="30" rows="3" placeholder="Enter Message ..."></textarea>
                                @error('message')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group  col-10 offset-1">
                                <button id="payment-button" type="submit" class="btn btn-lg bg-dark text-white btn-block">
                                    <span id="payment-button-amount">Send</span>
                                    <i class="fa-solid fa-arrow-right ml-2"></i>
                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection
