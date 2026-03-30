<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Student;
use App\Models\Course;
use App\Models\Schedule;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $response = Http::asForm()->post('https://quiztoxml.ucas.edu.ps/api/login', [
            'username' => $request->username,
            'password' => $request->password,
        ]);

        $data = $response->json();

        if (isset($data['message']) && $data['message'] == 'كلمة المرور او اسم المستخدم خطا') {
            return response()->json([
                'message' => 'كلمة المرور او اسم المستخدم خطا'
            ], 401);
        }

        $user = $data['data'];
        $token = $data['Token'] ?? '';

        $student = Student::updateOrCreate(
            ['student_id' => $user['user_id']],
            [
                'name'  => $user['user_ar_name'],
                'token' => $token,
            ]
        );

        $tableResponse = Http::asForm()->post('https://quiztoxml.ucas.edu.ps/api/get-table', [
            'user_id' => $user['user_id'],
            'token'   => $token,
        ]);

        $tableData = $tableResponse->json();

        DB::table('schedules')->where('student_id', $student->id)->delete();

        if (isset($tableData['data']) && is_array($tableData['data'])) {

            foreach ($tableData['data'] as $item) {
                $course = Course::firstOrCreate([
                    'course_no'   => $item['subject_no'] ?? 'غير معروف',
                    'course_name' => $item['subject_name'] ?? 'غير معروف',
                    'branch_no'   => $item['branch_no'] ?? '',
                ]);

                $days = ['S', 'N', 'M', 'T', 'W', 'R'];

                foreach ($days as $day) {
                    if (!empty($item[$day])) {
                        Schedule::create([
                            'student_id'  => $student->id,
                            'course_id'   => $course->id,
                            'day'         => $day,
                            'time'        => $item[$day],
                            'room'        => $item['room_no'] ?? '',
                            'teacher'     => $item['teacher_name'] ?? '',
                            'teacher_no'  => $item['teacher_no'] ?? null,
                        ]);
                    }
                }
            }
        }

        return response()->json([
            'message' => 'تم تسجيل الدخول وجلب الجدول بنجاح',
            'student' => $student
        ]);
    }
}
