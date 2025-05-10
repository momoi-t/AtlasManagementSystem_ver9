<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'over_name'       => '山田',
                'under_name'      => '一郎',
                'over_name_kana'  => 'ヤマダ',
                'under_name_kana' => 'イチロウ',
                'mail_address'    => 'yamada1@gmail.com',
                'sex'             => 1, // 1=男性、2=女性、3=その他
                'birth_day'       => '1990-01-01',
                'role'            => 1, // 1=教師(国語)、2=教師(数学)、3=教師(英語)、4=生徒
                'password'        => Hash::make('ichiro1'),
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'over_name'       => '佐藤',
                'under_name'      => '一子',
                'over_name_kana'  => 'サトウ',
                'under_name_kana' => 'イチコ',
                'mail_address'    => 'ichiko1@gmail.com',
                'sex'             => 2,
                'birth_day'       => '1992-05-05',
                'role'            => 2,
                'password'        => Hash::make('ichiko1'),
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
        ]);

    }
}
