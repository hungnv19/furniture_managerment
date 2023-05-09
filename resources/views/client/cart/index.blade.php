@extends('client.layouts.client')
@section('content')
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shopping Cart</h4>
                        <div class="breadcrumb__links">
                            <a href="/">Home</a>
                            <a href="/shop">Shop</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Main content -->

    <section class="content">

        <cart-list
            :data="{{ json_encode([
                'pos' => $pos,
                'extra' => $extra,
                'urlStore' => route('cart.orders'),
            ]) }}">
        </cart-list>

    </section>
@endsection
