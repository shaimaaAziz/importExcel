<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{

    protected $fillable =['beneficiaryNo','currency','amount','batchNo'];

   public function sponsor(){
        return $this->belongsTo('\App\ImportExcel');
    }


}
