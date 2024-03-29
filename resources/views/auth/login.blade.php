@extends('layouts.blank')
@section('content')
    <section class="h-screen w-full bg-center bg-no-repeat bg-gray-700 bg-blend-multiply relative"
        style="background: url({{ asset('images/bg_login.png') }}); background-repeat: no-repeat; background-size: cover;">
        <div
            class="h-full w-full bg-gradient-to-br from-gray-900 to-transparent opacity-80 mask-layer absolute top-0 left-0">
        </div>
        <div class="container flex items-center justify-center h-full relative">
            <div class="w-96 bg-white bg-opacity-90 p-8 rounded-lg shadow-lg">

                @if (session('success'))
                    <div id="alert-5" class="flex items-center p-4 rounded-lg bg-gray-50 dark:bg-gray-800" role="alert">
                        <svg class="flex-shrink-0 w-4 h-4 dark:text-gray-300" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="sr-only">Info</span>
                        <div class="ms-3 text-sm font-medium text-gray-800 dark:text-gray-300">
                            {{ session('success') }}
                        </div>
                        <button type="button"
                            class="ms-auto -mx-1.5 -my-1.5 bg-gray-50 text-gray-500 rounded-lg focus:ring-2 focus:ring-gray-400 p-1.5 hover:bg-gray-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white"
                            data-dismiss-target="#alert-5" aria-label="Close">
                            <span class="sr-only">Dismiss</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>
                @endif
                <img class="h-auto mx-auto mb-8" src="{{ asset('images/Logo.png') }}" alt="image description">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                      @if ($errors->any())
                      <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                          <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            @foreach ($errors->all() as $error)
                            <span class="font-medium">Warning </span>{{$error}}
                            @endforeach
                        </div>
                      </div>
                    @endif

                    <div class="mb-6">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email
                            address</label>
                        <input type="email" id="email" name="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="john@gmail.com" required>
                    </div>
                    <!-- Di dalam tag <form> Anda -->
                    <div class="mb-6 r">
                        <label for="password"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <div class="relative w-full">
                            <input type="password" id="password" name="password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="•••••••••" required>
                            <button type="button" id="show-password-btn"
                                class="absolute inset-y-0 right-0 flex items-center px-4 text-gray-500 focus:outline-none">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <button type="submit"
                            class="w-full bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200">
                            Sign In
                        </button>
                    </div>
                    <div class="mb-3">
                        <p class="text-gray-600 dark:text-gray-400">Don't have an account? <a href="{{ route('register') }}"
                                class="text-blue-500 hover:underline">Register in here</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@section('script')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const passwordInput = document.getElementById('password');
    const showPasswordBtn = document.getElementById('show-password-btn');

    showPasswordBtn.addEventListener('click', function () {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            showPasswordBtn.innerHTML = '<i class="fas fa-eye-slash"></i>';
        } else {
            passwordInput.type = 'password';
            showPasswordBtn.innerHTML = '<i class="fas fa-eye"></i>';
        }
    });
});
</script>
@endsection
