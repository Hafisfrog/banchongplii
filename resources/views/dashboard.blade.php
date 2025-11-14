@extends('layouts.layout')

@section('title', 'ข้อมูลนักเรียน')

@section('content')

@php
    // ห้องเรียนของครู (MOCK)
    $teacherRoom = 'ป1/1';

    // mock data
    $rooms = ['ป1/1', 'ป1/2', 'ป1/3'];
    $firstNames = ['กิตติ','อนันต์','ศิริชัย','นภัสกร','สุรเดช','ธีรภัทร','ชญาน์ทิพย์','กมลชนก','ธนพร'];
    $lastNames = ['บุญมี','ใจดี','แก้วดี','ทองดี','เพ็งดี','พรมมา','แก้วดวงดี','หมื่นไทย'];
    $genders = ['ชาย','หญิง'];

    // สร้าง MOCK เฉพาะห้อง ป.1/1
    $mockStudents = [];

    for ($i = 1; $i <= 60; $i++) {
        $room = $rooms[array_rand($rooms)];

        if ($room !== $teacherRoom) continue;

        $mockStudents[] = [
            'code' => 11000 + $i,
            'fname' => $firstNames[array_rand($firstNames)],
            'lname' => $lastNames[array_rand($lastNames)],
            'gender' => $genders[array_rand($genders)],
            'room' => $room
        ];
    }

    // ============= 🔍 SEARCH FILTER =============
    if (request('search')) {
        $keyword = strtolower(request('search'));
        $mockStudents = array_filter($mockStudents, function($stu) use ($keyword) {
            return strpos(strtolower($stu['code']), $keyword) !== false ||
                   strpos(strtolower($stu['fname']), $keyword) !== false ||
                   strpos(strtolower($stu['lname']), $keyword) !== false;
        });
        $mockStudents = array_values($mockStudents);
    }

    // ============= 🚹 FILTER เพศ =============
    if (request('gender') && request('gender') !== 'all') {
        $mockStudents = array_filter($mockStudents, function($stu) {
            return $stu['gender'] === request('gender');
        });
        $mockStudents = array_values($mockStudents);
    }

    // ============= 🔽 SORT ระบบ =============
    if (request('sort') === 'code_asc') {
        usort($mockStudents, fn($a,$b) => $a['code'] <=> $b['code']);
    }
    if (request('sort') === 'code_desc') {
        usort($mockStudents, fn($a,$b) => $b['code'] <=> $a['code']);
    }
    if (request('sort') === 'name_asc') {
        usort($mockStudents, fn($a,$b) => strcmp($a['fname'], $b['fname']));
    }
    if (request('sort') === 'name_desc') {
        usort($mockStudents, fn($a,$b) => strcmp($b['fname'], $a['fname']));
    }

    // ============= 🔢 PAGINATION =============
    $perPage = 10;
    $currentPage = request()->get('page', 1);
    $offset = ($currentPage - 1) * $perPage;

    $totalStudents = count($mockStudents);
    $pageStudents = array_slice($mockStudents, $offset, $perPage);

    $totalPages = ceil($totalStudents / $perPage);
@endphp

<div class="space-y-8 overflow-y-auto pr-2">

  <!-- HEADER -->
  <div class="bg-white rounded-3xl shadow-md p-8 border border-gray-100 mb-2">
      <h2 class="text-3xl font-bold text-gray-900">ข้อมูลนักเรียนห้อง {{ $teacherRoom }}</h2>
      <p class="text-gray-600 mt-1">ยินดีต้อนรับ <span class="font-semibold text-blue-700">{{ Auth::user()->name }}</span></p>
  </div>

  <!-- STATS -->
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <div class="p-6 bg-blue-50 border border-blue-200 rounded-2xl text-center shadow-sm">
          <h3 class="text-sm text-gray-600 mb-1">นักเรียนในห้อง</h3>
          <p class="text-4xl font-bold text-blue-700">{{ $totalStudents }}</p>
      </div>
  </div>

  <!-- SEARCH + FILTER + SORT -->
  <div class="bg-white rounded-3xl shadow-md p-8 border border-gray-100">

      <form method="GET" class="flex flex-wrap gap-3 mb-6">

          <!-- Search -->
          <input type="text" name="search"
                 value="{{ request('search') }}"
                 placeholder="ค้นหารหัส / ชื่อ..."
                 class="input w-60">

          <!-- Gender Filter -->
          <select name="gender" class="input w-40">
              <option value="all">เพศทั้งหมด</option>
              <option value="ชาย" {{ request('gender')=='ชาย' ? 'selected':'' }}>ชาย</option>
              <option value="หญิง" {{ request('gender')=='หญิง' ? 'selected':'' }}>หญิง</option>
          </select>

          <!-- Sort -->
          <select name="sort" class="input w-40">
              <option value="">-- เรียงตาม --</option>
              <option value="code_asc" {{ request('sort')=='code_asc' ? 'selected':'' }}>รหัส ↑</option>
              <option value="code_desc" {{ request('sort')=='code_desc' ? 'selected':'' }}>รหัส ↓</option>
              <option value="name_asc" {{ request('sort')=='name_asc' ? 'selected':'' }}>ชื่อ ↑</option>
              <option value="name_desc" {{ request('sort')=='name_desc' ? 'selected':'' }}>ชื่อ ↓</option>
          </select>

          <button class="bg-blue-600 text-white px-5 rounded-xl">ค้นหา</button>
      </form>

      <!-- TABLE -->
      <div class="overflow-x-auto">
          <table class="min-w-full border border-gray-200 rounded-xl text-sm text-gray-700">
              <thead class="bg-blue-600 text-white">
                  <tr>
                      <th class="py-3 px-4">#</th>
                      <th class="py-3 px-4">รหัส</th>
                      <th class="py-3 px-4">ชื่อ - นามสกุล</th>
                      <th class="py-3 px-4 text-center">เพศ</th>
                      <th class="py-3 px-4 text-center">ห้อง</th>
                      <th class="py-3 px-4 text-center">จัดการ</th>
                  </tr>
              </thead>

              <tbody>
                  @forelse ($pageStudents as $index => $stu)
                  <tr class="border-b hover:bg-blue-50">
                      <td class="py-3 px-4">{{ $offset + $index + 1 }}</td>
                      <td class="py-3 px-4">{{ $stu['code'] }}</td>
                      <td class="py-3 px-4">{{ $stu['fname'] }} {{ $stu['lname'] }}</td>
                      <td class="py-3 px-4 text-center">{{ $stu['gender'] }}</td>
                      <td class="py-3 px-4 text-center">{{ $stu['room'] }}</td>
                      <td class="py-3 px-4 text-center text-xs">
                          <button class="text-yellow-600">แก้ไข</button> |
                          <button class="text-red-600">ลบ</button>
                      </td>
                  </tr>
                  @empty
                  <tr>
                      <td colspan="6" class="text-center py-6 text-gray-500">ไม่มีข้อมูลนักเรียน</td>
                  </tr>
                  @endforelse
              </tbody>
          </table>
      </div>

      <!-- PAGINATION -->
      <div class="flex justify-center mt-6 gap-2">
          @if ($currentPage > 1)
              <a href="?page={{ $currentPage-1 }}" class="px-3 py-1 border rounded">ก่อนหน้า</a>
          @endif

          @for ($p = 1; $p <= $totalPages; $p++)
              <a href="?page={{ $p }}"
                 class="px-3 py-1 border rounded {{ $p==$currentPage ? 'bg-blue-600 text-white' : '' }}">
                 {{ $p }}
              </a>
          @endfor

          @if ($currentPage < $totalPages)
              <a href="?page={{ $currentPage+1 }}" class="px-3 py-1 border rounded">ถัดไป</a>
          @endif
      </div>

  </div>
</div>

@endsection
