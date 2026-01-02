<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Supervisor;
use Illuminate\Validation\Rule;

class SupervisorProfileController extends Controller
{
    public function profile()
    {
        $supervisor = Supervisor::findOrFail(Auth::guard('supervisor')->id());
        return view('html.supervisor.profile.profile', compact('supervisor'));
    }


    public function editProfile()
    {
        $supervisor = Supervisor::findOrFail(Auth::guard('supervisor')->id());
        return view('html.supervisor.profile.edit_profile', compact('supervisor'));
    }

    public function updateProfile(Request $request)
    {
        $supervisor = Supervisor::findOrFail(Auth::guard('supervisor')->id());
        try {
            $data = $request->validate([
                'full_name' => 'required|string|max:255',

                'username'  => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('supervisor', 'username')->ignore($supervisor->id),
                ],

                'email'     => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique('supervisor', 'email')->ignore($supervisor->id),
                ],



                'phone'     => 'required|string|max:20',
                'password'  => 'nullable|string|min:8|confirmed',
                [
                    'username.unique' => 'اسم المستخدم مستخدم بالفعل.',
                    'email.unique' => 'البريد الإلكتروني مستخدم بالفعل.',
                    'password.confirmed' => 'تأكيد كلمة المرور غير متطابق.'
                ],

            ]);

            // تحديث كلمة المرور فقط إذا تم إدخالها
            if ($request->filled('password')) {
                $data['password'] = bcrypt($request->password);
            } else {
                unset($data['password']); // لا نرسلها للتحديث
            }

            $supervisor->update($data);

            return redirect()->route('supervisor.profile')
                ->with('success', 'تم تحديث الملف الشخصي بنجاح');
        } catch (\Exception $e) {
            return redirect()->route('supervisor.profile.edit')
                ->with('error', 'حدث خطأ أثناء تحديث الملف الشخصي: ' . $e->getMessage());
        }
    }
}
