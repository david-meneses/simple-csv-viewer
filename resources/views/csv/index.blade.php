<!DOCTYPE html>
<html>
<head>
    <title>CSV Import</title>
</head>
<body>

<h1>Import CSV File</h1>
<form method="POST" action="{{ route('csv.upload') }}" enctype="multipart/form-data">
    @csrf
    <input type="file" name="csv_file" required accept=".csv">
    <br>
    <button type="submit">Submit</button>
</form>

@if($rows->count())
<p>
    <form method="GET" action="{{ route('csv.latest-download') }}">
        <button type="submit">Download Latest Record TXT(JSON)</button>
    </form>
</p>
<p>
    <form method="GET" action="{{ route('csv.latest-download', ['format' => 'xml']) }}">
        <button type="submit">Download Latest Record TXT(XML)</button>
    </form>
</p>
<p>
    <a href="{{ route('csv.download-pdf') }}">
        <button type="button">Export PDF</button>
    </a>
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
