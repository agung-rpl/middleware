@if($data->isEmpty())
<h6>Siswa belum memiliki project</h6>

@else
@foreach ($data as $item)
    <div class="card mb-3">
        <div class="card-header">
            <h6>{{$item->project_name}}</h6>
        </div>
        <div class="card-body">
            <h6>Tanggal :</h6>
            <p>{{$item->project_date}}</p>
            <h6>Photo :</h6>
            <p><img class="img-tumbnail" width="30%" src="/storage/img/{{$item->photo}}" alt=""></p>
        </div>
        <div class="card-footer d-flex justify-content-end" style="gap: 3px">
            <a href="{{route('masterproject.edit', $item->id)}}" class="btn btn-sm btn-success">
                <i class="fas fa-edit"></i>
            </a>
            <form action="{{route('masterproject.destroy',$item->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger" type="submit">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
        </div>
    </div>
@endforeach

@endif
