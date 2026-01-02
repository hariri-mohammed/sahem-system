@extends('templates.supervisor_app')

@section('title', 'قائمة الجمعيات - المشرف')

@push('styles')
    <link rel="stylesheet" href="/assets/css/supervisor/organization.css">
@endpush

@section('content')
    <div class="main-content">
        <div class="container">
            <h3 class="page-title"><i class="fas fa-building"></i> قائمة الجمعيات</h3>
            <div class="row">
                @forelse ($organizations ?? collect() as $org)
                    <div class="col-12 org-card">
                        <div class="org-header">
                            @if (!empty($org->logo ?? ($org['logo'] ?? null)))
                                <img src="{{ asset('assets/images/organizations/' . ($org->logo ?? $org['logo'])) }}"
                                    class="org-img-preview" alt="شعار الجمعية">
                            @else
                                <span class="text-muted"><i class="fas fa-image fa-2x"></i></span>
                            @endif
                            <div>
                                <h5 style="color:#1976d2;font-weight:700;">{{ $org->name ?? $org['name'] }}</h5>
                                <div class="text-muted">{{ $org->type ?? $org['type'] }}</div>
                                <span class="manager-badge"><i class="fas fa-user-tie"></i> المشرف:
                                    {{ $org->manager->name ?? ($org['manager']['full_name'] ?? '-') }}</span>
                            </div>
                        </div>
                        <div class="mt-3 d-flex gap-2">
                            <a href="{{ route('supervisor.organizations.show', $org->id ?? $org['id']) }}"
                                class="btn btn-primary"><i class="fas fa-eye"></i> عرض التفاصيل</a>
                            <a href="{{ route('supervisor.organizations.events.index', $org->id ?? $org['id']) }}"
                                class="btn btn-info"><i class="fas fa-calendar-alt"></i> فعاليات الجمعية</a>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted">
                        <i class="fas fa-info-circle mb-2" style="font-size:2rem;"></i>
                        <p>لا توجد جمعيات حالياً.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
@endpush
