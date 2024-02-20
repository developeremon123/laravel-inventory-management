<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\BaseService;
use App\Repositories\PermissionRepository as Permission;
use App\Repositories\ModuleRepository as Module;

class PermissionService extends BaseService
{
    protected $permission;
    protected $module;

    public function __construct(Permission $permission, Module $module)
    {
        $this->permission = $permission;
        $this->module     = $module;
    }

    public function index()
    {
        $data['modules'] = $this->module->module_list(1); //1=Backend Menu
        return $data;
    }

    public function get_datatable_data(Request $request)
    {
        if ($request->ajax()) {

            if (!empty($request->name)) {
                $this->permission->setName($request->name);
            }
            if (!empty($request->module_id)) {
                $this->permission->setModuleId($request->module_id);
            }

            $this->permission->setOrderValue($request->input('order.0.column'));
            $this->permission->setDirValue($request->input('order.0.dir'));
            $this->permission->setLengthValue($request->input('length'));
            $this->permission->setStartValue($request->input('start'));

            $list = $this->permission->getDatatableList();
            $data = [];
            $no = $request->input('start');
            foreach ($list as $value) {
                $no++;
                $action    = '';
                $action   .= '<a class="dropdown-item edit_data" data-id="' . $value->id . '"><i class="fa-solid fa-pen-to-square text-primary"></i> Edit </a>';
                $action   .= '<a class="dropdown-item delete_data" data-id="' . $value->id . '" data-name="' . $value->menu_name . '"><i class="fa-solid fa-trsh text-danger"></i> Delete </a>';
                $btnGroup  = '<div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-list"></i>
                                </button>
                                <ul class="dropdown-menu">
                                <li>' . $action . '</li>
                                </ul>
                            </div>';

                $row    = [];
                $row[]  = '<div class="form-check">
                                <input class="form-check-input select_data" onchange="select_single_item(' . $value->id . ')" type="checkbox" value="' . $value->id . '" name ="did[]" id="checkbox' . $value->id . '">
                                <label class="form-check-label" for="checkbox' . $value->id . '">
                                </label>
                            </div>';
                $row[]  = $no;
                $row[]  = $value->module->module_name;
                $row[]  = $value->name;
                $row[]  = $value->slug;
                $row[]  = $btnGroup;
                $data[] = $row;
            }
            return $this->datatable_draw($request->input('draw'),$this->permission->count_all(),$this->permission->count_filtered(),$data);
        }
    }

    public function store_or_update_data(Request $request)
    {
        $collection = collect($request->validated());
        $created_at = $updated_at = Carbon::now();
        if($request->update_id){
            $collection = $collection->merge(compact('updated_at'));
        }else{
            $collection = $collection->merge(compact('created_at'));
        }

        return $this->permission->updateOrCreate(['id'=>$request->update_id], $collection->all());
    }

    public function edit(Request $request)
    {
        return $this->permission->find($request->id);
    }

    public function delete(Request $request)
    {
        return $this->permission->delete($request->id);
    }

    public function bulk_delete(Request $request)
    {
        return $this->permission->destroy($request->ids);
    }
}