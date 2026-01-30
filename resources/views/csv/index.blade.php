<!DOCTYPE html>
<html>
<head>
    <title>CSV Import</title>
</head>
<body>

<h1>Importar archivo CSV</h1>
<form method="POST" action="{{ route('csv.upload') }}" enctype="multipart/form-data">
    @csrf
    <input type="file" name="csv_file" required>
    <button type="submit">Importar CSV</button>
</form>

@if($rows->count())
<p>
    <form method="GET" action="{{ route('csv.latest-download') }}">
        <button type="submit">Descargar último registro TXT(JSON)</button>
    </form>
</p>
<table border="1">
    <thead>
        <tr>
            @foreach(array_keys($rows->first()->data) as $col)
                <th>{{ $col }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($rows as $row)
        <tr>
            @foreach($row->data as $value)
                <td>{{ $value }}</td>
            @endforeach
        </tr>
        @endforeach
    </tbody>
</table>
@endif

</body>
</html>
