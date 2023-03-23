<!DOCTYPE html>
<html>
<head>
    <title>Report Izin Sakit</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <h1>{{ $title }}</h1>
    <p>{{ $date }}</p>
    <p>Laporan Sakit Format PDF</p>

    <table class="table table-bordered">
        <tr>
            <th>NIK</th>
            <th>Id Izin</th>
            <th>Jenis Izin</th>
            <th>Dari Tgl</th>
            <th>Sampai Tgl</th>
            <th>Ttl Izin</th>
            <th>Status</th>
        </tr>
        @foreach($getSick as $getRepSick)
            <tr>
                <td>{{ $getRepSick->user_id }}</td>
                <td>{{ $getRepSick->sick_id }}</td>
                <td>{{ $getRepSick->sick_type }}</td>
                <td>{{ $getRepSick->from_date }}</td>
                <td>{{ $getRepSick->to_date }}</td>
                <td>{{ $getRepSick->day }}</td>
                <td>{{ $getRepSick->stat_app3 }}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>
