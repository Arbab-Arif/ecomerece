<div class="products-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="title-all text-center">
                    <h1>Products</h1>
                </div>
            </div>
        </div>
        <div class="row col-md-12 mb-4">
            <input type="text" wire:model.live.debounce="search" class="form-control" placeholder="search">
        </div>
        <div class="row special-list">
            @forelse($products as $product)
                <div class="col-lg-3 col-md-6 special-grid best-seller">
                    <div class="products-single fix">
                        <div class="box-img-hover">
                            <div class="type-lb">
                                <p class="sale">Sale</p>
                            </div>
                            <img src="{{$product->getImagePath('thumbnail')}}" class="img-fluid" alt="Image">
{{--                            <div class="mask-icon">--}}
{{--                                <a class="cart" href="#">Add to Cart</a>--}}
{{--                            </div>--}}
                        </div>
                        <div class="why-text">
                            <a href="{{route('product.detail',$product->slug)}}">
                                <h4>{{$product->name}}</h4>
                                <h5> $ {{number_format($product->price,2)}}</h5>
                            </a>

                        </div>
                    </div>
                </div>
            @empty
                <h5>product not found</h5>
            @endforelse

        </div>
    </div>
</div>
