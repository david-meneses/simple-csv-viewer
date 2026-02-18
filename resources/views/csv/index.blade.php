<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSV Import</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm">
                <div class="card-body p-4 p-md-5">
                    <h1 class="h3 mb-4">Import CSV File</h1>

                    <form method="POST" action="{{ route('csv.upload') }}" enctype="multipart/form-data" class="mb-4">
                        @csrf
                        <div class="row g-2 align-items-center">
                            <div class="col-md">
                                <input class="form-control" type="file" name="csv_file" required accept=".csv">
                            </div>
                            <div class="col-md-auto">
                                <button class="btn btn-primary w-100" type="submit">Upload CSV</button>
                            </div>
                        </div>
                    </form>

                    @if($rows->count())
                        <div class="d-flex flex-wrap gap-2">
                            <form method="GET" action="{{ route('csv.latest-download') }}">
                                <button class="btn btn-outline-primary" type="submit">Download Latest TXT (JSON)</button>
                            </form>
                            <form method="GET" action="{{ route('csv.latest-download', ['format' => 'xml']) }}">
                                <button class="btn btn-outline-success" type="submit">Download Latest TXT (XML)</button>
                            </form>
                            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#csvTableModal">
                                Show Table
                            </button>
                        </div>
                    @else
                        <p class="text-secondary mb-0">No records yet. Upload a CSV to see available actions.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@if($rows->count())
<div class="modal fade" id="csvTableModal" tabindex="-1" aria-labelledby="csvTableModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="csvTableModalLabel">CSV Records</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-light">
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
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
