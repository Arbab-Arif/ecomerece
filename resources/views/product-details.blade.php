<x-frontend.app>
    <x-slot name="title">
        Product Details
    </x-slot>
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Shop Detail</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Product Detail</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Shop Detail  -->
    <div class="shop-detail-box-main">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-5 col-md-6">

                    <div id="carousel-example-1" class="single-product-slider carousel slide" data-ride="carousel">

                        <div class="carousel-inner" role="listbox">
                            @forelse($product->productGallery as $index => $gallery)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <img class="d-block w-100" src="{{ $gallery->getImagePath('image') }}"
                                         alt="Product image">
                                </div>
                            @empty
                                <div class="carousel-item active">
                                    <img class="d-block w-100" src="path_to_default_image.jpg"
                                         alt="No images available">
                                </div>
                            @endforelse
                        </div>
                        <ol class="carousel-indicators">
                            @foreach($product->productGallery as $index => $gallery)
                                <li data-target="#carousel-example-1" data-slide-to="{{ $index }}"
                                    class="{{ $index === 0 ? 'active' : '' }}">
                                    <img class="d-block w-100 img-fluid" src="{{ $gallery->getImagePath('image') }}"
                                         alt="Thumbnail {{ $index + 1 }}">
                                </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-7 col-md-6">
                    <div class="single-product-details">
                        <h2>{{$product->name}}</h2>
                        <h5>
                            ${{number_format($product->price,2)}}
                        </h5>
                        <p class="available-stock"><span> More than {{$product->qty}} available  <a href="#"></a></span>
                        <p>
                        <h4>Description:</h4>
                        <p>{!! $product->description !!} </p>
                        <ul>
                            <li>
                                <div class="form-group quantity-box">
                                    <label class="control-label">Quantity</label>
                                    <input class="form-control" value="0" min="0" max="20" type="number">
                                </div>
                            </li>
                        </ul>

                        <div class="price-box-bar">
                            <div class="cart-and-bay-btn">
                                <a class="btn hvr-hover" data-fancybox-close="" href="#">Add to cart</a>
                            </div>
                        </div>


                    </div>
                </div>
            </div>


        </div>
    </div>
    <!-- End Cart -->
    <x-slot name="scripts">
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const addToCartBtn = document.querySelector('.btn.hvr-hover');

                addToCartBtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    const productId = {{ $product->id }};
                    const quantity = document.querySelector('.quantity-box input').value;

                    // Check if quantity is valid
                    if (quantity <= 0) {
                        alert('Please select a valid quantity.');
                        return;
                    }

                    // Send data to the server via Axios
                    axios.post('{{ route("cart.add") }}', {
                        product_id: productId,
                        quantity: quantity
                    }, {
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                        .then(response => {
                            const data = response.data;
                            if (data.success) {
                                alert('Product added to cart successfully!');
                            } else {
                                alert('Error: ' + data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error.response);
                            alert('Failed to add product to cart. Please try again.');
                        });
                });
            });
        </script>

    </x-slot>
</x-frontend.app>
