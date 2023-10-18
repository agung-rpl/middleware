@extends('admin.admin')
@section('title','tambahproject')
@section('content-title','Tambah Project -'.$siswa->name)

@section('content')

    <div class="row">
        <div class="col-12">
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

                    <form action="{{route('masterproject.store')}}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <input type="hidden" name="siswa_id" value="{{$siswa->id}}">
                        <div class="form-grup">
                            <label for="project-name">Nama Project</label>

                            <input class="form-control" type="text" name="project_name" placeholder="Nama Project">
                        </div>
                        <div class="form-group">
                            <label for="project_date">Tanggal Project</label>
                            <input class="form-control" type="date" name="project_date" id="">
                        </div>
                        <div class="form-group">
                            <label for="photo">Photo Project</label>
                            <input class="form-control" type="file" name="photo" id="">
                        </div>
                        <div class="form-group">
                            <input class="btn btn-success" type="submit" value="Submit">
                            <input class="btn btn-danger" type="reset" value="Reset">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
