<?php

use App\Http\Controllers\Api\ApprovalController;
use App\Http\Controllers\Api\TestController;
use App\Http\Controllers\Api\QuestionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ResultController;

    Route::post('/reward-milestone-history', [ApprovalController::class, 'addRewardMilestoneHistory']);

    Route::get('/approval', [ApprovalController::class, 'getApprovalDataByPublicKey']);

    Route::apiResource('tests', TestController::class);


    Route::get('testQuestion/{id}',[TestController::class, 'showQuestions'])->name('test.show_questions');

    // Route cho tạo câu hỏi mới
    Route::post('questions', [QuestionController::class, 'store'])->name('questions.store');

    // Route cho hiển thị form tạo câu hỏi (nếu cần)
    Route::get('questions/create', [QuestionController::class, 'create'])->name('questions.create');

    // Route cho nộp đáp án
    Route::post('submit-answer', [TestController::class, 'submitAnswer'])->name('submitAnswer');

    // Route cho hiển thị điểm số của bài test
    Route::get('tests/{testId}/score', [TestController::class, 'showScore'])->name('tests.score');

    // Route cho hiển thị chi tiết các câu trả lời của người dùng
    Route::get('tests/{testId}/answers', [TestController::class, 'showDetailedAnswers'])->name('tests.answers');

    Route::middleware('api')->group(function () {
        Route::post('createTest',[TestController::class, 'createTest']);
        Route::post('createQuestions', [QuestionController::class, 'store']);
        Route::put('testQuestion/{id}',[TestController::class, 'updateQuestion']);
        Route::delete('deleteQuestion/{id}', [QuestionController::class, 'destroy']);
        Route::post('submit-result', [ResultController::class, 'store']);

        Route::get('approvals', [ApprovalController::class, 'index']);
        Route::post('post-approval', [ApprovalController::class, 'store']);
        Route::get('/{id}', [ApprovalController::class, 'show']);
        Route::put('/approvals/{id}/status', [ApprovalController::class, 'updateStatus']);
        Route::delete('/{id}', [ApprovalController::class, 'destroy']);


    });

    





