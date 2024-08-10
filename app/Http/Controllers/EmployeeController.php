<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    public function uploadForm()
    {
        return view('upload');
    }

    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'csv_file' => 'required|mimes:csv,txt'
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'Invalid file type. Please upload a CSV file.');
        }

        $file = $request->file('csv_file');

        if (($handle = fopen($file, 'r')) !== false) {
            $header = fgetcsv($handle, 1000, ',');
            $requiredHeader = ['EmployeeName', 'Email', 'Number', 'Designation', 'Address'];

            if ($header !== $requiredHeader) {
                return back()->with('error', 'Invalid CSV header. Required: ' . implode(',', $requiredHeader));
            }

            $inserted = 0;
            $skipped = 0;
            $errors = [];

            while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                if (count($row) < 5) {
                    $errors[] = "Incomplete row: " . implode(',', $row);
                    continue;
                }

                $employeeData = [
                    'EmployeeName' => $row[0],
                    'Email' => $row[1],
                    'Number' => $row[2],
                    'Designation' => $row[3],
                    'Address' => $row[4],
                ];

                $validator = Validator::make($employeeData, [
                    'EmployeeName' => 'required|string|max:255',
                    'Email' => 'required|email|unique:employees,Email',
                    'Number' => 'required|string|max:15',
                    'Designation' => 'required|string|max:255',
                    'Address' => 'required|string|max:255',
                ]);

                if ($validator->fails()) {
                    $errors[] = "Validation failed for row: " . implode(',', $row);
                    $skipped++;
                    continue;
                }

                try {
                    Employee::create($employeeData);
                    $inserted++;
                } catch (\Exception $e) {
                    Log::error("Error inserting row: " . $e->getMessage());
                    $errors[] = "Database error for row: " . implode(',', $row);
                    $skipped++;
                }
            }
            fclose($handle);

            if ($inserted > 0) {
                return back()->with('success', "CSV processed: $inserted rows inserted, $skipped rows skipped.")
                    ->with('error', implode('<br>', $errors));
            } else {
                return back()->with('error', 'Vadidation failed or Mail has already been used.');
            }
        }

        return back()->with('error', 'Failed to open the file.');
    }

    public function index(Request $request)
    {
        $employees = Employee::query();

        if ($request->filled('search')) {
            $employees->where('EmployeeName', 'like', '%' . $request->search . '%')
                ->orWhere('Email', 'like', '%' . $request->search . '%')
                ->orWhere('Number', 'like', '%' . $request->search . '%')
                ->orWhere('Designation', 'like', '%' . $request->search . '%')
                ->orWhere('Address', 'like', '%' . $request->search . '%');
        }

        $sort = $request->input('sort', 'created_at');
        $direction = $request->input('direction', 'desc');

        $employees = $employees->orderBy($sort, $direction)->paginate(10);

        return view('employees.index', compact('employees'));
    }
}
