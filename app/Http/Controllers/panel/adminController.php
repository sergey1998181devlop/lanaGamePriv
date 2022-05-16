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
use App\Services\MakeDataConfigurationService;
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
    private $models;

    public function __construct(TypeDevices $typeDevices, Memory $memory, TypeMemory $typeMemory, InternetSpeedLists $internetSpeed , MonitorHertz $monitorHertz , MonitorInches $monitorInches ,Models $models)
    {
        //это все нужно вынести в репозиторий чтобы не было этого списка
        $this->typeDevices = $typeDevices;
        $this->memory = $memory;
        $this->typeMemory = $typeMemory;
        $this->internetSpeed = $internetSpeed;
        $this->monitorHertz = $monitorHertz;
        $this->monitorInches = $monitorInches;
        $this->models = $models;

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
    public function configurationDirectory( MakeDataConfigurationService $service){

        $data = [];
        $data['typeDevicesFirms'] = $this->typeDevices->getTypeDevicesFirms();
        $data['memory'] =  $this->memory->getMemory()->toArray();
        $data['memory_type'] =  $this->typeMemory->getTypeMemory()->toArray();
        $data['internetSpeedList']  = $this->internetSpeed->getInternetSpeeds()->toArray();
        $data['monitorHertz'] = $this->monitorHertz->getMonitorHertz()->toArray();
        $data['monitorInches'] = $this->monitorInches->getMonitorInches()->toArray();
        //модели можно как-то получить через - релейшион - к многим через
        $data['modelsData'] = $this->models->getAllModels()->toArray();
        $result = $service->getDataForConfigurationDirectory($data);
        return view('admin.configuration_directory.directories')
            ->with([ 'resultForView' => $result , 'typeDevicesFirms' => $data['typeDevicesFirms']]);

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
