<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImportExcel extends Model
{

    protected $fillable =['batchNo','sponsorNo'];

//  protected $dateOfPayment = 'M d, Y';

    public function Beneficiaries(){
        return $this->hasMany('\App\Beneficiary');
    }




}
