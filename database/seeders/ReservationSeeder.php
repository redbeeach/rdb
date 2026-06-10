<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Treatment;
use App\Models\TimeSlot;

class ReservationSeeder extends Seeder
{
    public function run(): void
    {
        // 시술 데이터
        $treatments = [
            ['name' => '보톡스·필러', 'description' => '자연스러운 볼륨과 탄력으로 젊고 생기있는 피부를 만들어드립니다', 'duration' => 60, 'price' => 150000, 'sort_order' => 1],
            ['name' => '레이저 토닝', 'description' => '색소 침착과 잡티를 효과적으로 개선하여 맑고 균일한 피부톤을 완성합니다', 'duration' => 45, 'price' => 100000, 'sort_order' => 2],
            ['name' => '피부 재생', 'description' => '손상된 피부 장벽을 회복하고 피부 본연의 건강함을 되찾아드립니다', 'duration' => 90, 'price' => 200000, 'sort_order' => 3],
        ];

        foreach ($treatments as $treatment) {
            Treatment::create($treatment);
        }

        // 예약 시간 데이터
        $timeSlots = [
            ['time' => '10:00', 'sort_order' => 1],
            ['time' => '11:00', 'sort_order' => 2],
            ['time' => '13:00', 'sort_order' => 3],
            ['time' => '14:00', 'sort_order' => 4],
            ['time' => '15:00', 'sort_order' => 5],
            ['time' => '16:00', 'sort_order' => 6],
            ['time' => '17:00', 'sort_order' => 7],
            ['time' => '18:00', 'sort_order' => 8],
        ];

        foreach ($timeSlots as $slot) {
            TimeSlot::create($slot);
        }
    }
}