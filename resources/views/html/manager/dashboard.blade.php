@extends('templates.manager_app')

@section('title', 'لوحة تحكم المدير')

@push('styles')
    <link rel="stylesheet" href="/assets/css/manager/dashboard.css">
@endpush

@section('content')
    <div class="main-content">
        <div class="container">
            <h2 class="mb-4">مرحباً، {{ $manager['full_name'] ?? ($manager->full_name ?? '') }} 👋</h2>
            <div class="row dashboard-actions">
                <div>
                    <div class="stats-card text-center">
                        <div class="stats-icon"><i class="fas fa-calendar-alt"></i></div>
                        <div class="stats-number">{{ $activitiesCount ?? 0 }}</div>
                        <div class="stats-label">عدد الفعاليات</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div>
                    <div class="recent-card">
                        <div class="recent-header">
                            <h5 class="recent-title">آخر الفعاليات المضافة</h5>
                        </div>
                        @if (!empty($recent_activities))
                            @foreach ($recent_activities as $activity)
                                <div class="activity-item">
                                    <div class="activity-img">
                                        @if (!empty($activity['image'] ?? ($activity->image ?? null)))
                                            <img src="{{ asset('assets/images/activities/' . ($activity['image'] ?? $activity['image'])) }}"
                                                alt="{{ $activity['title'] ?? $activity->title }}"
                                                style="width:100%;height:100%;border-radius:8px;object-fit:cover;">
                                        @else
                                            <span class="text-muted" style="font-size:1.5rem;">لا يوجد</span>
                                        @endif
                                    </div>
                                    <div class="activity-info">
                                        <h6 class="activity-title">{{ $activity['title'] ?? $activity->title }}</h6>
                                        <div class="activity-type">@php $type = $activity->activity_type ?? $activity['activity_type']; @endphp
                                            {{ $type === 'donation' ? 'تبرع' : ($type === 'volunteer' ? 'تطوع' : ($type === 'both' ? 'شاملة' : 'عادية')) }}
                                        </div>
                                    </div>
                                    <div class="activity-date">{{ $activity['start_date'] ?? $activity->start_date }}</div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center text-muted">لا توجد فعاليات حديثة.</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="/assets/js/bootstrap.js"></script>
@endpush
