@extends('admin.layouts.master')

@section('title','Order Product List Page')

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
                            <h2 class="title-1">Order Product List</h2>
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


                <div class="table-responsive table-responsive-data2">
                    <a href="{{ route('order#list')}}" class="mb-3">
                        <button class="btn btn-dark"><i class="fa-solid fa-arrow-left mr-2"></i> Back</button>
                    </a>

                    <div class="row">
                        <div class="col-6">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h3><i class="fa-solid fa-clipboard mr-2"></i>OrderInfo</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row my-2">
                                        <div class="col" style="font-weight: 700"><i class="fa-solid fa-user mr-2"></i>Customer Name</div>
                                        <div class="col text-danger" style="text-transform: uppercase; font-weight:600">{{ $orderList[0]->user_name}}</div>
                                    </div>
                                    <div class="row my-2">
                                        <div class="col" style="font-weight: 700"><i class="fa-solid fa-barcode mr-2"></i>Order Code</div>
                                        <div class="col text-danger" style="font-weight: 600">{{ $orderList[0]->order_code}}</div>
                                    </div>
                                    <div class="row my-2">
                                        <div class="col" style="font-weight: 700"><i class="fa-solid fa-calendar-days mr-2"></i>Order Date</div>
                                        <div class="col text-danger" style="font-weight: 600">{{ $orderList[0]->created_at->format('d-M-Y ( H:i )')}}</div>
                                    </div>
                                    <div class="row my-2">
                                        <div class="col" style="font-weight: 700"><i class="fa-solid fa-money-check-dollar mr-2"></i>Total Price</div>
                                        <div class="col text-danger" style="font-weight: 600">{{ $order->total_price }} kyats <br><span class="text-warning"><i class="fa-solid fa-circle-info mr-2"></i>including delivery fee 3000 kyats</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th class="col-auto">Order ID</th>
                                <th class="col-auto">Product Name</th>
                                <th class="col-2">Product Image</th>
                                <th class="col-auto">Price</th>
                                <th class="col-auto">Quantity</th>
                                <th class="col-auto">Amount</th>
                            </tr>
                        </thead>
                        <tbody id="dataList">
                            @foreach ($orderList as $o)
                            <tr class="tr-shadow" >
                                <input type="hidden" name="" class="orderId" value="{{ $o->id}}">
                                <td>{{ $o->id }}</td>
                                <td>{{ $o->product_name}}</td>
                                <td>
                                    <img src="{{ asset('storage/'.$o->product_image)}}" alt="" class="img-thumbnail">
                                </td>
                                <td>{{ $o->product_price}} kyats</td>
                                <td>{{ $o->quantity}}</td>
                                <td>{{ $o->total}} kyats</td>
                            </tr>
                            <tr class="spacer"></tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection

