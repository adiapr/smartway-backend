<x-admin-layout>
    @push('styles')
        <style>
            .ratio{
                aspect-ratio: 12 / 16 !important;
                width: 100%;
                object-fit: cover;
                border-radius: 8px;
            }
        </style>
    @endpush
    <x-page-title 
        title="Documentation Service"
        sub="Hasil layanan dokumentasi"
    />

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body d-flex justify-content-between">
                    <div>
                        <h3 class="fw-bold">
                            {{ @$documentation->section2 ?? 'Header belum ditambahkan' }}
                        </h3>
                        <p>
                            {{ @$documentation->description2 ?? 'Tagline belum ditambahkan' }}
                        </p>
                    </div>
                    <div>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            <i class="fa fa-pencil-alt"></i> Edit Header
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form action="{{ route('documentation.header.store', $documentation->id) }}" method="post">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title fw-bold" id="exampleModalLabel">Edit Hader</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <x-form.text 
                                            name="section2"
                                            label="Judul"
                                            :value="@$documentation->section2"
                                            required
                                            placeholder="Masukkan Judul..."
                                        />
                                        <x-form.text 
                                            name="description2"
                                            label="Tagline"
                                            :value="@$documentation->description2"
                                            required
                                            placeholder="Masukkan Tagline..."
                                        />
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @forelse ($result as $item)
                            <div class="col-md-4">
                                <div style="position: relative; display: inline-block;">
                                    <img src="{{ $item->getFirstMediaUrl('cover', 'thumb') }}" class="ratio" alt="">
                                    <div style="
                                        position: absolute;
                                        top: 0;
                                        left: 0;
                                        width: 100%;
                                        height: 40%;
                                        background: linear-gradient(to bottom, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0));
                                        z-index: 1;">
                                    </div>
                                    <div style="position: absolute; top: 10px; left: 10px; z-index: 2;">
                                        <h3 class="text-white fw-bold">
                                            {{ $item->description }}
                                        </h3>
                                    </div>
                                    <div  style="position: absolute; top: 10px; right: 10px; z-index: 2;">
                                        <button class="btn btn-sm btn-danger delete-data float-right" style="right: 10px"
                                            data-bs-toggle="tooltip"
                                            data-bs-original-title="Hapus"
                                            data-url="{{ route('paket-wisata.documentation.destroy', $item->id) }}"
                                            data-id="{{ $item->id }}">
                                                <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-md-12 text-center">
                                - Data Belum Ada -
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title fw-bold">
                        Tambah Data
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('documentation.result.store', $documentation->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <x-form.file 
                            :data="@$item"
                            method="POST"
                        />

                        <x-form.text 
                            name="description"
                            label="Masukkan Keteranggan"
                            :value="@$item->description"
                            required
                            placeholder="Masukkan Keterangan..."
                        />

                        <button type="submit" class="btn btn-primary mt-3 w-100"> Simpan Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('button.delete')
</x-admin-layout>