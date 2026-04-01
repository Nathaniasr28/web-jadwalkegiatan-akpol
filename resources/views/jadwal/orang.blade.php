<!DOCTYPE html>
<html>
<head>
    <title>Jadwal Piket</title>

    <style>
        body {
            margin: 0;
            font-family: Segoe UI, Arial;
            background: #e6e6e6;
        }

        .container {
            width: 1000px;
            margin: 40px auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .date {
            font-size: 14px;
            color: #333;
        }

        .nama {
            font-size: 42px;
            font-weight: bold;
            font-style: italic;
        }

        .title {
            background: #2f2f2f;
            color: white;
            padding: 18px 40px;
            font-size: 24px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.2);
        }

        .form-tanggal {
            margin-top: 20px;
            margin-bottom: 25px;
        }

        input[type="date"] {
            padding: 8px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        .schedule-box {
            background: white;
            padding: 25px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 15px;
        }

        th {
            background: #2f2f2f;
            color: white;
            padding: 14px;
        }

        tr {
            background: white;
            box-shadow: 0 4px 10px rgba(0,0,0,0.12);
        }

        td {
            padding: 12px;
            text-align: center;
        }

        input[type="text"] {
            width: 90%;
            padding: 8px;
            border-radius: 6px;
            border: 1px solid #ddd;
        }

        .btn {
            padding: 10px 18px;
            background: #2f2f2f;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 10px;
        }

        .btn:hover {
            background: #444;
        }

        .add-btn {
            margin-bottom: 15px;
        }

        .status-box {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .checkmark {
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: #ddd;
            display: inline-block;
        }

        .status-box input {
            display: none;
        }

        .status-box input:checked + .checkmark {
            background: #2ecc71;
            box-shadow: 0 0 6px rgba(46,204,113,0.8);
        }

        .hapus-btn {
            background: #ff4b4b;
            color: white;
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
        }

        .hapus-btn:hover {
            background: #d93636;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">

        <div>
            <div class="date">
                DATE: {{ date('d/m/Y', strtotime($tanggal)) }}
            </div>

            <div class="nama">
                {{ $nama }}
            </div>

            <!-- FOTO PROFIL -->
            <form 
                id="formFoto" 
                action="/upload-foto" 
                method="POST" 
                enctype="multipart/form-data"
            >
                @csrf

                <label for="fotoInput" style="cursor:pointer;">
                    <img
                        src="{{ session('foto') ? asset('foto/'.session('foto')) : 'https://via.placeholder.com/120' }}"
                        style="width:120px;height:120px;border-radius:50%;object-fit:cover;margin-top:10px;"
                    >
                </label>

                <input
                    type="file"
                    id="fotoInput"
                    name="foto"
                    style="display:none"
                >
            </form>
        </div>

        <div class="title">
            JADWAL PIKET HARIAN
        </div>

    </div>

    <div class="form-tanggal">
        <form method="GET">
            <label>Pilih Tanggal :</label>

            <input 
                type="date" 
                name="tanggal" 
                value="{{ $tanggal }}"
            >

            <button class="btn">Lihat</button>
        </form>
    </div>

    <form method="POST" action="/simpan-jadwal">
        @csrf

        <input type="hidden" name="nama" value="{{ strtolower($nama) }}">
        <input type="hidden" name="tanggal" value="{{ $tanggal }}">

        <div class="schedule-box">

            <button 
                type="button" 
                class="btn add-btn" 
                onclick="tambahRow()"
            >
                + Tambah Slot Jadwal
            </button>

            <table id="jadwalTable">

                <tr>
                    <th>NO</th>
                    <th>JAM</th>
                    <th>TUGAS</th>
                    <th>TEMPAT</th>
                    <th>STATUS</th>
                    <th>AKSI</th>
                </tr>

                @foreach($jadwal as $i => $j)
                <tr>
                    <td>{{ $i + 1 }}</td>

                    <td>
                        <input type="text" name="jam[]" value="{{ $j->jam }}">
                    </td>

                    <td>
                        <input type="text" name="tugas[]" value="{{ $j->tugas }}">
                    </td>

                    <td>
                        <input type="text" name="tempat[]" value="{{ $j->tempat }}">
                    </td>

                    <td>
                        <label class="status-box">
                            <input 
                                type="checkbox" 
                                name="status[]" 
                                {{ $j->status ? 'checked' : '' }}
                            >
                            <span class="checkmark"></span>
                        </label>
                    </td>

                    <td>
                        <a 
                            href="{{ url('/hapus-jadwal/'.$j->id) }}" 
                            class="hapus-btn"
                        >
                            Hapus
                        </a>
                    </td>
                </tr>
                @endforeach

                <tr>
                    <td>+</td>

                    <td>
                        <input type="text" name="jam[]" placeholder="07:00">
                    </td>

                    <td>
                        <input type="text" name="tugas[]" placeholder="Isi tugas">
                    </td>

                    <td>
                        <input type="text" name="tempat[]" placeholder="Lokasi">
                    </td>

                    <td>
                        <label class="status-box">
                            <input type="checkbox" name="status[]">
                            <span class="checkmark"></span>
                        </label>
                    </td>

                    <td></td>
                </tr>

            </table>

        </div>

        <div style="display:flex; justify-content:flex-end; gap:10px; margin-top:15px;">
            <a href="/" class="btn">Home</a>
            <button class="btn" type="submit">SIMPAN JADWAL</button>
        </div>

    </form>

</div>

<script>
    document.getElementById("fotoInput").addEventListener("change", function () {
        document.getElementById("formFoto").submit();
    });

    function tambahRow() {
        let table = document.getElementById("jadwalTable");

        let row = table.insertRow(table.rows.length);

        row.innerHTML = `
            <td>+</td>
            <td><input type="text" name="jam[]" placeholder="07:00"></td>
            <td><input type="text" name="tugas[]" placeholder="Isi tugas"></td>
            <td><input type="text" name="tempat[]" placeholder="Lokasi"></td>
            <td>
                <label class="status-box">
                    <input type="checkbox" name="status[]">
                    <span class="checkmark"></span>
                </label>
            </td>
            <td></td>
        `;
    }
</script>

</body>
</html>