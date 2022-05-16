<?php


use Illuminate\Database\Seeder;

class TypeMemory extends Seeder
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
            'DDR3' => self::MemoryTypeFirst,
            'DDR4' => self::MemoryTypeFirst,
            'DDR5' => self::MemoryTypeFirst,

            'HDD' => self::MemoryTypeSecond,
            'SSD' => self::MemoryTypeSecond,
            'SSD+HDD' => self::MemoryTypeSecond,
            'Бездисковая система' => self::MemoryTypeSecond,
        ];
        $dataSave = [];
        foreach ($data as $titleMemory => $typeMemory){
            $dataSave[] = [
                'title' => $titleMemory,
                'type_memory' => $typeMemory,
            ];
        }
        \DB::table('type_memory')->insert($dataSave);
    }
}
