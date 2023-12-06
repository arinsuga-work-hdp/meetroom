<?php

namespace Arins\Bo\Http\Controllers\Bookroom;

use Illuminate\Http\Request;
use Auth;

use Arins\Facades\ConvertDate;
use Arins\Facades\Formater;

trait TransformField
{

    //Overrideable from WebController method
    protected function transformFieldCreate($paDataField) {
        $dataField = $paDataField;

        $dataField['room_id'] = $this->room_id;

        if (isset($paDataField['startdt'])) {

            $startdt = $dataField['meetingdt'].' '.$dataField['startdt'].':00'; 
            $dataField['startdt'] = ConvertDate::strDatetimeToDate($startdt);

        }

        if (isset($paDataField['enddt'])) {

            $enddt = $dataField['meetingdt'].' '.$dataField['enddt'].':00'; 
            $dataField['enddt'] = ConvertDate::strDatetimeToDate($enddt);
    
        }

        if (isset($paDataField['meetingdt'])) {

            $meetingdt = $dataField['meetingdt'].' 00:00:00'; 
            $dataField['meetingdt'] = ConvertDate::strDatetimeToDate($meetingdt);

        }

        $dataField['snack'] = 0;
        if (isset($paDataField['snack'])) {

            if (strtolower($paDataField['snack']) == 'on' ) {
                $dataField['snack'] = 1;
            } //end if

        } //end if

        return $dataField;
    }

    //Overrideable from WebController method
    protected function transformFieldEdit($paDataField) {

        $dataField = $paDataField;

        return $dataField;
    }

    //Overrideable method
    protected function transformFieldUpdate($paDataField) {

        $dataField = $this->transformFieldCreate($paDataField);

        return $dataField;
    }

}

