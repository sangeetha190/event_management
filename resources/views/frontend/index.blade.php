@extends('frontend.layouts.index')
@section('content')
    @include('frontend.slider')
    <!-- end slider section -->
    <!-- why section -->
    {{-- done kjk --}}
    @include('frontend.why')
    <!-- end why section -->

    <!-- arrival section -->
    @include('frontend.arrival')
    <!-- end arrival section -->

    <!-- product section -->
    @include('frontend.product')
    <!-- end product section -->

    {{-- Comment Starts --}}
    <div class="container">
        <x-alert />
        <h3 class="text-center">Comments</h3>
        <div class="text-center" id="commentSection">
            <form action="{{ route('add_comment.post') }}" method="POST">
                @csrf
                <textarea name="comment" class="mb-1" placeholder="Comment something here" style="width:600px;min-height:50px !important"></textarea>
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
    <!-- subscribe section -->
    @include('frontend.subscribe')
    <!-- end subscribe section -->
    <!-- client section -->
    @include('frontend.client')
    <!-- end client section -->
@endsection
