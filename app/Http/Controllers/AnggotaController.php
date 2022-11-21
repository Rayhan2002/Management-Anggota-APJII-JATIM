<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Regency;
use App\Models\Village;
use App\Models\District;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Exports\AnggotaExport;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $data_anggota=Anggota::all();
       
        if ($req->search != null){
            $data_anggota = Anggota::where('nama_per', 'LIKE', '%'.$req->search.'%')->get();
        }
        return view('anggota.index', compact('data_anggota'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinces = Province::all();

        return view('anggota.create', compact('provinces'));
    }

    public function getkabupaten(Request $request){
        $id_prov = $request->id_prov;

        $kabs = Regency::where('province_id', $id_prov)->get();

        $option = "<option>Pilih Kabupaten/Kota...</option>";
        foreach($kabs as $regencies){
            $option .= "<option value='$regencies->id'>$regencies->name</option>";
        }
        echo $option;
    }

    public function getkecamatan(Request $request){
        $id_kab = $request->id_kab;

        $kecs = District::where('regency_id', $id_kab)->get();

        $option = "<option>Pilih Kecamatan...</option>";
        foreach($kecs as $districts){
            $option .= "<option value='$districts->id'>$districts->name</option>";
        }
        echo $option;
    }

    public function getdesa(Request $request){
        $id_kec = $request->id_kec;

        $desas = Village::where('district_id', $id_kec)->get();

        $option = "<option>Pilih Kelurahan...</option>";
        foreach($desas as $villages){
            $option .= "<option value='$villages->id'>$villages->name</option>";
        }
        echo $option;
    }

    public function list()
    {
        $data_anggota=Anggota::with(['regency','province','district','village'])->get()->groupBy('regency.name')->toArray();
        $anggotas=Anggota::all();
        return view('anggota.list', compact('data_anggota','anggotas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'noreg'=>'required|unique:anggota',
            'nama_per'=>'required',
            'nama_brand'=>'required',
            'jenis_izin'=>'required',
            'pusat'=>'required',
            'media'=>'required',
            'coverage'=>'required',
            'alamat'=>'required',
            'provinces'=>'required',
            'regencies'=>'required',
            'districts'=>'required',
            'villages'=>'required',
            'rt'=>'required',
            'rw'=>'required',
            'kode_pos'=>'required',
            'pic'=>'required',
            'wa'=>'required',
            'email'=>'required|email',
            'image'=>'image|file|max:2048',
        ]);

        $anggota = new Anggota;

        $anggota->noreg = $request->noreg;
        $anggota->nama_per = $request->nama_per;
        $anggota->nama_brand = $request->nama_brand;
        $anggota->jenis_izin = json_encode($request->jenis_izin);
        $anggota->pusat = $request->pusat;
        $anggota->media = json_encode($request->media);
        $anggota->jenis_wireless = $request->jenis_wireless;
        $anggota->coverage = $request->coverage;
        $anggota->alamat = $request->alamat;
        $anggota->province_id = $request->provinces;
        $anggota->regency_id = $request->regencies;
        $anggota->district_id = $request->districts;
        $anggota->village_id = $request->villages;
        $anggota->rt = $request->rt;
        $anggota->rw = $request->rw;
        $anggota->kode_pos = $request->kode_pos;
        $anggota->pic = $request->pic;
        $anggota->wa = $request->wa;
        $anggota->email = $request->email;
        $anggota->pic2 = $request->pic2;
        $anggota->wa2 = $request->wa2;
        $anggota->email2 = $request->email2;
        
        // if($request->file('image')){
        //     $request->file('image')->store('images');
        // }
        if($request->hasfile('image'))
        {
            $file_name = $request->image->getClientOriginalName();
            $image = $request->image->storeAs('images', $file_name);
            $anggota->image = $image;
            // $file = $request->file('image');
            // $extension = $file->getClientOriginalExtension();
            // $filename = time().'.'.$extension;
            // $file->move('storage/images',$filename);
            // $anggota->image = $filename;
        }
        
        $anggota->save();

        if ($anggota) {
            toast('Anggota created successfully!','success');
            return redirect()->route('anggotas.index');
        } else {
            toast('Anggota failed to create!','error');
            return redirect()->route('anggotas.index');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $anggota = Anggota::find($id);
        return view('anggota.show', [
            'anggota' => $anggota
            // 'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Anggota $anggota)
    {
        $provinces = Province::all();
        return view('anggota.edit',compact('anggota','provinces'));
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
        $request ->validate([
            'nama_per'=>'required',
            'nama_brand'=>'required',
            'jenis_izin'=>'required',
            'pusat'=>'required',
            'media'=>'required',
            'coverage'=>'required',
            'alamat'=>'required',
            'provinces'=>'required',
            'regencies'=>'required',
            'districts'=>'required',
            'villages'=>'required',
            'rt'=>'required',
            'rw'=>'required',
            'kode_pos'=>'required',
            'pic'=>'required',
            'wa'=>'required',
            'email'=>'required',
            'image'=>'image|file|max:2048',
        ]);

        // $anggota->province_id = $request->provinces;
        // $anggota->regency_id = $request->regencies;
        // $anggota->district_id = $request->districts;
        // $anggota->village_id = $request->villages;
        
        // $anggota->update($data);

        // if($request->noreg != $data_anggota->noreg){
        //     $rules['noreg'] = 'required|unique:anggota';
        // }

        // $dataAnggota = $request->validate($rules);
        // Anggota::where('id', $data_anggota->id)
        //     ->update($dataAnggota);

        $anggota = Anggota::find($id);
        
        $anggota->nama_per = $request->nama_per;
        $anggota->nama_brand = $request->nama_brand;
        $anggota->jenis_izin = json_encode($request->jenis_izin);
        $anggota->pusat = $request->pusat;
        $anggota->media = json_encode($request->media);
        $anggota->coverage = $request->coverage;
        $anggota->alamat = $request->alamat;
        $anggota->province_id = $request->provinces;
        $anggota->regency_id = $request->regencies;
        $anggota->district_id = $request->districts;
        $anggota->village_id = $request->villages;
        $anggota->rt = $request->rt;
        $anggota->rw = $request->rw;
        $anggota->kode_pos = $request->kode_pos;
        $anggota->pic = $request->pic;
        $anggota->wa = $request->wa;
        $anggota->email = $request->email;  

        // $file_name = $request->image->getClientOriginalName();
        // $image = $request->image->storeAs('images', $file_name);

        // $anggota->image = $image;
        // $pathImage = $anggota->image;
        // if ($pathImage != null || $pathImage != '')
        // {
        //     Storage::delete($pathImage);
        // } 
        // $anggota->image = $image;
        if ($request->hasFile('image'))
        {
            $pathImage = $anggota->image;
            if ($pathImage != null || $pathImage != '')
            {
                Storage::delete($pathImage);
            } 
            // if($request->oldImage){
            //     Storage::delete($request->oldImage);
            // }
            // $request->file('image')->store('images');

            // $file = $request->file('image');
            // $extension = $file->getClientOriginalExtension();
            // $filename = time().'.'.$extension;
            // $file->move('storage/images',$filename);
            // $anggota->image = $filename;

            $file_name = $request->image->getClientOriginalName();
            $image = $request->image->storeAs('images', $file_name);
            $anggota->image = $image;
        } 
        // $dataAnggota->save();
            
        // return redirect('/anggota');
        $anggota->update();
        if ($anggota) {
            toast('Anggota updated successfully!','success');
            return redirect()->route('anggotas.index');
        } else {
            toast('Anggota failed to update!','error');
            return redirect()->route('anggotas.index');
        }
    }

    public function exportData(Request $request)
    {
        // dd($request->columns);
        // $data_anggota=Anggota::with(['regency','province','district','village'])->get();
        return Excel::download(new AnggotaExport($request->columns), 'anggota.xlsx');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Anggota $anggota)
    {
        $pathImage = $anggota->image;
        if ($pathImage != null || $pathImage != '')
        {
            Storage::delete($pathImage);
        }
        $anggota->delete();
        if ($anggota) {
            return response()->json([
                'success' => true,
                'title'   => 'Success',
                'message' => 'Your data has been deleted!'
            ]);
        } else {
            return response()->json([
                'success' => true,
                'title'   => 'Failed',
                'message' => 'Your failed to delete!'
            ]);
        }
        
        // $anggota->delete();
        // return redirect('anggotas.index');
    }
}
