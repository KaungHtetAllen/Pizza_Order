@extends('admin.layouts.master')

@section('title','Order List Page')

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
                            <h2 class="title-1">Order List</h2>

                        </div>
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



                {{-- <div class="row">
                    <div class="col-3">
                        <h4 class="text-secondary">Search Key : <span class="text-danger">{{ request('key')}}</span></h4>
                    </div> --}}
                    {{-- <div class="col-3 offset-6">
                        <form action="{{ route('order#list')}}" method="GET">
                            @csrf
                            <div class="d-flex">
                                <input type="text" name="key" id="" class="form-control" placeholder="Search ..." value="{{ request('key')}}">
                                <button class="btn bg-dark text-white" type="submit">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </form>
                    </div> --}}
                {{-- </div> --}}

                <div class="row my-5">
                    <div class="col-3">
                        <h3><i class="fa-solid fa-database mr-2" title="Total"></i>-{{ count($orders)}}</h3>
                    </div>

                    <div class="col-3 offset-6 d-flex">
                        <form action="{{ route('order#changeStatus')}}" method="get">
                            @csrf
                            <div class="input-group">
                                <select name="orderStatus" id="orderStatus"class="form-control" id="inputGroupSelect04" aria-label="Example select with button addon">
                                    <option class="" value="">All</option>
                                    <option class="text-warning" value="0" @if(request('orderStatus') == 0) selected @endif>Pending ...</option>
                                    <option class="text-success" value="1" @if(request('orderStatus') == 1) selected @endif>Success ...</option>
                                    <option class="text-danger" value="2" @if(request('orderStatus') == 2) selected @endif>Reject ...</option>
                                </select>

                                <button type="submit" class="btn btn-sm btn-dark ml-2">Search</button>
                            </div>
                        </form>
                    </div>

                </div>





                @if (count($orders) != 0)
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th class="col-2">User Id</th>
                                <th class="col-2">User Name</th>
                                <th class="col-2">Order Code</th>
                                <th class="col-2">Order Date</th>
                                <th class="col-2">Amount</th>
                                <th class="col-2">Status</th>
                            </tr>
                        </thead>
                        <tbody id="dataList">
                            @foreach ($orders as $order)
                            <tr class="tr-shadow" >
                                <input type="hidden" name="" class="orderId" value="{{ $order->id}}">
                                <td>{{ $order->user_id}}</td>
                                <td>{{ $order->user_name}}</td>
                                <td>
                                    <a href="{{ route('order#listInfo',$order->order_code)}}">
                                        {{ $order->order_code}}
                                    </a>
                                </td>
                                <td>{{ $order->created_at->format('d-M-Y')}}</td>
                                <td>{{ $order->total_price}} kyats</td>
                                <td >
                                    <select name="status"  class="form-control statusChange" >
                                        <option class="text-warning" value="0" @if($order->status == 0) selected @endif>Pending ...</option>
                                        <option class="text-success" value="1" @if($order->status == 1) selected @endif>Success ...</option>
                                        <option class="text-danger" value="2" @if($order->status == 2) selected @endif>Reject ...</option>
                                    </select>
                                </td>
                                {{-- <td>
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
                                    </div>
                                </td> --}}
                            </tr>
                            <tr class="spacer"></tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- <div class="mt-1">
                        {{ $orders->appends(request()->query())->links()}}
                    </div> --}}
                </div>
                @else
                <h3 class=" text-secondary text-center mt-5">There is no
                    @if (request('orderStatus') == 0)
                    <span class="text-warning">Pending</span>
                    @elseif(request('orderStatus') == 1)
                    <span class="text-success">Success</span>
                    @elseif(request('orderStatus') == 2)
                    <span class="text-danger">Reject</span>
                    @endif
                    Orders Here!</h3>
                @endif
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection


@section('scriptSource')
<script>
    $(document).ready(function(){
        $('#orderStatus').change(function(){
            $status = $('#orderStatus').val();
            // console.log($status);

            $.ajax({
                type:'get',
                url:'/order/ajax/status',
                dataType:'json',
                data:{
                    'status':$status
                },
                success:function(response){
                    $list = '';
                    for($i=0;$i<response.length;$i++){
                        $months = ['January','February','March','April','May','June','July','August','September','October','November','December'];

                        $dbDate = new Date(response[$i].created_at);
                        // console.log($dbDate.getMonth());
                        $date = $months[$dbDate.getMonth()] + '-' + $dbDate.getDate() + '-' + $dbDate.getFullYear();

                        $statusMessage = '';
                        if(response[$i].status == 0){
                            $statusMessage = `
                            <select name="status" id="" class="form-control">
                                <option class="text-warning" value="0" selected>Pending ...</option>
                                <option class="text-success" value="1">Success ...</option>
                                <option class="text-danger" value="2">Reject ...</option>
                            </select>`;
                        }
                        else if(response[$i].status == 1){
                            $statusMessage = `
                            <select name="status" id="" class="form-control">
                                <option class="text-warning" value="0">Pending ...</option>
                                <option class="text-success" value="1" selected>Success ...</option>
                                <option class="text-danger" value="2">Reject ...</option>
                            </select>`;
                        }
                        else if(response[$i].status == 2){
                            $statusMessage = `
                            <select name="status" id="" class="form-control">
                                <option class="text-warning" value="0">Pending ...</option>
                                <option class="text-success" value="1">Success ...</option>
                                <option class="text-danger" value="2" selected>Reject ...</option>
                            </select>`;
                        }

                        $list += `
                        <tr class="tr-shadow">
                            <td>${ response[$i].user_id}</td>
                            <td>${ response[$i].user_name} </td>
                            <td>${ response[$i].order_code} </td>
                            <td>${$date} </td>
                            <td>${response[$i].total_price}  kyats</td>
                            <td>
                                ${ $statusMessage }
                            </td>
                        </tr>
                        <tr class="spacer"></tr>`;

                    }
                    $('#dataList').html($list);
                }
            });
        })



        $('.statusChange').change(function(){
            // console.log('change');
            $currentStatus = $(this).val();
            $parentNode = $(this).parents('tr');
            $orderId = $parentNode.find('.orderId').val();
            console.log($currentStatus);

            $data = {
                'status':$currentStatus,
                'orderId':$orderId
            };

            $.ajax({
                type:'get',
                url:'/order/ajax/change/status',
                dataType:'json',
                data:$data
            })
        })
    })
</script>
@endsection
