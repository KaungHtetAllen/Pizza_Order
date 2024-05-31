@extends('admin.layouts.master')

@section('title','Account Profile Edit Page')

@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-1">
                    <a href="{{ route('admin#details')}}"><button class="btn bg-dark text-white my-3 ml-3"><i class="fa-solid fa-arrow-left mr-2"></i>back</button></a>
                </div>
            </div>
            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Edit Account Profile </h3>
                        </div>
                        <hr>
                        <form action="{{ route('admin#update',Auth::user()->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-4 offset-1">
                                     @if (Auth::user()->image == null)
                                        @if(Auth::user()->gender == 'male')
                                        <img src="{{ asset('image/male_default_user.jpg')}}" alt="John Doe" class='img-thumbnail shadow-sm'/>
                                        @else
                                        <img src="{{ asset('image/female_default_user.jpg')}}" alt="John Doe" class='img-thumbnail shadow-sm'/>
                                        @endif
                                     @else
                                     <img src="{{ asset('storage/'.Auth::user()->image)}}" alt="John Doe" class='img-thumbnail shadow-sm' />
                                     @endif

                                     <div class="form-group mt-3">
                                        <input type="file" name="image" id="" class="form-control @error('image') is-invalid @enderror">
                                        @error('image')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                     </div>

                                     <div class=" text-center">
                                        <button class="btn bg-dark text-white col-12"><i class="fa-solid fa-angles-up mr-2"></i>Update Profile</button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Name</label>
                                        <input id="cc-pament" name="name" value="{{ old('name',Auth::user()->name)}}" type="text" class="form-control  @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Name...">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Email</label>
                                        <input id="cc-pament" name="email" value="{{ old('email',Auth::user()->email)}}" type="email" class="form-control  @error('email') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Email...">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Phone</label>
                                        <input id="cc-pament" name="phone" value="{{ old('phone',Auth::user()->phone)}}" type="number" class="form-control  @error('phone') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Phone...">
                                        @error('phone')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Gender</label>
                                        <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                                            <option value="">Choose Gender ...</option>
                                            <option value="male" @if (Auth::user()->gender == 'male') selected @endif>Male</option>
                                            <option value="female" @if (Auth::user()->gender == 'female') selected @endif>Female</option>
                                        </select>
                                        @error('phone')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Address</label>
                                        <textarea name="address" id="" cols="30" rows="3" class="form-control" placeholder="Enter Address...">{{ Auth::user()->address }}</textarea>
                                        @error('address')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Role</label>
                                        <input id="cc-pament" name="role" value="{{ old('role',Auth::user()->role)}}" type="text" class="form-control  @error('role') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter role..." disabled>
                                        @error('role')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
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
