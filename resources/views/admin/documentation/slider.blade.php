<x-admin-layout>
    <x-page-title 
        title="Documentation Service"
        sub="List Data Sider"
    />

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title fw-bold">
                        Slide Atas
                    </h1>
                </div>
                <div class="card-body">
                    <div class="row">
                        @forelse ($sliders->where('keterangan', 'Atas') as $item)
                        
                            <div class="col-md-12 position-relative mt-2" style="position: relative">
                                <img src="{{ $item->getFirstMediaUrl('cover', 'thumb') }}" class="img-thumbnail w-100 aspect-video" alt="">
                                <div class="position-absolute top-0 end-0 me-4 mt-2" style="position: absolute; top:0; right: 25px">
                                    <button class="btn btn-sm btn-danger delete-data"
                                        data-bs-toggle="tooltip"
                                        data-bs-original-title="Hapus"
                                        data-url="{{ route('paket-wisata.documentation.destroy', $item->id) }}"
                                        data-id="{{ $item->id }}">
                                            <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 fw-bold text-center">
                                - Foto belum ada -
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title fw-bold">
                        Slide Bawah
                    </h1>
                </div>
                <div class="card-body">
                    <div class="row">
                        @forelse ($sliders->where('keterangan', 'Bawah') as $item)
                            <div class="col-md-12 position-relative mt-2" style="position: relative">
                                <img src="{{ $item->getFirstMediaUrl('cover', 'thumb') }}" class="img-thumbnail w-100 aspect-video" alt="">
                                <div class="position-absolute top-0 end-0 me-4 mt-2" style="position: absolute; top:0; right: 25px">
                                    <button class="btn btn-sm btn-danger delete-data"
                                        data-bs-toggle="tooltip"
                                        data-bs-original-title="Hapus"
                                        data-url="{{ route('paket-wisata.documentation.destroy', $item->id) }}"
                                        data-id="{{ $item->id }}">
                                            <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 fw-bold text-center">
                                - Foto belum ada -
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title fw-bold">
                        Tambah Slider
                    </h1>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('documentation.slider.store', $documentation->id) }}"  enctype="multipart/form-data">
                        @csrf
                        <x-form.file 
                            :data="@$item"
                            :method="$method"
                        />

                        <label for="" class="fw-bold mb-2 mt-3">Posisi</label>
                        <select name="position" id="" class="form-control" required>
                            <option value="">- Pilih Posisi -</option>
                            <option value="Atas">Atas</option>
                            <option value="Bawah">Bawah</option>
                        </select>

                        <button type="submit" class="btn btn-primary mt-3 w-100">
                            Simpan Data
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('button.delete')
</x-admin-layout>