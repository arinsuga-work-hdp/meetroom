<?php

namespace Arins\Bo\Http\Controllers\Bookpostmo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use Arins\Http\Controllers\WebController;

use Arins\Bo\Http\Controllers\Bookroom\UpdateStatus;
use Arins\Repositories\Orderstatus\OrderstatusRepositoryInterface;
use Arins\Repositories\Room\RoomRepositoryInterface;
use Arins\Repositories\Roomorder\RoomorderRepositoryInterface;
use Arins\Facades\Response;
use Arins\Facades\ConvertDate;

class BookpostmoController extends WebController
{
    use UpdateStatus;

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
        $this->insertDataModelToResponseData();

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

    protected function filters($request) {

        $data = [
            'name' => $request->input('name'),
            'meetingdt' => ConvertDate::strDatetimeToDate($request->input('meetingdt')),
            'startdt' => ConvertDate::strDatetimeToDate($request->input('startdt')),
            'enddt' => ConvertDate::strDatetimeToDate($request->input('enddt')),
            'orderstatus_id' => $request->input('orderstatus_id'),
            'subject' => $request->input('subject'),
            'snack' => $request->input('snack'),
        ];
        // $filter = json_decode(json_encode($data));
        $filter = $data;

        return $filter;
    }

    //Overrided method
    protected function transformFieldCreate($paDataField) {
        $dataField = $paDataField;

        $dataField['room_id'] = $this->room_id;

        if (isset($paDataField['meetingdt'])) {
            $dataField['meetingdt'] = ConvertDate::strDatetimeToDate($paDataField['meetingdt']);
        }

        if (isset($paDataField['startdt'])) {
            $dataField['startdt'] = ConvertDate::strDatetimeToDate($paDataField['startdt']);
        }

        if (isset($paDataField['enddt'])) {
            $dataField['enddt'] = ConvertDate::strDatetimeToDate($paDataField['enddt']);
        }

        if (isset($paDataField['snack'])) {

            if (strtolower($paDataField['snack']) == 'on' ) {
                $dataField['snack'] = 1;
            } else {
                $dataField['snack'] = 0;
            } //end if

        } //end if

        return $dataField;
    }

    //Overrideable method
    protected function transformFieldEdit($paDataField) {
        $dataField = $this->transformFieldCreate($paDataField);

        return $dataField;
    }


}
