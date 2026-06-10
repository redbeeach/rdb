<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Treatment;
use App\Helpers\ResponseHelper;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    // 활성 시술 목록 (프론트용)
    public function index()
    {
        $treatments = Treatment::active()->get();
        return ResponseHelper::success('treatments.fetched', $treatments);
    }

    // 전체 시술 목록 (관리자용)
    public function adminIndex()
    {
        $treatments = Treatment::orderBy('sort_order')->get();
        return ResponseHelper::success('treatments.fetched', $treatments);
    }

    // 시술 생성
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'integer|min:1',
            'price' => 'integer|min:0',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ]);

        $treatment = Treatment::create($validated);
        return ResponseHelper::success('treatments.created', $treatment);
    }

    // 시술 수정
    public function update(Request $request, Treatment $treatment)
    {
        $validated = $request->validate([
            'name' => 'string|max:255',
            'description' => 'nullable|string',
            'duration' => 'integer|min:1',
            'price' => 'integer|min:0',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ]);

        $treatment->update($validated);
        return ResponseHelper::success('treatments.updated', $treatment);
    }

    // 시술 삭제
    public function destroy(Treatment $treatment)
    {
        $treatment->delete();
        return ResponseHelper::success('treatments.deleted');
    }
}