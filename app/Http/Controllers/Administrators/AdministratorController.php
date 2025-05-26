<?php

namespace App\Http\Controllers\Administrators;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Lesson;
use Illuminate\Support\Carbon;

class AdministratorController extends Controller
{
    public function home()
    {
        $countTeachers = Teacher::count();
        $countStudents = Student::count();

        $lessons = Lesson::with('teacher')
            ->whereYear('created_at', Carbon::now()->year)
            ->get();

        $orderedMonths = [
            'Janeiro',
            'Fevereiro',
            'Março',
            'Abril',
            'Maio',
            'Junho',
            'Julho',
            'Agosto',
            'Setembro',
            'Outubro',
            'Novembro',
            'Dezembro'
        ];

        $groupedSummaries = $lessons->groupBy(function ($lesson) {
            return $lesson->teacher_id . '-' . $lesson->month;
        });

        $teacherSummaries = $groupedSummaries->map(function ($group) use ($orderedMonths) {
            $teacher = $group->first()->teacher;
            $month = $group->first()->month;

            $totalHours = $group->sum('hours');
            $hourlyRate = $teacher->hourly_rate;
            $commission = $teacher->commission;
            $totalValue = $totalHours * $hourlyRate;
            $valueProfessor = $totalValue * ((100 - $commission) / 100);
            $valueCompany = $totalValue * ($commission / 100);

            return [
                'name' => capitalizeNameMask($teacher->name),
                'month' => $month,
                'month_order' => array_search($month, $orderedMonths),
                'hours' => $totalHours . 'h',
                'total_value' => 'R$' . number_format($totalValue, 2, ',', ''),
                'value_professor' => 'R$' . number_format($valueProfessor, 2, ',', ''),
                'value_company' => 'R$' . number_format($valueCompany, 2, ',', ''),
            ];
        });


        $sortedSummaries = $teacherSummaries->sortByDesc('month_order');
        return view('administrator.home', compact('countTeachers', 'countStudents', 'sortedSummaries'));
    }

    public function login()
    {
        return view('auth.login');
    }

    public function teachers()
    {
        return view('administrator.teachers.index');
    }

    public function students()
    {
        return view('administrator.students');
    }
}
