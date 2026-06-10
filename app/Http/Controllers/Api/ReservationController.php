<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Helpers\ResponseHelper;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    // 예약 생성 (프론트용)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'treatment_id' => 'required|integer|exists:treatments,id',
            'time_slot_id' => 'required|integer|exists:time_slots,id',
            'date' => 'required|date|after_or_equal:today',
            'name' => 'required|string|max:50',
            'phone' => 'required|string|max:20',
            'memo' => 'nullable|string|max:500',
        ]);

        $validated['status'] = 'pending';
        $reservation = Reservation::create($validated);
        $reservation->load('treatment', 'timeSlot');

        return ResponseHelper::success('reservations.created', $reservation);
    }

    // 예약 목록 (관리자용)
    public function adminIndex(Request $request)
    {
        $query = Reservation::with('treatment', 'timeSlot')
            ->orderBy('date', 'asc')
            ->orderBy('created_at', 'desc');

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('date')) {
            $query->whereDate('date', $request->date);
        }

        $reservations = $query->paginate(20);
        return ResponseHelper::success('reservations.fetched', $reservations);
    }

    // 예약 상세 (관리자용)
    public function adminShow(Reservation $reservation)
    {
        $reservation->load('treatment', 'timeSlot');
        return ResponseHelper::success('reservations.fetched', $reservation);
    }

    // 예약 상태 변경 (관리자용)
    public function updateStatus(Request $request, Reservation $reservation)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        $reservation->update($validated);
        return ResponseHelper::success('reservations.updated', $reservation);
    }

    // 예약 삭제 (관리자용)
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return ResponseHelper::success('reservations.deleted');
    }
}