<?php

namespace Arins\Bo\Http\Controllers\Bookroom;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

trait UpdateStatus
{
    public function updateStatus($request, $id, $status) {

        $user = Auth::user();
        //get data from database
        $record = $this->data->find($id);
        $record->orderstatus_id = $status;

        //get input value by fillable fields
        $data = $request->only($this->data->getFillable()); //get field input

        //validate input value (validate resolution)
        if ($status == 2)
        {
            $record->resolution = $request->input('resolution');
            $request->validate(['resolution' => 'required']);
        } //end if
        $data['updated_by'] = $user->id;

        if ($this->data->update($record, $data)) {
            return 0; //success
        }

        /** jika tetap terjadi kesalahan maka ada kesalahan pada system */
        //step 2: Kembali ke halaman input
        return 2; //fail of exception
        
    }

    /** get request approve */
    public function approve($id)
    {
        $this->viewModel = Response::viewModel();
        $this->viewModel->data = $this->data->find($id);
        $this->aResponseData = [
            'viewModel' => $this->viewModel,
            'new' => false,
            'fieldEnabled' => true,
            'dataModel' => $this->dataModel
        ];
        $this->insertDataModelToResponseData();

        return view($this->sViewRoot.'.approve', $this->aResponseData);
    }

    /** put request approve */
    public function updateApprove(Request $request, $id)
    {
        $processResult = $this->updateStatus($request, $id, 2); //Approve Status
        //return 0; //success
        if (isset($this->redirectSuccessUpdate)) {

            return redirect()->route($this->sViewName . '.' . $this->redirectSuccessUpdate);

        } else {

            return redirect()->route($this->sViewName . '.index');

        }
    }

    /** get requst reject */
    public function reject($id)
    {
        $this->viewModel = Response::viewModel();
        $this->viewModel->data = $this->data->find($id);
        $this->aResponseData = [
            'viewModel' => $this->viewModel,
            'new' => false,
            'fieldEnabled' => true,
            'dataModel' => $this->dataModel
        ];
        $this->insertDataModelToResponseData();

        return view($this->sViewRoot.'.reject', $this->aResponseData);
    }

    /** put request reject */
    public function updateReject(Request $request, $id)
    {
        $processResult = $this->updateStatus($request, $id, 3); //Reject Status
        //return 0; //success
        if (isset($this->redirectSuccessUpdate)) {

            return redirect()->route($this->sViewName . '.' . $this->redirectSuccessUpdate);

        } else {

            return redirect()->route($this->sViewName . '.index');

        }
    }

    /** get requst cancel */
    public function cancel($id)
    {
        $this->viewModel = Response::viewModel();
        $this->viewModel->data = $this->data->find($id);
        $this->aResponseData = [
            'viewModel' => $this->viewModel,
            'new' => false,
            'fieldEnabled' => true,
            'dataModel' => $this->dataModel
        ];
        $this->insertDataModelToResponseData();

        return view($this->sViewRoot.'.cancel', $this->aResponseData);
    }

    /** put request cancel */
    public function updateCancel(Request $request, $id)
    {
        $processResult = $this->updateStatus($request, $id, 4); //Cancel Status
        //return 0; //success
        if (isset($this->redirectSuccessUpdate)) {

            return redirect()->route($this->sViewName . '.' . $this->redirectSuccessUpdate);

        } else {

            return redirect()->route($this->sViewName . '.index');

        }
    }

}

