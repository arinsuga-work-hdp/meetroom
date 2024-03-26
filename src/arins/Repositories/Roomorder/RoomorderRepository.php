<?php

namespace Arins\Repositories\Roomorder;

use Arins\Repositories\BaseRepository;
use Arins\Repositories\Roomorder\RoomorderRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Arins\Facades\Formater;
use Arins\Facades\Meetroom\Orderstatus;

class RoomorderRepository extends BaseRepository implements RoomorderRepositoryInterface
{
    public function __construct($parData)
    {
        parent::__construct($parData);

        $this->inputField = [
            'name' => null,
            'phone_ext' => null,
            'email' => null,
            'room_id' => null,
            'dept_id' => null,
            'orderstatus_id' => null,
            'orderby_id' => null,
            'orderfor_id' => null,
            'participants' => null,
            'snack' => null,
            'subject' => null,
            'description' => null,
            'resolution' => null,
            'image' => null,
            'meetingdt' => null,
            'startdt' => null,
            'enddt' => null,
        ];

        $this->validateInput = [
            'name' => 'required',
            'email' => 'nullable|email:rfc,dns',
            'participants' => 'required|numeric',
            'meetingdt' => 'required',
            'startdt' => 'required',
            'enddt' => 'required',
            'subject' => 'required',
        ];

        $this->validateField = [
            //code array here...
            // 'startdt' => 'required',
            // 'activitytype_id' => 'required',
            //remarkfortes 'activitysubtype_id' => 'required',
            //remarkfortes 'tasktype_id' => 'required',
            // 'subject' => 'required',
            // 'description' => 'required',
        ];

    }

    public function byRoomOrderByIdDesc($id)
    {
        $result = $this->model::where('room_id', $id)
                  ->orderBy('id', 'desc')
                  ->get();

        return $result;
    }

    public function byRoomStatusOpenOrderByIdAndStartdtDesc($id, $take=null)
    {
        if ($take == null) {

            return $this->model::where('room_id', $id)
            ->where('orderstatus_id', 1)
            ->orderBy('startdt', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        } else {
            return $this->model::where('room_id', $id)
            ->where('orderstatus_id', 1)
            ->take($take)
            ->get();
        }
    }

    public function byRoomStatusCancelOrderByIdAndStartdtDesc($id, $take=null)
    {
        if ($take == null) {

            return $this->model::where('room_id', $id)
            ->where('orderstatus_id', 4)
            ->orderBy('startdt', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        } else {
            return $this->model::where('room_id', $id)
            ->where('orderstatus_id', 4)
            ->take($take)
            ->get();
        }
    }

    public function byRoomTodayOrderByStartdt($id, $take=null)
    {
        if ($take == null) {

            return $this->model::where('room_id', $id)
            ->where('orderstatus_id', 1)
            ->whereDate('meetingdt', Carbon::today())
            ->orderBy('startdt')
            ->get();

        } else {
            return $this->model::where('room_id', $id)
            ->take($take)
            ->get();
        }
    }

    public function byRoomTodayOrderByIdAndStartdtDesc($id, $take=null)
    {
        if ($take == null) {

            return $this->model::where('room_id', $id)
            ->where('orderstatus_id', 1)
            ->whereDate('meetingdt', Carbon::today())
            ->orderBy('startdt', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        } else {
            return $this->model::where('room_id', $id)
            ->take($take)
            ->get();
        }
    }

    function byRoomCustom($id, $filter, $take=null)
    {
        $result = $this->model::where('room_id', $id);

        //meeting date
        if (isset($filter['meetingdt'])) {
            $result = $result->where('meetingdt', '=', $filter['meetingdt']);
        }

        //name
        if (isset($filter['name'])) {
            $result = $result->where('name', 'like', '%' . $filter['name'] . '%');
        }

        //subject
        if (isset($filter['subject'])) {
            $result = $result->where('subject', 'like', '%' . $filter['subject'] . '%');
        }

        //startdt - enddt
        if (
            isset($filter['startdt']) &&
            isset($filter['enddt'])
        ) {
            $result = $result->where('startdt', '>=', $filter['startdt']);
            $result = $result->where('enddt', '<=', $filter['enddt']);
        }

        //start date
        if (isset($filter['startdt'])) {
            $result = $result->where('startdt', '>=', $filter['startdt']);
        }

        //orderstatus_id
        if (isset($filter['orderstatus_id'])) {
            $result = $result->where('orderstatus_id', $filter['orderstatus_id']);
        }
        
        
        if ($take == null) {
            $result = $result->get();
        } else {
            $result = $result->take($take)->get();
        }

        return $result;
    }

    function existRoomStartEnd($room_id, $meetingdt, $startdt, $enddt, $id = null)
    {
        $result = -1;

        if ( isset($room_id) && isset($meetingdt) && isset($startdt) && isset($enddt) ) {

            $result = 0;
            $orderstatus_id	= 1; //1 = Open


            //id
            $data1 = $this->model::where('room_id', $room_id);
            $data2 = $this->model::where('room_id', $room_id);
            $data3 = $this->model::where('room_id', $room_id);

            if ($id != null) {

                $data1 = $data1->where('id', '!=', $id);
                $data2 = $data2->where('id', '!=', $id);
                $data3 = $data3->where('id', '!=', $id);

            }

            //orederstatus_id
            $data1 = $data1->where('orderstatus_id', $orderstatus_id);
            $data2 = $data2->where('orderstatus_id', $orderstatus_id);
            $data3 = $data3->where('orderstatus_id', $orderstatus_id);

            //meeting date
            $data1 = $data1->where('meetingdt', '=', $meetingdt);
            $data2 = $data2->where('meetingdt', '=', $meetingdt);

            //startdt
            $data1 = $data1->where('startdt', '<=', $startdt);
            $data1 = $data1->where('enddt', '>', $startdt);
            //enddt
            // $data2 = $data2->where('startdt', '<=', $enddt);
            $data2 = $data2->where('startdt', '<', $enddt);
            $data2 = $data2->where('enddt', '>=', $enddt);

            //startdt - enddt
            $data3 = $data3->where('startdt', '>=', $startdt);
            $data3 = $data3->where('enddt', '<=', $enddt);

            $data1 = $data1->get();
            $data2 = $data2->get();
            $data3 = $data3->get();


            // return dd([
            //     'periode' => ['$startdt' => $startdt, '$enddt' => $enddt],
            //     '$data1' => $data1,
            //     '$data2' => $data2,
            //     '$data3' => $data3
            // ]);

            $result = count($data1);
            if ($result <= 0) {
                
                $result = count($data2);
                if ($result <= 0) {

                    $result = count($data3);

                } //end if
    
            } //end if
    

        } //end if      

        return $result;
    }

    public function byRoomWeekOrderByIdAndStartdtDesc($id, $take=null)
    {
        $startdt = Carbon::today();
        $enddt = Carbon::today();
        $weekDay = date('w');

        if ($weekDay != 0) {

            $weekDayAdd = (6 - $weekDay)+1;
            $enddt = $enddt->addDays($weekDayAdd);

        } //end if

        if ($take == null) {

            return $this->model::where('room_id', $id)
            ->where('orderstatus_id', 1)
            ->where('meetingdt', '>=', $startdt)
            ->where('meetingdt', '<=', $enddt)
            ->orderBy('startdt', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        } else {
            return $this->model::where('room_id', $id)
            ->take($take)
            ->get();
        }
    }

    public function byRoomWeekOrderByIdAndStartdt($id, $take=null)
    {
        $startdt = Carbon::today();
        $enddt = Carbon::today();
        $weekDay = date('w');

        if ($weekDay != 0) {

            $weekDayAdd = (6 - $weekDay)+1;
            $enddt = $enddt->addDays($weekDayAdd);

        } //end if

        if ($take == null) {

            $data = $this->model::where('room_id', $id)
            // ->where('orderstatus_id', 1)
            ->whereIn('orderstatus_id', [1, 4])
            ->where('meetingdt', '>=', $startdt)
            ->where('meetingdt', '<=', $enddt)
            ->orderBy('startdt')
            ->orderBy('id')
            ->get();

        } else {
            $data =  $this->model::where('room_id', $id)
            ->take($take)
            ->get();
        }

        

        return $this->scanDone($data);
    }

    protected function scanDone($scanData)
    {
        foreach ($scanData as $item) {
            
            if ($item->orderstatus_id == 1) {

                $item->orderstatus_id = Orderstatus::statusDone($item->orderstatus_id, $item->enddt, Carbon::now());
                
            } //end if

        } //end

        return $scanData;
    }

}