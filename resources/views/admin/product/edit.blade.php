@extends('admin.layouts.master')

@section('title','Product Edit Page')

@section('content')
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-1">
                    <button class="btn bg-dark text-white my-3 ml-3" onclick="history.back()"><i class="fa-solid fa-arrow-left mr-2"></i>back</button>
                </div>
            </div>
            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Edit Product </h3>
                        </div>
                        <hr>
                        <form action="{{ route('product#update')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-4 offset-1">
                                    <input type="hidden" name="pizzaId" value="{{ $pizza->id }}">
                                     <img src="{{ asset('storage/'.$pizza->image)}}" alt="John Doe" class='img-thumbnail shadow-sm' />

                                     <div class="form-group mt-3">
                                        <input type="file" name="pizzaImage" id="" class="form-control @error('pizzaImage') is-invalid @enderror">
                                        @error('pizzaImage')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                     </div>

                                     <div class=" text-center">
                                        <button class="btn bg-dark text-white col-12"><i class="fa-solid fa-angles-up mr-2"></i>Update Product</button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Name</label>
                                        <input id="cc-pament" name="pizzaName" value="{{ old('pizzaName',$pizza->name)}}" type="text" class="form-control  @error('pizzaName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Name...">
                                        @error('pizzaName')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Description</label>
                                        <textarea name="pizzaDescription" id="" cols="30" rows="5" class="form-control  @error('pizzaDescription') is-invalid @enderror" placeholder="Enter Description...">{{ $pizza->description }}</textarea>
                                        @error('pizzaDescription')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Price</label>
                                        <input id="cc-pament" name="pizzaPrice" value="{{ old('pizzaPrice',$pizza->price)}}" type="number" class="form-control  @error('pizzaPrice') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Price...">
                                        @error('pizzaPrice')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                                        <input id="cc-pament" name="pizzaWaitingTime" value="{{ old('pizzaWaitingTime',$pizza->waiting_time)}}" type="number" class="form-control  @error('pizzaWaitingTime') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Waiting Time...">
                                        @error('pizzaWaitingTime')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Category</label>
                                        <select name="pizzaCategory" class="form-control @error('pizzaCategory') is-invalid @enderror">
                                            <option value="">Choose Category ...</option>
                                            @foreach ($categories as $category)
                                            <option value="{{ $category->id}}" @if($pizza->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('pizzaCategory')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">View Count</label>
                                        <input id="cc-pament" name="viewCount" value="{{ old('viewCount',$pizza->view_count)}}" type="text" class="form-control" aria-required="true" aria-invalid="false" placeholder="Enter viewCount..." disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Created Date</label>
                                        <input id="cc-pament" name="createdAt" value="{{ old('createdAt',$pizza->created_at->format('d-M-Y'))}}" type="text" class="form-control" aria-required="true" aria-invalid="false" placeholder="Enter createdAt..." disabled>
                                    </div>

                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection
