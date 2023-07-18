<!DOCTYPE html>
<html>
<head>
    <title>Sukses Pemilihan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold mb-4">Sukses Pemilihan</h1>
        <p class="mb-2">Anda telah berhasil memilih kandidat berikut:</p>
        <p class="mb-2">Nama Kandidat: {{ $selectedKandidat->nama }}</p>
        <p class="mb-4">Partai: {{ $selectedKandidat->partai }}</p>
        <!-- Tambahkan informasi lain mengenai kandidat terpilih -->
        <a href="/pemilihan" class="bg-blue-500 text-white py-2 px-4 rounded-md">Kembali</a>
    </div>
</body>
</html>
