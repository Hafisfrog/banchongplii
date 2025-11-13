@extends('layouts.layout')

@section('title', 'สรุปผลสัมฤทธิ์ | โรงเรียนบ้านช่องพลี')

@section('content')
  <h2 class="text-2xl font-bold text-gray-800 mb-6">สรุปผลสัมฤทธิ์รายวิชา</h2>

  <!-- 🔹 ตารางสรุปผล -->
  <div class="border rounded-2xl overflow-x-auto mb-6">
    <table class="min-w-[900px] text-sm text-center border-collapse">
      <thead class="bg-blue-700 text-white">
        <tr>
          <th class="p-2 border">ลำดับ</th>
          <th class="p-2 border">รหัสวิชา</th>
          <th class="p-2 border">ชื่อรายวิชา</th>
          <th class="p-2 border">ครูผู้สอน</th>
          <th class="p-2 border">ชั้น / ห้อง</th>
          <th class="p-2 border">จำนวนนักเรียน</th>
          <th class="p-2 border">ผ่านเกณฑ์</th>
          <th class="p-2 border">ร้อยละ</th>
          <th class="p-2 border">คะแนนเฉลี่ย</th>
          <th class="p-2 border">SD</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-200 text-gray-700">
        <tr class="hover:bg-blue-50">
          <td class="border p-2">1</td>
          <td class="border p-2">ว32102</td>
          <td class="border p-2 text-left px-3">วิทยาการคำนวณ 2</td>
          <td class="border p-2">ครูอภิรักษ์ อินทรพงศ์</td>
          <td class="border p-2">ม.5/1</td>
          <td class="border p-2">19</td>
          <td class="border p-2 text-green-600 font-semibold">17</td>
          <td class="border p-2">89.47%</td>
          <td class="border p-2">3.50</td>
          <td class="border p-2">0.96</td>
        </tr>
        <!-- เพิ่มรายวิชาอื่น ๆ ได้ -->
      </tbody>
    </table>
  </div>

  <!-- 🔹 การวิเคราะห์ผลรวม -->
  <div class="grid grid-cols-2 gap-4">
    <div class="border rounded-xl bg-gray-50 p-4">
      <h3 class="font-semibold text-gray-700 mb-2">สรุปภาพรวมรายชั้นเรียน</h3>
      <p>จำนวนนักเรียนทั้งหมด: <span class="font-bold">19 คน</span></p>
      <p>ผ่านเกณฑ์: <span class="font-bold text-green-600">17 คน</span></p>
      <p>ไม่ผ่านเกณฑ์: <span class="font-bold text-red-600">2 คน</span></p>
      <p>ร้อยละการผ่านเกณฑ์: <span class="font-bold text-blue-600">89.47%</span></p>
    </div>

    <div class="border rounded-xl bg-gray-50 p-4">
      <h3 class="font-semibold text-gray-700 mb-2">ผลการเรียนเฉลี่ยรวม</h3>
      <p>คะแนนเฉลี่ยรวม: <span class="font-bold text-blue-600">3.50</span></p>
      <p>ส่วนเบี่ยงเบนมาตรฐาน (SD): <span class="font-bold text-blue-600">0.96</span></p>
    </div>
  </div>

  <!-- 🔹 ปุ่ม -->
  <div class="flex justify-end mt-8">
    <button class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg transition">
      ดาวน์โหลดรายงาน PDF
    </button>
  </div>
@endsection
