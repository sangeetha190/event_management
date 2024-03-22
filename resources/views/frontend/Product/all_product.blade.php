@extends('frontend.layouts.index')
@section('content')
    {{-- <!-- product section -->
    @include('frontend.product')
    <!-- end product section --> --}}
    {{-- Product starts --}}
    <section class="product_section layout_padding">
        <div class="container">
            {{-- search starts --}}
            <form action="{{ route('search.product') }}" method="GET">
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
    </section>
    {{-- Product Ends --}}
    {{-- Comment Starts --}}
    <div class="container">
        <x-alert />
        <h3 class="text-center">Comments</h3>
        <div class="text-center" id="commentSection">
            <form action="{{ route('add_comment.post') }}" method="POST">
                @csrf
                <textarea name="comment" class="mb-1" placeholder="Comment something here"
                    style="width:600px;min-height:50px !important"></textarea>
                <div class="mt-0">
                    <button type="submit" class="btn btn-primary">Comment</button>
                </div>
            </form>
        </div>


        <div>
            <h5>All comments</h5>
            @foreach ($comments as $comment)
                <div class="mt-3">
                    <p class="mb-0"><b>{{ $comment->name }}</b></p>
                    <p class="mb-0 text-muted">{{ $comment->comment }}</p>
                    <a href="javascript::void(0);" onclick="reply(this)" data-Commentid="{{ $comment->id }}">Reply</a>
                    @foreach ($reply as $rep)
                        @if ($rep->comment_id == $comment->id)
                            <div class="px-5">
                                <p class="mb-0"><b>{{ $rep->name }}</b></p>
                                <p class="mb-0 text-muted">{{ $rep->reply }}</p>
                                <a href="javascript::void(0);" onclick="reply(this)"
                                    data-Commentid="{{ $comment->id }}">Reply</a>
                            </div>
                        @endif
                    @endforeach
                </div>
                <hr />
            @endforeach


            {{-- replay Textbox --}}
            <div style="display: none;" class="replyDiv">
                <form action="{{ route('add_reply.post') }}" method="POST">
                    @csrf
                    <input type="text" name="comment_id" id="comment_id" hidden>
                    <textarea name="reply" class="mb-1" placeholder="Write something here"
                        style="width:600px;min-height:50px !important"></textarea>
                    <div class="mt-0">
                        <button class="btn btn-primary">Reply</button>
                        <a href="javascript::void(0);" class="btn btn-danger" onClick="reply_close(this)">
                            Close
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>
    {{-- Comment Ends --}}


    <script>
        function reply(caller) {
            document.getElementById('comment_id').value = $(caller).attr('data-Commentid');
            $('.replyDiv').insertAfter($(caller));
            $('.replyDiv').show();
        }
    </script>

    <script>
        function reply_close(caller) {
            $('.replyDiv').hide();
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            var scrollpos = sessionStorage.getItem('scrollpos');
            if (scrollpos) {
                window.scrollTo(0, scrollpos);
                sessionStorage.removeItem('scrollpos');
            }
        });

        window.addEventListener("beforeunload", function(e) {
            sessionStorage.setItem('scrollpos', window.scrollY);
        });
    </script>
@endsection
