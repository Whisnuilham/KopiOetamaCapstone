<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExcelController extends Controller
{
    public function upload(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'excelFile' => 'required|mimes:xls,xlsx|max:10240', // Maximum 10MB file size
        ]);

        // Process the uploaded file
        if ($request->hasFile('excelFile')) {
            $file = $request->file('excelFile');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('excel-files', $fileName); // Store in storage/app/excel-files

            // Perform additional operations like importing data from Excel

            return redirect()->back()->with('success', 'Excel file uploaded successfully.');
        }

        return redirect()->back()->with('error', 'Failed to upload Excel file.');
    }
}
