@extends('layouts.main')

@section('container')
    <h1 class="mx-12 mt-20 mb-10 text-2xl font-bold">Edit Blog</h1>

    <form class="mx-10 mb-6" method="POST" action="{{ route('blogs.update', $blog->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
        <label for="title" class="block my-2 mr-4 text-sm font-medium text-gray-900 dark:text-white">Title</label>
        <div class="flex-1">
            <input type="text" id="title" name="title" class="block w-full p-2 my-5 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Judul" autofocus value="{{ old('title', $blog->title) }}" required/>
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>
        <label for="category" class="block my-5 mr-4 text-sm font-medium text-gray-900 dark:text-white">Category</label>
        <div class="flex-1">
            <input type="text" id="category" name="category" class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Category" value="{{ old('category', $blog->category) }}" required/>
            <x-input-error :messages="$errors->get('category')" class="mt-2" />
        </div>
        <div class="my-5">
            <x-input-label for="photo" :value="__('Photo')" />
            <input type="hidden" name="oldPhoto" value="{{ $blog->photo }}">
            @if ($blog->photo)
                <img src="{{ asset('storage/'. $blog->photo) }}" class="w-2/12 mb-5 img-preview img-fluid" alt="">
            @endif
        </div>
        <div class="mt-5 ">
            <x-text-input
            accept="image/*"
            id="photo"
            class="block w-full p-2 mt-1 border "
            type="file"
            name="photo"
            onchange="previewPhoto()"
            />
            <x-input-error :messages="$errors->get('photo')" class="mt-2" />
        </div>
        <label for="body" class="block my-5 mr-4 text-sm font-medium text-gray-900 dark:text-white">Body</label>
        <div class="flex-1">
            <input id="body" type="hidden" name="body" value="{{ old('body', $blog->body) }}">
            <trix-editor input="body"></trix-editor>
            <x-input-error :messages="$errors->get('body')" class="mt-2" />
        </div>
        </div>
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-4 mb-20">Update Blog</button>
    </form>

    <script>
        document.addEventListener('trix-file-accept', function(e){
            e.preventDefault();
        })

        function previewPhoto(){
            const photo = document.querySelector('#photo');
            const previewPhoto = document.querySelector('.img-preview');

            previewPhoto.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(photo.files[0]);

            oFReader.onload = function(oFREvent){
                previewPhoto.src = oFREvent.target.result;
            }
        }

    </script>

@endsection
