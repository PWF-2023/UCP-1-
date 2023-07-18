<!DOCTYPE html>
<html>
<head>
    <title>Pemilihan Kandidat</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold mb-4">Pemilihan Kandidat</h1>
        <form action="{{ route('pemilihan.vote', $item->id) }}" method="POST" class="max-w-md">
            @csrf
            <label for="pilihan_kandidat" class="block mb-2">Pilih Kandidat:</label>
            <select name="pilihan_kandidat" id="pilihan_kandidat" class="w-full py-2 px-4 border rounded-md">
                @foreach ($kandidat as $item)
                    <option value="{{ $item->id }}">{{ $item->nama }} (Partai: {{ $item->partai }})</option>
                @endforeach
            </select>
            <button type="submit" class="mt-4 bg-blue-500 text-white py-2 px-4 rounded-md">Pilih</button>
        </form>
    </div>
</body>
</html>
