<!DOCTYPE html>
<html>
<head>
    <title>Tambah Kandidat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f1f1f1;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .container h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="file"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .status {
            margin-bottom: 10px;
        }

        .status label {
            display: inline-block;
            margin-right: 10px;
        }

        .status input[type="radio"] {
            margin-right: 5px;
        }

        button[type="submit"] {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            width: 100%;
        }

        button[type="submit"]:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tambah Kandidat</h1>
        <form action="{{ route('kandidat.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label for="nama">Nama Kandidat:</label>
            <input type="text" name="nama" id="nama" required>

            <label for="partai">Partai:</label>
            <input type="text" name="partai" id="partai" required>

            <label for="foto">Foto:</label>
            <input type="file" name="foto" id="foto" accept="image/jpeg, image/png, image/webp" required>

            <div class="status">
                <label for="status">Status:</label>
                <input type="radio" name="status" value="menang" required> Menang
                <input type="radio" name="status" value="kalah" required> Kalah
            </div>

            <label for="total_vote">Total Voting:</label>
            <input type="number" name="total_vote" id="total_vote" min="0" required>

            <button type="submit">Tambahkan Kandidat</button>
        </form>
    </div>
</body>
</html>