<?php

namespace Arins\Bo\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

use Arins\Http\Controllers\WebController;
use Arins\Repositories\Room\RoomRepositoryInterface;
use Arins\Repositories\Roomorder\RoomorderRepositoryInterface;

use Arins\Facades\Response;
use Arins\Facades\Filex;
use Arins\Facades\Formater;
use Arins\Facades\ConvertDate;
use Arins\Facades\Meetroom\Orderstatus\Orderstatus;

class DashboardController extends WebController
{

    protected $sViewRoot;
    protected $data;
    protected $validateFields;
    protected $postmo_id, $founder_id, $interior_id, $rbulat_id, $faried_id;
    protected $dataPostmo, $dataFounder, $dataInterior, $dataRbulat, $dataFaried;


    /**
     * Create a new controller instance.
     *
     * Method Name: Constructor
     * 
     * @return void
     */
    public function __construct(RoomorderRepositoryInterface $parData)
    {
        $this->middleware('auth.admin');
        $this->middleware('is.admin');

        $psViewRoot = 'bo.dashboard';
        $this->sViewRoot = $psViewRoot;
        $this->data = $parData;
        $this->postmo_id = 1;
        $this->founder_id = 2;
        $this->interior_id = 3;
        $this->rbulat_id = 4;
        $this->faried_id = 5;
        
        $this->dataModel = [
        ];

    }

    /**
     * Method Name: index
     * 
     * http method: GET
     * 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $startdt = Carbon::today();
        // $enddt = Carbon::today();
        // $weekDay = date('w');
        // $weekDayAdd = (6 - $weekDay)+1;
        // $enddt = $startdt->addDays($weekDayAdd);
        // return dd([
        //     '$startdt' => $startdt,
        //     '$enddt' => $enddt,
        //     '$weekDay' => $weekDay,
        //     '$weekDayAdd' => $weekDayAdd
        // ]);


        $this->viewModel = Response::viewModel();
        $this->viewModel->data = null;

        
        //new code
        $this->dataPostmo = $this->data->byRoomWeekOrderByIdAndStartdt($this->postmo_id);
        $this->dataFounder = $this->data->byRoomWeekOrderByIdAndStartdt($this->founder_id);
        $this->dataInterior = $this->data->byRoomWeekOrderByIdAndStartdt($this->interior_id);
        $this->dataRbulat = $this->data->byRoomWeekOrderByIdAndStartdt($this->rbulat_id);
        $this->dataFaried = $this->data->byRoomWeekOrderByIdAndStartdt($this->faried_id);
        

        $this->aResponseData = [
            'viewModel' => $this->viewModel,
            'dataPostmo' => $this->dataPostmo,
            'dataFounder' => $this->dataFounder,
            'dataInterior' => $this->dataInterior,
            'dataRbulat' => $this->dataRbulat,
            'dataFaried' => $this->dataFaried,
        ];
        $this->insertDataModelToResponseData();

        return view($this->sViewRoot.'.index', $this->aResponseData);
    }

    protected function filters($request) {
        $filter = json_decode(json_encode([
            'tgl' => ConvertDate::strDatetimeToDate($request->input('tgl')),
        ]));

        return $filter;
    }

}
