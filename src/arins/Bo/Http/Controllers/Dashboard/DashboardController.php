<?php

namespace Arins\Bo\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

use Arins\Repositories\Activitytype\ActivitytypeRepositoryInterface;
use Arins\Repositories\Activity\ActivityRepositoryInterface;
use Arins\Repositories\ActivityView\ActivityViewRepositoryInterface;
use Arins\Repositories\ActivityViewjoin\ActivityViewjoinRepositoryInterface;
use Arins\Repositories\UserabsensiView\UserabsensiViewRepositoryInterface;

use Arins\Facades\Response;
use Arins\Facades\Filex;
use Arins\Facades\Formater;
use Arins\Facades\ConvertDate;

class DashboardController extends Controller
{

    protected $sViewRoot;
    protected $data, $dataView, $dataViewjoin;
    protected $dataAbsensiView;
    protected $dataActivitytype;
    protected $dataModel;
    protected $validateFields;


    /**
     * Create a new controller instance.
     *
     * Method Name: Constructor
     * 
     * @return void
     */
    public function __construct(ActivityRepositoryInterface $parData,
                                ActivityViewRepositoryInterface $parDataView,
                                ActivityViewjoinRepositoryInterface $parDataViewjoin,
                                ActivitytypeRepositoryInterface $parActivitytype,
                                UserabsensiViewRepositoryInterface $parDataAbsensiView)
    {
        $this->middleware('auth.admin');
        $this->middleware('is.admin');

        $psViewRoot = 'bo.dashboard';
        $this->sViewRoot = $psViewRoot;
        $this->data = $parData;
        $this->dataView = $parDataView;
        $this->dataViewjoin = $parDataViewjoin;
        $this->dataActivitytype = $parActivitytype;
        $this->dataAbsensiView = $parDataAbsensiView;
        $this->validateFields = [
            //code array here...
            'startdt' => 'required',
            'enddt' => 'required',
            'activitytype_id' => 'required',
            'description' => 'required',
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
        $user = Auth::user();

        $userId = Auth::user()->id;
        $untilDate = Carbon::today();
        $yearMonth = $untilDate->year. str_pad($untilDate->month, 2, '0', STR_PAD_LEFT);

        $year = $untilDate->year;
        $month = $untilDate->month;
        $months = config('a1.date.iso.months');
        $monthKeys = array_keys($months);
        $monthText = $monthKeys[$month];
        

        $incident = $this->dataView->countOpenSupportIncidentByUserUntilDate($userId, $untilDate);
        $request = $this->dataView->countOpenSupportRequestByUserUntilDate($userId, $untilDate);
        $pending = $this->dataView->countSupportPendingByUserUntilDate($userId, $untilDate);
        $mytask = $this->dataViewjoin->getSupportByUser($userId, 5);
        $project = $this->dataViewjoin->getProjectByUser($userId, 5);
        $absensiView = $this->dataAbsensiView->byUserIdYearMonth($userId, $yearMonth, 10);

        $absensiTemp = array();
        foreach ($absensiView as $index => $item) {
            # code...
            array_push($absensiTemp, [
                'hari' => config('a1.date.iso.hari')[$item->tgl->dayOfWeek],
                'tanggal' => \Arins\Facades\Formater::dateMonth($item->tgl),
                'masuk' => $item->masuk,
                'keluar' => $item->keluar,
                'lama' => $item->work,
                'lembur' => $item->overtime,
                'catatan' => $item->leavetype,
                'keterangan' => $item->remark,
            ]);
        } //end loop

        $absensi = json_decode(json_encode($absensiTemp));

        $viewModel = Response::viewModel([
            'ticket' => [
                            'incident' => $incident,
                            'request' => $request,
                            'pending' => $pending,
                        ],
            'mytask' => $mytask,
            'project' => $project,
            'absensi' => $absensi,
        ]);

        return view($this->sViewRoot.'.index',
        ['viewModel' => $viewModel, 'year' => $year, 'month' => $month, 'monthText' => $monthText]);
    }

    protected function filters($request) {
        $filter = json_decode(json_encode([
            'tgl' => ConvertDate::strDatetimeToDate($request->input('tgl')),
        ]));

        return $filter;
    }

}
