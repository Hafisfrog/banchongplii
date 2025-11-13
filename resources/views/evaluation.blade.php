@extends('layouts.layout')

@section('title', 'ประเมินผลการเรียน | โรงเรียนบ้านช่องพลี')

@section('content')
<div class="p-6 bg-gray-50 rounded-3xl shadow-inner space-y-6">

  <!-- 🔹 หัวข้อ -->
  <h2 class="text-2xl font-bold text-center text-gray-800 mb-4">
    แบบบันทึกผลการเรียน 
    
  </h2>

  <!-- ✅ ตาราง -->
  <div class="bg-white rounded-2xl shadow-md p-4 border border-gray-200">
    <table id="evaluationTable" class="w-full text-sm text-center border-collapse">
      <thead class="bg-blue-700 text-white">
        <tr>
          <th class="p-2 border w-10">เลขที่</th>
          <th class="p-2 border w-20">รหัส</th>
          <th class="p-2 border w-[20%]">ชื่อ - สกุล</th>
          <th class="p-2 border">คะแนนระหว่างภาค (80)</th>
          <th class="p-2 border">สอบปลายภาค (20)</th>
          <th class="p-2 border">รวม (100)</th>
          <th class="p-2 border">เกรด</th>
          <th class="p-2 border">สถานะ</th>
          <th class="p-2 border w-16">จัดการ</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-200 text-gray-700">
        @php
          $students = [
            ['no'=>1,'id'=>2997,'name'=>'นายเจนวิทย์ บุตรหมัน'],
            ['no'=>2,'id'=>3006,'name'=>'นายปภาวิน สายนุ้ย'],
            ['no'=>3,'id'=>3366,'name'=>'นายณัฐศิษฏ์ จงรักษ์'],
            ['no'=>4,'id'=>4474,'name'=>'นายอนุชิต โล่เสื้อ'],
            ['no'=>5,'id'=>2706,'name'=>'น.ส.ชนากานต์ ป้องปิด'],
          ];
        @endphp

        @foreach ($students as $s)
        <tr class="hover:bg-blue-50 transition">
          <td class="p-2 border">{{ $s['no'] }}</td>
          <td class="p-2 border">{{ $s['id'] }}</td>
          <td class="p-2 border text-left px-3">{{ $s['name'] }}</td>

          <td class="p-2 border">
            <input type="number" class="input-cell text-center midterm" value="80" min="0" max="80">
          </td>
          <td class="p-2 border">
            <input type="number" class="input-cell text-center final" value="20" min="0" max="20">
          </td>
          <td class="p-2 border total font-semibold text-blue-700">100</td>
          <td class="p-2 border grade font-semibold text-green-600">4.0</td>
          <td class="p-2 border status font-medium text-gray-700">ปกติ</td>
          <td class="p-2 border">
            <button class="deleteRow text-red-600 hover:text-red-800">ลบ</button>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <!-- ✅ ปุ่ม -->
  <div class="flex justify-end mt-4 space-x-3">
    <button id="addRow" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg transition">
      เพิ่มนักเรียน
    </button>
    <button id="saveBtn" class="bg-blue-700 hover:bg-blue-800 text-white px-5 py-2 rounded-lg transition">
       บันทึกทั้งหมด
    </button>
  </div>
</div>

<!-- ✅ Script -->
<script>
  const table = document.querySelector("#evaluationTable tbody");
  const addRowBtn = document.getElementById("addRow");

  // ฟังก์ชันเพิ่มแถวใหม่
  addRowBtn.addEventListener("click", () => {
    const rowCount = table.rows.length + 1;
    const row = document.createElement("tr");
    row.className = "hover:bg-blue-50 transition";

    row.innerHTML = `
      <td class="p-2 border">${rowCount}</td>
      <td class="p-2 border"><input type="text" class="input-cell text-center" placeholder="รหัส"></td>
      <td class="p-2 border text-left"><input type="text" class="input-cell" placeholder="ชื่อนักเรียน"></td>
      <td class="p-2 border"><input type="number" class="input-cell text-center midterm" min="0" max="80" value="0"></td>
      <td class="p-2 border"><input type="number" class="input-cell text-center final" min="0" max="20" value="0"></td>
      <td class="p-2 border total font-semibold text-blue-700">0</td>
      <td class="p-2 border grade font-semibold text-green-600">-</td>
      <td class="p-2 border status font-medium text-gray-700">-</td>
      <td class="p-2 border"><button class="deleteRow text-red-600 hover:text-red-800">ลบ</button></td>
    `;
    table.appendChild(row);
    updateDeleteButtons();
    updateGradeSystem();
  });

  // ฟังก์ชันลบแถว
  function updateDeleteButtons() {
    document.querySelectorAll(".deleteRow").forEach(btn => {
      btn.onclick = function() {
        this.closest("tr").remove();
        updateRowNumbers();
      };
    });
  }

  // อัปเดตเลขที่
  function updateRowNumbers() {
    document.querySelectorAll("#evaluationTable tbody tr").forEach((tr, idx) => {
      tr.children[0].textContent = idx + 1;
    });
  }

  // ✅ อัปเดตคะแนนรวม + เกรดอัตโนมัติ
  function updateGradeSystem() {
    document.querySelectorAll(".midterm, .final").forEach(input => {
      input.addEventListener("input", () => {
        const tr = input.closest("tr");
        const midterm = parseFloat(tr.querySelector(".midterm").value) || 0;
        const final = parseFloat(tr.querySelector(".final").value) || 0;
        const total = midterm + final;
        const totalCell = tr.querySelector(".total");
        const gradeCell = tr.querySelector(".grade");
        const statusCell = tr.querySelector(".status");

        totalCell.textContent = total;

        // คำนวณเกรด
        let grade = 0;
        if (total >= 80) grade = 4.0;
        else if (total >= 75) grade = 3.5;
        else if (total >= 70) grade = 3.0;
        else if (total >= 65) grade = 2.5;
        else if (total >= 60) grade = 2.0;
        else if (total >= 55) grade = 1.5;
        else if (total >= 50) grade = 1.0;
        else grade = 0;

        gradeCell.textContent = grade.toFixed(1);
        gradeCell.className = "grade p-2 border font-semibold " + (grade >= 1 ? "text-green-600" : "text-red-500");
        statusCell.textContent = grade >= 1 ? "ปกติ" : "ตก";
      });
    });
  }

  updateDeleteButtons();
  updateGradeSystem();

  // ✅ ปุ่มบันทึก
  document.getElementById("saveBtn").addEventListener("click", () => {
    const data = [];
    document.querySelectorAll("#evaluationTable tbody tr").forEach(tr => {
      const midterm = parseFloat(tr.querySelector(".midterm").value) || 0;
      const final = parseFloat(tr.querySelector(".final").value) || 0;
      const total = midterm + final;
      const grade = tr.querySelector(".grade").textContent;
      const status = tr.querySelector(".status").textContent;

      data.push({ midterm, final, total, grade, status });
    });
    console.log("ข้อมูลที่บันทึก:", data);
    alert("✅ บันทึกผลการเรียนสำเร็จ (Log ดูใน Console)");
  });
</script>

<!-- ✅ สไตล์ input -->
<style>
  .input-cell {
    width: 100%;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    padding: 4px 6px;
    font-size: 0.875rem;
    transition: 0.2s;
  }
  .input-cell:focus {
    outline: none;
    border-color: #2563eb;
    box-shadow: 0 0 0 2px #bfdbfe;
  }
</style>
@endsection
