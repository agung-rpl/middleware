@extends('admin.admin')
@section('title','editproject')
@section('content-title','editproject')

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


                <form method="POST" action="{{route('masterproject.update',$data->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="">Nama Project</label>
                        <input name="project_name" type="text" class="form-control" value="{{$data->project_name}}">
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal Project</label>
                        <input name="project_date" type="date" class="form-control" value="{{$data->project_date}}">
                    </div>
                    <div class="form-group">
                        <label for="">photo</label>
                        <input name="photo" type="file" class="form-control" value="{{$data->photo}}"> <br>
                        <img src="{{ asset('storage/img/' . $data->photo) }}" width="20%" alt="">
                    </div>
                    <div class="form-group">
                       <input class="btn btn-success" type="submit" value="simpan">
                      <a href="{{route('masterproject.store')}}" class="btn btn-danger" type="submit">back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
