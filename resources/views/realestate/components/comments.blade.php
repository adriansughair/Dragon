<div class="col-md-12 section-t3">
    <div class="title-box-d">
        <h3 class="title-d">{{ __('Comments') }}</h3>
    </div>
    <form action="{{ route('comment_submit', [app()->getLocale(), 'id' => $realEstate->id]) }}" id="comment-form"
        class="comment-form mb-5" method="POST">
        @csrf
        <div class="form-group">
            <textarea type="text" name="text" id="text" placeholder="{{ __('Write your comment') }} ..."
                class="form-control"></textarea>
            @error('text')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button class="btn btn-success" type="submit">{{ __('Add') }}</button>
    </form>
    @foreach ($realEstate->comment()->get() as $item)
        <div class="comment-item mb-4" id="comment-{{ $item->id }}">
            <div class="d-flex justify-content-start">
                <div class="image-container">
                    <i class="fa fa-user fa-3x"></i>
                </div>
                <div class="comment-body col">
                    <div class="d-flex justify-content-between">
                        <span class="username">{{ $realEstate->user()->first()->name }}</span>
                        {{-- <i class="fa fa-ellipsis-v fa-2x"></i>
                        --}}
                        {{-- <span class="text-secondary">11/07/2020</span>
                        --}}
                    </div>
                    <span class="text-secondary pb-2 d-block">{{ $item->created_at->diffForHumans() }}</span>
                    <p>{{ $item->text }}</p>
                </div>
            </div>
        </div>
    @endforeach
</div>

@if (Session::has('comment'))
    <script>
        $(document).ready(function() {
            window.scrollTo({
                top: $("#" + "{{ Session::get('comment') }}").offset().top - $("#" +
                    "{{ Session::get('comment') }}").height() - 50,
                left: 0,
                behavior: 'smooth'
            });
        })

    </script>
@endif

@if (Session::has('comment_error'))
    <script>
        $(document).ready(function() {
            window.scrollTo({
                top: $("#comment-form").offset().top,
                left: 0,
                behavior: 'smooth'
            });
        })

    </script>
@endif
