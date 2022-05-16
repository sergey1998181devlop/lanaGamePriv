<?php


use Illuminate\Database\Seeder;

class InternetSpeedLists extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            '<100 Мбит',
            '>100 Мбит',
            '>1 Гбит'
        ];
        $dataSave = [];
        foreach ($data as $item){
            $dataSave[] = [
                'title' => $item
            ];
        }
        \DB::table('internet_speed_list')->insert($dataSave);
    }
}
