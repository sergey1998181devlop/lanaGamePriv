<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TypeDevices::class);
        $this->call(Models::class);
        $this->call(Firms::class);

        $this->call(TypeMemory::class);//тип памяти
        $this->call(Memory::class);//кол-во памяти
        $this->call(MonitorHertz::class);//монитор герцы
        $this->call(MonitorInches::class);//монитор дюймы
        $this->call(InternetSpeedLists::class);//скорость интернета


//        $this->call(MonitorsFirms::class);//тип памяти


        //1 - фирмы
        //2 - модели
        //3 $firms->models()->saveMany(factory(App\firms::class)->make());



        //типы устройств
        //фирмы
        //3 $firms->belongsToMany()->saveMany(factory(App\firms::class)->make());

// $this->call(UsersTableSeeder::class);
//        TypeMemory::factory()->create();
//        $this->call(Database\Seeders\Firms::class);//тип памяти

//        factory(TypeDevicesFactory::class)->create()->each(function ($typeDevice) {
//            $typeDevice->firm()->belongsTo(factory(Firms::class)->make());
//        });
//        factory(TypeDevices::class )->create()->each(function ($typeDevice) {
//
////            $typeDevice->firm(factory(Models::class))
//            dd($typeDevice);
//            // Seed the relation with one address
//            $address = factory(App\CustomerAddress::class)->make();
//
//            $typeDevice->firm()->save($address);
//
//            // Seed the relation with 5 purchases
//            $purchases = factory(App\CustomerPurchase::class, 5)->make();
//            $customer->purchases()->saveMany($purchases);
//        });


    }
}
