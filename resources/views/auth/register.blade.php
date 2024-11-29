@extends('layouts.blank')
@section('content')
    <section class="h-screen w-full bg-center bg-no-repeat bg-gray-700 bg-blend-multiply relative"
     style="background: url({{ asset('images/bg_login.png') }}); background-repeat: no-repeat; background-size: cover;">

     <div class="absolute inset-0 flex items-center justify-center">
        <div class="w-96 bg-white bg-opacity-90 p-8 rounded-lg shadow-lg">
                <img class="h-28 mx-auto mb-8" src="{{ asset('images/Logo.png') }}" alt="image description">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    @if ($errors->any())
                      <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                          <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            <span class="font-medium">Warning</span>
                            <ul class="mt-1.5 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                      </div>
                    @endif

                    <div class="mb-3">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Full Name</label>
                        <input type="text" id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John Doe" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email address</label>
                        <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="john.doe@gmail.com" required>
                    </div>
                    <div class="flex gap-4">
                        <div class="mb-3 relative flex-1">
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <div class="relative w-full">
                                <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="•••••••••" required>
                                <button type="button" id="show-password-btn" class="absolute inset-y-0 right-0 flex items-center px-4 text-gray-500 focus:outline-none">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        <div class="mb-3 relative flex-1">
                            <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm Password</label>
                            <div class="relative w-full">
                                <input type="password" id="password_confirmation" name="password_confirmation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="•••••••••" required>
                                <button type="button" id="show-password-confirmation-btn" class="absolute inset-y-0 right-0 flex items-center px-4 text-gray-500 focus:outline-none">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 flex items-center justify-between">
                        <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200">
                            Register
                        </button>
                    </div>
                    <div class="mb-3">
                        <p class="text-gray-600 dark:text-gray-400">Already have an account? <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Log in here</a></p>
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
        const passwordConfirmationInput = document.getElementById('password_confirmation');
        const showPasswordConfirmationBtn = document.getElementById('show-password-confirmation-btn');

        showPasswordBtn.addEventListener('click', function () {
            togglePasswordVisibility(passwordInput, showPasswordBtn);
        });

        showPasswordConfirmationBtn.addEventListener('click', function () {
            togglePasswordVisibility(passwordConfirmationInput, showPasswordConfirmationBtn);
        });

        function togglePasswordVisibility(inputElement, buttonElement) {
            if (inputElement.type === 'password') {
                inputElement.type = 'text';
                buttonElement.innerHTML = '<i class="fas fa-eye-slash"></i>';
            } else {
                inputElement.type = 'password';
                buttonElement.innerHTML = '<i class="fas fa-eye"></i>';
            }
        }
    });
</script>
@endsection
