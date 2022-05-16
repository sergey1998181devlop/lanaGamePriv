<?php



use Illuminate\Database\Seeder;

class MonitorHertz extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            '60',
            '75',
            '100',
            '120',
            '144',
            '165',
            '240',
            '280',
            '360',
        ];
        $dataSave = [];
        foreach ($data as $item){
            $dataSave[] = [
                'title' => $item
            ];
        }
        \DB::table('monitor_hertz')->insert($dataSave);
    }
}
