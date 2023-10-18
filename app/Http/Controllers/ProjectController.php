<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Project;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function __construct()
    {
        $this->middleware(['role:admin'])->except(['index','show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswas = Siswa::all('id','name');
        return view('admin.masterproject', compact('siswas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tambahproject');
    }
    public function add($id){
        $siswa= Siswa::find($id);
        return view('admin.tambahproject',compact('siswa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)

    {
        $message =
        [
        'requred' => ':atribute harus diisi dong',
        'min' => ':atribute minimal :min karakter',
        'max' => ':atribute maximal :max karakter',
        'mimes' => 'file :harus bertipe :mimes'
        ];

        $this->validate($request,[
            'project_name' => 'required|min:5|max:20',
            'project_date' => 'required',
            'photo' => 'required|mimes: jpg,jpeg,png',
        ] , $message);

        $file = $request->file('photo');

        $nama_file = time(). '_' .$file->getClientOriginalName();

        $file->storeAs('img', $nama_file);

        Project::create([
            'siswa_id'    =>$request->siswa_id,
            'project_name'=>$request->project_name,
            'project_date'=>$request->project_date,
            'photo' => $nama_file
        ]);


        return redirect()->route('masterproject.index')->with('message', 'Project siswa berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Siswa::find($id)->project()->get();
        return view('admin.showproject', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Project::find($id);
        return view('admin.editproject', compact('data'));
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
        $data = Project::find($id);
        // $data->update($request->all());

        $message =
        [
        'requred' => ':atribute harus diisi dong',
        'min' => ':atribute minimal :min karakter',
        'max' => ':atribute maximal :max karakter',
        'mimes' => 'file :harus bertipe :mimes'
        ];

        // dd($request);
        //validasi
        $this->validate($request,[

            'project_name'=>'required|min:3|max:30',
            'project_date'=>'required',
            'photo'=>'nullable|mimes:jpg,jpeg,png'

        ] , $message);


      if($request->file('photo') == ""){
        $data->update([
            'project_name' => $request->project_name,
            'project_date' => $request->project_date
        ]);

      } else {
        Storage::disk('local')->delete('public/img/' . $data->photo);
        $file = $request->file('photo');

        $nama_file = time(). '_' .$file->getClientOriginalName();

        $file->storeAs('img', $nama_file);


        $data->update([
            'project_name' => $request->project_name,
            'project_date' => $request->project_date,
            'photo' => $nama_file
        ]);

      }

        return redirect('masterproject')->with('message', 'data project berhasil diupdate');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $project = Project::find($id);
        Storage::disk('local')->delete('public/img/' . $project->photo);
        $project->delete();
        return redirect('masterproject')->with('message', 'data siswa berhasil dihapus');

    }
}
