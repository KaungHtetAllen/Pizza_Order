@extends('admin.layouts.master')

@section('title','User List Page')

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
                            <h2 class="title-1">User List</h2>

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
                        <form action="{{ route('admin#userList')}}" method="GET">
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
                        <h3><i class="fa-solid fa-database mr-2" title="Total"></i>- {{ $users->total()}} </h3> {{-- pagniate => total() --}}
                    </div>
                </div>

                @if (count($users) != 0)
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th class="col-2">Image</th>
                                <th> Name</th>
                                <th> Email</th>
                                <th> Gender</th>
                                <th> Phone</th>
                                <th> Address</th>
                                <th>Role</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr class="tr-shadow">
                                <input type="hidden" name="" id="userId" value="{{ $user->id}}">
                                <td>
                                    @if ($user->image == null)
                                        @if($user->gender == 'male')
                                            <img src="{{ asset('image/male_default_user.jpg')}}" alt="John Doe" class='img-thumbnail shadow-sm'/>
                                        @else
                                            <img src="{{ asset('image/female_default_user.jpg')}}" alt="John Doe" class='img-thumbnail shadow-sm'/>
                                        @endif
                                    @else
                                        <img src="{{ asset('storage/'.$user->image)}}" alt="John Doe" class='img-thumbnail shadow-sm' />
                                    @endif
                                </td>
                                <td>{{ $user->name}}</td>
                                <td>{{ $user->email}}</td>
                                <td>{{ $user->gender}}</td>
                                <td>{{ $user->phone}}</td>
                                <td>{{ $user->address}}</td>
                                <td>
                                    <select name="role" id="" class="form-control roleChange">
                                        <option value="user" @if($user->role == 'user') selected @endif>User</option>
                                        <option value="admin"  @if($user->role == 'admin') selected @endif>Admin</option>
                                    </select>
                                </td>
                                <td>
                                    <div class="table-data-feature">
                                        <a href="{{ route('admin#deleteUser',$user->id)}}">
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
                        {{ $users->appends(request()->query())->links()}}
                    </div>
                </div>
                @else
                <h3 class=" text-secondary text-center mt-5">There is no <span class="text-danger">{{ request('key')}} </span> User Here!</h3>
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



        $('.roleChange').change(function(){
            // console.log('change');
            $currentRole = $(this).val();
            $parentNode = $(this).parents('tr');
            $userId = $parentNode.find('#userId').val();
            // console.log($currentRole);

            $data = {
                'role':$currentRole,
                'userId':$userId
            };
            // console.log($data);

            $.ajax({
                type:'get',
                url:'/user/change/role',
                dataType:'json',
                data:$data,
                success:function(response){
                    window.location.href = 'http://127.0.0.1:8000/user/list';
                }
            })
        })
    })
</script>
@endsection
