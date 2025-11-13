@extends('layouts.layout')

@section('title', 'โครงสร้างรายวิชา | โรงเรียนบ้านช่องพลี')

@section('content')
<div class="p-6 bg-gray-50 rounded-3xl shadow-inner space-y-6">

  <!-- 🔹 ส่วนหัว -->
  <h2 class="text-2xl font-bold text-center text-gray-800 mb-4">
    โครงสร้างคะแนนของรายวิชา 
  </h2>

  <!-- ✅ ตาราง -->
  <div class="bg-white p-4 rounded-2xl shadow-md border border-gray-200">
    <table id="structureTable" class="w-full text-sm text-center border-collapse">
      <thead class="bg-blue-700 text-white">
        <tr>
          <th class="p-2 border w-14">ข้อที่</th>
          <th class="p-2 border w-[35%]">ตัวชี้วัด / รายละเอียด</th>
          <th class="p-2 border w-16">เก็บ</th>
          <th class="p-2 border w-20">สอบกลางภาค</th>
          <th class="p-2 border w-20">สอบปลายภาค</th>
          <th class="p-2 border w-16">รวม</th>
          <th class="p-2 border w-16">จัดการ</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-200 text-gray-700">
        <tr>
          <td class="p-2 border">1</td>
          <td class="p-2 border text-left">
            <input type="text" class="input-cell font-medium" 
              value="เทคโนโลยีสารสนเทศในการแก้ปัญหาหรือเพิ่มมูลค่าให้กับบริการหรือผลิตภัณฑ์ในชีวิตจริงอย่างสร้างสรรค์">
          </td>
          <td class="p-2 border"><input type="number" class="input-cell text-center" value="70"></td>
          <td class="p-2 border"><input type="number" class="input-cell text-center" value="10"></td>
          <td class="p-2 border"><input type="number" class="input-cell text-center" value="20"></td>
          <td class="p-2 border font-semibold text-blue-700">100</td>
          <td class="p-2 border">
            <button class="deleteRow text-red-600 hover:text-red-800">ลบ</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- ✅ ปุ่มควบคุม -->
  <div class="flex justify-end mt-4 space-x-3">
    <button id="addRow" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg transition">
       เพิ่มแถว
    </button>
    <button id="saveBtn" class="bg-blue-700 hover:bg-blue-800 text-white px-5 py-2 rounded-lg transition">
       บันทึกทั้งหมด
    </button>
  </div>
</div>

<!-- ✅ Script -->
<script>
  const table = document.querySelector("#structureTable tbody");
  const addRowBtn = document.getElementById("addRow");

  // เพิ่มแถวใหม่
  addRowBtn.addEventListener("click", () => {
    const rowCount = table.rows.length + 1;
    const row = document.createElement("tr");
    row.className = "hover:bg-blue-50 transition";

    row.innerHTML = `
      <td class="p-2 border">${rowCount}</td>
      <td class="p-2 border text-left">
        <input type="text" class="input-cell font-medium" placeholder="พิมพ์ชื่อตัวชี้วัด...">
      </td>
      <td class="p-2 border"><input type="number" class="input-cell text-center" value="0"></td>
      <td class="p-2 border"><input type="number" class="input-cell text-center" value="0"></td>
      <td class="p-2 border"><input type="number" class="input-cell text-center" value="0"></td>
      <td class="p-2 border font-semibold text-blue-700">0</td>
      <td class="p-2 border">
        <button class="deleteRow text-red-600 hover:text-red-800">ลบ</button>
      </td>
    `;
    table.appendChild(row);
    updateDeleteButtons();
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

  // อัปเดตเลขข้อ
  function updateRowNumbers() {
    document.querySelectorAll("#structureTable tbody tr").forEach((tr, idx) => {
      tr.children[0].textContent = idx + 1;
    });
  }

  updateDeleteButtons();

  // ฟังก์ชันบันทึก (แสดงใน console)
  document.getElementById("saveBtn").addEventListener("click", () => {
    const data = [];
    document.querySelectorAll("#structureTable tbody tr").forEach(tr => {
      const cells = tr.querySelectorAll("input");
      data.push({
        indicator: cells[0].value,
        score_keep: cells[1].value,
        midterm: cells[2].value,
        final: cells[3].value,
        total: Number(cells[1].value) + Number(cells[2].value) + Number(cells[3].value)
      });
    });
    console.log("บันทึกข้อมูล:", data);
    alert("✅ บันทึกข้อมูลสำเร็จ (Log ดูใน Console)");
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
