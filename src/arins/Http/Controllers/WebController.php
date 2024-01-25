<?php

namespace Arins\Http\Controllers;

//CORE
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
//HELPER
use Arins\Facades\Response;
use Arins\Facades\Filex;
use Arins\Facades\Formater;
use Arins\Facades\ConvertDate;
//GET Request
use Arins\Traits\Http\Controller\Getprocess;
use Arins\Traits\Http\Controller\Getresponse;
//POST Request
use Arins\Traits\Http\Controller\Postprocess;
use Arins\Traits\Http\Controller\Postresponseview;

class WebController extends Controller
{
    //GET Request
    use Getprocess, Getresponse;
    //POST Request
    use Postprocess, Postresponseview;

    protected $appConfig, $appMode;
    protected $viewModel, $dataModel, $dataField;
    protected $sViewRoot, $sViewName;
    protected $redirectSuccessStore, $redirectSuccessUpdate, $redirectSuccessDestroy;
    protected $redirectFailStore, $redirectFailUpdate, $redirectFailDestroy;
    protected $aResponseData;
    protected $data, $validator, $validationMessages;
    protected $controllerModes;
    protected $uploadDirectory;

    public function __construct($psViewName=null)
    {
        $this->middleware('auth.admin');
        $this->middleware('is.admin');

        if ($psViewName != null)
        {
            $this->sViewName = $psViewName;
        } //end if
        
        $this->sViewRoot = 'bo.' . $this->sViewName;
        $this->appConfig = 'a1.app';
        $this->appMode = config($this->appConfig . '.mode');
        $this->aResponseData = [];
        $this->dataModel = [];

        /**
         * Overrrideable property.
         * 1. Set this properties to empty array in chiled class
         *    if you want to use default validation message
         * 2. Set this properties to any like example in child class
         *    if you want to customize validation message
         */
        $this->validationMessages = [
            'required' => 'kolom :attribute wajib diisi.',
            'email' => 'format alamat email tidak sesuai (contoh: example@mail.com)',
            'numeric' => 'kolom :attribute harus diisi dengan angka.',
        ];

        //Custom additional validation properties
        $this->customizeErrorMessage();
        
    }

    //GET Request
    public function index()
    {
        $this->viewModel = Response::viewModel();
        $this->viewModel->data = $this->data->allOrderByIdDesc();
        $this->aResponseData = ['viewModel' => $this->viewModel];

        return view($this->sViewRoot.'.index', $this->aResponseData);
    }

    //GET Request
    public function show($id)
    {
        $this->viewModel = Response::viewModel();
        $this->viewModel->data = $this->data->find($id);
        $this->aResponseData = [
            'viewModel' => $this->viewModel,
            'new' => false,
            'fieldEnabled' => false
        ];

        return view($this->sViewRoot.'.show', $this->aResponseData);
    }

    //GET Request
    public function create()
    {
        $this->viewModel = Response::viewModel();
        $this->viewModel->data = json_decode(json_encode($this->data->getInputField()));
        $this->viewModel->data->date = now();
        $this->aResponseData = [
            'viewModel' => $this->viewModel,
            'new' => true,
            'fieldEnabled' => true,
        ];
        $this->insertDataModelToResponseData();

        return view($this->sViewRoot.'.create', $this->aResponseData);
    }

    //POST Request
    public function store(Request $request)
    {
        //get input value by fillable fields
        $user = Auth::user();
        $data = $request->only($this->data->getFillable()); //get field input
        $upload = $request->file('upload'); //upload file (image/document) ==> if included
        $imageTemp = $request->input('imageTemp'); //temporary file uploaded
        $data = $this->transformFieldCreate($data);

        //create temporary uploaded image
        $uploadTemp = Filex::uploadTemp($upload, $imageTemp);
        $request->session()->flash('imageTemp', $uploadTemp);

        //validate input value
        $valid = $this->validateStore($data, $this->data->getValidateInput(), $this->validationMessages);
        if (!$valid) {

            //step 2: Kembali ke halaman input
            //return 1; //fail of validation
            return redirect()->route($this->sViewName . '.create')
            ->withErrors($this->validator)
            ->withInput();

        } //end if validator

        //copy temporary uploaded image to real path
        $data['image'] = Filex::uploadOrCopyAndRemove('', $uploadTemp, $this->uploadDirectory, $upload, 'public', false);
        $data['created_by'] = $user->id;
        //save data
        if ($this->data->create($data)) {

            //return 0; //success
            if (isset($this->redirectSuccessStore)) {
                return redirect()->route($this->sViewName . '.' . $this->redirectSuccessStore);
            } else {
                return redirect()->route($this->sViewName . '.index');
            } //end if

        }

        /** jika tetap terjadi kesalahan maka ada kesalahan pada system */
        //step 1: delete image if fail to save
        Filex::delete($data['image']);

        //step 2: Kembali ke halaman input
        //return 2; //fail of exception
        if (isset($this->redirectFailStore)) {

            return redirect()->route($this->sViewName . '.' . $this->redirectFailStore)
            ->withInput();
    
        } else {

            return redirect()->route($this->sViewName . '.create')
            ->withInput();

        } //end if
    }

    //GET Request
    public function edit($id)
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
        $this->viewModel->data = $this->transformFieldEdit($this->viewModel->data);

        return view($this->sViewRoot.'.edit', $this->aResponseData);
    }

    //POST Request
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        //get data from database
        $record = $this->data->find($id);
        $imageOld = $record->image;

        //get input value by fillable fields
        $data = $request->only($this->data->getFillable()); //get field input
        $data['id'] = $id;
        $data = $this->transformFieldUpdate($data);

        $upload = $request->file('upload'); //upload file (image/document) ==> if included
        $imageTemp = $request->input('imageTemp'); //temporary file uploaded
        $toggleRemoveImage = $request->input('toggleRemoveImage');

        //create temporary uploaded image
        $uploadTemp = Filex::uploadTemp($upload, $imageTemp);
        $request->session()->flash('imageTemp', $uploadTemp);

        //validate input value
        //validate input value
        $valid = $this->validateUpdate($data, $this->data->getValidateInput(), $this->validationMessages);
        if (!$valid) {

            //step 2: Kembali ke halaman input
            //return 1; //fail of validation
            return redirect()->route($this->sViewName . '.edit', $id)
            ->withErrors($this->validator)
            ->withInput();

        } //end if validator

        $data['updated_by'] = $user->id;
        $imageNew = Filex::uploadOrCopyAndRemove($imageOld, $uploadTemp, $this->uploadDirectory, $upload, 'public', false);
        $data['image'] = $imageNew;
        if (strtolower($toggleRemoveImage) ==  'true')
        {
            $data['image'] = null;
        }

        if ($this->data->update($record, $data)) {
        
            if ($uploadTemp != null)
            {
                Filex::delete($imageOld);
                Filex::delete($uploadTemp);
            } //end if

            if (strtolower($toggleRemoveImage) == 'true')
            {
                Filex::delete($imageOld);
                Filex::delete($imageNew);
                Filex::delete($uploadTemp);
            }
            //return 0; //success
            if (isset($this->redirectSuccessUpdate)) {

                return redirect()->route($this->sViewName . '.' . $this->redirectSuccessUpdate);

            } else {

                return redirect()->route($this->sViewName . '.index');

            }
        }

        /** jika tetap terjadi kesalahan maka ada kesalahan pada system */
        //step 1: delete image if fail to save
        if ($uploadTemp != null)
        {
            Filex::delete($data['image']);
        } //end if

        //step 2: Kembali ke halaman input
        //return 2; //fail of exception
        if (isset($this->redirectFailUpdate)) {

            return redirect()->route($this->sViewName . '.' . $this->redirectFailUpdate, $id)
            ->withInput();
    
        } else {

            return redirect()->route($this->sViewName . '.edit', $id)
            ->withInput();
    
        }
    }

    //POST Request
    public function destroy($id)
    {
        $record = $this->data->find($id);
        $fileName = $record->image;
        $this->data->delete($record);
        Filex::delete($fileName); 

        //return 0; //success
        if (isset($this->redirectSuccessDestroy)) {

            return redirect()->route($this->sViewName . '.' . $this->redirectSuccessDestroy);

        } else {

            return redirect()->route($this->sViewName . '.index');

        }
   }

    //GET Request
    public function indexCustom()
    {
        $this->viewModel = Response::viewModel();
        $this->viewModel->data = json_decode(json_encode($this->data->getInputField()));
        $this->viewModel->data->date = now();

        $this->aResponseData = [
            'viewModel' => $this->viewModel,
            'new' => true,
            'fieldEnabled' => true,
            'customError' => null,
        ];
        $this->insertDataModelToResponseData();

        return view($this->sViewRoot.'.index-custom', $this->aResponseData);
    }

    //POST Request
    public function indexCustomPost(Request $request)
    {

        $data = $request->only($this->data->getFillable()); //get field input
        $this->viewModel = Response::viewModel();
        $customData = $this->data->getInputField();
        $customData['datalist'] = null;
        $this->viewModel->data = json_decode(json_encode($customData));

        //custom validation
        $customError = 'Tanggal meeting harus diisi jika jam mulai dan selesai diisi';
        $validInput = $this->validateCustomView($data);

        if ($validInput) {

            $customError = null;
            $data = $this->transformFieldCreate($data);
            $filter = $this->filters($data);
            $this->viewModel->data->datalist = $this->data->byRoomCustom($this->room_id, $filter);
    
        } //end if
        
        $this->aResponseData = [
            'viewModel' => $this->viewModel,
            'new' => true,
            'fieldEnabled' => true,
            'customError' => $customError,
        ];
        $this->insertDataModelToResponseData();

        return view($this->sViewRoot.'.index-custom', $this->aResponseData);
    }

    //Additional data ( Lookup data)
    protected function insertDataModelToResponseData() {

        foreach ($this->dataModel as $key => $value) {

            $this->aResponseData[$key] = $value;

        } //end loop

    }

    //Overrideable method
    protected function transformFieldCreate($paDataField) {
        $dataField = $paDataField;

        return $dataField;
    }

    //Overrideable method
    protected function transformFieldEdit($paDataField) {
        $dataField = $paDataField;

        return $dataField;
    }

    //Overrideable method
    protected function transformFieldUpdate($paDataField) {
        $dataField = $paDataField;

        return $dataField;
    }

    //Overrideable method
    protected function validateStore($data, $validateInput, $validationMessages) {
        $result = true;

        return $result;
    }

    //Overrideable method
    protected function validateUpdate($data, $validateInput, $validationMessages) {
        $result = true;

        //Custom overrride code here...

        return $result;
    }

    //Overrideable method
    protected function validateDestroy($paDataField) {
        $result = true;

        //Custom overrride code here...

        return $result;
    }

    //Overrideable from WebController method
    protected function validateCustomView($data) {
        $result = true;

        return $result;
    }

    protected function customizeErrorMessage() {
        //Custom overrride code here...
    }

        
}
