@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-16">
        <div class="popular-actors">
            <h2 class="uppercase tracking-wider text-yellow-600 text-lg font-semibold">Popular Actors</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach($popularActors as $actor)
                    <div class="actor mt-8">
                        <a href="{{ route('actors.show', $actor['id']) }}">
                            <img src="{{ $actor['profile_path'] }}" alt="profile image"
                                class="hover:opacity-75 transition ease-in-out duration-150"
                            >
                            <div class="mt-2">
                                <a href="{{ route('actors.show', $actor['id']) }}" class="text-lg hover:text-gray-300">{{ $actor['name'] }}</a>
                                <div class="text-sm truncate text-gray-400">{{ $actor['known_for'] }}</div>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>
        </div>

        <!-- End popular-actors -->

        <div class="page-load-status my-8">
            <div class="flex justify-center">
                <div class="infinite-scroll-request">
                    <svg class="animate-spin text-4xl h-4 w-4 rounded-full bg-transparent border-2 border-transparent border-opacity-50" style="border-right-color: white; border-top-color: white;" viewBox="0 0 40 40"></svg>
                </div>

            <p class="infinite-scroll-last">End of content</p>
            <p class="infinite-scroll-error">Error</p>

            </div>
        </div>

{{--        <div class="flex justify-between mt-16">--}}
{{--            @if ($previous)--}}
{{--                <a href="/actors/page/{{ $previous }}">Previous</a>--}}
{{--            @else--}}
{{--                <div></div>--}}
{{--            @endif--}}
{{--            @if ($next)--}}
{{--                    <a href="/actors/page/{{ $next }}">Next</a>--}}
{{--                @else--}}
{{--                <div></div>--}}
{{--            @endif--}}
{{--        </div>--}}

    </div>

@endsection

@section('scripts')
    <script src="https://unpkg.com/infinite-scroll@4/dist/infinite-scroll.pkgd.min.js"></script>
    <script>
        let elem = document.querySelector('.grid');
        let infScroll = new InfiniteScroll( elem, {
            path: '/actors/page/@{{#}}',
            append: '.actor',
            status: '.page-load-status',
            // history: false,
        });
    </script>
@endsection


