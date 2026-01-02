@extends('templates.supervisor_app')

@section('title', 'عرض المدير')

@push('styles')
    <style>
        body {
            font-family: 'Tajawal', sans-serif;
            background-color: #f8f9fa;
        }

        .main-content {
            margin-right: 280px;
            padding: 15px;
        }

        .profile-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.05);
        }

        .profile-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .profile-name {
            font-size: 20px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .profile-role {
            font-size: 14px;
            padding: 4px 12px;
            background-color: #f0f0f0;
            border-radius: 15px;
            display: inline-block;
            margin-top: 5px;
            color: #7f8c8d;
        }

        .info-section {
            margin-bottom: 20px;
        }

        .info-title {
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 15px;
            font-size: 1rem;
            border-bottom: 1px solid #3498db;
            padding-bottom: 5px;
        }

        .info-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .info-item {
            flex: 1 1 calc(50% - 15px);
            display: flex;
            align-items: center;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 6px;
            min-width: 250px;
        }

        .info-icon {
            width: 32px;
            height: 32px;
            background: #3498db;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 12px;
            color: white;
            font-size: 0.9rem;
        }

        .info-label {
            color: #7f8c8d;
            font-size: 0.85rem;
            margin-bottom: 3px;
        }

        .info-value {
            color: #2c3e50;
            font-weight: 500;
            font-size: 0.95rem;
        }

        .info-text {
            display: flex;
            flex-direction: column;
        }

        .back-btn {
            background-color: #3498db;
            color: white;
            padding: 8px 16px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            margin-bottom: 15px;
            font-size: 0.9rem;
        }

        .back-btn:hover {
            background-color: #2980b9;
            color: white;
            text-decoration: none;
        }

        .back-btn i {
            margin-left: 5px;
        }

        .status-badge {
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .status-active {
            background-color: #2ecc71;
            color: white;
        }

        .status-inactive {
            background-color: #e74c3c;
            color: white;
        }

        @media (max-width: 768px) {
            .info-item {
                flex: 1 1 100%;
            }

            .main-content {
                margin-right: 0;
            }
        }
    </style>
@endpush

@section('content')
    <div class="main-content">
        <div class="container">
            <a href="{{ route('supervisor.managers.index') }}" class="back-btn"><i class="fas fa-arrow-right"></i> العودة إلى
                قائمة المدراء</a>

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="profile-card">
                        <div class="profile-header">
                            <h2 class="profile-name">{{ $manager['full_name'] }}</h2>
                            <div class="profile-role">
                                <span
                                    class="status-badge {{ $manager['status'] == 'active' ? 'status-active' : 'status-inactive' }}">
                                    <i
                                        class="fas {{ $manager['status'] == 'active' ? 'fa-check-circle' : 'fa-times-circle' }}"></i>
                                    {{ $manager['status'] == 'active' ? 'مفعل' : 'معطل' }}
                                </span>
                            </div>
                        </div>

                        <div class="info-section">
                            <h3 class="info-title">المعلومات الشخصية</h3>
                            <div class="info-grid">
                                <div class="info-item">
                                    <div class="info-icon"><i class="fas fa-envelope"></i></div>
                                    <div class="info-text">
                                        <div class="info-label">البريد الإلكتروني</div>
                                        <div class="info-value">{{ $manager['email'] }}</div>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <div class="info-icon"><i class="fas fa-phone"></i></div>
                                    <div class="info-text">
                                        <div class="info-label">رقم الهاتف</div>
                                        <div class="info-value">{{ $manager['phone'] }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="info-section">
                            <h3 class="info-title">معلومات الحساب</h3>
                            <div class="info-grid">
                                <div class="info-item">
                                    <div class="info-icon"><i class="fas fa-user"></i></div>
                                    <div class="info-text">
                                        <div class="info-label">اسم المستخدم</div>
                                        <div class="info-value">{{ $manager['username'] }}</div>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <div class="info-icon"><i class="fas fa-user-tag"></i></div>
                                    <div class="info-text">
                                        <div class="info-label">الدور</div>
                                        <div class="info-value">
                                            @php
                                                $role_name = match ($manager['manager_type']) {
                                                    'financial' => 'مدير مالي',
                                                    'activities' => 'مدير أنشطة',
                                                    default => 'غير محدد',
                                                };
                                            @endphp
                                            <span class="manager-role">{{ $role_name }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <div class="info-icon"><i class="fas fa-calendar"></i></div>
                                    <div class="info-text">
                                        <div class="info-label">تاريخ التسجيل</div>
                                        <div class="info-value">
                                            {{ \Carbon\Carbon::parse($manager['created_at'])->format('Y-m-d') }}</div>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <div class="info-icon"><i class="fas fa-info-circle"></i></div>
                                    <div class="info-text">
                                        <div class="info-label">الحالة</div>
                                        <div class="info-value">
                                            <span
                                                class="status-badge {{ $manager['status'] == 'active' ? 'status-active' : 'status-inactive' }}">
                                                <i
                                                    class="fas {{ $manager['status'] == 'active' ? 'fa-check-circle' : 'fa-times-circle' }}"></i>
                                                {{ $manager['status'] == 'active' ? 'مفعل' : 'معطل' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endpush
