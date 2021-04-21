<?php

namespace App\Http\Controllers;

use App\login;
use App\User;
use App\locker;
use App\role_user;
use App\mitra;
use Illuminate\Http\Request;

use Carbon\Carbon;


class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $db = User::all();
        // return $db;
        $model = new Login();
        return $model->get_user();
    }

    public function actionLogin(Request $r){
        $username = $r->username;
        $password = $r->password;
        $arr    = array($username,$password);
        $user  = User::where(['username'=>$username,"password"=>md5($password)]);
        $count_user  = $user->count();
        $data_user  = $user->get();
        

        if($count_user > 0){
            $r->session()->put('id_user',  $data_user[0]->id_user);
            $r->session()->put('id_locker',  $data_user[0]->id_role_user);

            if($data_user[0]->id_status_user != "2"){
                return redirect('login')->with('status', "User Anda Belum Di Approve");
            }
            return redirect('home');
            
        }else{
            return redirect('login')->with('status', "Username / Password anda salah");
        }
    
    }

    public function register(){
        $data_locker = locker::select('*')->get();        
        $data_mitra = mitra::getNotInMitra(0);      
        return view('register',['data'=>$data_locker,'data_mitra'=>$data_mitra]);
    }

    public function logout(Request $request){
        $request->session()->forget('id_user');
        $request->session()->forget('id_locker');
        return redirect('/login');
    }

    public function actionRegister(Request $r){
        
        $username= $r->username;
        $id_role= $r->id_role;
        $password= $r->password;
        $repassword= $r->repassword;
        $mitra= $r->id_mitra;
        $nama= $r->nama;
        $dt = Carbon::now();
        $now = $dt->toDateTimeString();

        if($id_role == '-'){
            return redirect('register')->with('status','Isi Role terlebih Dahulu');
        }


        if($id_role == '3'){
            if($mitra == '-'){
                return redirect('register')->with('status','Isi Mitra terlebih Dahulu');
            }
            
        }else{
            $mitra = 0;
        }
        
       
        if($password != $repassword){
            return redirect('register')->with('status','password tidak sama');
        }
        
        

        $user_count  = User::where(['username'=>$username])->count();

        if($user_count < 1){
            User::create([
                'nama'=>$nama,
                'username'=>$username,
                'id_role_user'=>$id_role,
                'create_dtm'=>$now,
                'id_mitra'=>$mitra,
                'id_status_user'=>"1",
                'password'=>md5($password)
            ]);
    
    
    
            return "
            <script>
                alert('Register Berhasil')
                window.location.href='/login'
            </script>
            ";
        }else{
            return redirect('register')->with('status','username sudah ada');
        }

       

    }


    public function userTable($id){
        $user = User::all();
        $m_locker = new locker();
        $m_role_user = new role_user();
        return view('user.table_user',['data'=>$user,'m_locker'=>$m_locker,'m_role_user'=>$m_role_user,'jenis_page'=>$id]);
        // return view('user.table_user',['data'=>$user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\login  $login
     * @return \Illuminate\Http\Response
     */
    public function show(login $login)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\login  $login
     * @return \Illuminate\Http\Response
     */
    public function edit(login $login)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\login  $login
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, login $login)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\login  $login
     * @return \Illuminate\Http\Response
     */
    public function destroy(login $login)
    {
        //
    }
}
