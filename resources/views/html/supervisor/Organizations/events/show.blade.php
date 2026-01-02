@extends('templates.supervisor_app')

@section('title', 'تفاصيل فعالية الجمعية - المشرف')

@push('styles')
    <link rel="stylesheet" href="/assets/css/supervisor/event.css">
@endpush

@section('content')
    <div class="main-content">
        <div class="container">
            <h3 class="page-title"><i class="fas fa-calendar-alt"></i> تفاصيل فعالية الجمعية</h3>
            <div class="event-details-card">
                <div class="d-flex align-items-center gap-4 mb-4">
                    @if (!empty($event->image ?? ($event['image'] ?? null)))
                        <img src="{{ asset('assets/images/organization_events/' . ($event->image ?? $event['image'])) }}"
                            class="event-img-preview" alt="صورة الفعالية">
                    @else
                        <span class="text-muted"><i class="fas fa-image fa-3x"></i></span>
                    @endif
                    <div>
                        <h4 style="color:#1976d2;font-weight:700;">{{ $event->title ?? $event['title'] }}</h4>
                        <div class="text-muted">{{ $event->type ?? $event['type'] }}</div>
                        <span class="manager-badge"><i class="fas fa-user-tie"></i> المشرف:
                            {{ $event->organization->manager->name ?? ($event['organization']['manager']['full_name'] ?? '-') }}</span>
                    </div>
                </div>
                <div class="mb-3"><strong>الوصف:</strong>
                    <p>{{ $event->description ?? $event['description'] }}</p>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="info-block"><i class="fas fa-map-marker-alt"></i> <strong>الموقع:</strong>
                            <span>{{ $event->location ?? $event['location'] }}</span>
                        </div>
                        <div class="info-block"><i class="fas fa-calendar-day"></i> <strong>البداية:</strong>
                            <span>{{ $event->start_date ?? $event['start_date'] }}</span>
                        </div>
                        <div class="info-block"><i class="fas fa-calendar-check"></i> <strong>النهاية: </strong>
                            <span>{{ $event->end_date ?? $event['end_date'] }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-block">
                            <i class="fas fa-external-link-alt"></i>
                            <strong>رابط الفعالية:</strong>
                            @php $url = $event->external_url ?? ($event['external_url'] ?? null); @endphp
                            @if ($url)
                                <a href="{{ $url }}" target="_blank" class="btn-event-link"><i
                                        class="fas fa-link"></i> فتح الرابط</a>
                            @else
                                <span>-</span>
                            @endif
                        </div>

                        <div class="info-block"><i class="fas fa-toggle-on"></i><strong> الحالة:</strong>
                            <span>@php
                                $type = $event->status ?? $event['status'];
                                $type_mape = [
                                    'upcoming' => 'قادمة',
                                    'ongoing' => 'جارية',
                                    'completed' => 'مكتملة',
                                    'cancelled' => 'ملغاة',
                                ];
                                echo $type_mape[$type] ?? '-';
                            @endphp</span>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('supervisor.organizations.show', $event->organization_id ?? $event['organization_id']) }}"
                            class="btn btn-info"><i class="fas fa-arrow-right"></i> العودة للجمعية</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
@endpush
