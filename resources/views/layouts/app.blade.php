<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name', 'Laravel'))</title>
    <style>
        :root {
            --bg: #f6f9fc;
            --card: #ffffff;
            --accent: #2563eb;
            --muted: #6b7280;
            --danger: #ef4444;
        }

        * {
            box-sizing: border-box
        }

        body {
            font-family: Inter, system-ui, Segoe UI, Roboto, Arial, Helvetica, sans-serif;
            background: var(--bg);
            margin: 0;
            color: #111
        }

        .container {
            max-width: 900px;
            margin: 48px auto;
            padding: 16px
        }

        .card {
            background: var(--card);
            border-radius: 10px;
            box-shadow: 0 6px 18px rgba(16, 24, 40, 0.06);
            padding: 28px
        }

        .center {
            display: flex;
            align-items: center;
            justify-content: center
        }

        form .field {
            margin-bottom: 12px
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: #111
        }

        input[type=text],
        input[type=email],
        input[type=password] {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #e6e9ef;
            border-radius: 8px;
            background: #fff
        }

        button {
            background: var(--accent);
            color: #fff;
            padding: 10px 14px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600
        }

        .small {
            font-size: 13px;
            color: var(--muted)
        }

        .errors {
            background: #fff5f5;
            border: 1px solid rgba(239, 68, 68, 0.12);
            color: var(--danger);
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 12px
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px
        }

        .brand {
            font-weight: 700;
            color: var(--accent);
            letter-spacing: 0.2px
        }

        @media (max-width:640px) {
            .container {
                margin: 20px;
                padding: 12px
            }
        }

        .spinner {
            display: inline-block;
            width: 18px;
            height: 18px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top-color: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            animation: spin .9s linear infinite;
            vertical-align: middle;
            margin-left: 8px
        }

        @keyframes spin {
            to {
                transform: rotate(360deg)
            }
        }
    </style>
    @stack('styles')
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="topbar">
                <div class="brand">{{ config('app.name', 'Laravel') }}</div>
                <div class="small">@yield('topright')</div>
            </div>

            @yield('content')

        </div>
    </div>

    <script>
        (function() {
            // Prevent double-submit and show spinner
            document.addEventListener('submit', function(e) {
                var form = e.target;
                if (form.dataset.busy) {
                    e.preventDefault();
                    return false;
                }
                var submit = form.querySelector('button[type=submit]');
                if (submit) {
                    form.dataset.busy = '1';
                    var spinner = document.createElement('span');
                    spinner.className = 'spinner';
                    submit.appendChild(spinner);
                }
            }, true);

            // Password match check for forms with data-validate="password-match"
            document.addEventListener('input', function(e) {
                var el = e.target;
                var form = el.form;
                if (!form) return;
                if (form.dataset.validate === 'password-match') {
                    var pw = form.querySelector('input[name="password"]');
                    var cpw = form.querySelector('input[name="password_confirmation"]');
                    if (pw && cpw) {
                        if (cpw.value && pw.value !== cpw.value) {
                            cpw.setCustomValidity('Passwords do not match');
                        } else {
                            cpw.setCustomValidity('');
                        }
                    }
                }
            }, true);

            // Simple client-side email pattern hint
            document.addEventListener('blur', function(e) {
                var el = e.target;
                if (el.name === 'email') {
                    if (el.value && !/^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(el.value)) {
                        el.style.borderColor = '#ef4444';
                    } else {
                        el.style.borderColor = '';
                    }
                }
            }, true);

        })();
    </script>
    @stack('scripts')
</body>

</html>
