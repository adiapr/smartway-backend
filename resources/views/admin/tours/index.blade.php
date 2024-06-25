<x-admin-layout>
    <x-page-title 
        title="List Tours"
        sub="Tours"
    />
    @foreach ($tours as $item)  
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <img src="{{ $item->cover_url }}" alt="" class="img-thumbnail">
                    </div>
                    <div class="col-md-9">
                        <h4 class="fw-bold">
                            {{ $item->name }}
                        </h4>
                        <div class="d-flex justify-content-between">
                            <div>
                                <span class="badge bg-{{ $item->type == 'Domestik' ? 'warning' : 'success' }} text-white">{{ $item->type }}</span>
                                <span class="ml-3"><i class="fas fa-map-marked-alt"></i> {{ $item->location->location }}</span>
                            </div>
                            <div>
                                <label class="switch">
                                    <input type="checkbox"
                                        class="tampilkan"
                                        data-id="11"
                                        id="publish-event-{{ $item->id }}"
                                        {{ $item->publishment == 'published' ? 'checked' : '' }}
                                        onclick="updatePublished('tours', {{ $item->id }}, `publish-event-{{ $item->id }}`)">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <hr>
                        <a href="{{ route('paket-wisata.edit', $item->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
                        <button class="btn btn-sm btn-danger delete-data"
                            data-bs-toggle="tooltip"
                            data-bs-original-title="Hapus"
                            data-url="{{ route('paket-wisata.destroy', $item->id) }}"
                            data-id="{{ $item->id }}">
                            <i class="fas fa-trash-alt"></i> Hapus
                        </button>
                        <a href="{{ route('paket-wisata.schedule', $item->uuid) }}" class="btn btn-outline-success btn-sm"><i class="far fa-clock"></i> Jadwal Tour</a>
                        <a href="{{ route('paket-wisata.documentation', $item->uuid) }}" class="btn btn-outline-warning btn-sm"><i class="far fa-images"></i> Dokumentasi</a>
                        <a href="{{ route('paket-wisata.price', $item->uuid) }}" class="btn btn-outline-danger btn-sm"><i class="fas fa-money-check-alt"></i> Data Harga</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @push('scripts')
        @include('button.publish')
        @include('button.delete')
    @endpush
</x-admin-layout>