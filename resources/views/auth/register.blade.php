<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registracija</title>
    <style>
        /* Global reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, black, #4e52c8);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }

        /* Register container styling */
        .register-container {
            background-color: #ffffff;
            padding: 2.5rem;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 420px;
            transition: all 0.3s ease-in-out;
            margin: 30px;
        }

        h2 {
            text-align: center;
            font-size: 2rem;
            color: #4e52c8;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        /* Form Group styling */
        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: #555;
            font-size: 1rem;
            font-weight: 500;
        }

        input {
            width: 100%;
            padding: 0.9rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease-in-out;
        }

        input:focus {
            outline: none;
            border-color: #4e52c8;
            box-shadow: 0 0 5px rgba(78, 82, 200, 0.3);
        }

        .error {
            color: #e74c3c;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        button {
            width: 100%;
            padding: 1rem;
            background-color: #4e52c8;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        button:hover {
            background-color: #3b46a1;
        }

        /* Forgot password link */
        .forgot-password {
            text-align: center;
            margin-top: 1.25rem;
        }

        .forgot-password a {
            color: #4e52c8;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease-in-out;
        }

        .forgot-password a:hover {
            color: #3b46a1;
        }

        /* Responsive design for mobile screens */
        @media (max-width: 480px) {
            .register-container {
                padding: 1.5rem;
            }

            h2 {
                font-size: 1.6rem;
            }

            button {
                font-size: 1rem;
            }
        }

    </style>
</head>
<body>

<div class="register-container">
    <h2>Registracija</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <label for="name">Ime</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
            @error('name')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required>
            @error('email')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="license_key">Licencni Ključ</label>
            <input id="license_key" type="text" name="license_key" value="{{ $licenseKey }}" disabled>
            <input type="hidden" name="license_key" value="{{ $licenseKey }}">
            @error('license_key')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Lozinka</label>
            <input id="password" type="password" name="password" required>
            @error('password')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Potvrda Lozinke</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required>
        </div>

        <button type="submit">Registruj se</button>
    </form>
</div>

</body>
</html>
