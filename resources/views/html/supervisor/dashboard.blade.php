@extends('templates.supervisor_app')

@section('title', 'لوحة تحكم المشرف')

@push('styles')
    <link rel="stylesheet" href="/assets/css/supervisor/dashboard.css">
@endpush

@section('content')
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="stats-card">
                    <div class="stats-icon"><i class="fas fa-users"></i></div>
                    <div class="stats-number">{{ $managersCount ?? 0 }}</div>
                    <div class="stats-label">عدد المدراء</div>
                </div>
            </div>

            <div class="row">
                <div class="recent-card">
                    <div class="recent-header">
                        <h5 class="recent-title">آخر المدراء المسجلين</h5>
                    </div>
                    @if (!empty($recentManagers))
                        @foreach ($recentManagers as $manager)
                            <div class="manager-item">
                                <div class="manager-avatar">
                                    {{ strtoupper(substr($manager['full_name'] ?? ($manager->full_name ?? 'م'), 0, 1)) }}
                                </div>
                                <div class="manager-info">
                                    <h6 class="manager-name">{{ $manager['full_name'] ?? ($manager->full_name ?? '') }}</h6>
                                    <div class="manager-role">
                                        {{ $manager['manager_type'] ?? ($manager->manager_type ?? '') }}
                                    </div>
                                </div>
                                <div class="manager-date">
                                    {{ isset($manager['created_at']) ? date('Y-m-d', strtotime($manager['created_at'])) : (isset($manager->created_at) ? $manager->created_at->format('Y-m-d') : '') }}
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="/assets/js/bootstrap.js"></script>
@endpush
