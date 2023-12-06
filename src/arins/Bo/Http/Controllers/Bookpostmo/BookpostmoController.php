<?php

namespace Arins\Bo\Http\Controllers\Bookpostmo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

use Arins\Http\Controllers\WebController;

use Arins\Bo\Http\Controllers\Bookroom\UpdateStatus;
use Arins\Bo\Http\Controllers\Bookroom\ValidateOrder;
use Arins\Bo\Http\Controllers\Bookroom\TransformField;
use Arins\Bo\Http\Controllers\Bookroom\FilterField;

use Arins\Repositories\Orderstatus\OrderstatusRepositoryInterface;
use Arins\Repositories\Room\RoomRepositoryInterface;
use Arins\Repositories\Roomorder\RoomorderRepositoryInterface;

use Arins\Facades\Response;
use Arins\Facades\Timeline;

class BookpostmoController extends WebController
{
    use UpdateStatus, ValidateOrder;
    use TransformField, FilterField;

    protected $dataRoom;
    protected $room_id;

    public function __construct(RoomorderRepositoryInterface $parData,
                                RoomRepositoryInterface $parRoom,
                                OrderstatusRepositoryInterface $parOrderstatus)
    {
        if ($this->sViewName == null)
        {
            $this->sViewName = 'bookpostmo';
            $this->room_id = 1; //Postmo
        } //end if

        parent::__construct();

        $this->data = $parData;
        $this->dataRoom = $parRoom;
        $this->dataOrderstatus = $parOrderstatus;

        $this->dataModel = [
            'room' => $this->dataRoom->all(),
            'orderstatus' => $this->dataOrderstatus->all()
        ];

        /**
         * overrided property.\
         * Set this properties to empty array if you want to use default validation message
         * Set this properties to any like example if you want to customize validation message
         */
        // $this->validationMessages = [
        //     //Example:
        //     // 'required' => 'kolom :attribute wajib diisi.',
        // ];

    } //end construction

    //GET Request overrided method
    public function index()
    {
        $this->viewModel = Response::viewModel();
        $this->viewModel->data = $this->data->byRoomOrderByIdDesc($this->room_id);
        $this->aResponseData = ['viewModel' => $this->viewModel];

        return view($this->sViewRoot.'.index', $this->aResponseData);
    }

    /** get */
    public function indexToday()
    {
        $this->viewModel = Response::viewModel();
        $this->viewModel->data = $this->data->byRoomTodayOrderByIdAndStartdtDesc($this->room_id);

        $this->aResponseData = ['viewModel' => $this->viewModel];

        for ($i=0; $i < count($this->viewModel->data); $i++) { 
            
            $startdt = $this->viewModel->data[$i]['startdt'];
            $enddt = $this->viewModel->data[$i]['enddt'];
            $todayStartTime = Timeline::todayStartTime($startdt);
            $progressStart = Timeline::progressStart($todayStartTime, $startdt);
            $progressRun = Timeline::progressRun($startdt, $enddt);

            $this->viewModel->data[$i]['progressStart'] = $progressStart;
            $this->viewModel->data[$i]['progressRun'] = $progressRun;

        } //end loop


       // return dd($this->viewModel->data);

        return view($this->sViewRoot.'.index-today', $this->aResponseData);
    }

    /** get */
    public function indexOpen()
    {
        $this->viewModel = Response::viewModel();
        $this->viewModel->data = $this->data->byRoomStatusOpenOrderByIdAndStartdtDesc($this->room_id);
        $this->aResponseData = ['viewModel' => $this->viewModel];


        return view($this->sViewRoot.'.index-open', $this->aResponseData);
    }

    /** get */
    public function indexCancel()
    {
        $this->viewModel = Response::viewModel();
        $this->viewModel->data = $this->data->byRoomStatusCancelOrderByIdAndStartdtDesc($this->room_id);
        $this->aResponseData = ['viewModel' => $this->viewModel];


        return view($this->sViewRoot.'.index-cancel', $this->aResponseData);
    }

    /** get */
    public function indexCustom()
    {
        $this->viewModel = Response::viewModel();
        $this->viewModel->data = json_decode(json_encode($this->data->getInputField()));
        $this->viewModel->data->date = now();

        $this->aResponseData = [
            'viewModel' => $this->viewModel,
            'new' => true,
            'fieldEnabled' => true,
        ];
        $this->insertDataModelToResponseData();

        return view($this->sViewRoot.'.index-custom', $this->aResponseData);
    }

    /** post */
    public function indexCustomPost(Request $request)
    {

        $filter = $this->filters($request);

        $this->viewModel = Response::viewModel();
        $data = $this->data->getInputField();
        $data['datalist'] = null;
        $this->viewModel->data = json_decode(json_encode($data));
        $this->viewModel->data->datalist = $this->data->byRoomCustom($this->room_id, $filter);
        
        $this->aResponseData = [
            'viewModel' => $this->viewModel,
            'new' => true,
            'fieldEnabled' => true,
        ];
        $this->insertDataModelToResponseData();

        return view($this->sViewRoot.'.index-custom', $this->aResponseData);
    }

}
