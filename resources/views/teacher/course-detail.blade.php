@extends('layouts.layout')

@section('title', 'รายละเอียดหลักสูตร')

@section('content')
<div class="space-y-8 overflow-y-auto pr-2">

    <!-- ========================= -->
    <!--          HEADER           -->
    <!-- ========================= -->
    <div class="bg-white rounded-3xl shadow-md p-8 border border-gray-100 mb-2">
        <h2 class="text-3xl font-bold text-gray-900">รายละเอียดหลักสูตร</h2>
        <p class="text-gray-600 mt-2">ดูรายละเอียดของหลักสูตรที่ครูกำลังสอน</p>
    </div>

    <!-- ========================= -->
    <!--     COURSE INFORMATION    -->
    <!-- ========================= -->
    <div class="bg-white rounded-3xl shadow-md p-8 border border-gray-100">

        <h3 class="text-xl font-semibold text-gray-800 mb-6">ข้อมูลหลักสูตร</h3>

        @php
            $course = [
                'name' => 'คณิตศาสตร์พื้นฐาน ป.1',
                'rooms' => ['ป.1/1','ป.1/2'],
                'term' => 1,
                'year' => 2567,
                'description' => 'หลักสูตรนี้เน้นพื้นฐานการบวก ลบ การนับเลข และการแก้ปัญหาเบื้องต้น'
            ];
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>
                <p class="text-sm text-gray-500">ชื่อหลักสูตร</p>
                <p class="font-semibold text-gray-800 text-lg">{{ $course['name'] }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">ห้องเรียน</p>
                <div class="flex flex-wrap gap-2 mt-1">
                    @foreach ($course['rooms'] as $room)
                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-xl text-sm">{{ $room }}</span>
                    @endforeach
                </div>
            </div>

            <div>
                <p class="text-sm text-gray-500">ภาคเรียน</p>
                <p class="font-semibold text-gray-800">{{ $course['term'] }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">ปีการศึกษา</p>
                <p class="font-semibold text-gray-800">{{ $course['year'] }}</p>
            </div>

            <div class="col-span-2">
                <p class="text-sm text-gray-500">รายละเอียดหลักสูตร</p>
                <p class="text-gray-700 mt-1 leading-relaxed">{{ $course['description'] }}</p>
            </div>

        </div>
    </div>


    <!-- ========================= -->
    <!--     TEACHING HOURS        -->
    <!-- ========================= -->
    <div class="bg-white rounded-3xl shadow-md p-8 border border-gray-100">

        <h3 class="text-xl font-semibold text-gray-800 mb-4">ชั่วโมงที่สอน</h3>

        <div id="hourList" class="space-y-3 mb-4">
            <div class="p-4 bg-gray-100 rounded-xl flex justify-between">
                <span>สอนทฤษฎี — 1 ชั่วโมง/สัปดาห์</span>
                <button class="text-red-600 hover:text-red-800" onclick="this.closest('.p-4').remove()">ลบ</button>
            </div>

            <div class="p-4 bg-gray-100 rounded-xl flex justify-between">
                <span>สอนปฏิบัติ — 2 ชั่วโมง/สัปดาห์</span>
                <button class="text-red-600 hover:text-red-800" onclick="this.closest('.p-4').remove()">ลบ</button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <input type="text" id="newHourName" placeholder="หัวข้อ เช่น ทฤษฎี / ปฏิบัติ"
                   class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400">

            <input type="number" id="newHourValue" placeholder="ชั่วโมง เช่น 1" min="1"
                   class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400">

            <button onclick="addTeachHour()"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl">
                 เพิ่มชั่วโมง
            </button>
        </div>
    </div>


    <!-- ========================= -->
    <!--          TOPICS           -->
    <!-- ========================= -->
    <div class="bg-white rounded-3xl shadow-md p-8 border border-gray-100">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">เนื้อหาที่สอน</h3>

        <div id="topicList" class="space-y-3 mb-4">

            <div class="p-4 bg-gray-100 rounded-xl flex justify-between">
                <span>บทที่ 1 : การนับเลข 1–20</span>
                <button class="text-red-600 hover:text-red-800" onclick="this.closest('.p-4').remove()">ลบ</button>
            </div>

            <div class="p-4 bg-gray-100 rounded-xl flex justify-between">
                <span>บทที่ 2 : การบวกเลขพื้นฐาน</span>
                <button class="text-red-600 hover:text-red-800" onclick="this.closest('.p-4').remove()">ลบ</button>
            </div>
        </div>

        <div class="flex gap-3">
            <input type="text" id="newTopic" placeholder="เพิ่มหัวข้อที่สอน"
                   class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400">
            <button onclick="addTopic()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl">
                เพิ่ม
            </button>
        </div>
    </div>


    <!-- ========================= -->
    <!--       HOMEWORK AREA       -->
    <!-- ========================= -->
    <div class="bg-white rounded-3xl shadow-md p-8 border border-gray-100">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">การบ้าน / ชิ้นงาน</h3>

        <div id="hwList" class="space-y-3 mb-4">

            <div class="p-4 bg-gray-100 rounded-xl">
                <div class="flex justify-between items-center">
                    <span class="font-semibold">ใบงานที่ 1 : นับจำนวนรูปภาพ</span>
                    <button class="text-red-600 hover:text-red-800" onclick="this.closest('.p-4').remove()">ลบ</button>
                </div>

                <p class="text-sm text-gray-600 mt-1">📅 กำหนดส่ง: 12 มกราคม 2568</p>
                <p class="text-sm text-gray-600">🏆 คะแนนเต็ม: 10 คะแนน</p>
            </div>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-3">

            <input type="text" id="newHW" placeholder="ชื่อการบ้าน เช่น ใบงานที่ 2"
                   class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400">

            <input type="date" id="newHWDate"
                   class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400">

            <input type="number" id="newHWScore" placeholder="คะแนนเต็ม" min="1"
                   class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400">
        </div>

        <button onclick="addHW()"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl">
             เพิ่มการบ้าน
        </button>
    </div>


</div>
@endsection



<!-- ============================= -->
<!--             SCRIPT            -->
<!-- ============================= -->
<script>

// =============================
// เพิ่มหัวข้อเนื้อหา
// =============================
function addTopic() {
    let topic = document.getElementById("newTopic").value.trim();
    if (!topic) return;

    document.getElementById("topicList").insertAdjacentHTML("beforeend", `
        <div class="p-4 bg-gray-100 rounded-xl flex justify-between">
            <span>${topic}</span>
            <button class="text-red-600 hover:text-red-800" onclick="this.closest('.p-4').remove()">ลบ</button>
        </div>
    `);

    document.getElementById("newTopic").value = "";
}



// =============================
// เพิ่มชั่วโมงสอน
// =============================
function addTeachHour() {
    let name = document.getElementById("newHourName").value.trim();
    let hour = document.getElementById("newHourValue").value.trim();

    if (!name || !hour) {
        alert("กรุณากรอกข้อมูลให้ครบ");
        return;
    }

    document.getElementById("hourList").insertAdjacentHTML("beforeend", `
        <div class="p-4 bg-gray-100 rounded-xl flex justify-between">
            <span>${name} — ${hour} ชั่วโมง/สัปดาห์</span>
            <button class="text-red-600 hover:text-red-800" onclick="this.closest('.p-4').remove()">ลบ</button>
        </div>
    `);

    document.getElementById("newHourName").value = "";
    document.getElementById("newHourValue").value = "";
}



// =============================
//  เพิ่มการบ้าน + แปลง ค.ศ. → พ.ศ.
// =============================
function addHW() {

    let hw = document.getElementById("newHW").value.trim();
    let date = document.getElementById("newHWDate").value;
    let score = document.getElementById("newHWScore").value;

    if (!hw || !date || !score) {
        alert("กรุณากรอกข้อมูลให้ครบ");
        return;
    }

    // แปลง ค.ศ. → พ.ศ.
    const d = new Date(date);
    const thaiYear = d.getFullYear() + 543;

    const thaiMonths = [
        "มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน",
        "กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม"
    ];

    const formattedThai = `${d.getDate()} ${thaiMonths[d.getMonth()]} ${thaiYear}`;

    document.getElementById("hwList").insertAdjacentHTML("beforeend", `
        <div class="p-4 bg-gray-100 rounded-xl">
            <div class="flex justify-between items-center">
                <span class="font-semibold">${hw}</span>
                <button class="text-red-600 hover:text-red-800" onclick="this.closest('.p-4').remove()">ลบ</button>
            </div>

            <p class="text-sm text-gray-600 mt-1"> กำหนดส่ง: ${formattedThai}</p>
            <p class="text-sm text-gray-600"> คะแนนเต็ม: ${score} คะแนน</p>
        </div>
    `);

    document.getElementById("newHW").value = "";
    document.getElementById("newHWDate").value = "";
    document.getElementById("newHWScore").value = "";
}

</script>
