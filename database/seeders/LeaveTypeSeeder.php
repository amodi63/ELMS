<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeaveTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('leave_types')->insert([
            [
                'title' => 'إجازة سنوية',
                'description' => 'إجازة لمدة عام كامل'
            ],
            [
                'title' => 'إجازة مرضية',
                'description' => 'إجازة بسبب المرض'
            ],
            [
                'title' => 'إجازة وفاة أحد الأقارب',
                'description' => 'إجازة بسبب وفاة أحد أفراد العائلة'
            ],
            [
                'title' => 'إجازة زواج',
                'description' => 'إجازة بمناسبة الزواج'
            ],
            [
                'title' => 'إجازة منحة',
                'description' => 'إجازة بمناسبة حصول الموظف على منحة'
            ],
            [
                'title' => 'إجازة إجبارية',
                'description' => 'إجازة تُفرض على الموظف من قِبل الإدارة'
            ],
          
        ]);
    }
}
