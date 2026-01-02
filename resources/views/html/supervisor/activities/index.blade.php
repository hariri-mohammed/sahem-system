@extends('templates.supervisor_app')

@section('title', 'قائمة الفعاليات - المشرف')

@push('styles')
    <link href="/assets/css/supervisor/activities.css" rel="stylesheet">
@endpush

@section('content')
    <div class="container main-content">

        <h3 class="page-header"><i class="fas fa-calendar-check"></i> قائمة الفعاليات</h3>

        <div class="row">

            @forelse ($activities ?? collect() as $activity)
                <div class="col-12">
                    <div class="activity-card">
                        <div class="activity-header">
                            @if (!empty($activity->image ?? ($activity['image'] ?? null)))
                                <img class="activity-img"
                                    src="{{ asset('assets/images/activities/' . ($activity->image ?? $activity['image'])) }}"
                                    alt="صورة الفعالية">
                            @else
                                <img class="activity-img" src="https://via.placeholder.com/90" alt="No Image">
                            @endif

                            <div>
                                <h5 class="fw-bold text-primary mb-1">{{ $activity->title ?? $activity['title'] }}</h5>

                                @php $type = $activity->activity_type ?? $activity['activity_type']; @endphp
                                <div class="text-muted mb-2"><i class="fas fa-layer-group"></i>
                                    {{ $type === 'donation' ? 'تبرع' : ($type === 'volunteer' ? 'تطوع' : ($type === 'both' ? 'شاملة' : 'عادية')) }}
                                </div>

                                <span class="badge-manager"><i class="fas fa-user-tie"></i> المشرف:
                                    {{ $activity->manager->name ?? ($activity['manager']['full_name'] ?? '-') }}</span>
                            </div>
                        </div>

                        <div class="mt-3">
                            <a href="{{ route('supervisor.activities.show', $activity->id ?? $activity['id']) }}"
                                class="btn btn-view"><i class="fas fa-eye"></i> عرض التفاصيل</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-5">
                    <i class="fas fa-info-circle mb-3" style="font-size: 2rem;"></i>
                    <p class="fs-5">لا توجد فعاليات حالياً.</p>
                </div>
            @endforelse

        </div>

    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
@endpush
