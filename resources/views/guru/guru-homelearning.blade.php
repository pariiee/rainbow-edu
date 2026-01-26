{{-- resources/views/admin.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Page</title>
    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: #0f172a;
            font-family: Arial, sans-serif;
            color: #38bdf8;
        }

        h1 {
            font-size: 48px;
            letter-spacing: 2px;
            margin-bottom: 40px;
        }

        form button {
            padding: 10px 20px;
            font-size: 18px;
            border: none;
            border-radius: 8px;
            background-color: #ef4444;
            color: white;
            cursor: pointer;
            transition: background 0.3s;
        }

        form button:hover {
            background-color: #dc2626;
        }
    </style>
</head>
<body>
    <h1>INI PAGE GURU HOMELEARNING</h1>

    {{-- Logout form Laravel Breeze --}}
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
