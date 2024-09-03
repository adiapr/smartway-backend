<x-admin-layout>
    <x-page-title 
        title="Documentation Service"
        sub="List Data"
    />

    @foreach ($documentations as $item)  
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <img src="{{ $item->cover_url }}" alt="" class="aspect-video w-100 rounded">
                    </div>
                    <div class="col-md-9">
                        <h1 class="fw-bold">
                            {{ $item->name }}
                        </h1>
                        <h5>
                            <s>Rp.{{ number_format($item->start_price)  }},-</s> <br>
                            <b>Rp.{{ number_format($item->price)  }},-</b>
                        </h5>
                        <hr>
                        <a href="{{ route('documentation.edit', $item->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
                        <button class="btn btn-sm btn-danger delete-data"
                            data-bs-toggle="tooltip"
                            data-bs-original-title="Hapus"
                            data-url="{{ route('documentation.destroy', $item->id) }}"
                            data-id="{{ $item->id }}">
                            <i class="fas fa-trash-alt"></i> Hapus
                        </button>
                        <a href="{{ route('documentation.slider.index', $item->id) }}" class="btn btn-success btn-sm"><i class="far fa-clock"></i> Slider</a>
                        <a href="{{ route('documentation.result.index', $item->id) }}" class="btn btn-warning btn-sm"><i class="far fa-images"></i> Dokumentasi</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @include('button.delete')
</x-admin-layout>