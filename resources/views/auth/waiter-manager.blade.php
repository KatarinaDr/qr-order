<!DOCTYPE html>
<html>
<head>
    <title>Uloge</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, black, #4e52c8);
            display: flex;
            justify-content: center;
            align-items: start;
            height: 100vh;
            margin-top: 100px;
        }
        .success-container {
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 80%;
            text-align: center;
        }
        h2 {
            color: #16a34a;
            margin-bottom: 1rem;
        }
        p {
            color: black;
            margin-bottom: 1.5rem;
            font-size: 35px;
        }
        a {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        button {
            background-color: #4e52c8;
            color: white;
            border: none;
            padding: 12px 24px;
            font-size: 2rem;
            width: 200px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        button:hover {
            background-color: #3b46a1;
            transform: translateY(-1px);
        }

    </style>
</head>
<body>
<div class="success-container">
    <p style="color: black">Izaberi ulogu</p>

    <p>
        <a href="{{ route('register.manager') }}">
            <button type="button">Menadžer</button>
        </a>
    </p>

    <p>
        <a href="{{ route('login') }}">
            <button type="button">Konobar</button>
        </a>
    </p>
</div>

</body>
</html>
