@extends('layouts.layout-director')

@section('title', 'แดชบอร์ดผู้อำนวยการ')

@section('content')
<div class="space-y-10 overflow-y-auto pr-2">

    <!-- หัวข้อหลัก -->
    <div class="bg-white rounded-3xl shadow p-8 border border-gray-100">
        <h2 class="text-3xl font-bold text-gray-900">แดชบอร์ดผู้อำนวยการ</h2>
        <p class="text-gray-600 mt-2">ยินดีต้อนรับ <span class="font-semibold text-blue-700">{{ Auth::user()->name }}</span></p>
    </div>

    <!-- สถิติหลัก -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="p-6 bg-gradient-to-br from-blue-50 to-blue-200 border border-blue-300 rounded-2xl shadow">
            <h3 class="text-gray-600">จำนวนนักเรียนทั้งหมด</h3>
            <p class="text-4xl font-bold text-blue-800 mt-1">{{ number_format($studentCount ?? 0) }}</p>
        </div>

        <div class="p-6 bg-gradient-to-br from-green-50 to-green-200 border border-green-300 rounded-2xl shadow">
            <h3 class="text-gray-600">จำนวนครูทั้งหมด</h3>
            <p class="text-4xl font-bold text-green-800 mt-1">{{ number_format($teacherCount ?? 0) }}</p>
        </div>

        <div class="p-6 bg-gradient-to-br from-purple-50 to-purple-200 border border-purple-300 rounded-2xl shadow">
            <h3 class="text-gray-600">ห้องเรียนทั้งหมด</h3>
            <p class="text-4xl font-bold text-purple-800 mt-1">{{ number_format($classCount ?? 0) }}</p>
        </div>

    </div>

    <!-- กราฟภาพรวม -->
    <div class="bg-white rounded-3xl shadow p-8 border border-gray-100">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">สถิติภาพรวม</h2>
        <canvas id="overviewChart" class="w-full h-64"></canvas>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('overviewChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['นักเรียน', 'ครู', 'ห้องเรียน'],
            datasets: [{
                label: 'จำนวนทั้งหมด',
                data: [
                    {{ $studentCount ?? 0 }},
                    {{ $teacherCount ?? 0 }},
                    {{ $classCount ?? 0 }}
                ],
                backgroundColor: ['#3b82f6', '#22c55e', '#a855f7']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            }
        }
    });
</script>
@endsection
