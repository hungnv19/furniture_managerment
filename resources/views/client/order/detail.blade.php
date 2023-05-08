@extends('client.layouts.client')
@section('content')
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Order Detail</h4>
                        <div class="breadcrumb__links">
                            <a href="/">Home</a>
                            <a href="/shop">Order Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <br>
    <section class="content">
        <div class="container-fluid" id="container-wrapper">


            <div class="row mb-3">
                <!-- Table 1 -->
                <div class="col-xl-6 col-lg-6">
                    <div class="card mb-4">
                        <div
                            class="
                      card-header
                      py-3
                      d-flex
                      flex-row
                      align-items-center
                      justify-content-between
                    ">
                            <h5 class="m-0 font-weight-bold text-primary">
                                Dashboard
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <b> Name : </b>
                                        {{ $orders->name }}
                                    </li>
                                    <li class="list-group-item">
                                        <b> Phone : </b> {{ $orders->phone }}
                                    </li>
                                    <li class="list-group-item">
                                        <b> Address : </b> {{ $orders->address }}
                                    </li>
                                    <li class="list-group-item">
                                        <b> Date : </b> {{ $orders->order_date }}
                                    </li>
                                    <li class="list-group-item">
                                        <b> Pay Through : </b> {{ $orders->payBy }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-6 col-lg-6">
                    <div class="card mb-4">
                        <div
                            class="
                      card-header
                      py-3
                      d-flex
                      flex-row
                      align-items-center
                      justify-content-between
                    ">
                            <h5 class="m-0 font-weight-bold text-primary">
                                Dashboard
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <b>Sub Total :
                                        </b> {{ $orders->sub_total }}
                                    </li>
                                    <li class="list-group-item">
                                        <b>Vat : </b> {{ $orders->vat }} %
                                    </li>
                                    <li class="list-group-item">
                                        <b>Total :
                                        </b>{{ $orders->total }}
                                    </li>
                                    <li class="list-group-item">
                                        <b>Pay Amount :
                                        </b>{{ $orders->pay }}
                                    </li>
                                    <li class="list-group-item">
                                        <b>Due Amount :
                                        </b>{{ $orders->due }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <!-- Table 3 -->
                <div class="col-xl-12 col-lg-12">
                    <div class="card mb-4">
                        <div
                            class="
                      card-header
                      py-3
                      d-flex
                      flex-row
                      align-items-center
                      justify-content-between
                    ">
                            <h5 class="m-0 font-weight-bold text-primary">
                                Ordered Products
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>
                                                Product Name
                                            </th>
                                            <th>Code</th>
                                            <th>
                                                Image
                                            </th>
                                            <th>Quantity</th>
                                            <th>Unit_price</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($details as $detail)
                                            <tr>
                                                <td>
                                                    {{ $detail->product_name }}
                                                </td>
                                                <td>
                                                    {{ $detail->product_code }}
                                                </td>
                                                <td>
                                                    <img src=" {{ Storage::url($detail->image) }}" style="width: 50px;" />
                                                </td>
                                                <td>
                                                    {{ $detail->product_quantity }}
                                                </td>
                                                <td>
                                                    {{ number_format($detail->product_price) . ' Đ' }}
                                                </td>
                                                <td>
                                                    {{ number_format($detail->sub_total) . ' Đ' }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Row-->
        </div>
    </section>
@endsection
