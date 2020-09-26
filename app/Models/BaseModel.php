<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BaseModel extends Model
{
    public function DB()
    {
        return DB::table($this->getTable());
    }
}
