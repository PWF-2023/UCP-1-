<?php

// Ambil data kandidat dari database
$kandidat = DB::table('kandidat')->get();
// Get user data for profile editing
$user = Auth::user();
?>
<!DOCTYPE html>
<html data-theme="light">

<head>
    <title>Dashboard</title>
    <style>
    /* Tema Light Mode */
    [data-theme="light"] {
        /* Ganti warna latar belakang, teks, atau elemen lainnya sesuai kebutuhan */
        background-color: #f9f9f9;
        color: #333;
    }

    /* Tema Dark Mode */
    [data-theme="dark"] {
        /* Ganti warna latar belakang, teks, atau elemen lainnya sesuai kebutuhan */
        background-color: #333;
        color: #fff;
    }
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            margin: 0;
        }

        .nav {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
        }

        .nav li {
            margin-right: 10px;
        }

        .nav li a {
            color: #fff;
            text-decoration: none;
            padding: 10px;
            border-radius: 5px;
        }

        .container {
            display: flex;
            margin: 20px;
        }

        .aside {
            flex-basis: 20%;
            background-color: #f1f1f1;
            padding: 20px;
        }

        .aside h2 {
            margin: 0;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            padding: 10px;
            background-color: #f9f9f9;
        }

        .main {
            flex-basis: 75%;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .footer {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        .btn {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 10px;
            display: block;
        }

        .btn:hover {
            background-color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #f1f1f1;
        }

        /* Efek layar */
        .screen-effect {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, #000000 25%, transparent 25%) -50% 0;
            background-size: 200% 200%;
            animation: screen-effect-animation 2s linear infinite;
            pointer-events: none;
            z-index: 9999;
        }

        @keyframes screen-effect-animation {
            0% {
                background-position: 100% 0;
            }
            100% {
                background-position: 0 0;
            }
        }

        /* Gaya tabel kandidat */
        #kandidat-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        #kandidat-table th,
        #kandidat-table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        #kandidat-table th {
            background-color: #f1f1f1;
        }

        .status {
            font-weight: bold;
        }

        .status-win {
            color: green;
        }

        .status-lose {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<script>
    function setSystemPreference(theme) {
        document.documentElement.setAttribute('data-theme', theme);
        localStorage.setItem('theme', theme);
    }

    // Atur tema berdasarkan preferensi yang disimpan pada local storage
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme) {
        setSystemPreference(savedTheme);
    }
</script>

<body>
    <header class="header">
        <h1>E-Voting Dashboard</h1>
        <nav>
            <ul class="nav">
                <li><a href="/">Beranda</a></li>
                <li>
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="btn">Logout</button>
                    </form>
                </li>
            </ul>
        </nav>

    </header>

    <div class="container">
    <aside class="aside">
        <div class="aside-content">
            <h2>Selamat datang, {{ Auth::user()->name }}!</h2>
            <hr>
            @if(Auth::user()->role === 'admin')
                <h3>Manajemen Kandidat</h3>
                <a href="/create" class="btn">Tambah Kandidat</a>
                <h3>Lihat Jumlah Suara Kandidat</h3>
                <a href="/kandidat" class="btn">Tabel Suara Kandidat</a>
                <hr>
            @endif
            <h3>Menu</h3>
            <a href="/kandidat/create" class="btn">Lihat Kandidat</a>
            <a href="/memilih" class="btn">Memilih Kandidat</a>
            <hr>
        </div>
    </aside>
<!-- New: Profile Edit Section -->
<h3>Edit Profil</h3>
<form action="{{ route('profile.edit') }}" method="POST">
    @csrf
    @method('PATCH')
            <label for="name">Nama:</label>
            <input type="text" name="name" id="name" value="{{ $user->name }}" required><br>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="{{ $user->email }}" required><br>

            <!-- Add more profile fields as needed -->

            <button type="submit" class="btn">Simpan Profil</button>
</form>
        <hr>
    <div class="main">
        <table id="kandidat-table">
            <thead>
                <tr>
                    <th>Nama Kandidat</th>
                    <th>Partai</th>
                    <th>Foto</th>
                    <th>Status</th>
                    <th>Total Voting</th>
                    @if (Auth::user()->role === 'admin')
                        <th>Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($kandidat as $item)
                    <tr>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->partai }}</td>
                        <td><img src="{{ $item->foto }}" alt="Foto {{ $item->nama }}" width="50"></td>
                        <td class="status {{ $item->status }}">{{ $item->status }}</td>
                        <td>{{ $item->total_vote }}</td> <!-- Update: Menampilkan total_vote dari tabel -->
                        @if (Auth::user()->role === 'admin')
                            <td>
                                <button class="btn btn-edit">Edit</button>
                                <button class="btn btn-delete">Hapus</button>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>





<footer class="footer">
    &copy; 2023 E-Voting. All rights reserved.
    <div class="system-preference">
        <button class="btn" onclick="setSystemPreference('auto')">Auto Mode</button>
        <button class="btn" onclick="setSystemPreference('dark')">Dark Mode</button>
        <button class="btn" onclick="setSystemPreference('light')">Light Mode</button>
    </div>
</footer>


    <script>
    // Fungsi untuk menangani voting
    function voteCandidate(candidateId) {
        // Lakukan permintaan HTTP (AJAX) untuk melakukan voting pada backend
        // Untuk contoh sederhana, saya akan menggunakan metode fetch() untuk permintaan POST ke URL "/vote"
        fetch('/vote', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}', // Ganti "{{ csrf_token() }}" dengan token CSRF dari Laravel
            },
            body: JSON.stringify({
                candidate_id: candidateId,
            }),
        })
        .then(response => response.json())
        .then(data => {
            // Jika voting berhasil, Anda dapat menonaktifkan tombol Vote
            document.querySelector(`button[data-kandidat-id="${candidateId}"]`).setAttribute("disabled", "true");
            // Juga Anda dapat memperbarui kolom Total Voting pada tabel jika perlu
            // Misalnya: document.querySelector(`tr[data-kandidat-id="${candidateId}"] .total-vote`).innerText = data.total_vote;
        })
        .catch(error => {
            console.error('Terjadi kesalahan saat melakukan voting:', error);
        });
    }

    // Fungsi untuk menampilkan data kandidat
    function displayCandidates() {
        var tableBody = document.querySelector("#kandidat-table tbody");

        candidates.forEach(function(candidate) {
            var row = createCandidateRow(candidate);
            tableBody.appendChild(row);

            // Tambahkan event listener untuk tombol Vote
            var voteBtn = row.querySelector(".btn-vote");
            if (voteBtn) {
                voteBtn.addEventListener("click", function() {
                    var candidateId = voteBtn.getAttribute("data-kandidat-id");
                    voteCandidate(candidateId);
                });
            }
        });
    }
        // Fungsi untuk membuat baris data kandidat
        function createCandidateRow(candidate) {
            var row = document.createElement("tr");
            var statusClass = "";

            if (candidate.status === "menang") {
                statusClass = "status-win";
            } else if (candidate.status === "kalah") {
                statusClass = "status-lose";
            }

            row.innerHTML = `
                <td>${candidate.nama}</td>
                <td>${candidate.partai}</td>
                <td><img src="${candidate.foto}" alt="Foto ${candidate.nama}" width="50"></td>
                <td class="status ${statusClass}">${candidate.status}</td>
                <?php if (Auth::user()->role === 'admin'): ?>
                    <td>
                        <button class="btn btn-edit">Edit</button>
                        <button class="btn btn-delete">Hapus</button>
                    </td>
                <?php endif; ?>
            `;

            return row;
        }

        // Fungsi untuk menampilkan data kandidat
        function displayCandidates() {
            var tableBody = document.querySelector("#kandidat-table tbody");

            candidates.forEach(function(candidate) {
                var row = createCandidateRow(candidate);
                tableBody.appendChild(row);
            });
        }

        // Panggil fungsi untuk menampilkan data kandidat
        displayCandidates();
    </script>
</body>
</html>
