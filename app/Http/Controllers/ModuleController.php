<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Http\Requests\ModuleRequest;
use App\Services\ModuleService;

class ModuleController extends BaseController
{
    public function __construct(ModuleService $module)
    {
        $this->service = $module;
    }
    public function index(int $id)
    {
        $this->setPageData('Menu Builder','Menu Builder','fa-solid fa-list');
        $data = $this->service->index($id);
        return view('module.index',compact('data'));
    }

    public function create($menu)
    {
        $this->setPageData('Create Menu Module','Add Menu Module','fa-solid fa-list');
        $data = $this->service->index($menu);
        return view('module.form',compact('data'));
    }

    public function store_or_update(ModuleRequest $request)
    {
        $data = $this->service->store_or_update_data($request);
        if($data){
            if($request->update_id){
                return redirect('/menu/builder/'.$request->menu_id)->with('success', 'Module Updated Successfully');
            }else{
                return redirect('/menu/builder/'.$request->menu_id)->with('success', 'Module Created Successfully');
            }
        }else{
            if($request->update_id){
                return back()->with('error', 'Module Failed to Update!');
            }else{
                return back()->with('error', 'Module Failed to Create!');
            }
        }
    }

    public function edit($menu, $module)
    {
        $this->setPageData('Update Menu Module','Update Menu Module','fa-solid fa-list');
        $data = $this->service->edit($menu, $module);
        return view('module.form',compact('data'));
    }

    public function destroy($module)
    {
        $result = $this->service->delete($module);
        if($result){
            return redirect()->back()->with('success', 'Module Deleted Successfully');
        }else{
            return redirect()->back()->with('error', 'Module Failed to delete!');
        }
    }
}
