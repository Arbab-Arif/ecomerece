<x-frontend.app>
    <x-slot name="title">
        Cart
    </x-slot>
    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Cart</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active">Cart</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Cart  -->
    <div class="cart-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @if(session()->has('cart') && count(session()->get('cart')) > 0)
                        <div class="table-main table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Images</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Remove</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $subTotal = 0;
                                @endphp
                                @foreach(session('cart') as $cart)
                                    @php
                                        $productTotal = $cart['price'] * $cart['qty'];
                                        $subTotal += $productTotal;
                                    @endphp
                                    <tr>
                                        <td class="thumbnail-img">
                                            <a href="#">
                                                <img class="img-fluid" src="{{ $cart['thumbnail'] }}" alt=""/>
                                            </a>
                                        </td>
                                        <td class="name-pr">
                                            <a href="#">
                                                {{ $cart['name'] }}
                                            </a>
                                        </td>
                                        <td class="price-pr">
                                            <p>${{ number_format($cart['price'], 2) }}</p>
                                        </td>
                                        <td class="quantity-box">
                                            <p>{{$cart['qty']}}</p>
                                        </td>
                                        <td class="total-pr">
                                            <p>${{ number_format($productTotal, 2) }}</p>
                                        </td>
                                        <td class="remove-pr">
                                            <a  href="{{ route('cart.remove', $cart['id']) }}"
                                                onclick="return confirm('Are you sure you want to remove this product?');">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info text-center">
                            Your cart is currently empty.
                        </div>
                    @endif
                </div>
            </div>
            @if(session()->has('cart') && count(session()->get('cart')) > 0)
                <form action="{{ route('checkout.create') }}" method="post">
                    @csrf
                    <div class="row my-5">
                        <div class="col-lg-8 col-sm-12">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="InputName" class="mb-0">Name</label>
                                    <input type="text" name="name" class="form-control" id="InputName" placeholder="Name"></div>
                                <div class="form-group col-md-6">
                                    <label for="InputEmail1" class="mb-0">Email Address</label>
                                    <input type="email" name="email" class="form-control" id="InputEmail1" placeholder="Enter Email">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-12">
                            <div class="order-box">
                                <h3>Order Summary</h3>
                                <div class="d-flex">
                                    <h4>Sub Total</h4>
                                    <div class="ml-auto font-weight-bold">${{ number_format($subTotal, 2) }}</div>
                                </div>
                                <div class="d-flex gr-total">
                                    <h5>Grand Total</h5>
                                    <div class="ml-auto h5">${{ number_format($subTotal, 2) }}</div>
                                </div>
                                <hr>
                            </div>
                        </div>
                        <div class="col-12 d-flex shopping-box">
                            <button type="submit" class="ml-auto btn hvr-hover">Checkout</button>
                        </div>
                    </div>
                </form>
            @endif
        </div>
    </div>
    <!-- End Cart -->
</x-frontend.app>
