<?php

namespace App\Http\Controllers;

use App\Beneficiary;
use App\ImportExcel;
use App\Imports\BeneficiaryImport;

//use Carbon\Carbon;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Excel;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Shared\Date;


class ImportExcelController extends Controller
{
    public function index()
    {

        $dataExcel = ImportExcel::get();

        return response()->json([
            'dataExcel' => $dataExcel
        ], 200);

    }

    public function importExcel(Request $request)
    {

        $this->validate($request, [
            'import_file' => 'required|mimes:xls,xlsx,CSV'
        ]);

        if ($request->hasFile('import_file')) {

            $file = $request->file('import_file');
//            $fileName = time() . '.' . $file->getClientOriginalExtension();
//            $location = public_path('files/' . $fileName);
//            $file->move($location,$fileName);

            $data = Excel::toArray(new ImportExcel(), $file);

                $importArray =array();
                $beneficiaryArray =array();

            if (!empty($data)) {
//                $i = 1;
                $index=0;
                 foreach ($data as $k => $v) {
                                     // 0 => [4]
                     foreach ($v as $key => $value) {    //0 => [6]

                         if ($index ==0){
                             $index++;
                             continue;
                         }


                         $importExcel = new ImportExcel();
                         $beneficiary = new Beneficiary();

                         $importExcel->batchNo = $value[3];

                         $importExcel->dateOfPayment =
                       Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(
                                                         $value[1]));
//                          $importExcel->dateOfPayment=Carbon::create($value[1][0], $value[1][2], $value[1][4]);
                         $importExcel->sponsorNo = $value[2];

                         $importArray [] = $importExcel;

                         $beneficiary->beneficiaryNo = $value[0];
                         $beneficiary->currency = $value[4];
                         $beneficiary->amount = $value[5];
                         $beneficiary->batchNo = $value[3];

//                    $beneficiaryArray [] = $beneficiary;

                         if ($importExcel->batchNo != $value[3]) {
                             $importExcel->sponsorNo = $value[2];
                             $importExcel->batchNo = $value[3];

                              Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject(
                                                                $value[1]));
//                          $importExcel->dateOfPayment=Carbon::create($value[1][0], $value[1][2], $value[1][4]);
                             $importArray [] = $importExcel;

                             $beneficiary->beneficiaryNo = $value[0];
                             $beneficiary->currency = $value[4];
                             $beneficiary->amount = $value[5];
                             $beneficiary->batchNo = $value[3];

                             $beneficiaryArray [] = $beneficiary;


                         } elseif ($importExcel->batchNo == $value[3] and
                             $importExcel->sponsorNo == $value[2]) {


                             $beneficiary->beneficiaryNo = $value[0];
                             $beneficiary->currency = $value[4];
                             $beneficiary->amount = $value[5];
                             $beneficiary->batchNo = $value[3];

                             $beneficiaryArray [] = $beneficiary;
                         } elseif ($importExcel->batchNo == $value[3] and
                             $importExcel->sponsorNo != $value[2]) {
                             $msg = "تننبيه رقم الكفيل مختلف عن قيمتو في ملف الاكسل";
                             echo $msg;
                         }
                     }
                }

                 foreach ($importArray as $h => $value ){
                                                                                                 
                          DB::table('import_excels')->insert($value->toArray() );
                                                                                                 
                   }


                foreach ($beneficiaryArray as $value ){

                      DB::table('beneficiaries')->insert($value->toArray() );
                    
                  }


            }
        }



        return response()->json([
            'success' => 'success'
        ], 200);


    }


}
