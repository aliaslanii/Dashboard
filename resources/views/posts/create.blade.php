<x-app-layout>
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">ایجاد پست جدید</h2>

        @if ($errors->any())
            <div class="mb-4 p-4 text-sm text-red-800 bg-red-100 rounded border border-red-200">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('posts.store') }}" method="POST" class="space-y-4" enctype="multipart/form-data">
            @csrf

            <div>
                <label for="title" class="block font-medium text-sm text-gray-700">عنوان پست</label>
                <input type="text" name="title" id="title" required
                       class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>
            <div>
                <label for="category_id" class="block font-medium text-sm text-gray-700">دسته‌بندی</label>
                <select name="category_id" id="category_id" required
                        class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="null">انتخاب دسته‌بندی</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="content" class="block font-medium text-sm text-gray-700">محتوای پست</label>
                <textarea name="content" id="content" rows="5" required
                          class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
            </div>
            <div>
                <label for="published_at" class="block font-medium text-sm text-gray-700">تاریخ انتشار</label>
                <input type="datetime-local" name="published_at" id="published_at"
                       class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>
            <div>
                <label for="photo" class="block font-medium text-sm text-gray-700">تصویر پست (اختیاری)</label>
                <input type="file" name="photo" id="photo" accept="image/*"
                       class="mt-1 block w-full text-sm text-gray-500
                      file:mr-4 file:py-2 file:px-4
                      file:rounded file:border-0
                      file:text-sm file:font-semibold
                      file:bg-indigo-50 file:text-indigo-700
                      hover:file:bg-indigo-100">
                <p class="mt-1 text-xs text-gray-500">فرمت‌های مجاز: JPEG, PNG, GIF (حداکثر 2MB)</p>
            </div>

            <div>
                <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                    ذخیره پست
                </button>
            </div>
        </form>
    </div>
</x-app-layout>>
