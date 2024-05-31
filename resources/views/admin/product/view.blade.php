@extends('admin.layouts.master')

@section('title','Product Detail Page')

@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-1">
                    <button class="btn bg-dark text-white my-3 ml-3" onclick="history.back()"><i class="fa-solid fa-arrow-left mr-2"></i>back</button>
                    {{-- <a href="{{ route('product#list')}}"><button class="btn bg-dark text-white my-3 ml-3"><i class="fa-solid fa-arrow-left mr-2"></i>back</button></a> --}}
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
                            <h3 class="text-center title-2">Product Details</h3>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-5">
                                <img src="{{ asset('storage/'.$pizza->image)}}" alt="John Doe" class='img-thumbnail shadow-sm' />
                            </div>
                            <div class="col-7">
                                <span class="my-3 btn bg-danger text-white" title="name"><i class="fa-solid fa-pizza-slice mr-2"></i>{{ $pizza->name}}</span>
                                <span class="my-3 btn bg-dark text-white" title="price"><i class="fa-solid fa-money-bill-wave mr-2"></i>{{ $pizza->price}} kyats</span>
                                <span class="my-3 btn bg-dark text-white" title="waiting time"><i class="fa-solid fa-hourglass-half mr-2"></i>{{ $pizza->waiting_time}} minutes</span>
                                <span class="my-3 btn bg-dark text-white" title="category"><i class="fa-solid fa-layer-group mr-2"></i>{{ $pizza->category_name}} </span>
                                <span class="my-3 btn bg-dark text-white" title="view count"><i class="fa-solid fa-eye mr-2"></i>{{ $pizza->view_count}}</span>
                                <span class="my-3 btn btn-dark text-white" title="Created Date"><i class="fa-regular fa-calendar-check mr-2"></i>{{ $pizza->created_at->format('d-M-Y')}}</span>
                                <div class="p-3 border rounded">
                                    <h4 class="my-3"><i class="fa-solid fa-file-lines mr-2" title="description"></i>Description</h4>
                                    <small>{{ $pizza->description}}</small>
                                </div>
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
