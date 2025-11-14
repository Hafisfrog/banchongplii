@extends('layouts.layout-admin')

@section('title', 'จัดการข้อมูลนักเรียน')

@section('content')

<h1 class="text-3xl font-bold text-gray-800 mb-6">จัดการข้อมูลนักเรียน</h1>

<!-- ปุ่มเพิ่มนักเรียน และ Import -->
<div class="flex justify-between items-center mb-6">

    <div class="flex gap-3">
        <!-- ปุ่มเปิด Popup เลือกห้อง -->
        <button onclick="openRoomSelector()"
            class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-5 rounded-xl shadow">
             เพิ่มนักเรียน
        </button>

        <!-- ปุ่มเปิด Popup Import Excel -->
        <button onclick="openImportModal()"
            class="bg-green-600 hover:bg-green-700 text-white py-2 px-5 rounded-xl shadow">
             Import Excel
        </button>
    </div>

    <!-- Search -->
    <input type="text" id="searchInput"
           onkeyup="searchStudent()"
           placeholder="ค้นหาชื่อ หรือ รหัสนักเรียน..."
           class="input w-72">
</div>

<!-- Filter ห้อง -->
<div class="mb-6">
    <label class="font-semibold text-gray-700">เลือกห้องเรียน:</label>
    <select id="roomFilter" onchange="filterRoom()" class="input w-48 ml-3">
        <option value="all">ทั้งหมด</option>
        <option value="ป1/1">ป.1/1</option>
        <option value="ป1/2">ป.1/2</option>
        <option value="ป1/3">ป.1/3</option>
    </select>
</div>

<!-- ตารางนักเรียน -->
<div class="bg-white p-6 rounded-2xl shadow-md border overflow-x-auto">
    <table class="w-full border-collapse">
        <thead>
        <tr class="bg-blue-600 text-white">
            <th class="p-3">#</th>
            <th class="p-3">รหัส</th>
            <th class="p-3">ชื่อ</th>
            <th class="p-3">นามสกุล</th>
            <th class="p-3">เพศ</th>
            <th class="p-3">ห้อง</th>
            <th class="p-3 text-center">จัดการ</th>
        </tr>
        </thead>

        <tbody id="studentTable">
        {{-- MOCK DATA --}}
        @php
            $rooms = ['ป1/1', 'ป1/2', 'ป1/3'];
            $firstNames = ['กิตติ','อนันต์','ศิริชัย','นภัสกร','สุรเดช','ธีรภัทร','ชญาน์ทิพย์','กมลชนก','ธนพร'];
            $lastNames = ['บุญมี','ใจดี','แก้วดี','ทองดี','เพ็งดี','พรมมา','แก้วดวงดี','หมื่นไทย'];
            $genders = ['ชาย','หญิง'];
        @endphp

        @for ($i=1;$i<=60;$i++)
            @php
                $room = $rooms[array_rand($rooms)];
                $fname = $firstNames[array_rand($firstNames)];
                $lname = $lastNames[array_rand($lastNames)];
                $gender = $genders[array_rand($genders)];
                $code = 11000 + $i;
            @endphp

            <tr class="border-b student-row"
                data-room="{{ $room }}"
                data-name="{{ strtolower($fname.' '.$lname) }}"
                data-code="{{ $code }}">
                <td class="p-3 text-center">{{ $i }}</td>
                <td class="p-3 text-center font-semibold">{{ $code }}</td>
                <td class="p-3">{{ $fname }}</td>
                <td class="p-3">{{ $lname }}</td>
                <td class="p-3 text-center">{{ $gender }}</td>
                <td class="p-3 text-center text-blue-600 font-semibold">{{ $room }}</td>

                <td class="p-3 text-center">
                    <button onclick="alert('แก้ไข (Mock)')" class="text-yellow-600 font-semibold">แก้ไข</button> |
                    <button onclick="alert('ลบ (Mock)')" class="text-red-600 font-semibold">ลบ</button>
                </td>
            </tr>
        @endfor

        </tbody>
    </table>
</div>

@endsection



{{-- ========================================= --}}
{{--  POPUP #1 เลือกห้องก่อนเพิ่มนักเรียน --}}
{{-- ========================================= --}}
<div id="roomSelectorModal"
     class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50">

    <div class="bg-white rounded-2xl w-[90%] max-w-md p-6 shadow-xl relative">
        <button onclick="closeRoomSelector()"
            class="absolute top-3 right-3 text-gray-500 text-xl">&times;</button>

        <h2 class="text-xl font-bold text-gray-800 mb-4">เลือกห้องเรียน</h2>

        <select id="selectedRoom" class="input w-full mb-6">
            <option value="">-- เลือกห้อง --</option>
            <option value="ป1/1">ป.1/1</option>
            <option value="ป1/2">ป.1/2</option>
            <option value="ป1/3">ป.1/3</option>
        </select>

        <button onclick="goToAddStudent()"
            class="bg-blue-600 hover:bg-blue-700 text-white w-full py-2 rounded-xl">
            ต่อไป ➜
        </button>
    </div>
</div>



{{-- ========================================= --}}
{{--  POPUP #2 Import Excel --}}
{{-- ========================================= --}}
<div id="importModal"
     class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50">

    <div class="bg-white rounded-2xl w-[90%] max-w-md p-6 shadow-xl relative">
        <button onclick="closeImportModal()"
            class="absolute top-3 right-3 text-gray-500 text-xl">&times;</button>

        <h2 class="text-xl font-bold text-gray-800 mb-4">นำเข้ารายชื่อนักเรียน (Excel)</h2>

        <input type="file" class="input w-full mb-4">

        <button onclick="alert('Import Excel แบบ Mock')"
            class="bg-green-600 hover:bg-green-700 w-full text-white py-2 rounded-xl">
             อัปโหลดไฟล์
        </button>
    </div>
</div>


{{-- ========================================= --}}
{{--  POPUP #3 ฟอร์มเพิ่มนักเรียน --}}
{{-- ========================================= --}}
<div id="addStudentModal"
     class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50">

    <div class="bg-white rounded-2xl w-[90%] max-w-md p-6 shadow-xl relative">
        <button onclick="closeAddStudentModal()"
            class="absolute top-3 right-3 text-gray-500 text-xl">&times;</button>

        <h2 class="text-xl font-bold text-gray-800 mb-4">
            เพิ่มนักเรียน (ห้อง: <span id="selectedRoomText" class="text-blue-700"></span>)
        </h2>

        <div class="mb-4">
            <label class="font-semibold">ชื่อนักเรียน</label>
            <input type="text" id="newFirstName" class="input w-full" placeholder="ชื่อจริง">
        </div>

        <div class="mb-4">
            <label class="font-semibold">นามสกุล</label>
            <input type="text" id="newLastName" class="input w-full" placeholder="นามสกุล">
        </div>

        <button onclick="addStudent()"
            class="bg-blue-600 hover:bg-blue-700 text-white w-full py-2 rounded-xl">
            ➕ เพิ่มนักเรียน
        </button>
    </div>
</div>



{{-- ============================= --}}
{{--  SCRIPT --}}
{{-- ============================= --}}
<script>

function searchStudent() {
    let input = document.getElementById("searchInput").value.toLowerCase();
    document.querySelectorAll(".student-row").forEach(row => {
        let name = row.dataset.name;
        let code = row.dataset.code;
        row.style.display = (name.includes(input) || code.includes(input)) ? "" : "none";
    });
}

function filterRoom() {
    let selected = document.getElementById("roomFilter").value;
    document.querySelectorAll(".student-row").forEach(row => {
        row.style.display = (selected === "all" || row.dataset.room === selected) ? "" : "none";
    });
}


/* ===== Popup เลือกห้อง ===== */
function openRoomSelector() {
    document.getElementById("roomSelectorModal").classList.remove("hidden");
}
function closeRoomSelector() {
    document.getElementById("roomSelectorModal").classList.add("hidden");
}

function goToAddStudent() {
    let room = document.getElementById("selectedRoom").value;

    if (!room) {
        alert("กรุณาเลือกห้องก่อน");
        return;
    }

    closeRoomSelector();

    document.getElementById("selectedRoomText").innerText = room;
    document.getElementById("addStudentModal").classList.remove("hidden");
}


/* ===== Popup Add Student ===== */
function closeAddStudentModal() {
    document.getElementById("addStudentModal").classList.add("hidden");
}

function addStudent() {

    let fname = document.getElementById("newFirstName").value.trim();
    let lname = document.getElementById("newLastName").value.trim();
    let room = document.getElementById("selectedRoomText").innerText;

    if (!fname || !lname) {
        alert("กรุณากรอกข้อมูลให้ครบ");
        return;
    }

    let table = document.getElementById("studentTable");

    let newCode = Math.floor(10000 + Math.random() * 89999);

    let newRow = `
        <tr class="border-b student-row"
            data-room="${room}"
            data-name="${(fname + ' ' + lname).toLowerCase()}"
            data-code="${newCode}">
            <td class="p-3 text-center">ใหม่</td>
            <td class="p-3 text-center font-semibold">${newCode}</td>
            <td class="p-3">${fname}</td>
            <td class="p-3">${lname}</td>
            <td class="p-3 text-center">-</td>
            <td class="p-3 text-center text-blue-600 font-semibold">${room}</td>

            <td class="p-3 text-center">
                <button onclick="alert('แก้ไข (Mock)')" class="text-yellow-600 font-semibold">แก้ไข</button> |
                <button onclick="this.parentNode.parentNode.remove()" class="text-red-600 font-semibold">ลบ</button>
            </td>
        </tr>
    `;

    table.insertAdjacentHTML('afterbegin', newRow);

    closeAddStudentModal();
    document.getElementById("newFirstName").value = "";
    document.getElementById("newLastName").value = "";

    alert("เพิ่มนักเรียนเรียบร้อย (Mock)");
}


/* ===== Popup Import ===== */
function openImportModal() {
    document.getElementById("importModal").classList.remove("hidden");
}
function closeImportModal() {
    document.getElementById("importModal").classList.add("hidden");
}

</script>
