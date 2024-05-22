
@extends('user.layouts.master')

@section('title','Home Page')

@section('content')
 <!-- Shop Start -->
 <div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-4">
            <!-- Price Start -->
            <h5 class="section-title position-relative text-uppercase mb-3"><span class=" pr-3">Filter by price</span></h5>
            <div class="bg-light p-4 mb-30">
                <form>
                    <div class="d-flex align-items-center justify-content-between mb-3 bg-dark text-white px-3 py-1" style="font-weight: 700">
                        <label class="mt-2" for="price-all">Categories</label>
                        <span class="badge" style="font-size: 15px">{{ count($categories)}}</span>
                    </div>
                    <hr>
                    @foreach ($categories as $category)
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <label class="c" for="price-1">{{ $category->name }}</label>
                    </div>
                    @endforeach

                </form>
            </div>
            <!-- Price End -->

            <div class="">
                <button class="btn btn btn-warning w-100">Order</button>
            </div>
            <!-- Size End -->
        </div>
        <!-- Shop Sidebar End -->


        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-8">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                            <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                            <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
                        </div>
                        <div class="ml-2">
                            <div class="btn-group">
                                {{-- password change alert message --}}
                                @if (session('updateSuccess'))
                                <div class="col-12">
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong><i class="fa-solid fa-cloud-arrow-up mr-2"></i>{{ session('updateSuccess')}}</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                </div>
                                @endif
                            </div>
                            <div class="btn-group">
                                <select name="sorting" id="sortingOption" class="form-control" style="cursor: pointer">
                                    <option value="">Choose Option ...</option>
                                    <option value="asc">Ascending</option>
                                    <option value="desc">Descending</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="dataList" class="row">
                    @foreach ($pizzas as $pizza)
                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1"  id="myForm">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="{{ asset('storage/'.$pizza->image)}}" alt="" style="height:230px; object-fit:cover">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">{{ $pizza->name}}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>{{ $pizza->price}} kyats</h5>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
<!-- Shop End -->

@endsection

@section('scriptSource')
<script>
    $(document).ready(function(){
        $('#sortingOption').change(function(){
            $sortingStatus = $('#sortingOption').val();

            if($sortingStatus == 'asc'){
                $.ajax({
                    type:'get',
                    url:'ajax/pizzaList',
                    dataType:'json',
                    data:{'status':'asc'},
                    success:function(response){ //after controller, come success function
                        $list = '';
                        for($i=0;$i<response.length;$i++){
                            $list += `
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1"  id="myForm">
                                <div class="product-item bg-light mb-4">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100" src="{{ asset('storage/${response[$i].image}')}}" alt="" style="height:230px; object-fit:cover">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>${response[$i].price} kyats</h5>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center mb-1">
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                        </div>
                                    </div>
                                </div>
                            </div>`;

                            // console.log($list);
                        }
                        $('#dataList').html($list);
                    }
                })
            }
            else if($sortingStatus == 'desc'){
                $.ajax({
                    type:'get',
                    url:'ajax/pizzaList',
                    dataType:'json',
                    data:{'status':'desc'},
                    success:function(response){ //after controller, come success function
                        $list = '';
                        for($i=0;$i<response.length;$i++){
                            $list += `
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1"  id="myForm">
                                <div class="product-item bg-light mb-4">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100" src="{{ asset('storage/${response[$i].image}')}}" alt="" style="height:230px; object-fit:cover">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>${response[$i].price} kyats</h5>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center mb-1">
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                        </div>
                                    </div>
                                </div>
                            </div>`;

                            // console.log($list);
                        }
                        $('#dataList').html($list);
                    }
                })
            }
            else{

            }
        })
    })
</script>
@endsection
