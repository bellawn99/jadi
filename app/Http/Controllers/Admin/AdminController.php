<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Mahasiswa;
use App\Daftar;
use App\Praktikum;
use App\Periode;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Charts;
use Notification;
use App\Notifications\PengumumanNotification;

class AdminController extends Controller
{
    public function home()
    {
        $data['mhs']=Mahasiswa::all();
        $data['jml_mhs']=$data['mhs']->count();

        $data['pengajuan']=Daftar::where('status','daftar')->get();
        $data['jml_pengajuan']=$data['pengajuan']->count();

        $data['prak']=Praktikum::all();
        $data['jml_prak']=$data['prak']->count();

        $cek = Carbon::now()->subday(14);

        $cek2 = Periode::select('tgl_mulai')
        ->where('status','=','pengumuman')
        ->whereDate('tgl_mulai', '>=', $cek->toDateString())
        ->get();
        if($cek2){
        $user = User::where('role_id',2)->select('id','role_id','nama','email')->get();

        // return $user;
        $nama = json_decode(json_encode($user));
        
        $collection = [];

        foreach($user as $iki){
            $collection[] = $iki;
        }

        $details = [
            'greeting' => 'Hallo!',
            'body' => 'Kami ingin memberitahukan bahwa data nama asistensi sudah dapat diakses di akun masing-masing',
            'thanks' => 'Terimakasih',
            'actionText' => 'Cek Pengumuman',
            'actionURL' => url('/login'),
            'id' => $cek2
        ];

        Notification::send($collection, new PengumumanNotification($details));
        }
        $data['matkul']=Daftar::all()->count();
        $grap=Daftar::join('praktikum','daftar.praktikum_id','=','praktikum.id')
        ->join('matkul','praktikum.matkul_id','=','matkul.id')
        ->select(DB::raw('COUNT(daftar.praktikum_id) as jml'),'matkul.nama_matkul')
        ->orderBy('jml','desc')
        ->groupBy('matkul.nama_matkul')
        ->get();

        $mencoba = Daftar::sum('praktikum_id');

        $grafik = [];

        foreach($grap as $row) {
            $grafik['nama'][] = $row->nama_matkul;
            $grafik['jml'][] = (int) ($row->jml*100)/$mencoba;
          }
     
        $grafik['chart_data'] = json_encode($grafik); 

        $now = Carbon::today();

        $daftars = Praktikum::join('dosen','praktikum.dosen_id','=','dosen.id')
        ->join('matkul','praktikum.matkul_id','=','matkul.id')
        ->join('jadwal','praktikum.jadwal_id','=','jadwal.id')
        ->leftJoin('daftar','daftar.praktikum_id','=','praktikum.id')
        ->join('periode','daftar.periode_id','=','periode.id')
        ->join('user','daftar.user_id','=','user.id')
        ->join('kelas','praktikum.kelas_id','=','kelas.id')
        ->join('semester','praktikum.semester_id','=','semester.id')
        ->select('user.nama as pengguna','user.foto','matkul.sks','daftar.status','kelas.nama as kelas','semester.semester','jadwal.hari','jadwal.jam_mulai','jadwal.jam_akhir','matkul.nama_matkul')
        ->where('daftar.created_at','=',$now)
        ->get()->toArray();

        //$bulan =  Carbon::now();
          
        $click = Daftar::select(DB::raw("SUM(status) as jumlah"),(DB::raw("DAY(created_at) as created_at")))
        ->where(DB::raw("MONTH(created_at)"),'>=',$now->month)
        ->groupBy('created_at')
        ->orderBy(DB::raw("DAY(created_at)"))
        ->get();
        //->toArray();
        foreach($click as $key=>$val){
            $dtgrfk[$val->created_at]=$val->jumlah;
        }

        //$click = array_column($click, 'jumlah');

        $z=Carbon::now();
        $bulan = $z->month;

        $dim=cal_days_in_month(CAL_GREGORIAN,$bulan,date('Y'));
        for($i=1;$i<=$dim;$i++){
            //$tgl[]="$i;
            if(isset($dtgrfk[$i])){
                $grfk[$i]=$dtgrfk[$i];
            }else{
                $grfk[$i]=0;
            }
        }
        //$arrtgl=implode(",",$tgl);
        $arrgrfk=implode(",",$grfk);

        //return $arrgrfk; exit();

        $thn_ajaran = Periode::where("status",'=','daftar')->get();

        // $products = Daftar::where(DB::raw("(DATE_FORMAT(created_at,'%M'))"), date('M'))->get();
        // $chart = Charts::database($products, 'bar', 'highcharts')
        //              ->title('Product Details')
        //              ->elementLabel('Total Products')
        //              ->dimensions(1000, 500)
        //              ->colors('blue')
        //              ->groupByMonth(date('M'), true);

        // foreach($click as $row) {
        //     $data['jumlah'][] = $row->jumlah;
        //   }
     
        // $data['bulan'] = json_encode($data); 

       
        

        // dd($daf);
        // echo "<pre>";
        // print_r(array_values(array_filter($data['ct_lecture'])));
        // print_r( $data['stat_lecture']);
        // echo self::oneDimentional($data['ct_lecture']);

        // // echo"</pre>";
        return view('admin.dashboard',$data, $grafik)->with('now',$now)->with('daftars',$daftars)
        ->with('tgl',$dim)
        ->with('thn_ajaran',$thn_ajaran)
        ->with('bulan',json_encode($bulan,JSON_NUMERIC_CHECK))
        ->with('grafik',$arrgrfk)
        ->with('bln',json_encode($click,JSON_NUMERIC_CHECK));
    }

    public function search(Request $request){

        $data['mhs']=Mahasiswa::all();
        $data['jml_mhs']=$data['mhs']->count();

        $data['pengajuan']=Daftar::where('status','daftar')->get();
        $data['jml_pengajuan']=$data['pengajuan']->count();

        $data['prak']=Praktikum::all();
        $data['jml_prak']=$data['prak']->count();

        $data['matkul']=Daftar::all()->count();
        $grap=Daftar::join('praktikum','daftar.praktikum_id','=','praktikum.id')
        ->join('matkul','praktikum.matkul_id','=','matkul.id')
        ->select(DB::raw('COUNT(daftar.praktikum_id) as jml'),'matkul.nama_matkul')
        ->orderBy('jml','desc')
        ->groupBy('matkul.nama_matkul')
        ->get();

        $mencoba = Daftar::sum('praktikum_id');

        $grafik = [];

        foreach($grap as $row) {
            $grafik['nama'][] = $row->nama_matkul;
            $grafik['jml'][] = (int) ($row->jml*100)/$mencoba;
          }
     
        $grafik['chart_data'] = json_encode($grafik); 

        $now = Carbon::today();

        $daftars = Praktikum::join('dosen','praktikum.dosen_id','=','dosen.id')
        ->join('matkul','praktikum.matkul_id','=','matkul.id')
        ->join('jadwal','praktikum.jadwal_id','=','jadwal.id')
        ->leftJoin('daftar','daftar.praktikum_id','=','praktikum.id')
        ->join('periode','daftar.periode_id','=','periode.id')
        ->join('user','daftar.user_id','=','user.id')
        ->join('kelas','praktikum.kelas_id','=','kelas.id')
        ->join('semester','praktikum.semester_id','=','semester.id')
        ->select('user.nama as pengguna','user.foto','matkul.sks','daftar.status','kelas.nama as kelas','semester.semester','jadwal.hari','jadwal.jam_mulai','jadwal.jam_akhir','matkul.nama_matkul')
        ->where('daftar.created_at','=',$now)
        ->get()->toArray();


        $thn_ajaran = $request->thn_ajaran;
        $bulan = $request->bulan;
        $semester = $request->semester;

        $periode = DB::table('periode')->where('thn_ajaran', $thn_ajaran)->where('semester', $semester)->first();

        $batas = DB::table('daftar')->where('periode_id',$periode->id)->whereMonth('created_at', $bulan)->get();
        
        //$periode_id = $periode->id;
        if (count($batas)>0){
        $data['periode'] = Daftar::where('periode_id',$periode->id)->get();
        // dd($data);

        $click = Daftar::select(DB::raw("SUM(status) as jumlah"),(DB::raw("DAY(created_at) as created_at")))
        ->where('periode_id',$periode->id)
        ->whereMonth('created_at',$bulan)
        ->groupBy('created_at')
        ->orderBy(DB::raw("DAY(created_at)"))
        ->get();
        
        foreach($click as $key=>$val){
            $dtgrfk[$val->created_at]=$val->jumlah;
        }
        
        foreach($batas as $iki){
            $thn = date("Y", strtotime($iki->created_at));
            }
        $dim=cal_days_in_month(CAL_GREGORIAN,$bulan,$thn);
        }else{

           $click='';
            $dim=cal_days_in_month(CAL_GREGORIAN,$bulan,date('Y'));
        }
        for($i=1;$i<=$dim;$i++){
            
            if(isset($dtgrfk[$i])){
                $grfk[$i]=$dtgrfk[$i];
            }else{
                $grfk[$i]=0;
            }
        }
        //$arrtgl=implode(",",$tgl);
        $arrgrfk=implode(",",$grfk);

        $thn_ajaran = Periode::where("status",'=','daftar')->get();
        //return $arrgrfk; exit();
        return view('admin.dashboard',$data, $grafik)
        ->with('now',$now)
        ->with('daftars',$daftars)
        ->with('tgl',$dim)
        ->with('thn_ajaran',$thn_ajaran)
        ->with('bulan',json_encode($bulan,JSON_NUMERIC_CHECK))
        ->with('grafik',$arrgrfk)
        ->with('bln',json_encode($click,JSON_NUMERIC_CHECK));
        
    }
}
