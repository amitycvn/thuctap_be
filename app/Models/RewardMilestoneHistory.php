<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RewardMilestoneHistory extends Model
{
    use HasFactory;

    // Định nghĩa bảng nếu tên bảng không theo quy tắc đặt tên mặc định
    protected $table = 'reward_milestone_history';

    // Các trường có thể điền (mass assignable)
    protected $fillable = [
        'public_key',
        'reward_milestone',
        'reward_value',
        'achieved_at',
    ];

    // Nếu bạn không muốn Laravel tự động thêm trường created_at và updated_at,
    // có thể thêm thuộc tính này
    public $timestamps = true;
}
