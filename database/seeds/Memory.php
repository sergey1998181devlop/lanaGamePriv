<?php



use Illuminate\Database\Seeder;

class Memory extends Seeder
{
    const MemoryTypeFirst = 0;
    const MemoryTypeSecond = 1;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            '4 Gb',
            '6 Gb',
            '8 Gb',
            '16 Gb',
            '32 Gb',
            '64 Gb',
        ];
        $dataSave = [];
        foreach ($data as $count){
            $dataSave[] = [
                'title' => $count,
            ];
        }
        \DB::table('memory')->insert($dataSave);
    }
}
