<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Volunteer;

class SupervisorVolunteerController extends Controller
{

    // عرض قائمة المتطوعين مع إمكانية التصفية حسب الحالة
    public function index(Request $request)
    {
        $status = $request->get('status', 'pending');
        // جلب المتطوعين بناءً على الحالة المحددة
        $volunteers = Volunteer::when($status, function ($q, $status) {
            return $q->where('status', $status);
            //12 طلب في كل صفحة
        })->latest()->paginate(12);

        // إحصائيات عدد المتطوعين حسب الحالة
        $counts = [
            'pending' => Volunteer::where('status', 'pending')->count(),
            'accepted' => Volunteer::where('status', 'accepted')->count(),
            'rejected' => Volunteer::where('status', 'rejected')->count(),
        ];

        return view('html.supervisor.volunteers.index', compact('volunteers', 'counts'));
    }

    // عرض تفاصيل طلب التطوع

    public function show($id)
    {
        $volunteer = Volunteer::findOrFail($id);
        return view('html.supervisor.volunteers.show', compact('volunteer'));
    }

    // تحديث حالة طلب التطوع
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:accepted,rejected',
        ]);

        $volunteer = Volunteer::findOrFail($id);
        // تحديث الحالة
        $volunteer->status = $request->status;
        $volunteer->save();

        return redirect()->route('supervisor.volunteers.show', $id)
            ->with('success', 'تم تحديث حالة الطلب بنجاح.');
    }
}
