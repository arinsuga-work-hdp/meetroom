<?php

namespace Arins\Bo\Http\Controllers\Bookroom;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

trait ValidateOrder
{

    protected function validateStartdtEnddt($startdt, $enddt)
    {
        $result = true;

        if ($startdt > $enddt) {

            $result = false;
            $this->validator->errors()->add('startend', 'Jam Mulai tidak boleh lebih besar dari jam selesai');

        } //end if


        return $result;
    }

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

        if ($result == true) {

            $result = $this->validateStartdtEnddt($startdt, $enddt);

        } //end if

        if ($result == true) {

            $validationData = $this->data->existRoomStartEnd($id, $meetingdt, $startdt, $enddt);
            if ( ($validationData < 0) || ($validationData > 0) ) {

                $result = false;
                if ($validationData > 0) {

                    $this->validator->errors()->add('custom', 'Ruang meeting sudah di booking...');

                } //end if

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
        $room_id = $this->room_id;
        $id = $data['id'];
        $meetingdt = $data['meetingdt'];
        $startdt = $data['startdt'];
        $enddt = $data['enddt'];

        if ($result == true) {

            $result = $this->validateStartdtEnddt($startdt, $enddt);

        } //end if

        if ($result == true) {

            $validationData = $this->data->existRoomStartEnd($room_id, $meetingdt, $startdt, $enddt, $id);
            if ( ($validationData < 0) || ($validationData > 0) ) {

                $result = false;
                if ($validationData > 0) {

                    $this->validator->errors()->add('custom', 'Ruang meeting sudah di booking...');

                } //end if

            } //end if

        } //end if


        return $result;
    }

    //Overrideable from WebController method
    protected function validateCustomView($data) {
        $result = true;

        if ( ($data['meetingdt'] === null) &&
            ( ($data['startdt'] !== null) || ($data['enddt'] !== null) ) ) {

                $result = false;

        } //end if


        return $result;
    }

}

