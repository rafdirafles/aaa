<?php

namespace App\Http\Controllers\Pengajuan;
use DateTime;
use App\Cuti;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jenis_cuti;
use App\Pengajuan_cuti;
use App\User;

class PengajuanCutiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pegawais=User::all();
        $jenis_cuti=Jenis_cuti::all();
        $data=Cuti::where('status',1)->with('jenis_cuti')->get();
        $P_cuti=Cuti::where('status',0)->with('jenis_cuti')->get();
        return view('Pengajuan.cuti.index',compact('data','jenis_cuti','pegawais','P_cuti'));
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
        $tgl_awal=explode("-",$request->tgl_mulai);
        $tgl_akhir=explode("-",$request->tgl_selesai);
        $x=$tgl_akhir[2];
        $y=$tgl_awal[2];
        $hasil=(int)$x-(int)$y;
        if($request->id_jenis_cuti == 1){
            if($hasil <=12)
            {
                $data=Cuti::where('nip_nrp',$request->nip_nrp)->count();
                if($data == 0){
                    $sum=$hasil;
                    // return 'dd';
                }
                else{
                    $z=0;
                    $data=Cuti::where('nip_nrp',$request->nip_nrp)->where('status','1')->get();
                    for($i=0;$i<count($data);$i++){
                        $z+=$data[$i]['jumlah'];
                    }
                   $sum=$hasil+$z;

                }
                if($sum <=12){
                    Cuti::create([
                        'nip_nrp'=>$request->nip_nrp,
                        'id_jenis_cuti'=>$request->id_jenis_cuti,
                        'tgl_mulai'=>$request->tgl_mulai,
                        'tgl_selesai'=>$request->tgl_selesai,
                        'status'=>'0',
                        'jumlah'=>$hasil,
                        'keterangan'=>$request->keterangan,
                    ]);
                }
                else{
                     return 'maaf input cuti melebihi batas';
                }
            }
            else{
                return 'maaf input cuti melebihi batas';
            }
        }
        else{
            $start_date = new DateTime($request->tgl_mulai);
            $end_date = new DateTime($request->tgl_selesai);
            $interval = $start_date->diff($end_date);
            if($interval->days >=90){
                return 'maaf jumlah input hanya 90 hari';
            }
            Cuti::create([
                'nip_nrp'=>$request->nip_nrp,
                'id_jenis_cuti'=>$request->id_jenis_cuti,
                'tgl_mulai'=>$request->tgl_mulai,
                'tgl_selesai'=>$request->tgl_selesai,
                'status'=>'0',
                'jumlah'=>$interval->days,
                'keterangan'=>$request->keterangan,
            ]);
        }
        return back();
        // return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $data=Cuti::where('id',$request->id);
        $z=0;
        if($request->jenis_cuti==1){
            $data=Cuti::where('nip_nrp',$id)->where('status','1')->get();
            for($i=0;$i<count($data);$i++){
                $z+=$data[$i]['jumlah'];
            }
            if($z<=12){
                // $data->update([
                //     'status'=>1,
                // ]);
                // $absensi=Cuti::where('id',$request->id)->first();
                // $start_date = new DateTime($absensi->tgl_mulai);
                // $end_date = new DateTime($absensi->tgl_selesai);
                // $interval = new DateInterval('P1D');
                // $period   = new DatePeriod($start_date, $interval, $end_date);

                // foreach ($period as $day) {
                //     // Do stuff with each $day...
                //     echo $day->format('Y-m-d'), "\n";
                // }
            }
            else{
                return 'Maaf inputan melebihi batas';
            }
        }
        else{
            $data->update([
                'status'=>1,
            ]);
            return back();
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
