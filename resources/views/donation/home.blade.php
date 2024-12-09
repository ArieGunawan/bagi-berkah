@extends('layouts.main')

@section('container')
    <div class="flex justify-center mt-32 ">
        <img class="w-5/12 rounded-lg" src="img/berbagi.jpg" alt="">
    </div>

    <div class="flex justify-center mt-5">
    <a href="{{ route('donations.donate') }}">
        <button type="button" class="py-3 mb-2 mr-2 text-base font-medium text-center text-white rounded-lg px-80 bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800">Mulai Donasi</button>
    </a>
    </div>

@endsection
