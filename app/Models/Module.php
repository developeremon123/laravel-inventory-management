<?php

namespace App\Models;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Module extends Model
{
    use HasFactory;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class,'menu_id','id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Module::class,'parent_id','id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Module::class,'parent_id','id')->orderBy('order','desc');
    }
}
