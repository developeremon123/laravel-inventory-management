<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PermissionService;
use App\Http\Controllers\BaseController;
use App\Http\Requests\PermissionRequest;

class PermissionController extends BaseController
{
    public function __construct(PermissionService $permission)
    {
        $this->service = $permission;
    }
    public function index()
    {
        $this->setPageData('Permission','Permission','fa-solid fa-list');
        $data = $this->service->index();
        return view('permission.index',compact('data'));
    }

    public function get_datatable_data(Request $request)
    {
        if($request->ajax()){
            $output = $this->service->get_datatable_data($request);
        }else{
            $output = ['status'=>'error','message'=>'Unauthorized Access Blocked!'];
        }
        return response()->json($output);
    }

    public function store_or_update_data(PermissionRequest $request)
    {
        if($request->ajax()){
            $data = $this->service->store_or_update_data($request);
            if(!empty($data)){
                return $this->response_json($status='success', $message='Data has been save successfully', $data=$data, $response_code=200);
            }else{
                return $this->response_json($status='error', $message='Data cannot save!', $data=$data, $response_code=204);
            }
        }else{
            return $this->response_json($status='error', $message=null, $data=null, $response_code=401);
        }
    }

    public function edit(Request $request)
    {
        if($request->ajax()){
            $data = $this->service->edit($request);
            if($data->count()){
                return $this->response_json($status='success', $message=null, $data=$data, $response_code=201);
            }else{
                return $this->response_json($status='error', $message='No Data Found!', $data=$data, $response_code=204);
            }
        }else{
            return $this->response_json($status='error', $message=null, $data=null, $response_code=401);
        }
    }

    public function delete(Request $request)
    {
        if($request->ajax()){
            $result = $this->service->delete($request);
            if($result){
                return $this->response_json($status='success', $message="Data has been deleted successfully", $data=null, $response_code=200);
            }else{
                return $this->response_json($status='error', $message='Data cannot delete!', $data=null, $response_code=204);
            }
        }else{
            return $this->response_json($status='error', $message=null, $data=null, $response_code=401);
        }
    }

    public function bulk_delete(Request $request)
    {
        if($request->ajax()){
            $result = $this->service->bulk_delete($request);
            if($result){
                return $this->response_json($status='success', $message="Data has been deleted successfully", $data=null, $response_code=200);
            }else{
                return $this->response_json($status='error', $message='Data cannot delete!', $data=null, $response_code=204);
            }
        }else{
            return $this->response_json($status='error', $message=null, $data=null, $response_code=401);
        }
    }

    public function orderItem(Request $request)
    {
        $menuItemOrder = json_decode($request->input('order'));
        $this->service->orderMenu($menuItemOrder,null);
    }
}
