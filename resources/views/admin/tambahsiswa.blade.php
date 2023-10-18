@extends('admin.admin')
@section('title','tambahsiswa')
@section('content-title','Tambah Siswa')

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



                <form method="POST" action="{{route('mastersiswa.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Nama Siswa</label>
                        <input name="name" type="text" class="form-control" value="{{old('name')}}">
                    </div>
                    <div class="form-group">
                        <label for="">About</label>
                       <textarea name="about" id="" cols="30" rows="10" class="form-control">{{old('about')}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Photo</label>
                        <input type="file" name="photo" class="form-control"value="{{old('photo')}}">
                    </div>
                    <div class="form-group">
                       <input class="btn btn-success" type="submit" value="Simpan">
                      <a href="{{route('mastersiswa.store')}}" class="btn btn-danger" type="submit">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
