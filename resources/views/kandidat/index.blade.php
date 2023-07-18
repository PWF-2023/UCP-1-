<!DOCTYPE html>
<html>
<head>
    <title>Daftar Kandidat</title>
</head>
<body>
    <h1>Daftar Kandidat</h1>

    <table>
        <thead>
            <tr>
                <th>Nama Kandidat</th>
                <th>Partai</th>
                <th>Foto</th>
                <th>Status</th>
                <th>Total Voting</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kandidat as $item)
                <tr>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->partai }}</td>
                    <td><img src="{{ asset($item->foto) }}" alt="Foto {{ $item->nama }}" width="50"></td>
                    <td class="status {{ $item->status }}">{{ $item->status }}</td>
                    <td>{{ $item->total_vote }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
