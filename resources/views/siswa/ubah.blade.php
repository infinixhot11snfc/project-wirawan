<!DOCTYPE html>
<html>

<head>
    <title>Ubah Data</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #f8d7da, #c3e6cb);
            color: #333;
            padding: 20px;
            margin: 0;
        }

        h1 {
            color: #444;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Form Styles */
        form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }

        label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }

        textarea {
            height: 100px;
            resize: vertical;
        }

        /* Button Styles */
        button {
            padding: 10px 15px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #218838;
        }

        a {
            text-decoration: none;
            padding: 10px 15px;
            background-color: #000;
            color: white;
            border-radius: 4px;
            margin-left: 10px;
            font-size: 16px;
            display: inline-block;
            cursor: pointer;
        }

        a:hover {
            background-color: #5a6268;
        }

        /* Error Message Styles */
        div {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 10px;
            border: 1px solid #f5c6cb;
        }

        /* Container Styles */
        body>div {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <h1>Ubah Data</h1>
    <form action="/siswa/update/{{ $siswa->id }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Name:</label><br>
        <input type="text" name="name" value="{{ old('name', $siswa->name) }}"><br>
        @error('name')
            <div>{{ $message }}</div>
        @enderror

        <label for="email">Email:</label><br>
        <input type="text" name="email" value="{{ old('email', $siswa->email) }}"><br>
        @error('email')
            <div>{{ $message }}</div>
        @enderror

        <label for="address">Address:</label><br>
        <textarea name="address">{{ old('address', $siswa->address) }}</textarea><br>
        @error('address')
            <div>{{ $message }}</div>
        @enderror

        <label for="birth_date">Birth Date (mm-dd-yyyy):</label><br>
        <input type="text" name="birth_date"
            value="{{ old('birth_date', date('m-d-Y', strtotime($siswa->birth_date))) }}"><br>
        @error('birth_date')
            <div>{{ $message }}</div>
        @enderror

        <button type="submit">Simpan Perubahan</button>
        <a href="/aplikasisekolah">Batal</a>
    </form>
</body>

</html>