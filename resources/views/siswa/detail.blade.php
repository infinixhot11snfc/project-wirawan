<!DOCTYPE html>
<html>
<head>
    <title>Detail Siswa</title>
    <link rel="stylesheet" href="style.css">
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
    margin-bottom: 20px;
}

p {
    font-size: 18px;
    margin: 10px 0;
}

/* Link Styles */
a {
    display: inline-block;
    margin-top: 20px;
    padding: 10px 15px;
    background-color: #007bff;
    color: white;
    text-decoration: none;
    border-radius: 4px;
    font-size: 16px;
    text-align: center;
}

a:hover {
    background-color: #0056b3;
}

/* Container Styles */
body > div {
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
    <h1>Detail Siswa</h1>
    <p>ID: {{ $siswa->id }}</p>
    <p>Nama: {{ $siswa->name }}</p>
    <p>Email: {{ $siswa->email }}</p>
    <p>Alamat: {{ $siswa->address }}</p>
    <p>Tanggal Lahir: {{ $siswa->birth_date }}</p>
    <a href="/aplikasisekolah">Kembali</a>
</body>
</html>
