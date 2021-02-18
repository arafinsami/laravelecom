@extends('layouts.frontend_layouts')

@section('content')


    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @if (session('cart_delete'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session('cart_delete') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (session('cart_update'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('cart_update') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($carts as $cart)
                                    <tr>
                                        <td class="shoping__cart__item">
                                            <img src="{{ asset($cart->getProduct->imageOne) }}"
                                                style="width:100px;height:100px" alt="">
                                            <h5>{{ $cart->getProduct->productName }}</h5>
                                        </td>
                                        <td class="shoping__cart__price">
                                            ${{ $cart->price }}
                                        </td>
                                        <td class="shoping__cart__quantity">
                                            <div class="quantity">
                                                <form action="{{ url('cart/quantity/update/'. $cart->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="pro-qty">
                                                        <input type="text" name="qty" value="{{ $cart->qty }}" min="1">
                                                    </div>
                                                    <button type="submit" class="btn btn-sm btn-success"><i
                                                            class="fa fa-refresh"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                        <td class="shoping__cart__total">
                                            ${{ $cart->price * $cart->qty }}
                                        </td>
                                        <td class="shoping__cart__item__close">
                                            <a href="{{ url('cart/destroy/' . $cart->id) }}"><span class="icon_close">
                                                </span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="{{ url('/') }}" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Discount Codes</h5>
                            <form action="#">
                                <input type="text" placeholder="Enter your coupon code">
                                <button type="submit" class="site-btn">APPLY COUPON</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            <li>Subtotal <span>$454.98</span></li>
                            <li>Total <span>$454.98</span></li>
                        </ul>
                        <a href="#" class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->

@endsection
