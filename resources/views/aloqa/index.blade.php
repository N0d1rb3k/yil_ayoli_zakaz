@extends('layouts.layout')

@section('title', 'Aloqa')

@section('content')
    <div class="container mx-auto max-w-3xl py-10">
        <h1 class="text-3xl font-bold text-center mb-8">Biz bilan aloqaga chiqing</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('aloqa.store') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                    Ismingiz
                </label>
                <input name="name" id="name" type="text" placeholder="Ismingizni kiriting"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                       value="{{ old('name') }}">
                @error('name')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                    Sinfingiz
                </label>
                <input name="sinf" id="name" type="text" placeholder="Sinfingiz kiriting"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                       value="{{ old('sinf') }}">
                @error('name')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                    Email
                </label>
                <input name="email" id="email" type="email" placeholder="Emailingizni kiriting"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                       value="{{ old('email') }}">
                @error('email')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="message">
                    Xabar
                </label>
                <textarea name="message" id="message" rows="5" placeholder="Xabaringizni yozing..."
                          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('message') }}</textarea>
                @error('message')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-center">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline">
                    Yuborish
                </button>
            </div>
        </form>

        <div class="text-center text-gray-600 mt-8">
            <p><strong>Telefon:</strong> +998 90 123 45 67</p>
            <p><strong>Email:</strong> info@namuna.uz</p>
            <p><strong>Manzil:</strong> Toshkent shahri</p>
        </div>
    </div>
@endsection
