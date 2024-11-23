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
}
