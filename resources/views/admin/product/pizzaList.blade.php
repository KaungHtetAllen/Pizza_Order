@extends('admin.layouts.master')

@section('title','Product List Page')

@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Product List</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{ route('product#createPage')}}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>Add Pizza
                            </button>
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>
                    </div>
                </div>
                {{-- insert alert message --}}
                @if (session('createSuccess'))
                <div class="col-4 offset-8">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><i class="fa-solid fa-check mr-2"></i>{{ session('createSuccess')}}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                </div>
                @endif

                {{-- delete alert message --}}
                @if (session('deleteSuccess'))
                <div class="col-4 offset-8">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><i class="fa-solid fa-circle-xmark mr-2"></i>{{ session('deleteSuccess')}}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                </div>
                @endif

                {{-- update alert message --}}
                @if (session('updateSuccess'))
                <div class="col-4 offset-8">
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <strong><i class="fa-solid fa-circle-up mr-2"></i>{{ session('updateSuccess')}}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                </div>
                @endif



                <div class="row">
                    <div class="col-3">
                        <h4 class="text-secondary">Search Key : <span class="text-danger">{{ request('key')}}</span></h4>
                    </div>
                    <div class="col-3 offset-6">
                        <form action="{{ route('product#list')}}" method="GET">
                            @csrf
                            <div class="d-flex">
                                <input type="text" name="key" id="" class="form-control" placeholder="Search ..." value="{{ request('key')}}">
                                <button class="btn bg-dark text-white" type="submit">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col-5">
                        <h3><i class="fa-solid fa-database mr-2" title="Total"></i>-{{ $pizzas->total()}}</h3>
                    </div>
                </div>

                @if (count($pizzas) != 0)
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th class="col-2">Image</th>
                                <th class="col-2">Name</th>
                                <th class="col-2">Price</th>
                                <th class="col-2">Category</th>
                                <th class="col-2">View COunt</th>
                                <th class="col-2"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pizzas as $pizza)
                            <tr class="tr-shadow">
                                <td><img src="{{ asset('storage/'.$pizza->image)}}" class="img-thumbnail shadow-sm"></td>
                                <td>{{ $pizza->name}}</td>
                                <td>{{ $pizza->price}}</td>
                                <td>{{ $pizza->category_id}}</td>
                                <td><i class="fa-solid fa-eye mr-2"></i>{{ $pizza->view_count}}</td>
                                <td>
                                    <div class="table-data-feature">
                                        <a href="{{ route('product#view',$pizza->id)}}">
                                            <button class="item mr-2" data-toggle="tooltip" data-placement="top" title="View">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                        </a>
                                        <a href="{{ route('product#edit',$pizza->id)}}">
                                            <button class="item mr-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                        </a>
                                        <a href="{{ route('product#delete',$pizza->id)}}">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                        </a>
                                        {{-- <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                            <i class="zmdi zmdi-more"></i>
                                        </button> --}}
                                    </div>
                                </td>
                            </tr>
                            <tr class="spacer"></tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-1">
                        {{ $pizzas->links()}}
                    </div>
                </div>
                @else
                <h3 class=" text-secondary text-center mt-5">There is no <span class="text-danger">{{ request('key')}} </span>Pizzas Here!</h3>
                @endif
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection
