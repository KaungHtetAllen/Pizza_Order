@extends('user.layouts.master')

@section('title','Cart List Page')

@section('content')

<!-- Cart Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                <thead class="thead-dark">
                    <tr>
                        <th>Image</th>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th class="col-3">Total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach ($carts as $cart)
                    <tr>
                        <td class="align-middle"><img src="{{ asset('storage/'.$cart->pizza_image)}}" alt="" style="width: 100px;height:100px;object-fit:cover" class="img-thumbnail" ></td>
                        <td class="align-middle">{{ $cart->pizza_name}}</td>
                        <td class="align-middle" id="price">{{ $cart->pizza_price}} kyats</td>
                        <input type="hidden" value="{{ $cart->product_id}}" id="productId" name="productId">
                        <input type="hidden" value="{{ $cart->user_id}}" id="userId" name="userId">
                        <input type="hidden" value="{{ $cart->id}}" id="cartId" name="cartId">
                        <td class="align-middle">
                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-warning btn-minus" >
                                    <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control form-control-sm  border-0 text-center" value="{{ $cart->quantity}}" id="quantity">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-warning btn-plus">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle" id="total">{{ $cart->pizza_price * $cart->quantity}} kyats</td>
                        <td class="align-middle"><button class="btn btn-sm btn-danger btnRemove"><i class="fa fa-times"></i></button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class=" pr-3">Cart Summary</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Subtotal</h6>
                        <h6 id="totalPrice">{{ $totalPrice}} kyats</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Delivery Fee</h6>
                        <h6 class="font-weight-medium">3000 kyats</h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5 id="finalPrice">{{ $totalPrice + 3000}} kyats</h5>
                    </div>
                    <button class="btn btn-block btn-warning font-weight-bold mt-3 py-3" id="orderBtn">Proceed To Checkout</button>
                    <button class="btn btn-block btn-danger font-weight-bold mt-3 py-3" id="clearBtn">Clear Carts</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->

@endsection


@section('scriptSource')
<script src="{{ asset('js/cart.js')}}"></script>
<script>
    $(document).ready(function(){
        $('#orderBtn').click(function(){
            $orderList = [];
            $random = Math.floor(Math.random() * 1001);
            $time = Math.ceil(new Date().getTime()/$random);

            $('#dataTable tbody tr').each(function(index,row){
                $orderList.push({
                    'user_id':$(row).find('#userId').val(),
                    'product_id':$(row).find('#productId').val(),
                    'quantity':$(row).find('#quantity').val(),
                    'total':$(row).find('#total').text().replace('kyats',''),
                    'order_code': 'POS' + $time,
                });

            })
            console.log($orderList);

            $.ajax({
                'type':'get',
                'url':'http://127.0.0.1:8000/user/ajax/order/',
                'dataType':'json',
                'data':Object.assign({},$orderList),//For json format, we have to change the array to object.
                'success':function(response){
                    if(response.status == 'true'){
                        window.location.href = 'http://127.0.0.1:8000/user/homePage';
                    }
                }
            });


        });

        //remove all click
        $('#clearBtn').click(function(){
            $('#totalPrice').html('0 kyats');
            $('#finalPrice').html('3000 kyats');
            $('#dataTable tbody tr').remove();

            $.ajax({
                'type':'get',
                'url': 'http://127.0.0.1:8000/user/ajax/clearAll',
                'dataType':'json',
            })
        })

         //remove button click
         $('.btnRemove').click(function(){
            $parentNode = $(this).parents('tr');
            $cartId = $parentNode.find('#cartId').val();
            // $totalPrice = 0;

            $.ajax({
                'type':'get',
                'url': 'http://127.0.0.1:8000/user/ajax/clearCart',
                'dataType':'json',
                'data':{'cartId':$cartId}
            });
            
            $parentNode.remove();


            $totalPrice = 0;
            $('#dataTable tbody tr').each(function(index,row){
                $totalPrice += Number($(row).find('#total').text().replace('kyats',''));
            })

            $('#totalPrice').html(`${$totalPrice} kyats`);

            $finalPrice = $totalPrice +3000;
            $('#finalPrice').html(`${$finalPrice} kyats`);
        });


    })
</script>
@endsection
