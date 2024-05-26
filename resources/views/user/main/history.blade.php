@extends('user.layouts.master')

@section('title','History List Page')

@section('content')

<!-- Cart Start -->
<div class="container-fluid" style="height:300px">
    <div class="row px-xl-5">
        <div class="col-lg-8 offset-2 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                <thead class="thead-dark">
                    <tr>
                        <th>Date</th>
                        <th>Order ID</th>
                        <th>Total Price</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->created_at->format('d-M-Y')}}</td>
                        <td>{{ $order->order_code }}</td>
                        <td>{{ $order->total_price }} kyats</td>
                        <td>
                            @if ($order->status == 0)
                            <span class="text-warning"><i class="fa-solid fa-hourglass-half mr-2"></i>Pending ...</span>
                            @elseif($order->status == 1)
                            <span class="text-success"><i class="fa-solid fa-circle-check mr-2"></i>Success ...</span>
                            @elseif($order->status == 2)
                            <span class="text-danger"><i class="fa-solid fa-triangle-exclamation mr-2"></i>Reject ...</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-3">
                {{ $orders->links()}}
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->

@endsection

{{--
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



    })
</script>
@endsection --}}
