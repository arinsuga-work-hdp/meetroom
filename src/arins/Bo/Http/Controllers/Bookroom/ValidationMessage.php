<?php

namespace Arins\Bo\Http\Controllers\Bookroom;

trait ValidationMessage
{

    protected function customizeErrorMessage() {

        /**
         * overrided property.\
         * Set this properties to empty array if you want to use default validation message
         * Set this properties to any like example 1 if you want to customize validation message
         * Or add Custom additional validation properties like example 2
         */
        //Example 1:
        // $this->validationMessages = [
        //     // 'required' => 'kolom :attribute wajib diisi.',
        //     // 'email' => 'format alamat email tidak sesuai (contoh: example@mail.com)',
        //     // 'numeric' => 'kolom :attribute harus diisi dengan angka.',
        // ];
        //Example 2:
        //Custom additional validation properties
        // $this->validationMessages['name.required'] = 'Nama wajib diisi.';
        $this->validationMessages['name.required'] = 'Nama wajib diisi.';
        $this->validationMessages['participants.required'] = 'Participants/peserta meeting wajib diisi.';
        $this->validationMessages['subject.required'] = 'Subject wajib diisi.';
        $this->validationMessages['meetingdt.required'] = 'Tanggal meeting wajib diisi.';
        $this->validationMessages['startdt.required'] = 'Jam mulai wajib diisi.';
        $this->validationMessages['enddt.required'] = 'Jam selesai wajib diisi.';

    }

}

