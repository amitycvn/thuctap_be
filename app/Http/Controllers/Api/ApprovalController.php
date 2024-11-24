<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Approval;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class ApprovalController extends Controller
{
    //

    public function index()
    {
        $approvals = Approval::all();
        return response()->json($approvals);
    }

    // Store a new approval
    public function store(Request $request)
{

    $approval = Approval::create([
        'public_key' => $request->public_key,
        'consent_url' => $request->consent_url,
        'status' => $request->status,
    ]);

    return response()->json($approval, 201);
}

    // Show a single approval
    public function show($id)
    {
        $approval = Approval::findOrFail($id);
        return response()->json($approval);
    }

    // Update an existing approval
    public function updateStatus($id): JsonResponse
    {
        try {
            $approval = Approval::findOrFail($id);

            if ($approval->status == 1) {
                return response()->json(['message' => 'Approval has already been updated'], 400);
            }

            $approval->status = 1;
            $approval->save();

            return response()->json(['message' => 'Approval status updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating approval status', 'error' => $e->getMessage()], 500);
        }
    }

    // Delete an approval
    public function destroy($id)
    {
        $approval = Approval::findOrFail($id);
        $approval->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function getApprovalDataByPublicKey(Request $request)
    {
        // Lấy public_key từ tham số query string
        $publicKey = $request->input('public_key');

        // Truy vấn tổng số bản ghi theo public_key
        $totalRecords = Approval::where('public_key', $publicKey)->count();

        // Kiểm tra nếu không có bản ghi nào với public_key
        if ($totalRecords === 0) {
            return response()->json([
                'message' => 'No records found for the given public key.'
            ], 404);
        }

        // Trả về public_key và tổng số bản ghi
        return response()->json([
            'public_key' => $publicKey,
            'total_records' => $totalRecords
        ]);
    }  
    
}
