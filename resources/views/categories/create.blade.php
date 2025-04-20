<x-app-layout :title="'ایجاد دسته‌بندی جدید'">

    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-bold">ایجاد دسته‌بندی جدید</h2>
        <a href="{{ route('categories.index') }}"
           class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition">
            بازگشت به لیست
        </a>
    </div>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categories.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="name" class="block font-medium text-sm text-gray-700">نام دسته‌بندی</label>
            <input type="text" name="name" id="name"
                   class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        </div>

        <div>
            <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                ذخیره دسته‌بندی
            </button>
        </div>
    </form>
</x-app-layout>
