<!DOCTYPE html>
<html>

<head>
    <title>Employees List</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sort-arrow {
            display: inline-block;
            margin-left: 5px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Employees List</h1>

        <!-- Search Form -->
        <form method="GET" action="{{ route('employees.index') }}" class="d-flex mb-4">
            <input type="text" name="search" class="form-control me-2" placeholder="Search employees..."
                value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <!-- Employees Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>
                            <a
                                href="{{ route('employees.index', ['sort' => 'EmployeeName', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc', 'search' => request('search')]) }}">
                                Employee Name
                                @if (request('sort') === 'EmployeeName')
                                    @if (request('direction') === 'asc')
                                        <span class="sort-arrow">&uarr;</span>
                                    @else
                                        <span class="sort-arrow">&darr;</span>
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th>
                            <a
                                href="{{ route('employees.index', ['sort' => 'Email', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc', 'search' => request('search')]) }}">
                                Email
                                @if (request('sort') === 'Email')
                                    @if (request('direction') === 'asc')
                                        <span class="sort-arrow">&uarr;</span>
                                    @else
                                        <span class="sort-arrow">&darr;</span>
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th>
                            <a
                                href="{{ route('employees.index', ['sort' => 'Number', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc', 'search' => request('search')]) }}">
                                Number
                                @if (request('sort') === 'Number')
                                    @if (request('direction') === 'asc')
                                        <span class="sort-arrow">&uarr;</span>
                                    @else
                                        <span class="sort-arrow">&darr;</span>
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th>
                            <a
                                href="{{ route('employees.index', ['sort' => 'Designation', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc', 'search' => request('search')]) }}">
                                Designation
                                @if (request('sort') === 'Designation')
                                    @if (request('direction') === 'asc')
                                        <span class="sort-arrow">&uarr;</span>
                                    @else
                                        <span class="sort-arrow">&darr;</span>
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th>
                            <a
                                href="{{ route('employees.index', ['sort' => 'Address', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc', 'search' => request('search')]) }}">
                                Address
                                @if (request('sort') === 'Address')
                                    @if (request('direction') === 'asc')
                                        <span class="sort-arrow">&uarr;</span>
                                    @else
                                        <span class="sort-arrow">&darr;</span>
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th>
                            <a
                                href="{{ route('employees.index', ['sort' => 'created_at', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc', 'search' => request('search')]) }}">
                                Created At
                                @if (request('sort') === 'created_at')
                                    @if (request('direction') === 'asc')
                                        <span class="sort-arrow">&uarr;</span>
                                    @else
                                        <span class="sort-arrow">&darr;</span>
                                    @endif
                                @endif
                            </a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($employees as $employee)
                        <tr>
                            <td>{{ $employee->EmployeeName }}</td>
                            <td>{{ $employee->Email }}</td>
                            <td>{{ $employee->Number }}</td>
                            <td>{{ $employee->Designation }}</td>
                            <td>{{ $employee->Address }}</td>
                            <td>{{ $employee->created_at }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No employees found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        <div class="d-flex justify-content-center">
            {{ $employees->appends(request()->except('page'))->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <!-- Bootstrap JS and dependencies (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>
