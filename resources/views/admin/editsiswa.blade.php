@extends('admin.admin')
@section('title','tambahsiswa')
@section('content-title','tambahsiswa')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">


                @if (count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                             @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                    </ul>
                </div>

                @endif


                <form method="POST" action="{{route('mastersiswa.update',$siswa->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="">Nama Siswa</label>
                        <input name="name" type="text" class="form-control" value="{{$siswa->name}}">
                    </div>
                    <div class="form-group">
                        <label for="">About</label>
                       <textarea name="about" id="" cols="30" rows="10" class="form-control">{{$siswa->about}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">photo</label>
                        <input name="photo" type="file" class="form-control" value="{{$siswa->photo}}"> <br>
                        <img src="{{ asset('storage/public/photo/' . $siswa->photo) }}" width="20%" alt="">
                    </div>
                    <div class="form-group">
                       <input class="btn btn-success" type="submit" value="simpan">
                      <a href="{{route('mastersiswa.store')}}" class="btn btn-danger" type="submit">back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

