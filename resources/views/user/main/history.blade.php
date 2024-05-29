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
