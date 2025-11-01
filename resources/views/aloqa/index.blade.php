@extends('layouts.layout')
@section('title', 'Aloqa')

@section('content')
    <div class="container mx-auto max-w-4xl py-16 px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <header class="text-center mb-12">
            <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-800 mb-2 tracking-tight">
                Biz bilan aloqaga chiqing
            </h1>
            <p class="text-lg text-gray-500">
                Savollaringiz, takliflaringiz yoki fikr-mulohazalaringizni yozib qoldiring.
            </p>
        </header>

        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded mb-6 shadow-sm">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <!-- Contact Form Card -->
        <div class="bg-white p-8 md:p-10 rounded-xl shadow-2xl border border-gray-100/70">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6 text-center border-b pb-3">Xabar yuborish</h2>
            <form action="{{ route('aloqa.store') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2" for="name">
                        Ismingiz
                    </label>
                    <input name="name" id="name" type="text" placeholder="Ism va Familiyangizni kiriting"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out placeholder-gray-400"
                           value="{{ old('name') }}">
                    @error('name')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2" for="sinf">
                        Sinfingiz
                    </label>
                    <input name="sinf" id="sinf" type="text" placeholder="Sinfingizni kiriting (Masalan: 9A)"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out placeholder-gray-400"
                           value="{{ old('sinf') }}">
                    @error('sinf')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2" for="email">
                        Email
                    </label>
                    <input name="email" id="email" type="email" placeholder="Email manzilingizni kiriting"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out placeholder-gray-400"
                           value="{{ old('email') }}">
                    @error('email')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2" for="message">
                        Xabar
                    </label>
                    <textarea name="message" id="message" rows="5" placeholder="Xabaringizni yozing..."
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out placeholder-gray-400">{{ old('message') }}</textarea>
                    @error('message')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-center pt-2">
                    <button type="submit"
                            class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-lg shadow-lg transition duration-200 ease-in-out transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Yuborish
                    </button>
                </div>
            </form>
        </div>

        <!-- Map and Contact Info Section (Responsive Grid) -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 mt-16">
            <!-- Map Section -->
            <div>
                <h2 class="text-2xl font-bold text-gray-800 mb-4 border-b pb-2">Manzilimiz</h2>
                <!-- Responsive Map Container (16:9 Aspect Ratio) -->
                <div class="rounded-xl overflow-hidden shadow-lg" style="padding-bottom: 56.25%; position: relative; height: 0;">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12183.728024919104!2d69.24942255020143!3d40.23281399048009!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38b1963eb86e099b%3A0xd4d7c89688f5d2bb!2zNS1tYWt0YWIgLyBTY2hvb2wgbnVtYmVyIDU!5e0!3m2!1sen!2s!4v1762035851513!5m2!1sen!2s"
                            width="100%" height="100%" style="border:0; position: absolute; top: 0; left: 0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="rounded-xl"></iframe>
                </div>
            </div>

            <!-- Contact Details Card -->
            <div class="lg:mt-0">
                <h2 class="text-2xl font-bold text-gray-800 mb-4 border-b pb-2">Konntaktlar</h2>
                <div class="bg-blue-50 p-6 rounded-xl shadow-lg h-full flex flex-col justify-center">
                    <div class="space-y-4 text-gray-700">
                        <p class="flex items-center text-lg">
                            <svg class="w-6 h-6 mr-3 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            <strong class="font-semibold">Telefon:</strong> <span class="ml-2">+998 90 123 45 67</span>
                        </p>
                        <p class="flex items-center text-lg">
                            <svg class="w-6 h-6 mr-3 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8m-1 10a2 2 0 01-2 2H6a2 2 0 01-2-2V6a2 2 0 012-2h12a2 2 0 012 2v12z"></path></svg>
                            <strong class="font-semibold">Email:</strong> <span class="ml-2">info@namuna.uz</span>
                        </p>
                        <p class="flex items-center text-lg">
                            <svg class="w-6 h-6 mr-3 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <strong class="font-semibold">Manzil:</strong> <span class="ml-2">Toshkent viloyati, Maktab 5</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
