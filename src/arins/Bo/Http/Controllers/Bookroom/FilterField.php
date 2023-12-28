<?php

namespace Arins\Bo\Http\Controllers\Bookroom;

use Illuminate\Http\Request;
use Auth;

use Arins\Facades\ConvertDate;

trait FilterField
{

    protected function filters($request) {

        // $data = [
        //     'name' => $request->input('name'),
        //     'meetingdt' => ConvertDate::strDatetimeToDate($request->input('meetingdt')),
        //     'startdt' => ConvertDate::strDatetimeToDate($request->input('startdt')),
        //     'enddt' => ConvertDate::strDatetimeToDate($request->input('enddt')),
        //     'orderstatus_id' => $request->input('orderstatus_id'),
        //     'subject' => $request->input('subject'),
        //     'snack' => $request->input('snack'),
        // ];

        $data = [];
        if ($request->input('name') !== null) {
            $data['name'] = $request->input('name');
        }

        if ($request->input('meetingdt') !== null) {
            $data['meetingdt'] = ConvertDate::strDatetimeToDate($request->input('meetingdt'));
        }

        if ($request->input('startdt') !== null) {
            $data['startdt'] = ConvertDate::strDatetimeToDate($request->input('startdt'));
        }
        
        if($request->input('enddt') !== null) {
            $data['enddt'] = ConvertDate::strDatetimeToDate($request->input('enddt'));
        }
        
        if ($request->input('orderstatus_id') !== null) {
            $data['orderstatus_id'] = $request->input('orderstatus_id');
        }
        
        if ($request->input('subject') !== null) {
            $data['subject'] = $request->input('subject');
        }

        if ($request->input('snack') !== null) {
            $data['snack'] = $request->input('snack');
        }


        $filter = $data;

        return $filter;
    }

}

