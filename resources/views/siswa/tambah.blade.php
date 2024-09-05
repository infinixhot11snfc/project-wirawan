<!DOCTYPE html>
<html>

<head>
    <title>Tambah Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #f8d7da, #c3e6cb);
            color: #333;
            padding: 20px;
        }

        h1 {
            color: #444;
        }

        form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: auto;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }

        textarea {
            height: 100px;
            resize: vertical;
        }

        button {
            padding: 10px 15px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button[type="button"] {
            background-color: #000;
            margin-left: 10px;
        }

        button:hover {
            opacity: 0.9;
        }

        a {
            text-decoration: none;
        }

        div {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
        }

        ul {
            margin: 0;
            padding: 0;
            list-style-type: none;
        }
    </style>
</head>

<body>
    <center>
        <h1>Tambah Data</h1>
    </center>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ url('/siswa/simpan') }}" method="POST" onsubmit="return validateEmailInput()">
        @csrf
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="{{ old('name') }}"
            onkeypress="return validateNameInput(event)"><br><br>

        <label for="email">Email:</label><br>
        <input type="text" id="email" name="email" value="{{ old('email') }}"><br><br>

        <label for="address">Address:</label><br>
        <textarea id="address" name="address">{{ old('address') }}</textarea><br><br>

        <label for="birth_date">Birth Date (mm-dd-yyyy):</label><br>
        <input type="text" id="birth_date" name="birth_date" value="{{ old('birth_date') }}" placeholder="mm-dd-yyyy"
            onblur="validateDateInput(event)"><br><br>

        <button type="submit">Simpan Data</button>
        <a href="{{ url('/aplikasisekolah') }}">
            <button type="button">Batal</button>
        </a>
    </form>
</body>

</html>