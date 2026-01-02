@extends('public.template_layouts.app')

@section('title', 'جميع الفعاليات - ساهم')

@section('content')

    <section class="py-14">

        <!-- العنوان -->
        <div class="text-center mb-10">
            <h2 class="text-4xl font-extrabold text-gray-800 mb-2">
                فعاليات ساهم
            </h2>
            <p class="text-gray-500 text-lg">
                ابحث وشارك بالتبرع أو التطوع بكل سهولة
            </p>
        </div>

        <!-- أدوات البحث والفلترة -->
        <div class="flex flex-col md:flex-row gap-4 mb-10 items-center justify-between">

            <!-- البحث -->
            <div class="w-full md:w-1/2">
                <input id="searchInput" type="text" placeholder="ابحث عن فعالية..."
                    class="w-full rounded-xl border border-gray-300 px-5 py-3 focus:ring-2 focus:ring-indigo-600 outline-none">
            </div>

            <!-- الفلاتر -->
            <div class="flex gap-3">
                <button data-filter="all" class="filter-btn bg-indigo-700 text-white px-5 py-2 rounded-xl font-semibold">
                    الكل
                </button>
                <button data-filter="donation" class="filter-btn bg-gray-200 px-5 py-2 rounded-xl">
                    تبرع
                </button>
                <button data-filter="volunteer" class="filter-btn bg-gray-200 px-5 py-2 rounded-xl">
                    تطوع
                </button>
            </div>
        </div>

        <!-- قائمة الفعاليات -->
        <div id="activitiesWrapper" class="space-y-8">

            @foreach ($activities as $activity)
                <div class="activity-item flex flex-col md:flex-row bg-white rounded-2xl shadow-md hover:shadow-2xl transition overflow-hidden"
                    data-type="{{ $activity->activity_type }}" data-title="{{ strtolower($activity->title) }}">

                    <!-- الصورة -->
                    <div class="md:w-1/3 h-60 md:h-auto relative overflow-hidden">
                        @if ($activity->image)
                            <img src="{{ asset('assets/images/activities/' . $activity->image) }}"
                                class="w-full h-full object-cover transition-transform duration-700 hover:scale-110">
                        @else
                            <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-400">
                                <i class="fas fa-image fa-3x"></i>
                            </div>
                        @endif

                        <!-- شارة النوع -->
                        <span
                            class="absolute top-4 right-4 text-xs px-3 py-1 rounded-full text-white
                        {{ $activity->activity_type === 'donation'
                            ? 'bg-green-600'
                            : ($activity->activity_type === 'volunteer'
                                ? 'bg-blue-600'
                                : 'bg-purple-600') }}">
                            {{ $activity->activity_type === 'donation'
                                ? 'تبرع'
                                : ($activity->activity_type === 'volunteer'
                                    ? 'تطوع'
                                    : 'تبرع & تطوع') }}
                        </span>
                    </div>

                    <!-- المحتوى -->
                    <div class="flex-1 p-6 flex flex-col">
                        <h3 class="text-2xl font-bold mb-2 text-gray-800">
                            {{ $activity->title }}
                        </h3>

                        <p class="text-gray-600 mb-4 line-clamp-3">
                            {{ $activity->description }}
                        </p>

                        <!-- Progress Bar للتبرع -->
                        @if ($activity->donationSettings)
                            @php
                                $goal = $activity->donationSettings->target_amount;
                                $current = $activity->donationSettings->collected_amount;
                                $percent = $goal > 0 ? min(100, ($current / $goal) * 100) : 0;
                            @endphp

                            <div class="mb-4">
                                <div class="flex justify-between text-sm mb-1">
                                    <span>التبرعات</span>
                                    <span>{{ number_format($current) }} / {{ number_format($goal) }} ر.س</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-3">
                                    <div class="bg-green-600 h-3 rounded-full transition-all"
                                        style="width: {{ $percent }}%"></div>
                                </div>
                            </div>
                        @endif

                        <!-- معلومات إضافية -->
                        <div class="flex justify-between items-center text-sm text-gray-500 mt-auto">
                            <span>
                                <i class="fas fa-users ml-1 text-indigo-600"></i>
                                {{ $activity->volunteerRequirements->required_volunteers ?? 'غير محدد' }}
                                متطوع
                            </span>

                            <a href="{{ route('public.activities.sahem.show', $activity->id) }}"
                                class="bg-[#2c3e50] text-white px-6 py-2 rounded-xl hover:bg-indigo-700 transition">
                                عرض التفاصيل
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </section>

@endsection

@push('scripts')
    <script>
        const searchInput = document.getElementById('searchInput');
        const filterButtons = document.querySelectorAll('.filter-btn');
        const items = document.querySelectorAll('.activity-item');

        let currentFilter = 'all';

        function filterActivities() {
            const search = searchInput.value.toLowerCase();

            items.forEach(item => {
                const type = item.dataset.type;
                const title = item.dataset.title;

                const matchFilter = currentFilter === 'all' || type === currentFilter || type === 'both';
                const matchSearch = title.includes(search);

                item.style.display = matchFilter && matchSearch ? 'flex' : 'none';
            });
        }

        searchInput.addEventListener('input', filterActivities);

        filterButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                filterButtons.forEach(b => b.classList.remove('bg-indigo-700', 'text-white'));
                btn.classList.add('bg-indigo-700', 'text-white');

                currentFilter = btn.dataset.filter;
                filterActivities();
            });
        });
    </script>
@endpush
