@extends('layouts.layout-admin')

@section('title', 'แดชบอร์ดผู้ดูแลระบบ')

@section('content')

<h1 class="text-3xl font-bold text-gray-800 mb-2">แดชบอร์ดผู้ดูแลระบบ</h1>
<p class="text-gray-600 mb-6">ยินดีต้อนรับ ผู้ดูแลระบบ</p>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <!-- MOCK จำนวนผู้ใช้งาน -->
    <div class="p-6 bg-blue-100 border border-blue-200 rounded-2xl shadow-sm">
        <h3 class="text-gray-600 mb-1">จำนวนผู้ใช้งานทั้งหมด</h3>
        <p class="text-4xl font-bold text-blue-700">-</p>
    </div>

    <!-- MOCK จำนวนครู -->
    <div class="p-6 bg-green-100 border border-green-200 rounded-2xl shadow-sm">
        <h3 class="text-gray-600 mb-1">จำนวนครูทั้งหมด</h3>
        <p class="text-4xl font-bold text-green-700">-</p>
    </div>

    <!-- MOCK จำนวนห้อง -->
    <div class="p-6 bg-purple-100 border border-purple-200 rounded-2xl shadow-sm">
        <h3 class="text-gray-600 mb-1">จำนวนห้องเรียน</h3>
        <p class="text-4xl font-bold text-purple-700">-</p>
    </div>

</div>

{{-- ปุ่มลัด --}}
{{-- <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-10">

    <a href="/dashboard/teacher"
       class="p-6 bg-blue-600 text-white rounded-2xl hover:bg-blue-700 block text-center shadow">
       ➕ เพิ่มนักเรียน
    </a>

    <a href="/admin/users"
       class="p-6 bg-indigo-600 text-white rounded-2xl hover:bg-indigo-700 block text-center shadow">
       👥 จัดการบัญชีผู้ใช้งาน
    </a>

</div> --}}

@endsection
