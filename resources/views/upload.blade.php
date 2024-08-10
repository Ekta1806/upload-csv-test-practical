<!DOCTYPE html>
<html>

<head>
    <title>Upload CSV</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('logo.webp') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">

        <div class="d-flex justify-content-between align-items-center mb-2">
            <div></div>
            <div>
                <h1 class="text-center mb-4">Upload CSV</h1>
            </div>
            <div>
                <button type="submit" class="btn btn-dark text-right"><a style="text-decoration: none; color:white"
                        href="/employees">View Employees</a></button>
            </div>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Error Message -->
        @if (session('error'))
            <div class="alert alert-danger">
                {!! session('error') !!}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <form action="{{ route('employees.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="csv_file" class="form-label">Choose CSV File</label>
                        <input type="file" class="form-control" id="csv_file" name="csv_file" accept=".csv"
                            required>
                    </div>
                    <button type="submit" class="btn btn-dark">Upload</button>
                </form>

            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>
