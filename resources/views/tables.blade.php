<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Odaberi sto</title>

    <style>
        body {
            background: #cccccc;
            text-align: center;
        }

        .tables {
            font-family: Arial, sans-serif;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            max-width: 520px;
            margin: 50px auto;
        }

        .table {
            background-color: red;
            border-radius: 20px;
            width: 100px;
            height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
        }

        .table a {
            color: black;
            text-decoration: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            width: 100%;
            height: 100%;
        }


        h1 {
            color: black;
        }

    </style>
</head>
<body>
<h1>Odaberi sto</h1>

<div class="tables">
    @foreach($tables as $table)
        <div class="table">
            <a href="{{ $table->web_page }}">
                <img src="{{ asset('images/table.png') }}" style="height: 50px; width: 50px;">
                Sto {{ $table->number }}
            </a>
        </div>
    @endforeach
</div>

</body>
</html>
