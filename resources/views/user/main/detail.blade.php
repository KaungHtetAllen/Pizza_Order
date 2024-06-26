@extends('user.layouts.master')

@section('title','Product Detail Page')

@section('content')
<!-- Shop Detail Start -->
<div class="container-fluid pb-5">
    <div class="row px-xl-5">
        <div class="col-lg-5 mb-30">
            <a href="{{ route('user#home')}}" class="text-dark text-decoration-none">
                <h4><i class="fa-solid fa-arrow-left mr-2"></i>Back</h4>
            </a>
            <div id="product-carousel" class="carousel slide mt-3" data-ride="carousel">
                <div class="carousel-inner bg-light">
                    <div class="carousel-item active">
                        <img class="w-100 h-100" src="{{ asset('storage/'.$pizza->image)}}" alt="Image">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-7 h-auto mb-30">
            <div class="h-100 bg-light p-30">
                <h3>{{ $pizza->name}}</h3>
                <div class="d-flex mb-3">
                    <h6 class="pt-1">{{ $pizza->view_count +1}} <i class="fa-solid fa-eye"></i></h6>
                </div>
                <h3 class="font-weight-semi-bold mb-4">{{ $pizza->price}} kyats</h3>
                <p class="mb-4">{{ $pizza->description}}</p>
                <div class="d-flex align-items-center mb-4 pt-2">
                    <div class="input-group quantity mr-3" style="width: 130px;">
                        <div class="input-group-btn">
                            <button class="btn btn-warning btn-minus">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control border-0 text-center" value="1" id="orderCount">
                        <div class="input-group-btn">
                            <button class="btn btn-warning btn-plus">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>

                    <input type="text" class="form-control bg-secondary border-0 text-center" value="{{ Auth::user()->id}}" id="userId" hidden>
                    <input type="text" class="form-control bg-secondary border-0 text-center" value="{{ $pizza->id}}" id="pizzaId" hidden>
                    <button type="btn" class="btn btn-warning px-3" id="addCartBtn"><i class="fa fa-shopping-cart mr-1"></i> Add To
                        Cart</button>
                </div>
                <div class="d-flex pt-2">
                    <strong class="text-dark mr-2">Share on:</strong>
                    <div class="d-inline-flex">
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-pinterest"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Shop Detail End -->


<!-- Products Start -->
<div class="container-fluid py-5">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="pr-3">You May Also Like</span></h2>
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel related-carousel">
                @foreach ($pizzaList as $p)
                <div class="product-item bg-light">
                    <div class="product-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="{{ asset('storage/'.$p->image)}}" alt="" style="height:300px;object-fit:cover">
                        <div class="product-action">
                            <a class="btn btn-outline-dark btn-square" href="{{ route('pizza#details',$p->id)}}"><i class="fa fa-info-circle"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate" href="">{{ $p->name}}</a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5>{{ $p->price}} kyats</h5>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- Products End -->



@endsection

@section('scriptSource')
<script>
    $(document).ready(function(){

        //increase view count
        $.ajax({
        type:'get',
        url:'/user/ajax/increase/viewcount',
        dataType:'json',
        data: {'productId':$('#pizzaId').val()}
    })

    //click add to cart btn
        $('#addCartBtn').click(function(){
            // alert($('#orderCount').val());

            $count = $('#orderCount').val();
            $userId = $('#userId').val();
            $pizzaId = $('#pizzaId').val();

            // alert($userId);
            $source = {
                'userId' : $userId,
                'pizzaId' : $pizzaId,
                'count': $count,
            };

            // alert($source);

            $.ajax({
                type:'get',
                url:'/user/ajax/addToCart',
                dataType:'json',
                data: $source,
                success : function(response){
                    if(response.status == 'success'){
                        window.location.href = 'http://127.0.0.1:8000/user/homePage';
                    }
                }
            })
        })
    })

</script>
@endsection
