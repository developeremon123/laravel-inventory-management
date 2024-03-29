<?php

namespace App\Services;

class BaseService{
    protected function datatable_draw($draw, $recordsTotal, $recordsFiltered, $data){
        return [
            "draw"            => $draw,
            "recordsTotal"    => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data"            => $data
        ];
    }
}