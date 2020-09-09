<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Auth;
use Illuminate\Support\Facades\Route;

class DashboardController extends Controller
{
    public function index()
    {
        
        if(isset(Auth::user()->email)== false){
            return redirect('/login');
        }
        // dd("09-09-2020"<=date('01-m-Y'));
        if(Auth::user()->code == '1' || Auth::user()->code == '2'){
            $voc2rb = DB::table('stok')
                        ->where('kodeprod','voc2rb')
                        // ->where('tgl_add','<=', date('d-m-Y'))
                        // ->where('tgl_add','>=', date('01-m-Y'))
                        ->sum('jumlah');
            dd($voc2rb);
            $estiVoc2 = $voc2rb * 2000;
            
            $sewa2 = $estiVoc2 * 2 /100 ;
            $voc3rb = DB::table('stok')
                        ->where('kodeprod','voc3rb')
                        ->sum('jumlah');
            $estiVoc3 = $voc3rb * 3000;
            $sewa3 = $estiVoc3 * 2 /100 ;
            $voc5rb = DB::table('stok')
                        ->where('kodeprod','voc5rb')
                        ->sum('jumlah');
            $estiVoc5 = $voc5rb * 5000;
            $sewa5 = $estiVoc5 * 2 /100 ;

            return view('welcome',[
                'voc2rb'=>$voc2rb,
                'voc3rb'=>$voc3rb,
                'voc5rb'=>$voc5rb,
                'estiVoc2'=>$estiVoc2,
                'estiVoc3'=>$estiVoc3,
                'estiVoc5'=>$estiVoc5,
                'sewa2'=>$sewa2,
                'sewa3'=>$sewa3,
                'sewa5'=>$sewa5,
            ]);
        }else{
            $voc2rb = DB::table('report')
                        ->select('sisa')
                        ->where('kodeprod','voc2rb')
                        ->where('koderesel',Auth::user()->code)
                        ->orderby('id','desc')
                        ->first();
            if($voc2rb == null){
                $voc2rb = 0;
            }else{
                $voc2rb = $voc2rb->sisa;
            }
            $voc3rb = DB::table('report')
                        ->select('sisa')
                        ->where('kodeprod','voc3rb')
                        ->where('koderesel',Auth::user()->code)
                        ->orderby('id','desc')
                        ->first();
            if($voc3rb == null){
                $voc3rb = 0;
            }else{
                $voc3rb = $voc3rb->sisa;
            }
            $voc5rb = DB::table('report')
                        ->select('sisa')
                        ->where('kodeprod','voc5rb')
                        ->where('koderesel',Auth::user()->code)
                        ->orderby('id','desc')
                        ->first();
            if($voc5rb == null){
                $voc5rb = 0;
            }else{
                $voc5rb = $voc5rb->sisa;
            }
            return view('welcome',['voc2rb'=>$voc2rb,'voc3rb'=>$voc3rb,'voc5rb'=>$voc5rb]);
        }        
        
    }

    public function Reseller()
    {
        if(isset(Auth::user()->email)== false){
            return redirect('/login');
        }
        $data = DB::table('reseller')
                    ->orderby('id','desc')
                    ->get();
        return view('reseller',['data'=>$data]);
    }
    public function postReseller(Request $request)
    {
        // dd($request);
        $add = DB::table('reseller')
                    ->insert(
                        ['koderesel'=>$request->kode,'name'=> $request->name]
                    );
        if($add){
            return redirect('/reseller');
        }
    }
    public function Report()
    {
        if(isset(Auth::user()->email)== false){
            return redirect('/login');
        }
        $prod = DB::table('product')
                    ->get();

        return view('report',['prod'=>$prod]);
    }

    public function postReport(Request $request)
    {
        $add = DB::table('report')
                        ->insert(
                            ['kodeprod'=>$request->kodeprod,'koderesel'=>Auth::user()->code,'sisa'=>$request->sisa,'tanggal'=>date('d-m-Y')]
                        );
        if($add){
            return redirect('/report');
        }
    }

    public function Stok()
    {
        if(isset(Auth::user()->email)== false){
            return redirect('/login');
        }
        $prod = DB::table('product')
                    ->get();
        $resel = DB::table('reseller')
                    ->get();
        $data = DB::table('stok')
                    ->get();
        return view('stok',['data'=>$data,'prod'=>$prod,'resel'=>$resel]);
    }
    public function postStok(Request $request)
    {
        $cek = DB::table('report')
                    ->select('sisa','id')
                    ->where('kodeprod','=', $request->kodeprod)
                    ->where('koderesel','=',$request->koderesel)
                    ->where('tanggal','<=',date('d-m-Y'))
                    ->orderby('id','desc')
                    ->first();
        // dd($cek);
        if($cek != null){
            if($cek->sisa == '0'){
                $add = DB::table('stok')
                        ->insert(
                            ['kodeprod'=>$request->kodeprod,'koderesel'=>$request->koderesel,'jumlah'=>$request->jumlah,'tgl_add'=>date('d-m-Y')]
                        );
                DB::table('report')
                ->where('id', $cek->id)
                ->update(['sisa' => $request->jumlah]);
                if($add){
                    return redirect('/stok')->with('status', 'Berhasil update Stok');;
                }
            }else{
                return redirect('/stok')->with('status', 'Stok Masih Ada');
            }
        }else{
            $add = DB::table('stok')
                    ->insert(
                        ['kodeprod'=>$request->kodeprod,'koderesel'=>$request->koderesel,'jumlah'=>$request->jumlah,'tgl_add'=>date('d-m-Y')]
                    );
            return redirect('/stok')->with('status', 'Stok Masih Ada');
            if($add){
                return redirect('/stok')->with('status', 'Berhasil update Stok');;
            }else{
                return redirect('/stok')->with('status', 'Gagal Nambah Stok');
            }
        }
        
    }

    public function Product()
    {
        if(isset(Auth::user()->email)== false){
            return redirect('/login');
        }

        $data = DB::table('product')
                    ->orderby('id','desc')
                    ->get();
        return view('product',['data'=>$data]);
    }

    public function postProduct(Request $request)
    {
        // dd($request);
        $add = DB::table('product')
                    ->insert(
                        ['kodeprod'=>$request->kode,'nama'=> $request->name]
                    );
        if($add){
            return redirect('/product');
        }
    }

    public function User()
    {
        if(isset(Auth::user()->email)== false){
            return redirect('/login');
        }
        $resel = DB::table('reseller')
                    ->get();
        $data = DB::table('users')
                    ->get();
        // dd($resel);
        return view('user',['resel'=>$resel,'data'=>$data]);
    
    }

    public function postUser(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->code = $request->code;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        
        if($user->save()){
            return redirect('/user');
        }else{
            return redirect('/user');
        }
        
    }

    public function login()
    {
        if(isset(Auth::user()->email)== true){
            return redirect('/');
        }
        return view('login',['email'=>null]);
    }

    public function postLogin(Request $request)
    {
        // dd($request);
        
        if(Auth::attempt($request->only('email','password'))){
            return redirect('/');
        }else{
            return view('/login',['email'=>$request->email]);
        }
    }
    public function logout()
    {
       Auth::logout();
        return redirect('/login');
    }
}
