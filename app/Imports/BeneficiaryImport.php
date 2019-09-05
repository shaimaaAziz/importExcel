<?php

namespace App\Imports;

use App\Beneficiary;
use Maatwebsite\Excel\Concerns\ToModel;


class BeneficiaryImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        return new Beneficiary([


           'beneficiaryNo' =>$row[0] ,
           'dateOfPayment' =>$row[1] ,
           'sponsorNo' =>$row[2] ,
            'batchNo'     => $row[3],
            'currency'     => $row[4],
            'amount'     => $row[5],


        ]);
    }
}
