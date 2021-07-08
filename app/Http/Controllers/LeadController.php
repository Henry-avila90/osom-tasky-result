<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Lead;
class LeadController extends Controller
{
    public function create(Request $request){
        try {
            $request->validate([
                'name' => 'required|max:255',
                'email' => 'required',
                'phone' => 'required',
            ]);
            $data = $request->all();
            $validate_name = $this->validate_name($data['name']);
            $validate_phone = $this->validate_phone($data['phone']);
            if(  $validate_name == true && $validate_phone== true){
                $lead = Lead::create($data);
                $response = array(
                'message'=>"tus datos se han enviado correctamente.",
                'data'=>$lead);
                return response()->json($response);
            }
            else{
                $response = array('message'=>"uno de los datos es erroneo,verifique por favor.");
                return response()->json($response);
            }
            
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function validate_name($name){
        $array_name = explode(" ", $name);
        if(count($array_name) < 3){
            return false;
        }else{
            return true;
        }
        
    }
    
    public function validate_phone($phone){
        $array_phone = str_split($phone);
        if(count($array_phone) < 10){
            return false;
        }else{
            return true;
        }
        
    }
}
