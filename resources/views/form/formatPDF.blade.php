<!DOCTYPE html>
<html>
<head>
    <title>Trial Report PDF Format</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <h1>{{ $title }}</h1>
    <p>{{ $date }}</p>
    <p>Laporan Cuti Hasil Trial Format PDF</p>

    <table class="table table-bordered">
        <tr>
            <th>NIK</th>
            <th>Jenis Izin</th>
            <th>Dari Tgl</th>
            <th>Sampai Tgl</th>
            <th>Hari Izin</th>
            <th>Alasan Izin</th>
            <th>Status</th>
        </tr>
        @foreach($getCuti as $getRepCuti)
            <tr>
                <td>{{ $getRepCuti->user_id }}</td>
                <td>{{ $getRepCuti->leave_type }}</td>
                <td>{{ $getRepCuti->from_date }}</td>
                <td>{{ $getRepCuti->to_date }}</td>
                <td>{{ $getRepCuti->day }}</td>
                <td>{{ $getRepCuti->leave_reason }}</td>
                <td>{{ $getRepCuti->data_status }}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>
