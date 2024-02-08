<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\BaseService;
use App\Repositories\MenuRepository as Menu;
use App\Repositories\ModuleRepository as Module;

class MenuService extends BaseService
{
    protected $menu;
    protected $module;

    public function __construct(Menu $menu, Module $module)
    {
        $this->menu = $menu;
        $this->module = $module;
    }

    public function get_datatable_data(Request $request)
    {
        if ($request->ajax()) {

            if (!empty($request->menu_name)) {
                $this->menu->setMenuName($request->menu_name);
            }

            $this->menu->setOrderValue($request->input('order.0.column'));
            $this->menu->setDirValue($request->input('order.0.dir'));
            $this->menu->setLengthValue($request->input('length'));
            $this->menu->setStartValue($request->input('start'));

            $list = $this->menu->getDatatableList();
            $data = [];
            $no = $request->input('start');
            foreach ($list as $value) {
                $no++;
                $action    = '';
                $action   .= '<a class="dropdown-item" href="'.route('menu.builder',[$value->id]).'" ><i class="fa-solid fa-list text-success"></i> Builder </a>';
                $action   .= '<a class="dropdown-item edit_data" data-id="' . $value->id . '"><i class="fa-solid fa-pen-to-square text-primary"></i> Edit </a>';
                // $action   .= '<a class="dropdown-item view_data" data-id="' . $value->id . '"><i class="fa-solid fa-eye text-warning"></i>View</a>';
                if($value->deletable == 1){
                    $action   .= '<a class="dropdown-item delete_data" data-name="' . $value->menu_name . '" data-id="' . $value->id . '"><i class="fa-solid fa-trash text-danger"></i>Delete</a>';
                }
                $btnGroup  = '<div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-list"></i>
                                </button>
                                <ul class="dropdown-menu">
                                <li>' . $action . '</li>
                                </ul>
                            </div>';

                $row    = [];
                if($value->deletable == 1){
                    $row[]  = '<div class="form-check">
                                    <input class="form-check-input select_data" onchange="select_single_item(' . $value->id . ')" type="checkbox" value="' . $value->id . '" name ="did[]" id="checkbox' . $value->id . '">
                                    <label class="form-check-label" for="checkbox' . $value->id . '">
                                    </label>
                                </div>';
                }else{
                    $row[] = '';
                }
                $row[]  = $no;
                $row[]  = $value->menu_name;
                $row[]  = DELETABLE[$value->deletable];
                $row[]  = $btnGroup;
                $data[] = $row;
            }
            return $this->datatable_draw($request->input('draw'),$this->menu->count_all(),$this->menu->count_filtered(),$data);
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

        return $this->menu->updateOrCreate(['id'=>$request->update_id], $collection->all());
    }

    public function edit(Request $request)
    {
        return $this->menu->find($request->id);
    }

    public function delete(Request $request)
    {
        return $this->menu->delete($request->id);
    }

    public function bulk_delete(Request $request)
    {
        return $this->menu->destroy($request->ids);
    }

    public function orderMenu(array $menuItems, $parent_id)
    {
        foreach($menuItems as $index => $menuItem){
            $item            = $this->module->findOrFail($menuItem->id);
            $item->order     = $index + 1;
            $item->parent_id = $parent_id;
            $item->save();
            if(isset($menuItem->children)){
                $this->orderMenu($menuItem->children, $item->id);
            }
        }
    }
}