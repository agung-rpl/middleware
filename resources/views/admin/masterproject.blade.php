@extends('admin.admin')
@section('title','masterproject')
@section('content-title','Master Project')

@section('content')

    <div class="row">
        <div class="col-5">
            <div class="card shadow">
                <div class="card-header">
                    <h6>Data siswa</h6>
                </div>
                    <div class="card-body">

                        @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{session()->get('message')}}
                        </div>

                    @endif

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @foreach ($siswas as $siswa)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$siswa->name}}</td>
                                    <td>
                                        <a onclick="show('{{route('masterproject.show',$siswa->id)}}')" class="btn btn-sm btn-info"> <i class="fas fa-folder-open"></i></a>
                                        <a class="btn btn-sm btn-success" href="{{ route('project.add', $siswa->id)}}"><i class="fas fa-plus"></i></a>

                                    </td>
                                </tr>
                            @endforeach

                        </table>
                    </div>
            </div>
        </div>
        <div class="col-7">
            <div class="card shadow">
                <div class="card-header">
                    <h6>List Project</h6>
                </div>
                <div id="masterproject" class="card-body">
                    <h6 class="text-center">Silahkan Pilih siswa terlebih dahulu</h6>
                </div>
                {{-- <div class="card-footer text-right">
                    <a class="btn btn-sm btn-success" href="{{ route('project.add', $siswa->id)}}"><i class="fas fa-edit"></i></a>
                <a class="btn btn-sm btn-danger" href=""><i class="fas fa-trash"></i></a>
                </div> --}}

        </div>

    </div>

    <script>
        function show(url){
            console.log(url);
            $.get(url, function(data){
                $('#masterproject').html(data);
            });
        }
    </script>

@endsection
