@extends('layouts.main')

@section('container')

<div class="mt-32">
<form class="max-w-md mx-auto" action="{{ route('donations.blog') }}">
    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
    <div class="relative">
        <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
        </div>
        <input type="text" name="search" id="default-search" class="block w-full p-4 text-sm text-gray-900 border border-gray-300 rounded-lg ps-10 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search..." value="{{ request('search') }}"/>
        <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
    </div>
</form>
</div>

<div class="flex justify-end my-20 mr-5">
    <a href="{{ route('donations.create') }}">
        <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Create Blog</button>
    </a>
</div>

    <div class="px-12 mx-auto mb-64 max-w-7xl sm:px-6 lg:px-8">
    @if ($blogs->count())
    <div class="grid grid-cols-1 gap-4 mt-3 mb-16 sm:grid-cols-2 md:grid-cols-4">
        @foreach ($blogs as $blog)
            <div class="flex flex-col h-full mb-4">
                <img src="{{ url('storage/'. $blog->photo) }}" class="object-cover object-center w-full rounded-lg h-96" alt="">
                <div class="flex flex-col flex-grow mt-2">
                    <p class="text-lg font-bold">{{ $blog->title }}</p>
                    <p class="font-semibold">{{ $blog->category }}</p>
                    <p class="flex-grow text-sm text-gray-500">{{ Str::limit($blog->body, 100) }}</p>
                </div>
                <a href="{{ route('blogs.show', $blog) }}">
                    <button class="w-full px-4 py-1 font-semibold text-white bg-blue-400 rounded-md">View More</button>
                </a>
            </div>
        @endforeach
    </div>
    {{ $blogs->links() }}
    </div>
    @else
    <p class="text-center text-gray-500">No matching results.</p>
    @endif



@endsection
