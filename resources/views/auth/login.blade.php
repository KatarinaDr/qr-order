<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <style>
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

        .login-container {
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

<div class="login-container">
    <h2>Log In</h2>

    <form method="POST" action="{{ route('login.submit') }}">
        @csrf
        <div>
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required>
            @error('email')
            <div style="color: red">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="password">Lozinka:</label><br>
            <input type="password" id="password" name="password" required>
            @error('password')
            <div style="color: red">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-top: 15px;">
            <button type="submit">Prijavi se</button>
        </div>
    </form>

    <div style="margin-top: 15px;">
        <form method="GET" action="{{ route('register.waiter') }}">
            <button type="submit">Registruj se</button>
        </form>
    </div>
</div>


</body>
</html>
