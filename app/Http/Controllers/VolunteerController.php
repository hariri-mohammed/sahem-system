<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Volunteer;

class VolunteerController extends Controller
{
    // عرض نموذج تسجيل المتطوعين
    // التواري المطلوبة مثل الدول واللغات
    public function volunteerRegister()
    {

        $countries = json_decode(file_get_contents(public_path('data/countries_ar.json')), true);
        $languages = json_decode(file_get_contents(public_path('data/languages_ar.json')), true);
        return view('public.volunteer.register', compact('countries', 'languages'));
    }






    // معالجة تسجيل المتطوعين

    public function volunteerStore(Request $request)
    {
        // التحقق من المدخلات
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:volunteers,email',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|max:20',
            'gender' => 'required|string',
            'age' => 'required|integer|min:16',
            'nationality' => 'required|string',
            'address' => 'required|string',
            'skills' => 'nullable|string',
            'experience' => 'nullable|string',
            'education_level' => 'nullable|string',
            'availability' => 'nullable|string',
            'preferred_roles' => 'nullable|string',
            'languages' => 'nullable|array',
            'languages.*' => 'string',
            'emergency_contact' => 'nullable|string',
        ]);

        // التحقق من البريد مسبقًا)
        if (Volunteer::where('email', $request->email)->exists()) {
            return back()->withInput()->withErrors(['error' => 'هذا البريد الإلكتروني مسجل مسبقًا.']);
        }

        // التحقق من رقم الهاتف
        if (Volunteer::where('phone', $request->phone)->exists()) {
            return back()->withInput()->withErrors(['error' => 'رقم الهاتف مستخدم مسبقًا.']);
        }

        // تحويل اللغات إلى نص
        $data['languages'] = $request->languages ? implode(',', $request->languages) : null;

        // تشفير كلمة المرور
        $data['password'] = bcrypt($data['password']);

        // الحالة
        $data['status'] = 'pending';

        // حفظ المتطوع
        Volunteer::create($data);

        // رسالة النجاح
        return redirect()->route('public.volunteer.register')
            ->with('success', 'تم إرسال طلبك بنجاح وسيتم مراجعته من قبل المشرف.');
    }
}
