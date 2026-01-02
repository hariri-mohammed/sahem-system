@extends('templates.supervisor_app')

@section('title', 'تفاصيل الفعالية - المشرف')

@push('styles')
    <link href="/assets/css/supervisor/activities.css" rel="stylesheet">
@endpush

@section('content')
    <div class="main-content">
        <div class="container">
            <h3 class="page-title"><i class="fas fa-bolt"></i> تفاصيل الفعالية</h3>
            <div class="activity-details-card">
                <div class="d-flex align-items-center gap-4 mb-4">
                    @if (!empty($activity->image ?? ($activity['image'] ?? null)))
                        <img src="{{ asset('assets/images/activities/' . ($activity->image ?? $activity['image'])) }}"
                            class="activity-img-preview" alt="صورة الفعالية">
                    @else
                        <span class="text-muted"><i class="fas fa-image fa-3x"></i></span>
                    @endif
                    <div>
                        <h4 style="color:#1976d2;font-weight:700;">{{ $activity->title ?? $activity['title'] }}</h4>
                        <div class="text-muted">{{ $activity->activity_type ?? $activity['activity_type'] }}</div>
                        <span class="manager-badge"><i class="fas fa-user-tie"></i> المشرف:
                            {{ $activity->manager->name ?? ($activity['manager']['full_name'] ?? '-') }}</span>
                    </div>
                </div>
                <div class="mb-3"><strong>الوصف:</strong>
                    <p>{{ $activity->description ?? $activity['description'] }}</p>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="section-title"><i class="fas fa-info-circle"></i> معلومات الفعالية</div>
                        <div class="info-block"><i class="fas fa-map-marker-alt"></i> الموقع:
                            <span>{{ $activity->location ?? $activity['location'] }}</span>
                        </div>
                        <div class="info-block"><i class="fas fa-calendar-day"></i> البداية:
                            <span>{{ $activity->start_date ?? $activity['start_date'] }}</span>
                        </div>
                        <div class="info-block"><i class="fas fa-calendar-check"></i> النهاية:
                            <span>{{ $activity->end_date ?? $activity['end_date'] }}</span>
                        </div>
                        <div class="info-block"><i class="fas fa-toggle-on"></i> الحالة:
                            <span>{{ $activity->status ?? $activity['status'] }}</span>
                        </div>
                        <div class="info-block"><i class="fas fa-eye"></i> النشر:
                            <span>{{ $activity->is_published ?? $activity['is_published'] ? 'منشور' : 'غير منشور' }}</span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="section-title"><i class="fas fa-users"></i> متطلبات التطوع</div>
                        @php $volunteer = $activity->volunteerRequirements ?? ($activity['volunteerRequirements'] ?? null); @endphp
                        @if ($volunteer)
                            <ul class="volunteer-list">
                                <li><i class="fas fa-user-check volunteer-icon"></i> العدد المطلوب: <span
                                        class="fw-bold">{{ $volunteer->required_volunteers ?? $volunteer['required_volunteers'] }}</span>
                                </li>
                                <li><i class="fas fa-user-friends volunteer-icon"></i> عدد المتطوعين الحالي: <span
                                        class="fw-bold">{{ $volunteer->volunteers_count ?? $volunteer['volunteers_count'] }}</span>
                                </li>
                                <li><i class="fas fa-briefcase volunteer-icon"></i> نوع التطوع: <span
                                        class="fw-bold">{{ $volunteer->volunteer_mode ?? $volunteer['volunteer_mode'] }}</span>
                                </li>
                                <li><i class="fas fa-hourglass volunteer-icon"></i> الحد الأدنى للساعات: <span
                                        class="fw-bold">{{ $volunteer->min_hours ?? $volunteer['min_hours'] }}</span></li>
                                <li><i class="fas fa-user-graduate volunteer-icon"></i> العمر الأدنى: <span
                                        class="fw-bold">{{ $volunteer->min_age ?? $volunteer['min_age'] }}</span></li>
                                <li><i class="fas fa-venus-mars volunteer-icon"></i> الجنس المطلوب: <span
                                        class="fw-bold">{{ $volunteer->gender_requirement ?? $volunteer['gender_requirement'] }}</span>
                                </li>
                                <li><i class="fas fa-tools volunteer-icon"></i> المهارات المطلوبة: <span
                                        class="fw-bold">{{ $volunteer->skills_required ?? $volunteer['skills_required'] }}</span>
                                </li>
                            </ul>
                        @else
                            <div class="text-muted">لا توجد متطلبات تطوع لهذه الفعالية.</div>
                        @endif
                    </div>
                </div>

                <div class="section-title"><i class="fas fa-hand-holding-heart"></i> إعدادات التبرع</div>
                @php $donation = $activity->donationSettings ?? ($activity['donationSettings'] ?? null); @endphp
                @if ($donation)
                    <ul class="settings-list">
                        <li><i class="fas fa-bullseye settings-icon"></i> الهدف: <span
                                class="fw-bold">{{ number_format($donation->target_amount ?? $donation['target_amount'], 2) }}
                                $</span></li>
                        <li><i class="fas fa-coins settings-icon"></i> المجموع المحصّل: <span
                                class="fw-bold">{{ number_format($donation->collected_amount ?? $donation['collected_amount'], 2) }}
                                $</span></li>
                        <li><i class="fas fa-toggle-on settings-icon"></i> حالة التبرع: <span
                                class="fw-bold">{{ ($donation->donation_status ?? $donation['donation_status']) == 'active' ? 'مفعّل' : 'غير مفعّل' }}</span>
                        </li>
                    </ul>
                @else
                    <div class="text-muted">لا توجد إعدادات تبرع لهذه الفعالية.</div>
                @endif

                <div class="mt-4">
                    <a href="{{ route('supervisor.activities.index') }}" class="btn btn-info"><i
                            class="fas fa-arrow-right"></i> العودة للقائمة</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
@endpush
