<?php

namespace Arins\Bo\Http\Controllers\Bookroom;

use Illuminate\Http\Request;
use Auth;

trait FilterField
{

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
        $filter = $data;

        return $filter;
    }

}

