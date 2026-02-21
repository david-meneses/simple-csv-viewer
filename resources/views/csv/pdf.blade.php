<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Registros CSV</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #333;
        }
        h1 {
            text-align: center;
            font-size: 16px;
            margin-bottom: 4px;
        }
        .subtitle {
            text-align: center;
            font-size: 10px;
            color: #666;
            margin-bottom: 16px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        thead tr {
            background-color: #2d6a4f;
            color: #fff;
        }
        thead th {
            padding: 7px 8px;
            text-align: left;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        tbody tr:nth-child(even) {
            background-color: #f0f7f4;
        }
        tbody tr:nth-child(odd) {
            background-color: #ffffff;
        }
        tbody td {
            padding: 6px 8px;
            border-bottom: 1px solid #d8e8e1;
        }
        .footer {
            margin-top: 16px;
            text-align: right;
            font-size: 9px;
            color: #999;
        }
    </style>
</head>
<body>
    <h1>Registros CSV</h1>
    <div class="subtitle">Generado el {{ now()->format('d/m/Y H:i') }} &mdash; Total de registros: {{ $rows->count() }}</div>

    <table>
        <thead>
            <tr>
                @foreach($headers as $header)
                    <th>{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($rows as $row)
                <tr>
                    @foreach($headers as $header)
                        <td>{{ $row->data[$header] ?? '' }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">{{ config('app.name') }}</div>
</body>
</html>
