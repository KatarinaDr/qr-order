<!DOCTYPE html>
<html>
<head>
    <title>Uspješna Registracija</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
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
            color: #333;
            margin-bottom: 1.5rem;
            font-size: 30px;
        }
        .license-key {
            font-weight: bold;
            color: #1d4ed8;
        }
        a {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            background-color: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        a:hover {
            background-color: #1d4ed8;
        }

        @media (max-width: 768px) {
            p {
                font-size: 50px;
            }
        }

    </style>
</head>
<body>
<div class="success-container">
    <p style="color: green">Uspješno ste se registrovali!</p>
    <p>Vaš licencni ključ je: <span class="license-key">{{ $licenseKey }}</span></p>
    <p>Proslijedite ovaj ključ administratoru.</p>
</div>
</body>
</html>
