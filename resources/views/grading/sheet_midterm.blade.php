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

    $realStudents = $students; // only real students
    $totalRows = ceil(50 / 2); // half of 50, for two columns
    $passed = $realStudents->where('midterm_grade', '>=', 75)->count();
    $failed = $realStudents->where('midterm_grade', '<', 75)->count();
@endphp

<div class="bg-white p-6 text-sm mx-auto" style="max-width: 700px;">
<a href="{{ route('grades.download.midterm', $class_id) }}" class="bg-blue-500 text-white px-4 py-2 rounded">Download Midterm PDF</a>
<img src="{{ asset('images/header.jpg') }}" alt="Header" style="padding-top: 50px; padding-bottom: 20px">
   <h2 style="font-size: 20px; text-align:center;" class="font-bold">Grading Sheet</h2><br>

    <!-- HEADER -->
    <table class="w-full border border-black mb-3">
        <tr>
            <td class="border border-black p-1 font-bold" >Subject Code</td>
            <td colspan="3" class="border border-black p-1 font-bold">{{ $subject_code }}</td>
            <td class="border border-black p-1 font-bold">College</td>
            <td colspan="2" class="border border-black p-1 font-bold">{{ $department }}</td>
        </tr>
        <tr>
            <td rowspan="2" class="border border-black p-1 font-bold">Subject Title</td>
            <td colspan="3" rowspan="2" class="border border-black p-1 font-bold">{{ $subject_description }}</td>
            <td class="border border-black p-1 font-bold">Academic Year & Term</td>
            <td class="border border-black p-1 font-bold">{{ $academic_year }}</td>
            <td class="border border-black p-1 font-bold">{{ $semester }}</td>
        </tr>
        <tr>
            <td class="border border-black p-1 font-bold">Class Section</td>
            <td class="border border-black p-1 font-bold">{{ $block }}</td>
            <td class="border border-black p-1 font-bold">{{ $section }}</td>
        </tr>
        <tr>
            <td class="border border-black p-1 font-bold">Lab</td>
            <td class="border border-black p-1 font-bold"></td>
            <td class="border border-black p-1 font-bold">Credits</td>
            <td class="border border-black p-1 font-bold">3</td>
            <td class="border border-black p-1 font-bold">Date & Time</td>
            <td class="border border-black p-1 font-bold">{{ $schedule_time }}</td>
            <td class="border border-black p-1 font-bold">{{ $schedule_date }}</td>
        </tr>
        <tr>
            <td class="border border-black p-1 font-bold">Instructor</td>
            <td colspan="3" class="border border-black p-1 uppercase font-bold">{{ $name }}</td>
            <td class="border border-black p-1 font-bold">Date Posted</td>
            <td colspan="2" class="border border-black p-1"></td>
        </tr>
    </table>

    <table class="w-full border border-black text-xs mb-3">
        <thead>
            <tr class="font-bold text-center">
                <td rowspan='2' class="border border-black w-6">No.</td>
                <td rowspan='2' class="border border-black">Student Name</td>
                <td colspan='2' class="border border-black w-16">Grades</td>

                <td rowspan='2' class="border border-black w-6">No.</td>
                <td rowspan='2' class="border border-black">Student Name</td>
                <td colspan='2' class="border border-black w-16">Grades</td>
            </tr>
            <tr class="font-bold text-center">
                <td class="border border-black w-16">Midterm</td>
                <td class="border border-black w-20">Remarks</td>
                <td class="border border-black w-16">Midterm</td>
                <td class="border border-black w-20">Remarks</td>
            </tr>
        </thead>
        <tbody>
            @for ($i = 0; $i < $totalRows; $i++)
                @php
                    $left = $students->get($i);
                    $right = $students->get($i + $totalRows);
                @endphp
                <tr>
                    {{-- LEFT COLUMN --}}
                    <td class="border border-black text-center">{{ $i + 1 }}</td>
                    <td class="border border-black">{{ $left->student_name ?? '' }}</td>
                    <td class="border border-black text-center font-bold">
                        @if($left)
                            {{ number_format(gradeEquivalent($left->midterm_grade ?? 0), 2) }}
                        @endif
                    </td>
                    <td class="border border-black text-center font-bold
                        @if($left)
                            {{ ($left->midterm_grade ?? 0) >= 75 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}
                        @endif
                    ">
                        @if($left)
                            {{ ($left->midterm_grade ?? 0) >= 75 ? 'PASSED' : 'FAILED' }}
                        @endif
                    </td>

                    {{-- RIGHT COLUMN --}}
                    <td class="border border-black text-center">{{ $i + $totalRows + 1 }}</td>
                    <td class="border border-black">{{ $right->student_name ?? '' }}</td>
                    <td class="border border-black text-center font-bold">
                        @if($right)
                            {{ number_format(gradeEquivalent($right->midterm_grade ?? 0), 2) }}
                        @endif
                    </td>
                    <td class="border border-black text-center font-bold
                        @if($right)
                            {{ ($right->midterm_grade ?? 0) >= 75 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}
                        @endif
                    ">
                        @if($right)
                            {{ ($right->midterm_grade ?? 0) >= 75 ? 'PASSED' : 'FAILED' }}
                        @endif
                    </td>
                </tr>
            @endfor
        </tbody>
    </table>

    <!-- SIGNATURES & STATISTICS -->
    <table class="w-full">
        <tr>
            <td colspan="2" class="text-center" style="background-color: lightblue;">Grading Sheet Statistics</td>
        </tr>
        <tr>
            <td class="border border-black p-1">Passed</td>
            <td class="text-center border border-black p-1">{{ $passed }}</td>
            <td class="text-center">Prepared by:</td>
            <td class="text-center">
                <p class="font-bold uppercase">{{ $name }}</p>
                <p>Instructor I</p>
            </td>
        </tr>
        <tr>
            <td class="border border-black p-1">Failed</td>
            <td class="text-center border border-black p-1">{{ $failed }}</td>
        </tr>
        <tr>
            <td class="border border-black p-1">Conditionals</td>
            <td class="text-center border border-black p-1">0</td>
        </tr>
        <tr>
            <td class="border border-black p-1">Incomplete</td>
            <td class="text-center border border-black p-1">0</td>
            <td class="text-center">Noted by:</td>
            <td class="text-center">
                <p class="font-bold uppercase">{{ $head_of_department }}</p>
                <p>Program Head - {{ $department }}</p>
            </td>
        </tr>
        <tr>
            <td class="border border-black p-1">Dropped</td>
            <td class="text-center border border-black p-1">0</td>
        </tr>
        <tr>
            <td class="border border-black p-1">No Grade</td>
            <td class="text-center border border-black p-1">0</td>
        </tr>
        <tr>
            <td class="border border-black p-1">Total No. of Students</td>
            <td class="text-center border border-black p-1">{{ $realStudents->count() }}</td>
            <td class="text-center">Approved:</td>
            <td class="text-center">
                <p class="font-bold uppercase">Atty. ALBERT C. DELAWAT, EdD, JD</p>
                <p>College Administrator</p>
            </td>
        </tr>
    </table>
<img src="{{ asset('images/footer.jpg') }}" alt="Footer" style="padding-top: 30px;">
</div>
@endsection
