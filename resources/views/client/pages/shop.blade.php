@extends('client.layouts.client')
@section('content-title', 'Trang sản phẩm')
@section('content')
    <section class="shop spad">
        <section class="breadcrumb-option">
            <div class="container">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb__text">
                            <h4>Shop</h4>
                            <div class="breadcrumb__links">
                                <a href="{{ asset('/') }}">Home</a>
                                <a href="{{ asset('/shop') }}">Shop</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="shop__sidebar">
                        <div class="shop__sidebar__search">
                            <form action="{{ route('searchProduct') }}">
                                @csrf
                                <input type="text" width="400px" name="name" placeholder="Tìm kiếm"
                                    class="form-control">
                                <button type="submit"><span class="icon_search"></span></button>
                            </form>
                        </div>
                        <div class="shop__sidebar__accordion">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseOne">Categories</a>
                                    </div>
                                    <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__categories">

                                                @foreach ($categories as $category)
                                                    <li>
                                                        <a
                                                            href="{{ route('categoryProducts', $category->id) }}">{{ $category->category_name }}</a>
                                                    </li>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="shop__product__option">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__left">
                                    <p>Showing 1–12 of 126 results</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__right">
                                    <p>Sort by Price:</p>
                                    <select>
                                        <option value="">Low To High</option>
                                        <option value="">$0 - $55</option>
                                        <option value="">$55 - $100</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($products as $product)
                            <div class="col-lg-4 col-md-6">
                                <div class="single-product">
                                    <div class="product-img">
                                        {{-- <img class="card-img" src="{{ asset($product->image) }}"
                                            style="width: 254px; height: 254px;" alt="" /> --}}
                                        <img src=" {{ Storage::url($product->image) }}"
                                            style="width: 254px; height: 254px;" />
                                        <div class="p_icon">
                                            <a href=" {{ route('productDetail', $product->id) }}">

                                                <i class="ti-eye"></i>
                                            </a>
                                            <a href="#">
                                                <i class="ti-heart"></i>
                                            </a>
                                            <a href=" {{ route('cart.addCart', $product->id) }}">


                                                <i class="ti-shopping-cart"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="product-btm">
                                        <a href="   {{ route('productDetail', $product->id) }}" class="d-block">

                                            <h4>{{ $product->product_name }}</h4>
                                        </a>
                                        <div class="mt-3">
                                            <span class="mr-4" style=" color:red">{{ $product->buying_price }}
                                                <sup>đ</sup></span>
                                            <del>{{ $product->selling_price }} <sup>đ</sup></del>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                    <div>
                        {{ $products->links() }}
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
