<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - JokoUI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        lime: {
                            50: '#f7fee7',
                            100: '#ecfccb',
                            200: '#d9f99d',
                            300: '#bef264',
                            400: '#a3e635',
                            500: '#84cc16',
                            600: '#65a30d',
                            700: '#4d7c0f',
                            800: '#3f6212',
                            900: '#365314',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
        .transition-all {
            transition-property: all;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 300ms;
        }
        .dark-mode-toggle {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 100;
        }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 transition-all">
    <!-- Dark Mode Toggle -->
    <button id="darkModeToggle" class="dark-mode-toggle bg-white dark:bg-gray-800 p-3 rounded-full shadow-lg hover:shadow-xl transition-shadow">
        <i id="darkModeIcon" class="fas fa-moon text-gray-800 dark:text-yellow-300"></i>
    </button>

    <!-- Login Form -->
    <div class="min-h-screen flex items-center justify-center px-4 py-12">
        <div class="max-w-md w-full">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8 transition-all hover:shadow-2xl">
                <!-- Logo & Header -->
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-lime-100 to-lime-200 dark:from-lime-900/40 dark:to-lime-800/40 rounded-2xl mb-4 shadow-inner">
                        <svg class="w-8 h-8 text-lime-600 dark:text-lime-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Welcome back</h2>
                    <p class="text-gray-600 dark:text-gray-400 mt-2">Sign in to your account</p>
                    
                    <!-- Session Status -->
                    @if (session('status'))
                    <div class="mt-4 p-3 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-lg">
                        <p class="text-sm text-green-800 dark:text-green-300">{{ session('status') }}</p>
                    </div>
                    @endif
                </div>

                <!-- Login Form -->
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Email Address
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400 dark:text-gray-500"></i>
                            </div>
                            <input
                                id="email"
                                name="email"
                                type="email"
                                value="{{ old('email') }}"
                                autocomplete="email"
                                required
                                autofocus
                                class="w-full pl-10 pr-4 py-3 bg-white dark:bg-gray-700 border {{ $errors->has('email') ? 'border-red-500 dark:border-red-500' : 'border-gray-300 dark:border-gray-600' }} rounded-lg focus:ring-2 focus:ring-lime-500 dark:focus:ring-lime-400 focus:border-lime-500 dark:focus:border-lime-400 outline-none transition-colors text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400"
                                placeholder="example@jokoui.web.id"
                            >
                        </div>
                        @if ($errors->has('email'))
                            <div class="mt-2 text-sm text-red-600 dark:text-red-400">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>

                    <!-- Password -->
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Password
                            </label>
                            @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm font-medium text-lime-600 dark:text-lime-400 hover:text-lime-500 dark:hover:text-lime-300 transition-colors">
                                Forgot password?
                            </a>
                            @endif
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400 dark:text-gray-500"></i>
                            </div>
                            <input
                                id="password"
                                name="password"
                                type="password"
                                autocomplete="current-password"
                                required
                                class="w-full pl-10 pr-4 py-3 bg-white dark:bg-gray-700 border {{ $errors->has('password') ? 'border-red-500 dark:border-red-500' : 'border-gray-300 dark:border-gray-600' }} rounded-lg focus:ring-2 focus:ring-lime-500 dark:focus:ring-lime-400 focus:border-lime-500 dark:focus:border-lime-400 outline-none transition-colors text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400"
                                placeholder="••••••••"
                            >
                        </div>
                        @if ($errors->has('password'))
                            <div class="mt-2 text-sm text-red-600 dark:text-red-400">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <input
                            id="remember_me"
                            name="remember"
                            type="checkbox"
                            class="h-4 w-4 text-lime-600 dark:text-lime-400 focus:ring-lime-500 dark:focus:ring-lime-400 border-gray-300 dark:border-gray-600 rounded"
                        >
                        <label for="remember_me" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                            Remember me
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button
                        type="submit"
                        class="w-full bg-gradient-to-r from-lime-600 to-lime-500 dark:from-lime-500 dark:to-lime-400 text-white py-3 px-4 rounded-lg font-medium hover:from-lime-700 hover:to-lime-600 dark:hover:from-lime-600 dark:hover:to-lime-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-lime-500 dark:focus:ring-offset-gray-800 transition-all shadow-md hover:shadow-lg"
                    >
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Sign in
                    </button>
                </form>

                <!-- Social Login Separator -->
                <div class="mt-8">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300 dark:border-gray-700"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-4 bg-white dark:bg-gray-800 text-gray-500 dark:text-gray-400">
                                Or continue with
                            </span>
                        </div>
                    </div>

                    <!-- Social Login Buttons -->
                    <div class="mt-6 grid grid-cols-2 gap-3">
                        <button
                            type="button"
                            class="w-full inline-flex justify-center items-center py-2.5 px-4 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-white dark:bg-gray-700 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors"
                        >
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            </svg>
                            Google
                        </button>
                        <button
                            type="button"
                            class="w-full inline-flex justify-center items-center py-2.5 px-4 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-white dark:bg-gray-700 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors"
                        >
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0c-6.626 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-2 16h-2v-6h2v6zm-1-6.891c-.607 0-1.1-.496-1.1-1.109 0-.612.492-1.109 1.1-1.109s1.1.497 1.1 1.109c0 .613-.493 1.109-1.1 1.109zm8 6.891h-1.998v-3.862c0-1.881-2.002-1.722-2.002 0v3.862h-2v-6h2v1.093c.872-1.616 4-1.736 4 1.548v3.359z"/>
                            </svg>
                            LinkedIn
                        </button>
                    </div>
                </div>

                <!-- Sign Up Link -->
                <p class="mt-8 text-center text-sm text-gray-600 dark:text-gray-400">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="font-medium text-lime-600 dark:text-lime-400 hover:text-lime-500 dark:hover:text-lime-300 transition-colors ml-1">
                        Sign up
                    </a>
                </p>
            </div>
            
            <!-- Footer -->
            <div class="mt-8 text-center">
                <p class="text-xs text-gray-500 dark:text-gray-500">
                    &copy; {{ date('Y') }} JokoUI. All rights reserved.
                </p>
            </div>
        </div>
    </div>

    <!-- JavaScript for Dark Mode Toggle -->
    <script>
        // Dark Mode Toggle
        const darkModeToggle = document.getElementById('darkModeToggle');
        const darkModeIcon = document.getElementById('darkModeIcon');
        const htmlElement = document.documentElement;
        
        // Check for saved theme preference or respect OS preference
        const savedTheme = localStorage.getItem('theme');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        
        if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
            htmlElement.classList.add('dark');
            darkModeIcon.classList.remove('fa-moon');
            darkModeIcon.classList.add('fa-sun');
        } else {
            htmlElement.classList.remove('dark');
            darkModeIcon.classList.remove('fa-sun');
            darkModeIcon.classList.add('fa-moon');
        }
        
        darkModeToggle.addEventListener('click', () => {
            htmlElement.classList.toggle('dark');
            
            if (htmlElement.classList.contains('dark')) {
                darkModeIcon.classList.remove('fa-moon');
                darkModeIcon.classList.add('fa-sun');
                localStorage.setItem('theme', 'dark');
            } else {
                darkModeIcon.classList.remove('fa-sun');
                darkModeIcon.classList.add('fa-moon');
                localStorage.setItem('theme', 'light');
            }
        });

        // Form validation feedback
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            
            // Add validation classes on input
            emailInput.addEventListener('input', function() {
                if (this.validity.valid) {
                    this.classList.remove('border-red-500', 'dark:border-red-500');
                    this.classList.add('border-lime-500', 'dark:border-lime-400');
                }
            });
            
            passwordInput.addEventListener('input', function() {
                if (this.validity.valid) {
                    this.classList.remove('border-red-500', 'dark:border-red-500');
                    this.classList.add('border-lime-500', 'dark:border-lime-400');
                }
            });
            
            // Form submission animation
            form.addEventListener('submit', function(e) {
                const submitBtn = form.querySelector('button[type="submit"]');
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Signing in...';
                submitBtn.disabled = true;
            });
        });
    </script>
</body>
</html>