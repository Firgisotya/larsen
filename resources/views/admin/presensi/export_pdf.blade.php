<!DOCTYPE html>
<html>
<head>
    <style>
        /* CSS styling for PDF */
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Data Presensi</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Karyawan</th>
                <th>Izin</th>
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                <th>Lokasi Masuk</th>
                <th>Jam Pulang</th>
                <th>Lokasi Pulang</th>
                <th>Telat</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach ($absensi as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->karyawan->nama_karyawan }}</td>
                    <td>{{ $item->izin ? $item->izin->jenis_izin : '-' }}</td>
                    <td>{{ $item->tanggal }}</td>
                    <td>{{ $item->jam_masuk }}</td>
                    <td>{{ $item->lokasi_masuk }}</td>
                    <td>{{ $item->jam_pulang }}</td>
                    <td>{{ $item->lokasi_pulang }}</td>
                    <td>{{ $item->telat }}</td>
                </tr>
            @endforeach --}}
        </tbody>
    </table>
</body>
</html>
