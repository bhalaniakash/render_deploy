<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name', 'Finance Manager'))</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#6366f1',
                        'primary-dark': '#4f46e5',
                        secondary: '#f0f4ff',
                        success: '#10b981',
                        warning: '#f59e0b',
                        danger: '#ef4444',
                        'light-blue': '#e0f2fe',
                        'light-purple': '#f3e8ff',
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-up': 'slideUp 0.3s ease-out',
                        'bounce-in': 'bounceIn 0.6s ease-out',
                    }
                }
            }
        }
    </script>
    
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #f0f4ff;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --muted: #6b7280;
            --light: #f8fafc;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background: linear-gradient(135deg, #f0f4ff 0%, #e6f0ff 100%);
            margin: 0;
            color: #1e293b;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .gradient-bg {
            background: linear-gradient(135deg, var(--primary) 0%, #8b5cf6 100%);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(99, 102, 241, 0.15);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(99, 102, 241, 0.3);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes bounceIn {
            0% { opacity: 0; transform: scale(0.8); }
            50% { opacity: 1; transform: scale(1.05); }
            100% { opacity: 1; transform: scale(1); }
        }

        .floating-shapes {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
            pointer-events: none;
        }

        .shape {
            position: absolute;
            opacity: 0.1;
            border-radius: 50%;
            animation: float 20s infinite linear;
        }

        .shape-1 {
            width: 120px;
            height: 120px;
            background: var(--primary);
            top: 10%;
            left: 5%;
        }

        .shape-2 {
            width: 80px;
            height: 80px;
            background: var(--success);
            top: 70%;
            right: 10%;
            animation-delay: -5s;
        }

        .shape-3 {
            width: 150px;
            height: 150px;
            background: var(--warning);
            bottom: 10%;
            left: 20%;
            animation-delay: -10s;
        }

        @keyframes float {
            0% { transform: translate(0, 0) rotate(0deg); }
            25% { transform: translate(30px, 30px) rotate(90deg); }
            50% { transform: translate(0, 60px) rotate(180deg); }
            75% { transform: translate(-30px, 30px) rotate(270deg); }
            100% { transform: translate(0, 0) rotate(360deg); }
        }

        .input-focus:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            transform: translateY(-1px);
        }

        .table-row-hover:hover {
            background: rgba(99, 102, 241, 0.05);
            transform: translateX(5px);
        }

        .stats-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8faff 100%);
            border-left: 4px solid var(--primary);
        }
    </style>
    @stack('styles')
</head>

<body class="min-h-screen">
    <!-- Floating Background Shapes -->
    <div class="floating-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
    </div>

    <!-- Main Container -->
    <div class="min-h-screen flex items-center justify-center py-8 px-4">
        <div class="w-full max-w-6xl">
            <!-- Header -->
            <div class="text-center mb-8 animate-fade-in">
                <div class="flex items-center justify-center mb-4">
                    <div class="w-12 h-12 rounded-xl gradient-bg flex items-center justify-center mr-3">
                        <i class="fas fa-chart-line text-white text-xl"></i>
                    </div>
                    <h1 class="text-3xl font-bold text-gray-800">{{ config('app.name', 'FinanceFlow') }}</h1>
                </div>
                <p class="text-gray-600">@yield('subtitle', 'Manage your finances with ease')</p>
            </div>

            <!-- Main Content Card -->
            <div class="glass-effect rounded-2xl shadow-xl overflow-hidden animate-slide-up">
                <!-- Top Bar -->
                <div class="gradient-bg px-6 py-4 flex justify-between items-center">
                    <div class="flex items-center">
                        <i class="fas fa-wallet text-white text-lg mr-2"></i>
                        <span class="text-white font-semibold text-lg">@yield('page-title')</span>
                    </div>
                    <div class="text-white/90">
                        @yield('topright')
                        @auth
                            <div class="flex items-center space-x-4">
                                <span class="text-sm">Welcome, {{ Auth::user()->name }}</span>
                                <form method="POST" action="{{ route('logout') }}" class="inline">
                                    @csrf
                                    <button type="submit" class="text-sm bg-white/20 hover:bg-white/30 px-3 py-1 rounded-lg transition-colors">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        @endauth
                    </div>
                </div>

                <!-- Content -->
                <div class="p-6 bg-white/50">
                    @yield('content')
                </div>
            </div>

            <!-- Footer -->
            <div class="text-center mt-6 text-gray-600 text-sm">
                <p>&copy; 2024 {{ config('app.name', 'FinanceFlow') }. All rights reserved.</p>
            </div>
        </div>
    </div>

    <script>
        // Enhanced form handling with animations
        document.addEventListener('DOMContentLoaded', function() {
            // Add loading states to buttons
            document.addEventListener('submit', function(e) {
                const form = e.target;
                const button = form.querySelector('button[type="submit"]');
                
                if (button && !form.dataset.processing) {
                    form.dataset.processing = 'true';
                    const originalText = button.innerHTML;
                    button.innerHTML = `
                        <i class="fas fa-spinner fa-spin mr-2"></i>
                        Processing...
                    `;
                    button.disabled = true;
                    
                    // Revert after 5 seconds if still processing (fallback)
                    setTimeout(() => {
                        if (form.dataset.processing) {
                            button.innerHTML = originalText;
                            button.disabled = false;
                            delete form.dataset.processing;
                        }
                    }, 5000);
                }
            });

            // Enhanced input validation
            const inputs = document.querySelectorAll('input, select');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('ring-2', 'ring-primary', 'ring-opacity-20');
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('ring-2', 'ring-primary', 'ring-opacity-20');
                    this.classList.remove('border-red-500', 'border-green-500');
                    
                    if (this.value) {
                        if (this.checkValidity()) {
                            this.classList.add('border-green-500');
                        } else {
                            this.classList.add('border-red-500');
                        }
                    }
                });
            });

            // Password match validation
            document.addEventListener('input', function(e) {
                const form = e.target.form;
                if (form && form.dataset.validate === 'password-match') {
                    const password = form.querySelector('input[name="password"]');
                    const confirm = form.querySelector('input[name="password_confirmation"]');
                    
                    if (password && confirm && confirm.value) {
                        if (password.value !== confirm.value) {
                            confirm.setCustomValidity('Passwords do not match');
                            confirm.classList.add('border-red-500');
                            confirm.classList.remove('border-green-500');
                        } else {
                            confirm.setCustomValidity('');
                            confirm.classList.remove('border-red-500');
                            confirm.classList.add('border-green-500');
                        }
                    }
                }
            });

            // Add animations to table rows
            const tableRows = document.querySelectorAll('.finance-row');
            tableRows.forEach((row, index) => {
                row.style.animationDelay = `${index * 0.1}s`;
                row.classList.add('animate-fade-in');
            });

            // Toast notifications
            window.showToast = function(message, type = 'success') {
                const toast = document.createElement('div');
                toast.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg text-white animate-bounce-in ${
                    type === 'success' ? 'bg-green-500' : 
                    type === 'error' ? 'bg-red-500' : 'bg-blue-500'
                }`;
                toast.innerHTML = `
                    <div class="flex items-center">
                        <i class="fas fa-${type === 'success' ? 'check' : 'exclamation'}-circle mr-2"></i>
                        <span>${message}</span>
                    </div>
                `;
                document.body.appendChild(toast);
                
                setTimeout(() => {
                    toast.remove();
                }, 3000);
            };

            // Check for success messages in URL
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('success')) {
                showToast(urlParams.get('success'), 'success');
            }
        });
    </script>
    @stack('scripts')
</body>

</html>