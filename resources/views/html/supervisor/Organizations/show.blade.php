@extends('templates.supervisor_app')

@section('title', 'تفاصيل الجمعية - المشرف')

@push('styles')
    <link rel="stylesheet" href="/assets/css/supervisor/organization.css">
@endpush

@section('content')
    <div class="main-content">
        <div class="container">
            <a href="{{ route('supervisor.organizations.index') }}" class="back-btn"><i class="fas fa-arrow-right"></i> العودة
                إلى الجمعيات</a>
            <div class="org-card">
                <div class="row align-items-center">
                    <div class="col-md-3 text-center">
                        @if (!empty($org->logo ?? ($org['logo'] ?? null)))
                            <img src="{{ asset('assets/images/organizations/' . ($org->logo ?? $org['logo'])) }}"
                                class="org-img-preview" alt="شعار الجمعية">
                        @else
                            <span class="text-muted"><i class="fas fa-image fa-4x"></i></span>
                        @endif
                    </div>
                    <div class="col-md-9">
                        <h2 style="color:#3498db;font-weight:700;">{{ $org->name ?? $org['name'] }}</h2>
                        <div class="manager-badge"><i class="fas fa-user-tie"></i> المشرف:
                            {{ $org->manager->name ?? ($org['manager']['full_name'] ?? '-') }}</div>
                        <div class="info-block"><i class="fas fa-tag"></i> <strong>النوع:</strong>
                            <span>@php
                                $type = $org->type ?? $org['type'];
                                $type_map = ['local' => 'محلية', 'external' => 'خارجية'];
                                echo $type_map[$type] ?? '-';
                            @endphp</span>
                        </div>
                        <div class="info-block"><i class="fas fa-external-link-alt"></i> <strong>الموقع الإلكتروني:</strong>
                            @php $url = $org->website_url ?? ($org['website_url'] ?? null); @endphp
                            @if ($url)
                                <a href="{{ $url }}" target="_blank" class="btn-event-link"><i
                                        class="fas fa-link"></i> فتح الرابط</a>
                            @else
                                <span>-</span>
                            @endif
                        </div>
                        <div class="info-block"><i class="fas fa-envelope"></i> <strong>البريد الإلكتروني</strong>
                            <span>{{ $org->contact_email ?? ($org['contact_email'] ?? '-') }}</span>
                        </div>
                        <div class="info-block"><i class="fas fa-phone"></i> <strong>الهاتف:</strong>
                            <span>{{ $org->contact_phone ?? ($org['contact_phone'] ?? '-') }}</span>
                        </div>
                        <div class="info-block"><i class="fas fa-info-circle"></i> <strong>الوصف:</strong>
                            <span>{{ $org->description ?? ($org['description'] ?? '-') }}</span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="event-list">
                    <h4 style="color:#1976d2;"><i class="fas fa-calendar-alt"></i> فعاليات الجمعية</h4>
                    @if (!empty($org->events) && count($org->events) > 0)
                        @foreach ($org->events as $ev)
                            <div class="event-card">
                                <div class="event-title"><i class="fas fa-bolt"></i> {{ $ev->title ?? $ev['title'] }}</div>
                                <div class="info-block"><i class="fas fa-calendar-day"></i> <strong>البداية:</strong>
                                    {{ $ev->start_date ?? $ev['start_date'] }}</div>
                                <div class="info-block"><i class="fas fa-calendar-check"></i> <strong>النهاية:</strong>
                                    {{ $ev->end_date ?? $ev['end_date'] }}</div>
                                <a href="{{ route('supervisor.organizations.events.show', $ev->id ?? $ev['id']) }}"
                                    class="btn btn-info btn-sm mt-2"><i class="fas fa-eye"></i> عرض الفعالية</a>
                            </div>
                        @endforeach
                    @else
                        <div class="text-muted">لا توجد فعاليات لهذه الجمعية.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
@endpush
