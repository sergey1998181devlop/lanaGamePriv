<?php



use Illuminate\Database\Seeder;

class MonitorInches extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            '22"',
            '23,6"',
            '24"',
            '24,5"',
            '25"',
            '27"',
            '28"',
            '29"',
            '30"',
            '31"',
            '31,5"',
            '32"',
            '33"',
            '34"',
            '>34"',
        ];
        $dataSave = [];
        foreach ($data as $item){
            $dataSave[] = [
                'title' => $item
            ];
        }
        \DB::table('monitor_inches')->insert($dataSave);
    }
}
