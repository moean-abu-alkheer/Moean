<x-auth-layout>
    <div class="max-w-md mx-auto mt-10 p-6 bg-white shadow-md rounded-lg" style="width:50%">
        <h2 class="text-2xl font-bold mb-6 text-center">إنشاء حساب جديد</h2>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('store') }}">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-gray-700 mb-1">الاسم الكامل</label>
                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    autofocus
                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                >
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 mb-1">البريد الإلكتروني</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                >
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700 mb-1">كلمة المرور</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                >
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="block text-gray-700 mb-1">تأكيد كلمة المرور</label>
                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    required
                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                >
            </div>

            <div>
                <button type="submit"
                    class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 transition-colors">
                    تسجيل حساب جديد
                </button>
            </div>
        </form>

        <p class="mt-4 text-center text-gray-600">
            لديك حساب بالفعل؟
            <a href="{{ route('login') }}" class="text-blue-500 hover:underline">تسجيل الدخول</a>
        </p>
    </div>
</x-auth-layout>
