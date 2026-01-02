@extends('public.template_layouts.app')

@section('title', $activity->title . ' - ساهم')

@section('content')
    <section class="max-w-6xl mx-auto my-12 px-4">

        <!-- عنوان الفعالية -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-extrabold text-indigo-900 mb-2">{{ $activity->title }}</h1>
            <p class="text-gray-600 text-lg">{{ $activity->description }}</p>
        </div>

        <!-- صورة الفعالية -->
        <div class="mb-8 overflow-hidden rounded-xl shadow-lg">
            <img src="{{ asset('assets/images/activities/' . ($activity->image ?? 'default-event.png')) }}"
                alt="{{ $activity->title }}"
                class="w-full h-96 object-cover transform hover:scale-105 transition duration-500">
        </div>

        <!-- تفاصيل الفعالية -->
        <div class="grid md:grid-cols-2 gap-8 mb-12">

            <!-- معلومات الفعالية -->
            <div class="bg-white rounded-xl shadow-lg p-6 space-y-4">
                <h2 class="text-2xl font-bold text-indigo-900 mb-4">تفاصيل الفعالية</h2>
                <p><strong>نوع الفعالية:</strong>
                    @if ($activity->activity_type == 'donation')
                        تبرع
                    @elseif($activity->activity_type == 'volunteer')
                        تطوع
                    @else
                        كلاهما
                    @endif
                </p>
                <p><strong>الموقع:</strong> {{ $activity->location ?? 'غير محدد' }}</p>
                <p><strong>تاريخ البداية:</strong> {{ $activity->start_date->format('Y-m-d H:i') }}</p>
                <p><strong>تاريخ النهاية:</strong> {{ $activity->end_date->format('Y-m-d H:i') }}</p>
            </div>

            <!-- التبرعات أو التطوع -->
            <div class="space-y-6">

                <!-- قسم التبرع -->
                @if ($activity->activity_type == 'donation' || $activity->activity_type == 'both')
                    @php
                        $donation = $activity->donationSettings;
                        $progress = $donation
                            ? ($donation->collected_amount / max($donation->target_amount, 1)) * 100
                            : 0;
                    @endphp
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h2 class="text-2xl font-bold text-indigo-900 mb-4">التبرع</h2>
                        <p>المبلغ المستهدف: {{ number_format($donation?->target_amount ?? 0, 2) }} ر.س</p>
                        <p>المبلغ المجموع: {{ number_format($donation?->collected_amount ?? 0, 2) }} ر.س</p>

                        <div class="w-full bg-gray-200 h-6 rounded-full mt-3 overflow-hidden">
                            <div class="bg-green-500 h-6 rounded-full" style="width: {{ min($progress, 100) }}%"></div>
                        </div>

                        <button
                            class="mt-4 w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-xl font-semibold transition">
                            تبرع الآن
                        </button>
                    </div>
                @endif

                <!-- قسم التطوع -->
                @if ($activity->activity_type == 'volunteer' || $activity->activity_type == 'both')
                    @php
                        $volunteer = $activity->volunteerRequirements;
                    @endphp
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h2 class="text-2xl font-bold text-indigo-900 mb-4">التطوع</h2>
                        <p>عدد المتطوعين المطلوبين: {{ $volunteer?->required_volunteers ?? 'غير محدد' }}</p>
                        <p>عدد المسجلين: {{ $volunteer?->volunteers_count ?? 0 }}</p>
                        <p>الحد الأدنى للعمر: {{ $volunteer?->min_age ?? '-' }}</p>
                        <p>الجنس:
                            {{ [
                                'male' => 'ذكر',
                                'female' => 'انثى',
                                'both' => 'كلا الجنسين',
                            ][$volunteer?->gender_requirement ?? 'both'] }}
                        </p>
                        <p>المهارات المطلوبة: {{ $volunteer?->skills_required ?? '-' }}</p>


                        <button
                            class="mt-4 w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-semibold transition">
                            انضم إلينا كمتطوع
                        </button>
                    </div>
                @endif
            </div>
        </div>

        <!-- أزرار العودة -->
        <div class="text-center mt-12">
            <a href="{{ route('public.activities.index') }}"
                class="inline-block bg-gray-900 hover:bg-gray-800 text-white py-3 px-6 rounded-xl font-semibold transition">
                العودة إلى جميع الفعاليات
            </a>
        </div>

    </section>
@endsection
