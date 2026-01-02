@extends('public.template_layouts.app')

@section('title', 'تسجيل متطوع - ساهم')

@section('content')
    <section class="my-12 max-w-4xl mx-auto bg-white p-10 rounded-2xl shadow-lg border border-gray-100">

        <!-- العنوان -->
        <div class="text-center mb-10">
            <h2 class="text-4xl font-extrabold text-gray-800 mb-3">تسجيل متطوع جديد</h2>
            <p class="text-gray-500 text-lg">ساهم معنا في دعم المبادرات الإنسانية والفعاليات التطوعية</p>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 text-center">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 text-center">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('public.volunteer.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <div class="grid md:grid-cols-2 gap-6">

                <!-- الاسم -->
                <div>
                    <label class="block mb-2 font-semibold text-gray-700">الاسم الكامل</label>
                    <input type="text" name="name" placeholder="أدخل اسمك الكامل"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        value="{{ old('name') }}">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- البريد الإلكتروني -->
                <div>
                    <label class="block mb-2 font-semibold text-gray-700">البريد الإلكتروني</label>
                    <input type="email" name="email" placeholder="example@mail.com"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        value="{{ old('email') }}">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- كلمة المرور -->
                <div>
                    <label class="block mb-2 font-semibold text-gray-700">كلمة المرور</label>
                    <input type="password" name="password" placeholder="أدخل كلمة المرور"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- تأكيد كلمة المرور -->
                <div>
                    <label class="block mb-2 font-semibold text-gray-700">تأكيد كلمة المرور</label>
                    <input type="password" name="password_confirmation" placeholder="أعد إدخال كلمة المرور"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                </div>

                <!-- الهاتف -->
                <div>
                    <label class="block mb-2 font-semibold text-gray-700">رقم الهاتف</label>
                    <input type="text" name="phone" placeholder="09xx xxx xxx"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        value="{{ old('phone') }}">
                    @error('phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- الجنس -->
                <div>
                    <label class="block mb-2 font-semibold text-gray-700">الجنس</label>
                    <select name="gender"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                        <option value="">اختر الجنس</option>
                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>ذكر</option>
                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>أنثى</option>
                    </select>
                    @error('gender')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- العمر -->
                <div>
                    <label class="block mb-2 font-semibold text-gray-700">العمر</label>
                    <input type="number" name="age" placeholder="أدخل عمرك"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        value="{{ old('age') }}">
                    @error('age')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- الجنسية -->
                <div>
                    <label class="block mb-2 font-semibold text-gray-700">الجنسية</label>
                    <select name="nationality"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                        <option value="">اختر الجنسية</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country['name_ar'] }}">{{ $country['name_ar'] }}</option>
                        @endforeach
                    </select>
                </div>


                <!-- المستوى التعليمي -->
                <div>
                    <label class="block mb-2 font-semibold text-gray-700">المستوى التعليمي</label>
                    <input type="text" name="education_level" placeholder="مثل: بكالوريوس، ثانوي"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        value="{{ old('education_level') }}">
                    @error('education_level')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- التوفر -->
                <div>
                    <label class="block mb-2 font-semibold text-gray-700">التوفر</label>
                    <input type="text" name="availability" placeholder="يمكن تركها فارغة"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        value="{{ old('availability') }}">
                </div>

                <!-- اللغات -->
                <div>
                    <label class="block mb-2 font-semibold text-gray-700">اللغات</label>

                    <div class="border border-gray-300 rounded-lg p-4 h-40 overflow-y-scroll space-y-3">

                        @foreach ($languages as $lang)
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="checkbox" name="languages[]" value="{{ $lang['name_ar'] }}"
                                    class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-400"
                                    {{ collect(old('languages'))->contains($lang['name_ar']) ? 'checked' : '' }}>
                                <span class="text-gray-700">{{ $lang['name_ar'] }}</span>
                            </label>
                        @endforeach

                    </div>

                    @error('languages')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>


                <!-- العنوان -->
                <div class="md:col-span-2">
                    <label class="block mb-2 font-semibold text-gray-700">العنوان</label>
                    <input type="text" name="address" placeholder="أدخل العنوان الكامل"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        value="{{ old('address') }}">
                </div>

                <!-- المهارات -->
                <div class="md:col-span-2">
                    <label class="block mb-2 font-semibold text-gray-700">المهارات</label>
                    <textarea name="skills" rows="3" placeholder="يمكن تركها فارغة"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-400 focus:outline-none">{{ old('skills') }}</textarea>
                </div>

                <!-- الخبرة -->
                <div class="md:col-span-2">
                    <label class="block mb-2 font-semibold text-gray-700">الخبرة</label>
                    <textarea name="experience" rows="3" placeholder="يمكن تركها فارغة"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-400 focus:outline-none">{{ old('experience') }}</textarea>
                </div>

                <!-- الأدوار المفضلة -->
                <div>
                    <label class="block mb-2 font-semibold text-gray-700">الأدوار المفضلة</label>
                    <input type="text" name="preferred_roles" placeholder="يمكن تركها فارغة"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        value="{{ old('preferred_roles') }}">
                </div>

                <!-- جهة الطوارئ -->
                <div class="md:col-span-2">
                    <label class="block mb-2 font-semibold text-gray-700">جهة الاتصال في الطوارئ</label>
                    <input type="text" name="emergency_contact" placeholder="يمكن تركها فارغة"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        value="{{ old('emergency_contact') }}">
                </div>

            </div>

            <!-- زر الإرسال -->
            <button type="submit"
                class="w-full bg-blue-600 text-white py-4 rounded-xl text-lg font-semibold hover:bg-blue-700 transition-all shadow-md">
                إرسال الطلب
            </button>

        </form>
    </section>
@endsection
