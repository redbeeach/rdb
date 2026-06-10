<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TimeSlot;
use App\Helpers\ResponseHelper;
use Illuminate\Http\Request;

class TimeSlotController extends Controller
{
    // 활성 시간 목록 (프론트용)
    public function index()
    {
        $timeSlots = TimeSlot::active()->get();
        return ResponseHelper::success('time_slots.fetched', $timeSlots);
    }

    // 전체 시간 목록 (관리자용)
    public function adminIndex()
    {
        $timeSlots = TimeSlot::orderBy('sort_order')->get();
        return ResponseHelper::success('time_slots.fetched', $timeSlots);
    }

    // 시간 생성
    public function store(Request $request)
    {
        $validated = $request->validate([
            'time' => 'required|string|max:10',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ]);

        $timeSlot = TimeSlot::create($validated);
        return ResponseHelper::success('time_slots.created', $timeSlot);
    }

    // 시간 수정
    public function update(Request $request, TimeSlot $timeSlot)
    {
        $validated = $request->validate([
            'time' => 'string|max:10',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ]);

        $timeSlot->update($validated);
        return ResponseHelper::success('time_slots.updated', $timeSlot);
    }

    // 시간 삭제
    public function destroy(TimeSlot $timeSlot)
    {
        $timeSlot->delete();
        return ResponseHelper::success('time_slots.deleted');
    }
}