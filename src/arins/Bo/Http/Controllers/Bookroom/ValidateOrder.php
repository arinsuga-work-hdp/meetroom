<?php

namespace Arins\Bo\Http\Controllers\Bookroom;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

trait ValidateOrder
{

    //Overrideable from WebController method
    protected function validateStore($data, $validateInput, $validationMessages) {
        $result = true;

        //Basic validation
        $this->validator = Validator::make($data, $validateInput, $validationMessages);
        if ($this->validator->fails()) {

            $result = false;

        } //end if validator

        //Custom validation
        $id = $this->room_id;
        $meetingdt = $data['meetingdt'];
        $startdt = $data['startdt'];
        $enddt = $data['enddt'];
        $validationData = $this->data->existRoomStartEnd($id, $meetingdt, $startdt, $enddt);
        if ( ($validationData < 0) || ($validationData > 0) ) {

            $result = false;
            if ($validationData > 0) {

                $this->validator->errors()->add('custom', 'Ruang meeting sudah di booking...');

            } //end if

        } //end if

        return $result;
    }

    //Overrideable from WebController method
    protected function validateUpdate($data, $validateInput, $validationMessages) {
        $result = true;

        //Basic validation
        $this->validator = Validator::make($data, $validateInput, $validationMessages);
        if ($this->validator->fails()) {

            $result = false;

        } //end if validator

        //Custom validation
        $id = $this->room_id;
        $meetingdt = $data['meetingdt'];
        $startdt = $data['startdt'];
        $enddt = $data['enddt'];
        $validationData = $this->data->existRoomStartEnd($id, $meetingdt, $startdt, $enddt);
        if ( ($validationData < 0) || ($validationData > 0) ) {

            $result = false;
            if ($validationData > 0) {

                $this->validator->errors()->add('custom', 'Ruang meeting sudah di booking...');

            } //end if

        } //end if

        return $result;
    }

}

