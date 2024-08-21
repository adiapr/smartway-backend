<x-admin-layout>
    <x-page-title 
        title="{{ $tour->name }}"
        sub="List Documentation"
    />
    @push('styles')
        <style>
            .aspect-video{
                aspect-ratio : 16/9;
                object-fit: cover;
            }
        </style>
    @endpush

    <div class="card">
        <div class="card-header">
            <h1 class="card-title float-left">
                List Foto
            </h1>
            <button class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#exampleModal">Tambah Foto</button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ $store }}" method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5 text-black card-title" id="exampleModalLabel">Tambah Foto</h1>
                            
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body"> 
                            @csrf
                            {{-- <p> --}}
                                Gunakan gambar dengan ration 16:9 agar hasil tidak terpotong
                            {{-- </p> --}}
                            <div class="mt-4">
                                <div class="1 select">
                                  <input type="file" name="file" id="" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-sm btn-primary">Save File</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                @forelse ($documentations as $item)
                    <div class="col-md-4 position-relative mt-2" style="position: relative">
                        <img src="{{ $item->cover_url }}" class="img-thumbnail w-100 aspect-video" alt="">
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
    @include('button.delete')
</x-admin-layout>