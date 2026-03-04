@extends('layout')

@section('content')
@php
    function gradeEquivalent($grade) {
        if ($grade >= 96) return 1.00;
        if ($grade >= 94) return 1.25;
        if ($grade >= 92) return 1.50;
        if ($grade >= 89) return 1.75;
        if ($grade >= 87) return 2.00;
        if ($grade >= 84) return 2.25;
        if ($grade >= 82) return 2.50;
        if ($grade >= 79) return 2.75;
        if ($grade >= 75) return 3.00;
        return 5.00;
    }

    $totalRows = 25; // 1–25 | 26–50
    $passed = $students->where('final_grade', '>=', 75)->count();
    $failed = $students->where('final_grade', '<', 75)->count();
@endphp

<style>
    body {
        font-family: "Times New Roman", Times, serif;
        font-size: 10.5px;
    }
    table {
        border-collapse: collapse;
        width: 100%;
    }
    td {
        border: 1px solid #000;
        padding: 3px 4px;
        vertical-align: middle;
    }
    .center { text-align: center; }
    .bold { font-weight: bold; }
    .uppercase { text-transform: uppercase; }
    .no-border td { border: none; }
</style>

<div style="max-width: 700px; margin:auto; background:#fff; padding:15px;">

<a href="{{ route('grades.download.final', $class_id) }}"
   style="background:#16a34a;color:white;padding:6px 12px;border-radius:4px;text-decoration:none;">
   Download Final PDF
</a>
<img src="{{ asset('images/header.jpg') }}" alt="Header" style="padding-top: 50px; padding-bottom: 20px">
<h2 class="center bold" style="font-size:18px; margin:10px 0;">GRADING SHEET</h2>

<!-- HEADER -->
<table>
<tr>
    <td class="bold" style="width:140px;">Subject Code</td>
    <td colspan="3">{{ $subject_code }}</td><!-- from classess table -->
    <td class="bold" style="width:140px;">College</td>
    <td colspan="2">{{ $department }}</td><!-- from classess table -->
</tr>
<tr>
    <td rowspan="2" class="bold">Subject Title</td>
    <td colspan="3" rowspan="2">{{ $subject_description }}</td><!-- from classess table -->
    <td class="bold">Academic Year & Term</td>
    <td>{{ $academic_year }}</td><!-- from academic_years table -->
    <td>{{ $semester }}</td><!-- from classess table -->
</tr>
<tr>
    <td class="bold">Class Section</td>
    <td>{{ $block }}</td><!-- from classess table -->
    <td>{{ $section }}</td><!-- from classess table -->
</tr>
<tr>
    <td class="bold">Lab</td>
    <td></td>
    <td class="bold">Credits</td>
    <td>3</td>
    <td class="bold">Date & Time</td>
    <td>{{ $schedule_time }}</td><!-- from classess table -->
    <td>{{ $schedule_date }}</td><!-- from classess table -->
</tr>
<tr>
    <td class="bold">Instructor</td>
    <td colspan="6" class="uppercase bold">{{ $name }}</td><!-- name from teachers table -->
</tr>
</table>

<br>

<!-- STUDENT LIST -->
<table>
<thead>
<tr class="bold center">
    <td rowspan="2" style="width:30px;">No.</td>
    <td rowspan="2">Student Name</td>
    <td colspan="2" style="width:120px;">Grades</td>

    <td rowspan="2" style="width:30px;">No.</td>
    <td rowspan="2">Student Name</td>
    <td colspan="2" style="width:120px;">Grades</td>
</tr>
<tr class="bold center">
    <td>Final</td>
    <td>Remarks</td>
    <td>Final</td>
    <td>Remarks</td>
</tr>
</thead>
<tbody>

@for ($i = 0; $i < $totalRows; $i++)
@php
    $left  = $students->get($i);
    $right = $students->get($i + 25);
@endphp
<tr>
    <!-- LEFT -->
    <td class="center">{{ $i + 1 }}</td>
    <td>{{ $left->student_name ?? '' }}</td>
    <td class="center">
        {{ $left ? number_format(gradeEquivalent($left->final_grade ?? 0), 2) : '' }}
    </td>
    <td class="center">
        {{ $left ? (($left->final_grade ?? 0) >= 75 ? 'PASSED' : 'FAILED') : '' }}
    </td>

    <!-- RIGHT -->
    <td class="center">{{ $i + 26 }}</td>
    <td>{{ $right->student_name ?? '' }}</td>
    <td class="center">
        {{ $right ? number_format(gradeEquivalent($right->final_grade ?? 0), 2) : '' }}
    </td>
    <td class="center">
        {{ $right ? (($right->final_grade ?? 0) >= 75 ? 'PASSED' : 'FAILED') : '' }}
    </td>
</tr>
@endfor

</tbody>
</table>

<br>

<!-- STATISTICS + SIGNATURES -->
<table class="no-border">
<tr>

<!-- STATISTICS -->
<td style="width:35%; vertical-align:top;">
    <table style="border: 1px solid black;">
        <tr>
            <td colspan="2" class="center bold" style="background:#cfe8ff; border: 1px solid black;">
                Grading Sheet Statistics
            </td>
        </tr>
        <tr><td style="border: 1px solid black;">Passed</td><td style="border: 1px solid black;" class="center">{{ $passed }}</td></tr>
        <tr><td style="border: 1px solid black;">Failed</td><td style="border: 1px solid black;" class="center">{{ $failed }}</td></tr>
        <tr><td style="border: 1px solid black;">Conditionals</td><td style="border: 1px solid black;" class="center">0</td></tr>
        <tr><td style="border: 1px solid black;">Incomplete</td><td style="border: 1px solid black;" class="center">0</td></tr>
        <tr><td style="border: 1px solid black;">Dropped</td><td style="border: 1px solid black;" class="center">0</td></tr>
        <tr><td style="border: 1px solid black;">No Grade</td><td style="border: 1px solid black;" class="center">0</td></tr>
        <tr>
            <td class="bold">Total No. of Students</td>
            <td class="center bold">{{ $students->count() }}</td>
        </tr>
    </table>
</td>

<!-- LABELS -->
<td style="width:25%; vertical-align:top; padding-left:20px;">
    <div class="bold">Prepared by:</div>
    <div style="height:60px;"></div>
    <div class="bold">Noted by:</div>
    <div style="height:60px;"></div>
    <div class="bold">Approved by:</div>
</td>

<!-- SIGNATORIES -->
<td style="width:40%; vertical-align:top; text-align:center;">
    <div class="uppercase bold">{{ $name }}</div><!-- name from teachers table -->
    <div>Instructor I</div>

    <div style="height:40px;"></div>

    <div class="uppercase bold">{{ $head_of_department }}</div>
    <div>Program Head – {{ $department }}</div>

    <div style="height:40px;"></div>

    <div class="uppercase bold">Atty. ALBERT C. DELAWAT, EdD, JD</div>
    <div>College Administrator</div>
</td>

</tr>
</table>
<img src="{{ asset('images/footer.jpg') }}" alt="Footer" style="padding-top: 30px;">
</div>
@endsection
