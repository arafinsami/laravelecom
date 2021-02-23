@extends('layouts.frontend_layouts')

@section('content')


    <!-- wishlist section begin -->
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
                                    <th>Cart</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($wishlists as $wishlist)
                                    <tr>
                                        <td class="shoping__cart__item">
                                            <img src="{{ asset($wishlist->getProduct->imageOne) }}"
                                                style="height: 70px; width:70px;" alt="">
                                            <h5>{{ $wishlist->getProduct->productName }}</h5>
                                        </td>
                                        <td class="shoping__cart__price">
                                            ${{ $wishlist->getProduct->price }}
                                        </td>

                                        <td class="shoping__cart__price">
                                            <form action="{{ url('add/to-cart/' . $wishlist->productId) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="price"
                                                    value="{{ $wishlist->getProduct->price }}">
                                                <button class="btn btn-sm btn-danger">Add To Cart</button>
                                            </form>
                                        </td>

                                        <td class="shoping__cart__item__close">
                                            <a href="{{ url('wishlist/delete/' . $wishlist->id) }}"> <span
                                                    class="icon_close">
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
        </div>
    </section>
    <!-- wishlist section End -->

@endsection
