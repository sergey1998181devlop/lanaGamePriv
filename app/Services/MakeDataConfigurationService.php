<?php


namespace App\Services;


use App\Models\TypeMemory;

class MakeDataConfigurationService

{
    const mainDataConfigurationDirectory = [
        'cpus',
        'videoCards',
        'keybords',
        'mouses',
        'headphones',
        'chairs',
        'monitor_types',
        'monitor_hertz',
        'monitors',

        'internetSpeed',
        'memoryCount',
        'memoryType'
    ];
    public function getDataForConfigurationDirectory(array $array): array
    {

        $models = $this->getModalSortByFirm($array['modelsData']);
//список вот этих всех данных надо собирать иначе и все это пихать в сервис провайдер вместе с массивами
        $memoryData = [
            TypeMemory::TypeRAM => [],
            TypeMemory::TypeHDD => []
        ];
        $ram = [];
        $hdd = [];
        foreach ( $array['memory_type'] as $memoryVal){
            if($memoryVal['type_memory'] == TypeMemory::TypeRAM){
                $memoryData[TypeMemory::TypeRAM]['types'][] = $memoryVal;
            }
            if($memoryVal['type_memory'] == TypeMemory::TypeHDD){
                $memoryData[TypeMemory::TypeHDD]['types'][] = $memoryVal;
            }
        }
        foreach ($array['memory'] as $countMemory){
            $memoryData[TypeMemory::TypeRAM]['countMemory'][] = $countMemory;
        }



        $result['dataForView'] = [
            'cpus' => [],
            'videoCards' => [],
            'ram' => $memoryData[TypeMemory::TypeRAM],
            'hdd' => [
                'types' => $memoryData[TypeMemory::TypeHDD]['types']
            ],
            'keyboards' => [

            ],
            'mouse'  =>  [

            ],
            'headphones'  =>  [

            ],
            'chairs'  =>  [

            ],
            'monitor'  =>  [

            ],
            'internet'  =>  [
                'internetSpeedList' => $array['internetSpeedList'],

            ]

        ];
        $result['optionsForView'] = [
            'cpus' => [
                'Фирма' , 'Модель'
            ],
            'videoCards' => [
                'Фирма' , 'Модель'
            ],
            'ram' => [
                'Тип' ,'Обьем'
            ],
            'hdd' => [
                'Тип'
            ],
            'keyboards' => [
                'Фирма'
            ],
            'mouse'  =>  [
                'Фирма'
            ],
            'headphones'  =>  [
                'Фирма'
            ],
            'chairs'  =>  [
                'Фирма'
            ],
            'monitor'  =>  [
                'Фирма' , 'Дюймы' , 'Герцы'
            ],
            'internet'  =>  [
                'Скорость интернета'
            ]
        ];
        $result['listWithoutDopData'] = [
            'type' ,  'keyboards' , 'mouse' , 'headphones' , 'chairs' , 'internet','hdd'
        ];
        $result['listWithoutDopDataModel'] = [
            'type' ,  'keyboards' , 'mouse' , 'headphones' , 'chairs' , 'internet','hdd' , 'monitor'
        ];
        foreach ($array['typeDevicesFirms'] as $type){
            foreach ($type->firms as $id => $firm){
                if(!empty($firm)){
                    $result['dataForView'][$type->slug]['firms'][$id] = [
                        'id' => $firm->id,
                        'title' => $firm->title,
                        'slug' => $firm->slug
                    ] ;

                    if(!empty($models[$firm->id])){
                        foreach ($models[$firm->id] as $model){
                            if($type->slug == 'cpus'){
                                if($model['type_model'] == 0){
                                    $result['dataForView'][$type->slug]['firms'][$id]['models'][] = $model;
                                }
                            }
                            if($type->slug == 'videoCards'){
                                if($model['type_model'] == 1){
                                    $result['dataForView'][$type->slug]['firms'][$id]['models'][] = $model;
                                }
                            }
                        }
                    }
                }
            }
        }

        $result['dataForView']['monitor']['monitorHertz'] = $array['monitorHertz'] ;
        $result['dataForView']['monitor']['monitorInches'] = $array['monitorInches'] ;


        return $result;
    }
    public function getDataForConfigurationDirectoryModel(array $array): array
    {
//        dd($array);
        $models = $this->getModalSortByFirm($array['modelsData']);
        $dataForRemodal = [];
        foreach ($array['typeDevicesFirms'] as $itemTypeDevicesFirms){
//            mainDataConfigurationDirectory
            foreach ($itemTypeDevicesFirms['firms'] as $id =>  $firm){
                if(!empty($firm)){
                    if(!empty($models[$firm->id])) {
                        foreach ($models[$firm['id']] as $model) {
                            if ($itemTypeDevicesFirms->slug == 'cpus') {
                                if ($model['type_model'] == 0) {
                                    $this->mainDataConfigurationDirectory[$itemTypeDevicesFirms->slug][$firm->title][] = $model['title'];
                                }
                            }
                            if ($itemTypeDevicesFirms->slug == 'videoCards') {
                                if ($model['type_model'] == 1) {
                                    $this->mainDataConfigurationDirectory[$itemTypeDevicesFirms->slug][$firm->title][] = $model['title'];
                                }
                            }
                        }
                    }else{
                        $this->mainDataConfigurationDirectory[$itemTypeDevicesFirms->slug][$firm->title] = $firm->title;

                    }
                }
            }
        }

        $this->mainDataConfigurationDirectory['monitor_types'] = $array['monitorInches'] ;
        $this->mainDataConfigurationDirectory['monitorHertz'] = $array['monitorHertz'];
        $this->mainDataConfigurationDirectory['internetSpeed'] = $array['internetSpeedList'];
        $this->mainDataConfigurationDirectory['memoryCount'] = $array['memory'];
        $this->mainDataConfigurationDirectory['memoryType'] = $array['memory_type'];
//        dd($this->mainDataConfigurationDirectory);
        return $this->mainDataConfigurationDirectory;
    }
    protected function getModalSortByFirm($array){
        $models = [];
        foreach ($array as $model) {
            $models[$model['firms_id']][] =  $model;
        }
        return $models;
    }
}
