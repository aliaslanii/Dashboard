<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
                <h2 class="text-xl font-bold">لیست پست‌ها</h2>

                <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                   <form class="flex flex-col sm:flex-row gap-3 w-full md:w-auto" action="{{ route('posts.search') }}">
                       <div class="relative flex-grow" dir="rtl">
                           <input
                               type="text"
                               name="q"
                               placeholder="جستجوی پست..."
                               value="{{ request('q') }}"
                               class="w-full px-4 py-2 rounded border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                           >
                           <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-2.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                           </svg>
                       </div>
                       <select
                           name="category_id"
                           class="px-4 py-2 rounded border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                       >
                           <option value="">همه دسته‌بندی‌ها</option>
                           @foreach($categories as $category)
                               <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                   {{ $category->name }}
                               </option>
                           @endforeach
                       </select>
                       <button type="submit"
                          class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition whitespace-nowrap">
                           جست و جو
                       </button>
                   </form>

                </div>
                <a href="{{ route('posts.create') }}"
                   class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition whitespace-nowrap">
                    ایجاد پست جدید
                </a>
            </div>
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                <tr>
                    <th class="border px-4 py-2">#</th>
                    <th class="border px-4 py-2">نام پست </th>
                    <th class="border px-4 py-2">محتوا </th>
                    <th class="border px-4 py-2">تصویر </th>
                    <th class="border px-4 py-2">دسته بندی </th>
                    <th class="border px-4 py-2">تاریخ انتشار </th>
                    <th class="border px-4 py-2">عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($posts as $post)
                    <tr class="text-center">
                        <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="border px-4 py-2">{{ $post->title }}</td>
                        <td class="border px-4 py-2">{{ $post->content }}</td>
                        <td class="border px-4 py-2">
                            @if ($post->photo_path)
                                <img src="{{ asset('storage/' . $post->photo_path) }}" alt="تصویر" class="h-10 w-10 rounded object-cover">
                            @else
                                <span class="text-gray-400">ندارد</span>
                            @endif
                        </td>
                        <td class="border px-4 py-2">{{ $post->category->name }}</td>
                        <td class="border px-4 py-2">{{ $post->published_at }}</td>
                        <td class="border px-4 py-2">
                            <div class="inline-flex items-center space-x-2">
                                <a href="{{ route('posts.edit', $post->id) }}"
                                   class="text-blue-500 hover:text-blue-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


</x-app-layout>






