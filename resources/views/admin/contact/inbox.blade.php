@extends('admin.layouts.master')

@section('title','Inbox Page')

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
                            <h2 class="title-1">Message Inbox</h2>

                        </div>
                    </div>
                </div>

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

                <div class="row">
                    <div class="col-3">
                        <h4 class="text-secondary">Search Key : <span class="text-danger">{{ request('key')}}</span></h4>
                    </div>
                    <div class="col-3 offset-6">
                        <form action="{{ route('admin#messageInbox')}}" method="GET">
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

                <div class="row my-2">
                    <div class="col-3">
                        <h3><i class="fa-solid fa-database mr-2" title="Total"></i>-{{ $contacts->total()}}</h3>
                    </div>

                </div>

                @if (count($contacts) != 0)
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th class="col-2">Customer Name</th>
                                <th class="col-2">Customer Email</th>
                                <th class="col-2">Date</th>
                                <th class="col">Message</th>
                                <th class="col-2"></th>
                            </tr>
                        </thead>
                        <tbody id="dataList">
                            @foreach ($contacts as $contact)
                            <tr class="tr-shadow" >
                                <input type="hidden" name="" class="orderId" value="">
                                <td>{{ $contact->name}}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->created_at->format('d-M-Y')}}</td>
                                <td style="text-align: center"><small>{{ $contact->message}}</small></td>
                                <td>
                                    <div class="table-data-feature">
                                        <a href="{{ route('admin#messageDelete',$contact->id)}}">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr class="spacer"></tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-1">
                        {{ $contacts->appends(request()->query())->links()}}
                    </div>
                </div>
                @else
                <h3 class=" text-secondary text-center mt-5">There is no  <span class="text-danger">{{ request('key')}}</span> message! </h3>
                @endif
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection
