<x-admin-layout>
    <x-page-title 
        title="{{ $documentation->name }}"
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
                <div class="modal-dialog  modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Harga</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('documentation.price.store', $documentation->id) }}" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        @include('admin.tours.partials.price-modal')
                                    </div>
                                    <div class="col-md-6">
                                        <x-form.text 
                                            name="duration"
                                            label=" Hour Duration"
                                            :value="@$item->duration"
                                            type="number"
                                            required
                                            placeholder="Hour Duration..."
                                        />
                                        <x-form.text 
                                            name="edited"
                                            label="Edited Photos"
                                            :value="@$item->edited"
                                            type="number"
                                            required
                                            placeholder="Edited Photos..."
                                        />
                                        <x-form.text 
                                            name="downloadable"
                                            label=" Downloadable Photos"
                                            :value="@$item->downloadable"
                                            type="number"
                                            required
                                            placeholder=" Downloadable Photos..."
                                        />
                                    </div>
                                </div>
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
                            <th>#</th>
                            <th>Nama Paket</th>
                            <th>Harga Coret</th>
                            <th>Harga Asli</th>
                            <th>Hours Duration</th>
                            <th>Edited Photos</th>
                            <th>Downloadable Photos</th>
                            <th style="width: 10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($prices as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                <s>Rp.{{ number_format($item->start_price,0,',','.') }}</s>
                            </td>
                            <td>Rp.{{ number_format($item->price,0,',','.') }}</td>
                            <td>{{ $item->duration }}</td>
                            <td>{{ $item->edited }}</td>
                            <td>{{ $item->downloadable }}</td>
                            <td>
                                <div class="form-button-action">
                                    <button type="button" class="btn btn-link btn-primary btn-lg" data-toggle="modal" data-target="#editModal{{ $item->id }}" data-original-title="Edit Data">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-link btn-danger delete-data" data-toggle="tooltip" data-url="{{ route('documentation.price.delete', $item->id) }}" data-id="{{ $item->id }}" data-original-title="Remove">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
  
                                @push('modals')
                                <!-- Edit Modal -->
                                <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Harga</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('documentation.price.store', $item->id) }}" method="post">
                                                @csrf
                                                {{-- @method('PUT') --}}
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                                            @include('admin.tours.partials.price-modal')
                                                        </div>
                                                        <div class="col-md-6">
                                                            <x-form.text 
                                                                name="duration"
                                                                label=" Hour Duration"
                                                                :value="@$item->duration"
                                                                type="number"
                                                                required
                                                                placeholder="Hour Duration..."
                                                            />
                                                            <x-form.text 
                                                                name="edited"
                                                                label="Edited Photos"
                                                                :value="@$item->edited"
                                                                type="number"
                                                                required
                                                                placeholder="Edited Photos..."
                                                            />
                                                            <x-form.text 
                                                                name="downloadable"
                                                                label=" Downloadable Photos"
                                                                :value="@$item->downloadable"
                                                                type="number"
                                                                required
                                                                placeholder=" Downloadable Photos..."
                                                            />
                                                        </div>
                                                    </div>
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
