<x-admin-layout>
    <x-page-title 
        title="{{ $tour->name }}"
        sub="Create Price"
    />
    <div class="card">
        <div class="card-header">
            <h1 class="card-title float-left">
                List Harga Paket
            </h1>
            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">
                <i class="fas fa-cart-plus"></i> Tambah Paket Harga
            </button> 
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Harga</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('paket-wisata.price.store', $tour->uuid) }}" method="post">
                            @csrf
                            <div class="modal-body">
                                @include('admin.tours.partials.price-modal')
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                <button type="submit" class="btn btn-primary">Simpan Harga</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
  
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="add-row" class="display table table-striped table-hover" >
                    <thead>
                        <tr>
                            <th>Urutan</th>
                            <th>Nama Paket</th>
                            <th>Jumlah PAX</th>
                            <th>Harga Coret</th>
                            <th>Harga Asli</th>
                            <th style="width: 10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($prices as $item)
                        <tr>
                            <td>{{ $item->urutan }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->pax }}</td>
                            <td>
                                <s>Rp.{{ number_format($item->start_price,0,',','.') }}</s>
                            </td>
                            <td>Rp.{{ number_format($item->price,0,',','.') }}</td>
                            <td>
                                <div class="form-button-action">
                                    <button type="button" class="btn btn-link btn-primary btn-lg" data-toggle="modal" data-target="#editModal{{ $item->id }}" data-original-title="Edit Data">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-link btn-danger delete-data" data-toggle="tooltip" data-url="{{ route('paket-wisata.price.destroy', $item->id) }}" data-id="{{ $item->id }}" data-original-title="Remove">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
  
                                @push('modals')
                                <!-- Edit Modal -->
                                <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Harga</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('paket-wisata.price.update', $item->id) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <!-- Include your form here -->
                                                    @include('admin.tours.partials.price-modal')
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endpush
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center fw-bold">- Data belum ada -</td>
                            </tr>
                        @endforelse
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('button.delete')
    @stack('modals')
    @push('scripts')
        <script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('#add-row').DataTable({
                    "pageLength": 5,
                });
            });
        </script>
    @endpush
</x-admin-layout>
