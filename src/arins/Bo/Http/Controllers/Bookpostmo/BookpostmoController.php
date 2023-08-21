<?php

namespace Arins\Bo\Http\Controllers\Bookpostmo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use Arins\Http\Controllers\WebController;

use Arins\Bo\Http\Controllers\Bookpostmo\UpdateStatus;
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

        foreach ($this->dataModel as $key => $value) {

            $this->aResponseData[$key] = $value;

        } //end loop

        return view($this->sViewRoot.'.index-open', $this->aResponseData);
    }



    protected function filters($request) {
        $filter = json_decode(json_encode([
            'startdt' => ConvertDate::strDatetimeToDate($request->input('startdt')),
            'enddt' => ConvertDate::strDatetimeToDate($request->input('enddt')),
            'activitystatus_id' => $request->input('activitystatus_id'),
            'enduser_id' => $request->input('enduser_id'),
            'technician_id' => $request->input('technician_id'),
            'activitysubtype_id' => $request->input('activitysubtype_id'),
            'tasktype_id' => $request->input('tasktype_id'),
            'tasksubtype1_id' => $request->input('tasksubtype1_id'),
            'tasksubtype2_id' => $request->input('tasksubtype2_id'),
        ]));

        return $filter;
    }

    //Overrided method
    protected function transformField($paDataField) {
        $dataField = $paDataField;
        
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

}
