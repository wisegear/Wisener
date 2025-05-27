@extends('layouts.app')
@section('content')

    <div class=""> 
        <!-- Header section -->
        <header>
            <div class="mt-20 md:w-8/12">
                <img src="../assets/images/site/lee-wisener.jpg" alt="Lee Wisener Logo" class="rounded-full h-16 shadow-lg">
                <h2 class="mt-6 font-bold text-3xl md:text-5xl tracking-tight">Property and finance geek, part-time coder, tech enthusiast and full-time overthinker.</h2>
                <p class="mt-6 text-zinc-500 text-base">I’m Lee. I’ve spent 25 years in UK mortgages and banking, which probably says more about my life choices than I’d like to admit. 
                    These days I write about it too, well a lot things actually, mainly because my memory’s shot and it’s the only way I can keep track of what I’m supposed to know or I'm trying to remember. </p>
            </div>
        </header>

        <!-- Social Icons -->
        <section aria-label="Social Media Links" class="mt-6 flex gap-6">
            <!-- X -->
            <a class="group -m-1 p-1" aria-label="Follow on X" href="https://x.com/wisenerl">
            <svg viewBox="0 0 24 24" aria-hidden="true" class="h-6 w-6 fill-zinc-500 transition group-hover:fill-zinc-600 dark:fill-zinc-400 dark:group-hover:fill-zinc-300">
                <path d="M13.3174 10.7749L19.1457 4H17.7646L12.7039 9.88256L8.66193 4H4L10.1122 12.8955L4 20H5.38119L10.7254 13.7878L14.994 20H19.656L13.3171 10.7749H13.3174ZM11.4257 12.9738L10.8064 12.0881L5.87886 5.03974H8.00029L11.9769 10.728L12.5962 11.6137L17.7652 19.0075H15.
                6438L11.4257 12.9742V12.9738Z"></path>
            </svg>
            </a>
            <!--  -->
            <a class="group -m-1 p-1" aria-label="Follow on Linkedin" href="https://www.linkedin.com/in/leewisener/">
            <svg viewBox="0 0 24 24" aria-hidden="true" class="h-6 w-6 fill-zinc-500 transition group-hover:fill-zinc-600 dark:fill-zinc-400 dark:group-hover:fill-zinc-300"><path d="M18.335 18.339H15.67v-4.177c0-.996-.02-2.278-1.39-2.278-1.389 0-1.601 1.084-1.601 2.205v4.25h-2.666V9.75h2.56v1.17h.035c.358-.674 1.228-1.387 2.528-1.387 2.7 0 3.2 1.778 3.2 4.091v4.715zM7.003 8.575a1.546 1.546 
            0 01-1.548-1.549 1.548 1.548 0 111.547 1.549zm1.336 9.764H5.666V9.75H8.34v8.589zM19.67 3H4.329C3.593 3 3 3.58 3 4.297v15.406C3 20.42 3.594 21 4.328 21h15.338C20.4 21 21 20.42 21 19.703V4.297C21 3.58 20.4 3 19.666 3h.003z"></path></svg>
            </a>
            </section>

        <!-- Image Header -->
        <section class="w-screen relative left-1/2 -translate-x-1/2 mt-20">
            <div class="flex flex-nowrap justify-center gap-16">
                <img src="../assets/images/site/image1.jpg" alt="Gallery image 1" class="rounded-lg w-54 h-52 rotate-5 shrink-0">
                <img src="../assets/images/site/image2.jpg" alt="Gallery image 2" class="rounded-lg w-54 h-52 -rotate-5 shrink-0">
                <img src="../assets/images/site/image3.jpg" alt="Gallery image 3" class="rounded-lg w-54 h-52 rotate-5 shrink-0">
                <img src="../assets/images/site/image4.jpg" alt="Gallery image 4" class="rounded-lg w-54 h-52 -rotate-5 shrink-0">
            </div>
        </section>

        <div class="flex-grow">
            <!-- Split into 2 one for articles and another for whatever -->
            <main class="my-20 flex flex-col md:flex-row gap-24">
                <div class="md:w-7/12">
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
                <div class="md:w-5/12 text-sm p-2">
                    <div class="flex gap-4 items-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0-10.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.25-8.25-3.286Zm0 13.036h.008v.008H12v-.008Z" />
                        </svg>
                        <h2 class="font-semibold">A confused blog</h2>
                    </div>
                    <p class="mb-10 text-zinc-500">Like the title says, I’m a bit of a geek when it comes to property and finance. I also code, tinker with tech, and occasionally go down strange 
                        rabbit holes just to find my way out again with a blog post. This site is where all that lands. It’s not one of those highly focused niche blogs—more like a mildly confused collection 
                        of thoughts from someone who can’t quite pick a lane. Welcome. </p>
                    <div class="flex gap-4 items-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.05 4.575a1.575 1.575 0 1 0-3.15 0v3m3.15-3v-1.5a1.575 1.575 0 0 1 3.15 0v1.5m-3.15 0 .075 5.925m3.075.75V4.575m0 0a1.575 1.575 0 0 1 3.15 0V15M6.9 7.575a1.575 1.575 0 1 0-3.15 0v8.175a6.75 6.75 0 0 0 6.75 6.75h2.018a5.25 5.25 0 0 0 3.712-1.538l1.732-1.732a5.25 5.25 0 0 0 1.538-3.712l.003-2.024a.668.668 0 0 1 .198-.471 1.575 1.575 0 1 0-2.228-2.228 3.818 3.818 0 0 0-1.12 2.687M6.9 7.575V12m6.27 4.318A4.49 4.49 0 0 1 16.35 15m.002 0h-.002" />
                    </svg>

                        <h2 class="font-semibold">No AI on this site</h2>
                    </div>
                    <p class="mb-4 text-zinc-500">It feels odd having to say this, but, no AI was used in creating the content on this site.  With so much of the internet being dominated by AI generated content these days
                        it's hard to tell. </p>
                    <p class="text-zinc-500">Go have a look at some of my articles, either my grammar and spelling are bad or AI is not as good as people think it is!</p>
                </div>
            </main>
        </div>
    </div>
@endsection