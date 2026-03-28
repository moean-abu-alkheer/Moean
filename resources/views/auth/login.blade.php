<x-auth-layout>
    <div class="max-w-lg mx-auto mt-16 p-8 bg-white shadow-xl rounded-2xl border border-gray-100 " style="width:50%" >

        <h2 class="text-3xl font-bold mb-2 text-center text-gray-800">
            أهلاً بعودتك 👋
        </h2>
        <p class="text-center text-gray-500 mb-6">
            قم بتسجيل الدخول للمتابعة
        </p>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}" class="space-y-5">
            @csrf

            <div>
                <label class="block text-gray-700 mb-1">البريد الإلكتروني</label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 transition"
                    placeholder="example@email.com"
                >
            </div>

            <div>
                <label class="block text-gray-700 mb-1">كلمة المرور</label>
                <input
                    type="password"
                    name="password"
                    required
                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 transition"
                    placeholder="********"
                >
            </div>


            <button type="submit"
                class="w-full bg-blue-500 text-white py-3 rounded-lg font-semibold hover:bg-blue-600 transition duration-200">
                تسجيل الدخول
            </button>
        </form>

        <p class="mt-6 text-center text-gray-600">
            ما عندك حساب؟
            <a href="{{ route('register') }}" class="text-blue-500 font-medium hover:underline">
                إنشاء حساب
            </a>
        </p>
    </div>
</x-auth-layout>
