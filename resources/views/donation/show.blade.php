@extends('layouts.main')

@section('container')

<<div class="flex flex-col items-start mt-20 mb-28">
    <div class="flex justify-end w-full gap-5 mb-4">
        <a href="{{ route('blogs.edit', $blog) }}">
            <button class="px-4 py-1.5 font-semibold text-white bg-blue-400 rounded-md hover:bg-blue-600">Edit</button>
        </a>
        @include('donation.partials.delete-blog')
    </div>

    <img src="{{ url('storage/'.$blog->photo) }}" alt="" class="max-w-screen-xl rounded-lg ml-[21rem]">

    <div class="mt-6 text-left ml-[21rem]">
        <h1 class="text-2xl font-bold">{{ $blog->title }}</h1>
        <p class="mt-2 text-gray-500">{{ $blog->category }}</p>
        <p class="mt-4 max-w-[800px] overflow-hidden">{{ $blog->body }}</p>
    </div>

    <a href="{{ route('donations.blog') }}">
        <button class="px-4 py-2 my-6 font-semibold text-white bg-blue-400 rounded-md hover:bg-blue-600 ml-[21rem]">Back</button>
    </a>
</div>

@endsection
