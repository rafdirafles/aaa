<?php

namespace App\Http\Controllers;
use Image;
use App\biodata;
use App\Pendidikan_kejuruan;
use App\Pendidikan_non_formal;
use App\Pendidikan_umum;
use App\Riwayat_jabatan;
use App\Riwayat_kepangkatan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use PDF;
class BiodataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data=User::where('nip_nrp',auth::user()->nip_nrp)->first();
        $datas=biodata::where('nip_nrp',auth::user()->nip_nrp)->first();
        return view('Profile.biodata.index',compact('datas','data'));

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
        //

        $this->validate($request,[
            'status_menikah'=>'required',
            'no_kk'=>'required','hobi'=>'required',
            'no_tlp'=>'required',
            'tinggi_badan'=>'required|numeric',
            'berat_badan'=>'required|numeric',
            'warna_rambut'=>'required',
            'bentuk_muka'=>'required',
            'warna_kulit'=>'required',
            'ciri_khas'=>'required',
            'cacat_tubuh'=>'required',
        ]);
        $datas=biodata::where('nip_nrp',$id)->get();
        $users=User::findOrFail($id);
        $data=biodata::where('nip_nrp',$id);
        if(empty($request->file('foto'))){
            $nama_file=$users->foto;
        }
        else{
            $this->validate($request,[
                'foto' =>'file|image|mimes:jpeg,png,jpg|max:2048',
            ]);
            if (file_exists($_SERVER['DOCUMENT_ROOT'].'/img/'.$users->foto))
            {
                $image_path = $_SERVER['DOCUMENT_ROOT'].'/img/'.$users->foto;
                unlink($image_path);
            }
            $file = $request->file('foto');
            $text = str_replace(' ', '',$file->getClientOriginalName());
            $nama_file = time()."_".$text;
            $tujuan_upload = 'img';
            // $file->move($tujuan_upload,$nama_file);
            $img = Image::make($file->getRealPath());
            $img->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->save($tujuan_upload.'/'.$nama_file);

        }

        if(count($datas) == 0){
            biodata::create($request->all());
            $users->update([
                'foto'=>$nama_file,
            ]);
            return back()->with('succes','Data berhasil Ditambahakan');
        }
        else{
            $data->update([
                'nip_nrp'=>$request->nip_nrp,
                'status_menikah'=>$request->status_menikah,
                'no_kk'=>$request->no_kk,
                'hobi'=>$request->hobi,
                'no_tlp'=>$request->no_tlp,
                'tinggi_badan'=>$request->tinggi_badan,
                'berat_badan'=>$request->berat_badan,
                'warna_rambut'=>$request->warna_rambut,
                'bentuk_muka'=>$request->bentuk_muka,
                'warna_kulit'=>$request->warna_kulit,
                'ciri_khas'=>$request->ciri_khas,
                'cacat_tubuh'=>$request->cacat_tubuh,

            ]);
            $users->update([
                'foto'=>$nama_file,
            ]);
            return back()->with('succes','Data berhasil Diupdate');
        }
        // return $request->all();

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
    public function cetak_pdf()
    {
        $biodata = biodata::where('nip_nrp',auth::user()->nip_nrp)->first();
        $user=User::where('nip_nrp',auth::user()->nip_nrp)->first();
        $p_umum=Pendidikan_umum::where('nip_nrp',auth::user()->nip_nrp)->get();
        $p_non_formal=Pendidikan_non_formal::where('nip_nrp',auth::user()->nip_nrp)->get();
        $r_pangkat=Riwayat_kepangkatan::where('nip_nrp',auth::user()->nip_nrp)->get();
        $r_jabatan=Riwayat_jabatan::where('nip_nrp',auth::user()->nip_nrp)->get();
        $bahasa=Riwayat_jabatan::where('nip_nrp',auth::user()->nip_nrp)->get();
        $pdf = PDF::loadview('Profile.cetak_rh',['biodata'=>$biodata,'user'=>$user,'p_umum'=>$p_umum,'p_non_formal'=>$p_non_formal,
            'r_pangkat'=>$r_pangkat,'r_jabatan'=>$r_jabatan,'bahasa'=>$bahasa
        ]);
        return $pdf->download('laporan-pegawai-pdf');
        return $user;
    }
}
