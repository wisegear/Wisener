@extends('layouts.app')

@section('content')

   <div class="my-10">
        <!-- Header section -->
        <header>
            <div class="mt-10 md:w-8/12">
                <h2 class="mt-6 font-bold text-4xl md:text-5xl tracking-tight">Straight talk on property and finance — no fluff, no influencer nonsense.</h2>
                <p class="mt-6 text-zinc-500 text-base">Some of these articles might be useful. Others might just pass the time while your kettle boils. 
                    Either way, don’t take financial advice from a bloke with a blog — speak to someone qualified (ideally with insurance… and a desk).
                </p>
            </div>
        </header>
    </div>

    <div class="flex-grow">
        <!-- Split into 2 one for articles and another for whatever -->
        <main class="my-10 md:my-20 flex gap-24">
            <div class="md:w-7/12">
                <div>
                    @foreach($posts as $post)
                        <a href="/blog/{{ $post->slug }}">
                            <article class="mb-10 transition-colors duration-200 hover:bg-zinc-100 p-4 rounded-xl">
                                <p class="text-zinc-400 text-sm border-l pl-4 mb-2">{{ $post->date->format('F j, Y') }}</p>
                                <h2 class="my-4 font-semibold text-sm">{{ $post->title }}</h2>
                                <p class="text-sm text-zinc-500">{{ $post->summary }}</p>
                                <p class="text-sm text-teal-500 mt-4">Read article ></p>
                            </article>
                        </a>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="">
                    {{ $posts->links() }}
                </div>
            </div>

            <!-- Blog Sidebar -->
            <div class="w-3/12 hidden md:block">
                <!-- Search -->
                <div class="mb-10 w-full">
                    <form method="get" action="/blog" class="mb-5">
                        <h2 class="text-lg font-bold mb-2">Search Blog</h2>
                        <div class="relative">
                            <input type="text" class="border border-slate-300 rounded-md w-full text-sm pl-2 p-2" id="search" name="search" placeholder="Enter search term">
                            <button class=" absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </form>
                </div>
                <!-- Categories -->
                <div class="text-sm">
                    <div class="border-b pb-2 border-slate-300">
                        <h2 class="text-lg font-bold">Categories</h2>
                    </div>
                    <div class="my-4">
                        <ul class="text-zinc-500 space-y-2">
                            @foreach($categories as $category)
                            <li><a href="/blog?category={{ Str::slug($category->name) }}">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!-- Blog Tags -->
                <div class="hidden md:block my-6">
                    <h2 class="text-lg font-bold border-b mb-4 border-slate-300">Popular Tags</h2>
                    @foreach ($popular_tags as $tag)
                    <a href="/blog?tag={{ $tag->name }}" class="">
                        <button class="mr-2 mb-4 p-1 text-xs uppercase border border-slate-300 hover:text-teal-500 rounded cursor-pointer">{{ $tag->name }}</button>
                    </a>
                    @endforeach
                </div>
                @can('Admin')
                    <!-- Admin -->
                    <div class="hidden md:block my-6">
                        <h2 class="text-xl font-bold text-gray-700 dark:text-red-300 border-b border-gray-300 mb-4"><i class="fa-solid fa-user-secret text-red-800"></i> Admin Tools</h2>
                        <div class="flex justify-center">
                            <p class="border p-1 bg-lime-400 text-black rounded text-sm"><a href="/blog/create">Create New Post</a></p>
                        </div>
                        <div class="flex flex-col space-y-2 text-sm mt-4">
                            @foreach ($unpublished as $post)
                                <a href="../blog/{{$post->id}}/edit" class="text-gray-700 hover:text-sky-700">{{ $post->title }}</a>
                            @endforeach
                        </div>
                    </div> 
                @endcan 
            </div>
        </main>
    </div>


@endsection