@extends('templates.supervisor_app')

@section('title', 'فعاليات الجمعية')

@push('styles')
    <link rel="stylesheet" href="/assets/css/organizations/events.css">
@endpush

@section('content')
    <div class="main-content">
        <div class="container">
            <a href="{{ route('supervisor.organizations.index') }}" class="back-btn"><i class="fas fa-arrow-right"></i> العودة
                إلى الجمعيات</a>

            <div class="card mt-3">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <h5 class="page-title"><i class="fas fa-calendar-alt text-primary me-2"></i> فعاليات:
                        {{ $org->name ?? ($org['name'] ?? '') }}</h5>
                </div>
                <div class="mt-4 table-responsive">
                    @if (!empty($events) && count($events) > 0)
                        <table class="table table-bordered align-middle text-center">
                            <thead class="table-light">
                                <tr>
                                    <th><i class="fas fa-hashtag"></i> #</th>
                                    <th><i class="fas fa-heading"></i> العنوان</th>
                                    <th><i class="fas fa-calendar-day"></i> البداية</th>
                                    <th><i class="fas fa-calendar-check"></i> النهاية</th>
                                    <th><i class="fas fa-cogs"></i> الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($events as $index => $ev)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td class="event-title-cell">{{ $ev->title ?? $ev['title'] }}</td>
                                        <td>{{ $ev->start_date ?? $ev['start_date'] }}</td>
                                        <td>{{ $ev->end_date ?? ($ev['end_date'] ?? '-') }}</td>
                                        <td>
                                            <div class="d-flex flex-column gap-2">
                                                <a href="{{ route('supervisor.organizations.events.show', $ev->id ?? $ev['id']) }}"
                                                    class="btn btn-outline-info btn-sm w-100"><i class="fas fa-eye"></i>
                                                    عرض</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="text-muted">لا توجد فعاليات لهذه الجمعية.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endpush
