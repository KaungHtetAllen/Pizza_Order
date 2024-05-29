@extends('admin.layouts.master')

@section('title','Account Profile Page')

@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-1">
                    <a href="{{ route('category#list')}}"><button class="btn bg-dark text-white my-3 ml-3"><i class="fa-solid fa-arrow-left mr-2"></i>back</button></a>
                </div>
                <div class="col-5 offset-2">
                    @if (session('updateSuccess'))
                    <div class="col-12">
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <strong><i class="fa-solid fa-cloud-arrow-up mr-2"></i>{{ session('updateSuccess')}}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Account Info</h3>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-3 offset-2">
                                @if (Auth::user()->image == null)
                                    @if(Auth::user()->gender == 'male')
                                        <img src="{{ asset('image/male_default_user.jpg')}}" alt="John Doe" class='img-thumbnail shadow-sm'/>
                                    @else
                                        <img src="{{ asset('image/female_default_user.jpg')}}" alt="John Doe" class='img-thumbnail shadow-sm'/>
                                    @endif
                                @else
                                <img src="{{ asset('storage/'.Auth::user()->image)}}" alt="John Doe" class='img-thumbnail shadow-sm' />
                                @endif
                            </div>
                            <div class="col-5 offset-1">
                                <h4 class="my-3"><i class="fa-solid fa-user-pen mr-2" title="name"></i>{{ Auth::user()->name}}</h4>
                                <h4 class="my-3"><i class="fa-solid fa-envelope-open-text mr-2" title="email"></i>{{ Auth::user()->email}}</h4>
                                <h4 class="my-3"><i class="fa-solid fa-phone-volume mr-2" title="phone"></i>{{ Auth::user()->phone}}</h4>
                                <h4 class="my-3"><i class="fa-solid fa-venus-mars mr-2" title="gender"></i>{{ Auth::user()->gender}}</h4>
                                <h4 class="my-3"><i class="fa-solid fa-location-dot mr-2" title="address"></i>{{ Auth::user()->address}}</h4>
                                <h4 class="my-3"><i class="fa-regular fa-calendar-check mr-2" title="Joined Date"></i>{{ Auth::user()->created_at->format('d-M-Y')}}</h4>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-3 offset-2 text-center">
                                <a href="{{ route('admin#edit')}}">
                                    <button class="btn bg-dark text-white"><i class="fa-solid fa-pen-to-square mr-2"></i>Edit Profile</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection
