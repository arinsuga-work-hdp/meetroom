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
    protected $data, $validator;
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

        $tes = [
            '$data' => $data,
            '#request->input()' => $request->input()
        ];

        //create temporary uploaded image
        $uploadTemp = Filex::uploadTemp($upload, $imageTemp);
        $request->session()->flash('imageTemp', $uploadTemp);

        //validate input value
        $this->validator = Validator::make($data, $this->data->getValidateInput());
        if ($this->validator->fails()) {

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
        $upload = $request->file('upload'); //upload file (image/document) ==> if included
        $imageTemp = $request->input('imageTemp'); //temporary file uploaded
        $toggleRemoveImage = $request->input('toggleRemoveImage');
        $data = $this->transformFieldEdit($data);

        //create temporary uploaded image
        $uploadTemp = Filex::uploadTemp($upload, $imageTemp);
        $request->session()->flash('imageTemp', $uploadTemp);

        //validate input value
        $request->validate($this->data->getValidateInput());

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

}
