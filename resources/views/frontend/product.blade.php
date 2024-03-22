<style>
    /* Custom CSS for fixed-height cards */
    .card {
        height: 100%;
        /* Make the card take 100% of its parent's height */
    }

    .card .card-img-top {
        height: 300px;
        /* Set the image height as needed */
        object-fit: cover;
        /* Cover the entire area of the image */
    }
</style>

{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.1.1/sweetalert2.min.css"> --}}
<section class="product_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Our <span>products</span>
            </h2>
        </div>


        {{-- search starts --}}
        <form action="{{ route('product.search') }}" method="GET">
            @csrf
            <input type="text" name="search" placeholder="Search for something..." />
            <button class="btn btn-danger">search</button>
        </form>
        {{-- search Ends --}}
        <div class="container mb-5">
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-md-4 mt-3">
                        <a href="{{ route('frontend_product.show', ['product' => $product->id]) }}">
                            <div class="card h-100">
                                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top"
                                    alt="{{ $product->name }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text">Price: ${{ $product->price }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="btn-box">
            <a href="">
                View All products
            </a>
        </div>
    </div>

    {{-- test --}}
    {{-- <div class="text-center">
        <p>Click on Submit Button</p>
        <button class="btn btn-success btn-lg">
            <i class="glyphicon glyphicon-save"></i>
            Submit !
        </button>
    </div> --}}
</section>

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/sweetalert2/6.1.1/sweetalert2.min.css"></script>
<script src="https://cdn.jsdelivr.net/sweetalert2/6.1.1/sweetalert2.min.js"></script>
<script>
    $('.btn').click(function() {
        swal({
            title: 'Awesome !',
            text: 'form submitted successfully !',
            type: 'success'
        });
    });
</script> --}}
