<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    public function index(){
        $data = Siswa::all();
        //  return $data;
        return view('admin.mastersiswa', compact('data'));
    }

    public function create(){
        return view('admin.tambahsiswa');
    }

    public function store(Request $request){
        // dd($request);

        //custom message

        $message =
        [
        'requred' => ':atribute harus diisi dong',
        'min' => ':atribute minimal :min karakter',
        'max' => ':atribute maximal :max karakter',
        'mimes' => 'file :harus bertipe :mimes'
        ];

        //validasi
        $this->validate($request,[

            'name'=>'required|min:3|max:30',
            'about'=>'required|min:20',
            'photo'=>'mimes:jpg, jpeg, png'

        ], $message);


        $file = $request->file('photo');

        $nama_file = time(). '_' .$file->getClientOriginalName();

        $file->storeAs('public/photo', $nama_file);


        Siswa::create([
            'name' => $request->name,
            'about' => $request->about,
            'photo' => $nama_file,
        ]);
        // $siswa = new Siswa();
        // $siswa->name = $request->name;
        // $siswa->about = $request->about;

        // $siswa->photo = $request->file('photo')->storeAs('public/photo', $request -> file('photo')->getClientOriginalName());
        // $siswa->save();


        //ambil nama gambar dan rename
        // $file = $request->file('photo');
        // $nama_file = time().'-'.$file->getClientOriginalName();

        // //proses upload
        // $file->move('./storage', $nama_file);

        // Siswa::create([
        //     'name' => $request->name,
        //     'about' => $request->about,
        //     'name' => $nama_file
        // ]);
        return redirect()->route('mastersiswa')->with('message', 'Data siswa berhasil ditambahkan');

    }

    public function edit($id){
        $siswa = Siswa::find($id);
        return view('admin.editsiswa',compact('siswa'));

    }

    public function update($id, Request $request){
        $siswa = Siswa::find($id);
        $siswa->update($request->all());

        $message =
        [
        'requred' => ':atribute harus diisi dong',
        'min' => ':atribute minimal :min karakter',
        'max' => ':atribute maximal :max karakter',
        'mimes' => 'file :harus bertipe :mimes'
        ];

        //validasi
        $this->validate($request,[

            'name'=>'required|min:3|max:30',
            'about'=>'required|min:20',
            'photo'=>'mimes:jpg, jpeg, png'

        ], $message);


      if($request->file('photo') == ""){
        $siswa->update([
            'name' => $request->name,
            'about' => $request->about
        ]);
      } else {
        File::delete('storage/public/photo/' . $siswa->photo);
        $file = $request->file('photo');

        $nama_file = time(). '_' .$file->getClientOriginalName();

        $file->storeAs('public/photo', $nama_file);


        $siswa->update([
            'name' => $request->name,
            'about' => $request->about,
            'photo' => $nama_file
        ]);

      }

        return redirect('mastersiswa')->with('message', 'data siswa berhasil diupdate');


    }

    public function delete($id){

        $siswa = Siswa::find($id);
        File::delete('storage/public/photo/' . $siswa->photo);
        $siswa->delete();
        return redirect('mastersiswa')->with('message', 'data siswa berhasil dihapus');

    }
}
