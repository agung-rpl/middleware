@extends('admin.admin')
@section('title','mastersiswa')
@section('content-title','Master Siswa')

@section('content')
@if (session()->has('message'))
    <div class="alert alert-success">
        {{session()->get('message')}}
    </div>

@endif
<div class="row">



    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <a href="{{route('mastersiswa.create')}}" class="btn btn-info">Tambah Data</a>
            </div>

            <div class="card body">



                <table class="table table-bordered">
                    <thead>
                        <th>Nama</th>
                        <th>About</th>
                        <th>Photo</th>
                        <th>Action</th>
                    </thead>
                @foreach ($data as $siswa)
                        <tr>
                            <td class="text-center" style="vertical-align: middle">{{$siswa->name}}</td>
                            <td class="text-center" style="vertical-align: middle">{{substr($siswa->about,0,50)}}...</td>
                            <td class="text-center" style="vertical-align: middle"><img class="align-center" src="{{ asset('storage/public/photo/' . $siswa->photo) }}" width="200px" alt=""></td>
                            <td class="text-center" style="vertical-align: middle">
                                <div class="d-flex justify-content-center" style="gap: 10px">
                                    <a href="{{route('mastersiswa.edit', $siswa->id)}}" class="btn btn-info"><i class="fas fa-edit"></i></a>
                                    <form action="{{route('mastersiswa.delete', $siswa->id)}}" onclick="return confirm('Apakah anda ingin menghapus data ini? ')" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit"  class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </table>
            </div>
        </div>
    </div>
</div>




@endsection
