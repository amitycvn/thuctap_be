<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRewardMilestoneHistoryTable extends Migration
{
    public function up()
    {
        Schema::create('reward_milestone_history', function (Blueprint $table) {
            $table->id(); // Tạo trường id tự tăng
            $table->string('public_key'); // Thêm public_key để liên kết với bảng chính
            $table->string('reward_milestone'); // Mốc thưởng, có thể là tên hoặc mô tả
            $table->integer('reward_value'); // Giá trị của mốc thưởng (có thể là điểm hoặc tiền)
            $table->timestamp('achieved_at')->useCurrent(); // Thời gian đạt được mốc thưởng
            $table->timestamps(); // Thêm cột created_at và updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('reward_milestone_history');
    }
}
