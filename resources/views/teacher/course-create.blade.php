@extends('layouts.layout')

@section('title', 'สร้างหลักสูตร | ครู')

@section('content')
<div class="space-y-8 overflow-y-auto pr-2">

    <!-- Header -->
    <div class="bg-white rounded-3xl shadow-md p-8 border border-gray-100 mb-2">
        <div>
            <p class="text-sm text-slate-500 uppercase tracking-wide">สำหรับครู</p>
            <h2 class="text-3xl font-bold text-gray-900 mt-1">สร้างหลักสูตรการสอน</h2>
            <p class="text-gray-600 mt-1">
                ยินดีต้อนรับ <span class="font-semibold text-blue-700">{{ Auth::user()->name }}</span>
            </p>
        </div>
    </div>

    <!-- Create Course Form -->
    <div class="bg-white rounded-3xl shadow-md p-8 border border-gray-100">

        <h3 class="text-xl font-semibold text-gray-800 mb-6">เพิ่มหลักสูตรใหม่</h3>

        <form class="space-y-6">

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">ชื่อหลักสูตร</label>
                <input type="text"
                       class="w-full border rounded-lg px-3 py-2 focus:ring-2 
                              focus:ring-blue-400 focus:outline-none"
                       placeholder="เช่น คณิตศาสตร์พื้นฐาน ชั้น ป.1">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">ชั้นเรียน</label>
                    <select class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400">
                        <option>ป1/1</option>
                        <option>ป1/2</option>
                        <option>ป1/3</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">ภาคเรียน</label>
                    <select class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400">
                        <option>ภาคเรียนที่ 1</option>
                        <option>ภาคเรียนที่ 2</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">ปีการศึกษา</label>
                    <input type="number" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400"
                           placeholder="เช่น 2567">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">รายละเอียดหลักสูตร</label>
                <textarea class="w-full border rounded-lg px-3 py-2 h-28 focus:ring-2 focus:ring-blue-400"
                          placeholder="ใส่คำอธิบายรายวิชา / จุดประสงค์ / เนื้อหาการเรียนรู้"></textarea>
            </div>

            <div class="flex justify-end">
                <button type="button"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-xl shadow">
                    บันทึกหลักสูตร
                </button>
            </div>
        </form>

    </div>

    <!-- Course List (Mock Data) -->
    <div class="bg-white rounded-3xl shadow-md p-8 border border-gray-100">

        <h3 class="text-xl font-semibold text-gray-800 mb-4">หลักสูตรที่คุณสร้างไว้</h3>

        @php
            $mockCourses = [
                ['name' => 'คณิตศาสตร์พื้นฐาน ป.1', 'room' => 'ป1/1', 'term' => '1', 'year' => '2567'],
                ['name' => 'ภาษาไทยเพื่อการสื่อสาร ป.1', 'room' => 'ป1/2', 'term' => '1', 'year' => '2567'],
            ];
        @endphp

        <table class="min-w-full border border-gray-200 rounded-xl text-sm">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="py-3 px-4 text-left font-medium">ชื่อหลักสูตร</th>
                    <th class="py-3 px-4 text-center font-medium">ห้อง</th>
                    <th class="py-3 px-4 text-center font-medium">ภาคเรียน</th>
                    <th class="py-3 px-4 text-center font-medium">ปี</th>
                    <th class="py-3 px-4 text-center font-medium">จัดการ</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach ($mockCourses as $c)
                <tr class="hover:bg-blue-50 transition">
                    <td class="py-2 px-4">{{ $c['name'] }}</td>
                    <td class="py-2 px-4 text-center">{{ $c['room'] }}</td>
                    <td class="py-2 px-4 text-center">{{ $c['term'] }}</td>
                    <td class="py-2 px-4 text-center">{{ $c['year'] }}</td>
                    <td class="py-2 px-4 text-center">
                        <button class="text-yellow-600 hover:underline">แก้ไข</button>
                        |
                        <button class="text-red-600 hover:underline">ลบ</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
@endsection
