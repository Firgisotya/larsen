
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Karyawan Akses</title>
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
    <h1>Karyawan Information</h1>
    <table>
        <thead>
            <tr>
                <th>NIK</th>
                <th>Nama Karyawan</th>
                <th>Email</th>
                <th>Username</th>
                <th>Password</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td>{{ $user->karyawan->nik }}</td>
                    <td>{{ $user->karyawan->nama_karyawan }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->secret }}</td>
                </tr>
        </tbody>
    </table>
</body>
</html>
