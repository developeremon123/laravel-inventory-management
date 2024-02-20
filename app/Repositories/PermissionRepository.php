<?php

namespace App\Repositories;

use App\Models\Permission;
use App\Repositories\BaseRepository;

class PermissionRepository extends BaseRepository {
    
    protected $order = ['id' => 'desc'];
    protected $ModuleId;
    protected $name;

    public function __construct(Permission $model)
    {
        $this->model = $model;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
    public function setModuleId($ModuleId)
    {
        $this->ModuleId = $ModuleId;
    }


    private function get_datatable_query()
    {
        $this->column_order = [null, 'id', 'module_id', 'name', 'slug', null];
        $query = $this->model->with('module:id','module_name');

        /******
         *  *Search Data*
         ******/
        if (!empty($this->name)) {
            $query->where('name', 'like', '%' . $this->name . '%');
        }
        if (!empty($this->ModuleId)) {
            $query->where('module_id', $this->ModuleId);
        }

        if (isset($this->orderValue) && isset($this->dirValue)) {
            $query->orderBy($this->column_order[$this->orderValue], $this->dirValue);
        } elseif (isset($this->order)) {
            $query->orderBy(key($this->order), $this->order[key($this->order)]);
        }
        return $query;
    }

    public function getDatatableList()
    {
        $query = $this->get_datatable_query();
        if ($this->lenghtValue != -1) {
            $query->offset($this->startValue)->limit($this->lenghtValue);
        }
        return $query->get();
    }

    public function count_filtered()
    {
        $query = $this->get_datatable_query();
        return $query->get()->count();
    }

    public function count_all()
    {
        return $this->model->toBase()->get()->count();
    }
}