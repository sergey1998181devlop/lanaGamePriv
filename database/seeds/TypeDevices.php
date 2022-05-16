<?php


use Illuminate\Database\Seeder;

class TypeDevices extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $typesDevicesData = [
            'cpus' => 'Процессор',
            'videoCards' => 'Видеокарта',
            'ram'  =>  'Оперативная память',
            'hdd'  =>  'Жёсткий диск',
            'keyboards' => 'Клавиатура',
            'mouse' => 'Мышь',
            'headphones' => 'Гарнитура',
            'chairs' => 'Кресло',
            'monitor' => 'Монитор',
            'internet' => 'Интернет'
        ];

        $typesDevices = [];

        foreach ($typesDevicesData as $id => $typeDevice){
            $typesDevices[] = [
                'title_device' => $typeDevice,
                'slug' => $id
            ];
        }

        \DB::table('type_devices')->insert($typesDevices);
    }
}
