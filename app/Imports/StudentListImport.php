<?php

namespace App\Imports;

use App\Models\StudentList;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class StudentListImport implements ToModel, WithStartRow
{
    public function startRow(): int
    {
        return 4; // row 4 magsisimula (same sa preview mo)
    }

    public function model(array $row)
    {
        return new StudentList([
            'reg_number'      => $row['reg_#'] ?? null,
            'student_number'  => $row['student_#'] ?? null,
            'student_name'    => $row['student_name'] ?? null,
            'barangay'        => $row['barangay'] ?? null,
            'city'            => $row['city/municipality'] ?? null,
            'province'        => $row['province'] ?? null,
            'date_of_birth'   => $row['date_of_birth'] ?? null,
            'sex'             => $row['sex'] ?? null,
            'mobile_number'   => $row['mobile_#'] ?? null,
            'email'           => $row['email_address'] ?? null,
        ]);
    }
}

