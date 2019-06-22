<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\User; 
use App\Patient;
use App\Emergency;
use Illuminate\Support\Facades\Auth; 
use Validator;
use Storage;

class AuthController extends Controller 
{
 public $successStatus = 200;

 public function register(Request $request) {    
    $validator = Validator::make($request->all(), [ 
                 'name' => 'required',
                 'username' => 'required',
                 'password' => 'required',
                 'usertype' => 'required',  
                 'c_password' => 'required', 
       ]);   
    if ($validator->fails()) {          
          return response()->json(['error'=>$validator->errors()], 401);                        }    
    $input = $request->all();  
    $input['password'] = bcrypt($input['password']);
    $user = User::create($input); 
    $success['token'] =  $user->createToken('AppName')->accessToken;
    return response()->json(['success'=>$success], $this->successStatus); 
   }
    
     
   public function login(){ 
      if(Auth::attempt(['username' => request('username'), 'password' => request('password')])){ 
         $user = Auth::user(); 
         $success['token'] =  $user->createToken('AppName')-> accessToken; 
         $name=$user->name;

         return response()->json(['success' => $success,$user], $this-> successStatus); 
      } else{ 
         return response()->json(['error'=>'Unauthorised'], 401); 
         } 
   }
    
   public function getUser() {
    $user = Auth::user();
    return response()->json(['success' => $user], $this->successStatus); 
    }


    public function addpatient(Request $request) {  
      $validator = Validator::make($request->all(), [ 
                   'name' => 'required',
                   'age' => 'required',
         ]);   
      if ($validator->fails()) {          
            return response()->json(['error'=>$validator->errors()], 401);                        }    
      $input = $request->all();  
      $patient = Patient::create($input); 
      return response()->json(['patient'=>$patient], $this->successStatus); 
     }

     /*public function getallpatients(){
      $patients =Patient::all();
      return response()->json(['success' => $patients], $this->successStatus); 
     }*/

     public function getemergency(Request $request)
      { 
         $id=$request->patient_id;
         $emergency = \DB::table('emergency')->where('patient_id',$id)->get();
         return response()->json(['success' => $emergency], $this->successStatus); 

      } 

      public function getpatients() {
         $user = Auth::user();
         $allpatients=\DB::table('patient_assign')->where('user_id',$user->id)->get();
         return response()->json(['success' => $allpatients,$ids], $this->successStatus); 
         }

         public function history (Request $request)
         {        
            $id=$request->patient_id;
            $history = \DB::table('history')->where('patient_id',$id)->get();
            return response()->json(['success' => $history], $this->successStatus); 
         }
}