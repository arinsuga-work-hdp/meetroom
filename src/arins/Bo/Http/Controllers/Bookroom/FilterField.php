<?php

namespace Arins\Bo\Http\Controllers\Bookroom;

use Illuminate\Http\Request;
use Auth;

use Arins\Facades\ConvertDate;

trait FilterField
{

    protected function filters($data) {

        // $data = [
        //     'name' => $data->input('name'),
        //     'meetingdt' => ConvertDate::strDatetimeToDate($data->input('meetingdt')),
        //     'startdt' => ConvertDate::strDatetimeToDate($data->input('startdt')),
        //     'enddt' => ConvertDate::strDatetimeToDate($data->input('enddt')),
        //     'orderstatus_id' => $data->input('orderstatus_id'),
        //     'subject' => $data->input('subject'),
        //     'snack' => $data->input('snack'),
        // ];

        $result = [];
        if ($data['name'] !== null) {
            $result['name'] = $data['name'];
        }

        if ($data['meetingdt'] !== null) {
            $result['meetingdt'] = $data['meetingdt'];
        }

        if ($data['startdt'] !== null) {
            $result['startdt'] =$data['startdt'];
        }
        
        if($data['enddt'] !== null) {
            $result['enddt'] = $data['enddt'];
        }
        
        if ($data['orderstatus_id'] !== null) {
            $result['orderstatus_id'] = $data['orderstatus_id'];
        }
        
        if ($data['subject'] !== null) {
            $result['subject'] = $data['subject'];
        }

        if ($data['snack'] !== null) {
            $result['snack'] = $data['snack'];
        }


        $filter = $result;

        return $filter;
    }

}

