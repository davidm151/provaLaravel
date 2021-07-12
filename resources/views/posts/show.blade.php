<x-app-layout>
    <div class="container py-8">
        <h1 class="text-4xl font-bold text-gray-600">{{ $post->name }}</h1>
        <div class="text-lg text-gray-500 mb-2">
            {{ $post->extract }}
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2">
                <figure>
                    <img class="w-full h-80 object-cover object-center" src="{{ Storage::url($post->image->url) }}" alt="">
                </figure>
                <div class="text-base text-gray-500 mt-4">
                    {{ $post->body }}
                </div>
            </div>
            <aside>
                <h1 class="text-2xl font-bold text-gray-600 mb-4">Mas en {{ $post->category->name }}</h1>
                <ul>
                    @foreach ($similares as $similar)
                        <li class="mb-4">
                            <article class="w-full h-80 bg-cover bg-center @if ($loop->first) md:col-span-2
                                @endif" style="background-image: url({{ '/storage/' . $similar->image->url }})">                          
                            
                            {{-- <img href="{{ route('posts.tag',$similar)}}" class="w-36 h-20 object-cover object-center" src="{{ Storage::url($similar->image->url) }}" alt=""> --}}
                            <div class="w-full h-full px-8 flex flex-col justify-center">
                                <h1 class="text-4xl text-white lading-8 font-bold mt-2">
                                    <a href="{{ route('posts.show',$similar)}}">{{ $post->name }}</a>
                                </h1>
                            </div>
                            {{-- <span class="ml-2 text-gray-600">{{ $similar->name }}</span> --}}
                            </article>

                        </li>
                    @endforeach
                </ul>
            </aside>

        </div>
    </div>
</x-app-layout>