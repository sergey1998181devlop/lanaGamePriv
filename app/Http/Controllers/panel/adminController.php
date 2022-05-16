<?php

namespace  App\Http\Controllers\panel;

use App\Models\Firms;
use App\Models\InternetSpeedLists;
use App\Models\Memory;
use App\Models\Models;
use App\Models\MonitorHertz;
use App\Models\MonitorInches;
use App\Models\TypeDevices;
use App\Models\TypeMemory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\contact;
use Carbon\Carbon;
use App\club;
use App\offer;
use App\langame_request;
use App\report;
use App\club_report;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use ImageResize;
class adminController extends Controller
{

    private $typeDevices;
    private $memory;
    private $typeMemory;
    private $internetSpeed;
    private $monitorHertz;
    private $monitorInches;

    public function __construct(TypeDevices $typeDevices, Memory $memory, TypeMemory $typeMemory, InternetSpeedLists $internetSpeed , MonitorHertz $monitorHertz , MonitorInches $monitorInches)
    {
        //это все нужно вынести в репозиторий чтобы не было этого списка
        $this->typeDevices = $typeDevices;
        $this->memory = $memory;
        $this->typeMemory = $typeMemory;
        $this->internetSpeed = $internetSpeed;
        $this->monitorHertz = $monitorHertz;
        $this->monitorInches = $monitorInches;

        $this->middleware('rule:1');
    }

    public function index()
    {
        $newMessages = contact::whereNull('seen_at')->count();
        $newReports = report::whereNull('seen_at')->WithoutSpam()->count();
        $newClubs= club::UnderEdit()->count();
        $newOffersClubs = offer::where('type', 'newClub')->where('published_at','=', null)->paginate(99999)->total();
        $newLangameRequests= langame_request::whereNull('seen_at')->count();
        return view('admin.home')->with(['newMessages'=>$newMessages,'newClubs'=>$newClubs,'newOffersClubs'=>$newOffersClubs,'newLangameRequests'=>$newLangameRequests,'newReports'=>$newReports]);
    }

    public function configurationDirectorySave(Request $request ){
        //!КОСТЫЛЬ! тоже надо переписать)
        //предполагаю что нужно это все вынести на отдельные методы - где каждый будет отвечать
        //за свои таблицы
        $data = $request->all();
        $dataSave = [];
        $result = 0;
        switch ($data['typeDevice']){
            case 'cpus':
                if($data['typeNewValue'] == 'models') {
                    $dataSave['title'] = $data['new_val'];
                    $dataSave['firms_id'] = $data['firmId'];
                    $dataSave['type_model'] = 0;
                    $models = Models::create($dataSave);
                }
                if($data['typeNewValue'] == 'firms') {
                    $dataSave['title'] = $data['new_val'];
                    $dataSave['slug'] = Str::slug($data['new_val']);
                    $typeDevice = TypeDevices::find($data['idTypeDevice']); // Modren Chairs, Home Chairs
                    $firms = Firms::create($dataSave);
                    $item = $firms->typeDevices()->attach($typeDevice);
                }
                break;
            case 'videoCards':
                if($data['typeNewValue'] == 'models') {
                    $dataSave['title'] = $data['new_val'];
                    $dataSave['firms_id'] = $data['firmId'];
                    $dataSave['type_model'] = 1;
                    $models = Models::create($dataSave);
                }
                if($data['typeNewValue'] == 'firms') {
                    $dataSave['title'] = $data['new_val'];
                    $dataSave['slug'] = Str::slug($data['new_val']);
                    $typeDevice = TypeDevices::find($data['idTypeDevice']); // Modren Chairs, Home Chairs
                    $firms = Firms::create($dataSave);
                    $item = $firms->typeDevices()->attach($typeDevice);
                }
                break;
            case 'ram':
                 if($data['typeNewValue'] == 'types') {
                     $typeMemory = TypeMemory::TypeRAM;
                     $dataSave['title'] = $data['new_val'];
                     $dataSave['type_memory'] = $typeMemory;
                     $item = new TypeMemory($dataSave);
                     $item->save();
                 }
                if($data['typeNewValue'] == 'countMemory') {
                    $dataSave['title'] = $data['new_val'];
                    $item = new Memory($dataSave);
                    $item->save();
                }
                break;
            case 'hdd':
                $typeMemory = TypeMemory::TypeHDD;
                $dataSave['title'] = $data['new_val'];
                $dataSave['type_memory'] = $typeMemory;
                $item = new TypeMemory($dataSave);
                $item->save();
                break;
            case 'keyboards':
                if($data['typeNewValue'] == 'firms'){
                    $dataSave['title'] = $data['new_val'];
                    $dataSave['slug'] = Str::slug($data['new_val']);
                    $typeDevice = TypeDevices::find($data['idTypeDevice']); // Modren Chairs, Home Chairs
                    $firms = Firms::create($dataSave);
                    $item = $firms->typeDevices()->attach($typeDevice);
                }
                break;
            case 'mouse':
                if($data['typeNewValue'] == 'firms'){
                    $dataSave['title'] = $data['new_val'];
                    $dataSave['slug'] = Str::slug($data['new_val']);
                    $typeDevice = TypeDevices::find($data['idTypeDevice']); // Modren Chairs, Home Chairs
                    $firms = Firms::create($dataSave);
                    $firms->typeDevices()->attach($typeDevice);
                }
                break;
            case 'headphones':
                if($data['typeNewValue'] == 'firms'){
                    $dataSave['title'] = $data['new_val'];
                    $dataSave['slug'] = Str::slug($data['new_val']);
                    $typeDevice = TypeDevices::find($data['idTypeDevice']); // Modren Chairs, Home Chairs
                    $firms = Firms::create($dataSave);
                    $firms->typeDevices()->attach($typeDevice);
                }
                break;
            case 'chairs':
                if($data['typeNewValue'] == 'firms'){
                    $dataSave['title'] = $data['new_val'];
                    $dataSave['slug'] = Str::slug($data['new_val']);
                    $typeDevice = TypeDevices::find($data['idTypeDevice']); // Modren Chairs, Home Chairs
                    $firms = Firms::create($dataSave);
                    $firms->typeDevices()->attach($typeDevice);
                }
                break;
            case 'monitor':
                if($data['typeNewValue'] == 'firms'){
                    $dataSave['title'] = $data['new_val'];
                    $dataSave['slug'] = Str::slug($data['new_val']);
                    $typeDevice = TypeDevices::find($data['idTypeDevice']); // Modren Chairs, Home Chairs
                    $firms = Firms::create($dataSave);
                    $firms->typeDevices()->attach($typeDevice);
                }
                if($data['typeNewValue'] == 'monitorInches'){
                    $dataSave['title'] = $data['new_val'];
                    $item = new MonitorInches($dataSave);
                    $item->save();
                }
                if($data['typeNewValue'] == 'monitorHertz'){
                    $dataSave['title'] = $data['new_val'];
                    $item = new MonitorHertz($dataSave);
                    $item->save();
                }
                break;
            case 'internet':
                $dataSave['title'] = $data['new_val'];
                $item = new InternetSpeedLists($dataSave);
                $item->save();
                break;
        }
        return $result;
    }
    /**
     *  Method for get all data for configs directory list
     */
    public function configurationDirectory( ){

        //cpu type - 0
        //videocards - 1

        $typeDevicesFirms = $this->typeDevices->getTypeDevicesFirms();
        $memory = $this->memory->getMemory()->toArray();
        $memory_type = $this->typeMemory->getTypeMemory()->toArray();

        $internetSpeedList  = $this->internetSpeed->getInternetSpeeds()->toArray();
        $monitorHertz = $this->monitorHertz->getMonitorHertz()->toArray();
        $monitorInches = $this->monitorInches->getMonitorInches()->toArray();

//Санный костыль который я не знаю как решить через связи - как узнаю - перепишу через связь !КОСТЫЛЬ!
        $modelsData = Models::all()->toArray();
        $models = [];
        foreach ($modelsData as $model) {
            $models[$model['firms_id']][] =  $model;
        }
//список вот этих всех данных надо собирать иначе и все это пихать в сервис провайдер вместе с массивами
        $memoryData = [
            TypeMemory::TypeRAM => [],
            TypeMemory::TypeHDD => []
        ];
        $ram = [];
        $hdd = [];
        foreach ($memory_type as $memoryVal){
            if($memoryVal['type_memory'] == TypeMemory::TypeRAM){
                $memoryData[TypeMemory::TypeRAM]['types'][] = $memoryVal;
            }
            if($memoryVal['type_memory'] == TypeMemory::TypeHDD){
                $memoryData[TypeMemory::TypeHDD]['types'][] = $memoryVal;
            }
        }
        foreach ($memory as $countMemory){
            $memoryData[TypeMemory::TypeRAM]['countMemory'][] = $countMemory;
        }

        $optionsForView = [
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

        $dataForView = [
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
                'internetSpeedList' => $internetSpeedList,

            ]

        ];
        $listWithoutDopData = [
            'type' ,  'keyboards' , 'mouse' , 'headphones' , 'chairs' , 'internet','hdd'
        ];
        $listWithoutDopDataModel = [
            'type' ,  'keyboards' , 'mouse' , 'headphones' , 'chairs' , 'internet','hdd' , 'monitor'
        ];
        foreach ($typeDevicesFirms as $type){
            foreach ($type->firms as $id => $firm){
                if(!empty($firm)){
                    $dataForView[$type->slug]['firms'][$id] = [
                        'id' => $firm->id,
                        'title' => $firm->title,
                        'slug' => $firm->slug
                    ] ;

                    if(!empty($models[$firm->id])){
                        foreach ($models[$firm->id] as $model){
                            if($type->slug == 'cpus'){
                                if($model['type_model'] == 0){
                                    $dataForView[$type->slug]['firms'][$id]['models'][] = $model;
                                }
                            }
                            if($type->slug == 'videoCards'){
                                if($model['type_model'] == 1){
                                    $dataForView[$type->slug]['firms'][$id]['models'][] = $model;
                                }
                            }
                        }
                    }
                }
            }
        }

        $dataForView['monitor']['monitorHertz'] = $monitorHertz ;
        $dataForView['monitor']['monitorInches'] = $monitorInches ;

        //   конец костыля
//        dd($dataForView);
        return view(
            'admin.configuration_directory.directories' ,
            compact(
                'typeDevicesFirms',
                'internetSpeedList',
                'dataForView',
                'optionsForView',
                'listWithoutDopData',
                'listWithoutDopDataModel'
            ));
    }
    public function contacts(){
        $messages = contact::select('id','name','phone','email','created_at','seen_at')->whereNull('seen_at')->orderBy('created_at','DESC')->get();
        $messagesR = contact::select('id','name','phone','email','created_at','seen_at')->whereNotNull('seen_at')->orderBy('created_at','DESC')->get();
        $newCount = contact::whereNull('seen_at')->count();
        $new_collection = $messages->merge($messagesR);
        return view('admin.contacts.contacts')->with(['messages'=>$new_collection,'newCount'=>$newCount]);
    }
    public function getMessage(Request $request)
    {
        $message = contact::findOrFail($request->input('id'));
        if($message->seen_at == null){
            $message->seen_at = Carbon::now()->toDateTimeString();
            $message->save();
        }
        $html = '<p>'.$message->name.'</p>';
        $html .= '<p>'.$message->email.'</p>';
        $html .= '<p>'.$message->phone.'</p>';
        $html .= '<h4>'.$message->message.'</h4>';
        $html .= '<p>'.$message->created_at.'</p>';
        return response()->json(['status'=>'success','html'=>$html], 202);
    }
    public function deleteMessage(Request $request)
    {
        $message = contact::findOrFail($request->input('id'));
        $message->delete();
        return back()->with('success',__('messages.Success'));
    }
    public function langameRequests(){
        $langame_requests = langame_request::whereNull('seen_at')->orderBy('created_at','DESC')->with('city_name')->get();
        $langame_requestsR = langame_request::whereNotNull('seen_at')->orderBy('created_at','DESC')->with('city_name')->get();
        $newCount = langame_request::whereNull('seen_at')->count();
        $new_collection = $langame_requests->merge($langame_requestsR);
        return view('admin.contacts.langame_software')->with(['requests'=>$new_collection,'newCount'=>$newCount]);
    }
    public function deleteRequest(Request $request)
    {
        $langame_requests = langame_request::findOrFail($request->input('id'));
        $langame_requests->delete();
        return back()->with('success',__('messages.Success'));
    }
    public function langameRequestsToggle($id)
    {
        $langame_requests = langame_request::select('id','seen_at')->findOrFail($id);
        if($langame_requests->seen_at === null ){
            $langame_requests->seen_at = Carbon::now()->toDateTimeString();
        }else{
            $langame_requests->seen_at = null;
        }
        if( $langame_requests->save())
        return back()->with('success',__('messages.Success'));
    }
    public function errorReports(){
        if(isset($_GET['withSpam'])){
            $reports = report::whereNull('seen_at')->orderBy('created_at','desc')->get();
            $reportsR = report::whereNotNull('seen_at')->orderBy('created_at','desc')->get();
            $newCount = report::whereNull('seen_at')->count();
        }else{
            $reports = report::whereNull('seen_at')->WithoutSpam()->orderBy('created_at','desc')->get();
            $reportsR = report::whereNotNull('seen_at')->WithoutSpam()->orderBy('created_at','desc')->get();
            $newCount = report::whereNull('seen_at')->WithoutSpam()->count();
        }
        $new_collection = $reports->merge($reportsR);
        return view('admin.contacts.reports')->with(['reports'=>$new_collection,'newCount'=>$newCount]);
    }
    public function clubErrorReports(){
        $reports = club_report::whereNull('seen_at')->orderBy('created_at','desc')->get();
        $reportsR = club_report::whereNotNull('seen_at')->orderBy('created_at','desc')->get();
        $newCount = club_report::whereNull('seen_at')->count();
        $new_collection = $reports->merge($reportsR);
        return view('admin.contacts.club_errors')->with(['reports'=>$new_collection,'newCount'=>$newCount]);
    }

    public function getReports(Request $request)
    {
        $report = report::findOrFail($request->input('id'));
        if($report->seen_at == null){
            $report->seen_at = Carbon::now()->toDateTimeString();
            $report->save();
        }
        $html = '<h4>'.$report->message.'</h4>';
        $html .= '<p>'.$report->created_at.'</p>';
        return response()->json(['status'=>'success','html'=>$html], 202);
    }
    public function clubGetReport(Request $request)
    {
        $report = club_report::findOrFail($request->input('id'));
        if($report->seen_at == null){
            $report->seen_at = Carbon::now()->toDateTimeString();
            $report->save();
        }
        $html = '<h4>'.$report->message.'</h4>';
        $html .= '<p>'.$report->created_at.'</p>';
        return response()->json(['status'=>'success','html'=>$html], 202);
    }

    public function deleteErrorReport(Request $request)
    {
        $report = report::findOrFail($request->input('id'));
        $report->delete();
        return back()->with('success',__('messages.Success'));
    }
    public function deleteClubErrorReport(Request $request)
    {
        $report = club_report::findOrFail($request->input('id'));
        $report->delete();
        return back()->with('success',__('messages.Success'));
    }

}
