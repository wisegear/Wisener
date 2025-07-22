@extends('layouts.app')
@section('content')
   <div class="flex flex-col md:flex-row justify-between gap-20 my-20">
        <div class="md:w-1/2">
            <!-- Cheating with image -->
            <div class="my-10 md:hidden">
                <img src="../assets/images/site/charity.jpg" class="ml-2 rounded-lg rotate-5 h-[300px] w-[300px]" alt="">
            </div>
            <h2 class="font-bold text-4xl md:text-5xl tracking-tight">
                I’m Lee Wisener. I live in Glasgow and overthink things.            </h2>
            <div class="wise1text my-10">
                <p>After 25 years in mortgages and banking, I’m probably about done. I’ve officially reached the dinosaur stage, younger folks seem to know better, or at least think they do. Maybe they’re right. But it helps if you’ve lived through a recession, the collapse of the mortgage market, skyrocketing property prices, and interest rates that would make today’s buyers weep. (My first mortgage was nearly 9%. My parents? 14%. Character-building stuff.)</p>
<p>Somehow, I’m still here. Sarcastic as ever, navigating today’s modern work culture with all the grace of someone who remembers telex machines.</p>
<p>These days, I write about a bit of everything, property, finance, tech, coding, running, and whatever else manages to both amuse and confuse me. It’s a blog without a clear niche, because frankly, I don’t have one either. Call it a collection of curiosities, written by someone who still hasn’t quite worked out what he wants to be when he grows up.</p>
<p>At 53, I might not be “disrupting the algorithm,” but I know a few things, and I’m still learning the rest, usually the hard way. If that sounds like your sort of company, you might enjoy poking around. If not, feel free to cancel me early. Saves me writing the next post.</p>
<p>If it helps, there’s a photo above of me with two of my kids doing something vaguely noble for charity, proof that I’m not entirely irredeemable.  Just for clarity, I am the handsome one on the right.</p>
<p>If you fancy getting in touch, whether it’s to say thanks, share your thoughts, or serve legal notice — there’s an email link somewhere on the right. Please note: I’m still not sending money to the foreign prince who needs help unlocking his inheritance. Not again.</p>            </div>
        </div>
        <!-- Side panel -->
        <div class="mt-10 md:w-1/2">
            <div class="hidden md:block">
                <img src="../assets/images/site/charity.jpg" class="rounded-lg rotate-5 md:h-[300px] md:w-[300px] lg:h-[400px] lg:w-[400px] ml-4" alt="">
            </div>

            <!-- Social and Mail -->
             <div class="md:mt-10">
                <a href="https://x.com/wisenerl">
                    <div class="flex gap-4 items-center mb-2">              
                        <svg viewBox="0 0 24 24" aria-hidden="true" class="h-6 w-6 fill-zinc-500">
                        <path d="M13.3174 10.7749L19.1457 4H17.7646L12.7039 9.88256L8.66193 4H4L10.1122 12.8955L4 20H5.38119L10.7254 13.7878L14.994 20H19.656L13.3171 10.7749H13.3174ZM11.4257 12.9738L10.8064 12.0881L5.87886 5.03974H8.00029L11.9769 10.728L12.5962 11.6137L17.7652 19.0075H15.
                        6438L11.4257 12.9742V12.9738Z"></path>
                        </svg>    
                        <p class="text-sm">Follow me on X</p>
                    </div>
                </a>
                <a href="https://www.linkedin.com/in/leewisener/">
                    <div class="flex gap-4 items-center">                
                        <svg viewBox="0 0 24 24" aria-hidden="true" class="h-6 w-6 fill-zinc-500 transition group-hover:fill-zinc-600 dark:fill-zinc-400 dark:group-hover:fill-zinc-300">
                            <path d="M18.335 18.339H15.67v-4.177c0-.996-.02-2.278-1.39-2.278-1.389 0-1.601 1.084-1.601 2.205v4.25h-2.666V9.75h2.56v1.17h.035c.358-.674 1.228-1.387 2.528-1.387 2.7 0 3.2 1.778 3.2 4.091v4.715zM7.003 8.575a1.546 1.546 
                            0 01-1.548-1.549 1.548 1.548 0 111.547 1.549zm1.336 9.764H5.666V9.75H8.34v8.589zM19.67 3H4.329C3.593 3 3 3.58 3 4.297v15.406C3 20.42 3.594 21 4.328 21h15.338C20.4 21 21 20.42 21 19.703V4.297C21 
                            3.58 20.4 3 19.666 3h.003z"></path>
                        </svg>   
                        <p class="text-sm">Follow me on LinkedIn</p>
                    </div>
                </a>
                <a href="mailto:lee@wisener.net">
                    <div class="flex gap-4 items-center mt-10">                
                        <svg viewBox="0 0 24 24" aria-hidden="true" class="h-6 w-6 flex-none fill-zinc-500 transition group-hover:fill-teal-500">
                            <path fill-rule="evenodd" d="M6 5a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3h12a3 3 0 0 0 3-3V8a3 3 0 0 0-3-3H6Zm.245 2.187a.75.75 0 0 0-.99 1.126l6.25 5.5a.75.75 0 0 0 .99 0l6.25-5.5a.75.75
                            0 0 0-.99-1.126L12 12.251 6.245 7.187Z"></path>
                        </svg> 
                        <p class="text-sm"><span class="">lee@wisener.net</span></p>
                    </div>
                </a>
             </div>
        </div>
    </div>
@endsection


