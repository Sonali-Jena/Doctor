<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PDF;
class AssesmentController extends Controller
{
    //
    public function create(){
        // echo 231;exit;
        // echo "<pre>";print_r($data);exit;
        $doctorData = DB::select("select * from doctor_master");
        $diseaseData = DB::select("select*from disease_master");
        return view('home', ['doctorData' => $doctorData, 'diseaseData' => $diseaseData]);
        }
        public function PatientAjaxData()
        {
            // echo 321;exit;
            // echo '<pre>';print_r(request()->all());exit;
            $getParams = request()->all();
            // $doctorId = $getParams->Doctor_id;
            $doctorId = $getParams['id'];
       $patientData=DB::select("SELECT DA.Patient_Name,DA.Doctor_Appointment_id FROM doctor_appointment AS DA WHERE
       DA.Patient_Status='A'  AND DA.Doctor_id=$doctorId");
            foreach ($patientData as $s) :
                echo '<option value="' . $s->Doctor_Appointment_id . '">' . $s->Patient_Name . '</option>';
            endforeach;
        }
        public function MedicineName()
        {
            // echo 213;exit;
            // echo '<pre>';print_r(request()->all());exit;
            $getParams = request()->all();
            $patientData = DB::select("select medicine_Name,medicine_id from medicine_master where disease_id = " . $getParams['id']);
               echo "<pre>"; print_r($patientData);
            //    return response()
            foreach ($patientData as $s) :
                echo '<option value="' . $s->medicine_id . '">' . $s->medicine_Name . '</option>';
            endforeach;
        }

        public function ShowData(){
            $data=DB::select("SELECT DA.Date_Of_appointment,DM.Doctor_Name,DA.Patient_Name,DISM.disease_Name,MM.medicine_Name,P.prescription FROM doctor_appointment AS DA LEFT JOIN
            doctor_master AS DM ON DM.Doctor_id=DA.Doctor_id LEFT JOIN prescription AS P ON P.Doctor_Appointment_id=DA.Doctor_Appointment_id
            LEFT JOIN disease_master AS DISM ON DISM.disease_id=P.disease_id LEFT JOIN medicine_master AS MM  ON MM.medicine_id=P.medicine_id
            ");
              return response()->json($data);
        }
        public function insert(){
            $input=request()->all();
            $doctorname=$input['doctorname'];
            //    $patientname=$input['patientname'];
               $diseasename=$input['diseasename'];
               $medicinename=$input['medicinename'];
               $prescription=$input['prescription'];
               $input= DB::insert("INSERT INTO prescription (Doctor_Appointment_id, disease_id,medicine_id,prescription) VALUES ('$doctorname', '$diseasename','$medicinename','$prescription')");
            // echo "<pre>"; print_r($data);exit;
            return redirect('/home');
        }
        public function DownloadData(){
            $ShowData = DB::table('prescription AS P')
            ->leftJoin('doctor_appointment AS DA', 'P.Doctor_Appointment_id', '=', 'DA.Doctor_Appointment_id')
            ->leftJoin('doctor_master AS DM', 'DM.Doctor_id', '=', 'DA.Doctor_id')
            ->leftJoin('disease_master AS DIS', 'DIS.disease_id', '=', 'P.disease_id')
            ->leftJoin('medicine_master AS MM', 'MM.medicine_id', '=', 'P.medicine_id')
            ->select('DA.Date_Of_appointment', 'DA.Patient_Name', 'DM.Doctor_Name', 'DIS.disease_Name', 'MM.medicine_Name', 'P.slno')
            ->get();
            // echo "<pre>";print_r($ShowData);exit;
            $pdf=PDF::loadView('pdf',['ShowData'=>$ShowData]);
            return $pdf->download('das.pdf');
            // return view('pdf',['ShowData'=>$ShowData]);
    }
}

