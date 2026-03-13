<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <style>
        @page {
            size: 8.5in 13in;
            margin: 0;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            font-family: "Times New Roman", Times, serif;
            font-size: 10px;
        }

        table {
            border-collapse: collapse;
        }

        td,
        th {
            border: 1px solid #000;
            padding: 1px 2px;
        }

        .center {
            text-align: center;
        }

        .bold {
            font-weight: bold;
        }

        .uppercase {
            text-transform: uppercase;
        }

        .bg {
            background-color: #cfe8ff;
        }

        .centered-table {
            margin: 0 auto;
            /* centers the table horizontally */
            padding: 0px 0px 0px 30px;
            /* vertical padding (top/bottom) */
            width: 100%;
            /* optional, keeps table smaller than full width */
        }

        #tablehead {
            table-layout: fixed;
        }
    </style>
</head>

<body>

    @php
        function gradeEquivalent($grade)
        {
            if ($grade >= 96)
                return 1.00;
            if ($grade >= 94)
                return 1.25;
            if ($grade >= 92)
                return 1.50;
            if ($grade >= 89)
                return 1.75;
            if ($grade >= 87)
                return 2.00;
            if ($grade >= 84)
                return 2.25;
            if ($grade >= 82)
                return 2.50;
            if ($grade >= 79)
                return 2.75;
            if ($grade >= 75)
                return 3.00;
            return 5.00;
        }

        $passed = $students->where('final_grade', '>=', 75)->count();
        $failed = $students->where('final_grade', '<', 75)->count();
    @endphp

    <div style="width:100%; margin:0; padding:0;">
        <img src="{{ $headerBase64 }}" style="display:block; width:100%; margin:0; padding:0;">
        <br><br>
        <div style="width: 95%; margin:0; padding:0;">
            <!-- HEADER -->
            <table class="centered-table">
                <tr>
                    <td style="font-size: 13px; border: none;" colspan="7" class="center bold">GRADING SHEET</td>
                </tr>
            </table>

            <br>

            <table class="centered-table" id="tablehead">
                <tr>
                    <td style="width: 140px;" class="bold tdth">Subject Code</td>
                    <td style="width: 140px;" class="tdth" colspan="3">{{ $subject_code }}</td>
                    <td class="bold tdth">College</td>
                    <td class="tdth" colspan="2">{{ $department }}</td>
                </tr>
                <tr>
                    <td style="width: 140px;" rowspan="2" class="bold tdth">Subject Title</td>
                    <td style="width: 140px;" class="tdth" colspan="3" rowspan="2">{{ $subject_description }}</td>
                    <td class="bold tdth">Academic Year & Term</td>
                    <td class="tdth">{{ $academic_year }}</td>
                    <td class="tdth">{{ $semester }}</td>
                </tr>
                <tr>
                    <td class="bold tdth">Class Section</td>
                    <td class="tdth">{{ $block }}</td>
                    <td class="tdth">{{ $section }}</td>
                </tr>
                <tr>
                    <td style="width: 140px;" class="bold tdth">Lab</td>
                    <td class="tdth"></td>
                    <td class="bold tdth">Credits</td>
                    <td class="tdth">{{ $credits ?? '3.0' }}</td>
                    <td class="bold tdth">Date & Time</td>
                    <td class="tdth">{{ $schedule_time }}</td>
                    <td class="tdth">{{ $schedule_date }}</td>
                </tr>
                <tr>
                    <td style="width: 140px;" class="bold tdth">Instructor</td>
                    <td colspan="6" class="uppercase tdth">{{ $name }}</td>
                </tr>
            </table>

            <br>

            <!-- STUDENT GRADES TABLE -->
            <table class="centered-table">
                <thead>
                    <tr class="font-bold text-center">
                        <td rowspan='2'>No.</td>
                        <td rowspan='2'>Student Name</td>
                        <td colspan='2'>Grades</td>
                        <td rowspan='2'>No.</td>
                        <td rowspan='2'>Student Name</td>
                        <td colspan='2'>Grades</td>
                    </tr>
                    <tr class="font-bold text-center">
                        <td>Midterm</td>
                        <td>Remarks</td>
                        <td>Midterm</td>
                        <td>Remarks</td>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalRows = 25;
                    @endphp
                    @for ($i = 0; $i < $totalRows; $i++)
                        @php
                            $left = $students->get($i);
                            $right = $students->get($i + $totalRows);
                        @endphp
                        <tr>
                            {{-- LEFT COLUMN --}}
                            <td class="text-center">{{ $i + 1 }}</td>
                            <td>{{ $left->student_name ?? '' }}</td>
                            <td class="text-center font-bold">
                                {{ $left ? number_format(gradeEquivalent($left->midterm_grade ?? 0), 2) : '' }}</td>
                            <td
                                class="text-center font-bold {{ $left ? (($left->midterm_grade ?? 0) >= 75 ? 'bg-green' : 'bg-red') : '' }}">
                                {{ $left ? (($left->midterm_grade ?? 0) >= 75 ? 'PASSED' : 'FAILED') : '' }}
                            </td>

                            {{-- RIGHT COLUMN --}}
                            <td class="text-center">{{ $i + $totalRows + 1 }}</td>
                            <td>{{ $right->student_name ?? '' }}</td>
                            <td class="text-center font-bold">
                                {{ $right ? number_format(gradeEquivalent($right->midterm_grade ?? 0), 2) : '' }}</td>
                            <td
                                class="text-center font-bold {{ $right ? (($right->midterm_grade ?? 0) >= 75 ? 'bg-green' : 'bg-red') : '' }}">
                                {{ $right ? (($right->midterm_grade ?? 0) >= 75 ? 'PASSED' : 'FAILED') : '' }}
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>

            <br>

            <table class="centered-table" style="width:100%; border:none; padding-top: 15px; padding-bottom: 15px">
                <tr style="border:none;">

                    <!-- LEFT : STATISTICS -->
                    <td style="width:35%; vertical-align:top; border:none;">

                        <table style="width:100%;">
                            <tr>
                                <td colspan="2" class="center bold">Grading Sheet Statistics</td>
                            </tr>
                            <tr>
                                <td>Passed</td>
                                <td class="center">{{ $passed }}</td>
                            </tr>
                            <tr>
                                <td>Failed</td>
                                <td class="center">{{ $failed }}</td>
                            </tr>
                            <tr>
                                <td>Conditionals</td>
                                <td class="center">0</td>
                            </tr>
                            <tr>
                                <td>Incomplete</td>
                                <td class="center">0</td>
                            </tr>
                            <tr>
                                <td>Dropped</td>
                                <td class="center">0</td>
                            </tr>
                            <tr>
                                <td>No Grade</td>
                                <td class="center">0</td>
                            </tr>
                            <tr>
                                <td class="bold">Total No. of Students</td>
                                <td class="center bold">{{ $students->count() }}</td>
                            </tr>
                        </table>

                    </td>


                    <!-- MIDDLE : LABELS -->
                    <td style="width:25%; vertical-align:top; border:none; padding-left:30px;">

                        <div class="bold">Prepared by:</div>
                        <div style="height: 41px;"></div>

                        <div class="bold">Noted by:</div>
                        <div style="height: 41px;"></div>

                        <div class="bold">Approved by:</div>

                    </td>


                    <!-- RIGHT : SIGNATORIES -->
                    <td style="width:40%; vertical-align:top; border:none; text-align:center;">

                        <div class="uppercase bold">{{ $name }}</div>
                        <div>Instructor I</div>

                        <div style="height:30px;"></div>

                        <div class="uppercase bold">{{ $head_of_department }}</div>
                        <div>Program Head – {{ $department }}</div>

                        <div style="height:30px;"></div>

                        <div class="uppercase bold">Atty. ALBERT C. BULAWAT, EdD, JD</div>
                        <div>College Administrator</div>

                    </td>

                </tr>
            </table>
        </div>
        <br><br>
        <img src="{{ $footerBase64 }}" style="display:block; width:100%; margin:0; padding:0;">
    </div>
</body>

</html>