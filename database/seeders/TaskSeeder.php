<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tasks = [
            [
                'title' => 'Hoàn thành báo cáo tháng 10',
                'description' => 'Tổng hợp và phân tích dữ liệu tháng 10',
                'deadline' => '2025-11-05',
                'status' => 'Đang làm',
                'priority' => 'Cao',
                'created_by' => 1,
                'assigned_to' => 2,
            ],
            [
                'title' => 'Thiết kế giao diện trang chủ',
                'description' => 'Tạo mockup và prototype cho trang chủ mới',
                'deadline' => '2025-11-10',
                'status' => 'Chưa làm',
                'priority' => 'Trung bình',
                'created_by' => 1,
                'assigned_to' => 2,
            ],
            [
                'title' => 'Review code module thanh toán',
                'description' => 'Kiểm tra và đánh giá code của team',
                'deadline' => '2025-11-03',
                'status' => 'Hoàn thành',
                'priority' => 'Cao',
                'created_by' => 1,
                'assigned_to' => 3,
            ],
        ];

        foreach ($tasks as $task) {
            Task::create($task);
        }
    }
}
