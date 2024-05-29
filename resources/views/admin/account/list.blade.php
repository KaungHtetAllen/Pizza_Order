@extends('admin.layouts.master')

@section('title','Admin List Page')

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
                            <h2 class="title-1">Admin List</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{ route('category#createPage')}}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>Add Category
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

                {{-- change role message --}}
                @if (session('changeSuccess'))
                <div class="col-4 offset-8">
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <strong><i class="fa-solid fa-circle-up mr-2"></i>{{ session('changeSuccess')}}</strong>
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
                        <form action="" method="GET">
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
                        <h3><i class="fa-solid fa-database mr-2" title="Total"></i>- {{ $admins->total()}} </h3> {{-- pagniate => total() --}}
                    </div>
                </div>

                @if (count($admins) != 0)
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
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $admin)
                            <tr class="tr-shadow">
                                <input type="hidden" value="{{ $admin->id}}" id="adminId">
                                <td>
                                    @if ($admin->image == null)
                                        @if($admin->gender == 'male')
                                            <img src="{{ asset('image/male_default_user.jpg')}}" alt="John Doe" class='img-thumbnail shadow-sm'/>
                                        @else
                                            <img src="{{ asset('image/female_default_user.jpg')}}" alt="John Doe" class='img-thumbnail shadow-sm'/>
                                        @endif
                                    @else
                                        <img src="{{ asset('storage/'.$admin->image)}}" alt="John Doe" class='img-thumbnail shadow-sm' />
                                    @endif
                                </td>
                                <td>{{ $admin->name}}</td>
                                <td>{{ $admin->email}}</td>
                                <td>{{ $admin->gender}}</td>
                                <td>{{ $admin->phone}}</td>
                                <td>{{ $admin->address}}</td>
                                <td>
                                    <div class="table-data-feature">
                                        @if(Auth::user()->id != $admin->id)
                                        <a href="{{ route('admin#delete',$admin->id)}}">
                                            <button class="item mr-2" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                        </a>
                                        <a href="{{ route('admin#changeRole',$admin->id)}}">
                                            <button class="item mr-2" data-toggle="tooltip" data-placement="top" title="Role Change">
                                                <i class="fa-solid fa-people-arrows"></i>
                                            </button>
                                        </a>
                                        <form action="" id="roleData">
                                            @csrf
                                            <select name="role" id="role" class="form-control roleChange">
                                                <option value="admin" @if($admin->role == 'admin') selected @endif>Admin</option>
                                                <option value="user" @if($admin->role == 'user') selected @endif>User</option>
                                            </select>
                                        </form>

                                        @endif
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
                        {{ $admins->links()}}
                    </div>
                </div>
                @else
                <h3 class=" text-secondary text-center mt-5">There is no <span class="text-danger">{{ request('key')}} </span> Admin Here!</h3>
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
        $('.roleChange').change(function(){
            $currentRole = $(this).val();
            $currentId = $('#adminId').val();
            // console.log($currentRole,$currentId);
            $data = {
                'currentRole':$currentRole,
                'adminId':$currentId
            };

            $.ajax({
                type:'get',
                url:'http://127.0.0.1:8000/admin/ajax/change/role',
                dataType:'json',
                data:$data
            })

            window.location.href = 'http://127.0.0.1:8000/admin/list';

        })
    })
</script>
@endsection
