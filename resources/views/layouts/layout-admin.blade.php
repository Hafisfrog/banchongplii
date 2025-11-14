<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'ระบบผู้ดูแล')</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-screen flex overflow-hidden bg-gray-100 font-sans">

  <!-- 📌 Sidebar สำหรับ Admin -->
  <aside class="w-64 bg-gray-800 text-white shadow-xl rounded-r-3xl p-6 flex flex-col justify-between">
      <div>
          <h1 class="text-lg font-bold mb-8 leading-tight">ผู้ดูแลระบบ</h1>

          <nav class="space-y-2">

             <!-- แดชบอร์ด -->
             <a href="{{ route('dashboard.admin') }}"
               class="block py-2.5 px-4 rounded-xl transition
               {{ request()->routeIs('dashboard.admin') ? 'bg-gray-700 font-medium' : 'hover:bg-gray-700' }}">
               แดชบอร์ด
             </a>

             <!-- จัดการข้อมูลนักเรียน -->
             <a href="{{ route('admin.add-student') }}"
               class="block py-2.5 px-4 rounded-xl transition
               {{ request()->routeIs('admin.add-student') ? 'bg-gray-700 font-medium' : 'hover:bg-gray-700' }}">
               จัดการข้อมูลนักเรียน
             </a>

             <!-- จัดการข้อมูลครู -->
             <a href="{{ route('admin.add-teacher') }}"
               class="block py-2.5 px-4 rounded-xl transition
               {{ request()->routeIs('admin.add-teacher') ? 'bg-gray-700 font-medium' : 'hover:bg-gray-700' }}">
               จัดการข้อมูลครู
             </a>

          </nav>
      </div>

      <form method="POST" action="{{ route('logout') }}" class="mt-8">
          @csrf
          <button type="submit" class="w-full py-2 bg-red-500 hover:bg-red-600 text-white rounded-xl transition">
            ออกจากระบบ
          </button>
      </form>
  </aside>

  <!-- Main -->
  <main class="flex-1 flex flex-col p-10 bg-gray-50 overflow-hidden h-screen">
      <div class="bg-white rounded-3xl shadow-md p-8 border border-gray-100 flex flex-col flex-1 overflow-hidden">
          @yield('content')
      </div>
  </main>

</body>
</html>
