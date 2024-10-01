<x-admin-layout>
    <x-page-title 
        title="List Order"
        sub="Order"
    />
    <div class="card">
        <div class="card-header">
            <h4 class="card-title pull-left">List Data Order</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>#</th>
                        <th>ID Order</th>
                        <th>Status</th>
                        <th>Total Bayar</th>
                        <th>Nama Pemesan</th>
                        <th>Produk</th>
                        {{-- <th>Nomor HP</th> --}}
                        <th>Pembayaran</th>
                        <th>Tanggal Order</th>
                        <th>Tanggal Update</th>
                        {{-- <th>Aksi</th> --}}
                    </tr>
                    @forelse ($orders as $order)
                        <tr>
                            <td>{{ increment($orders, $loop) }}</td>
                            <td>{{ $order->kode }}</td>
                            <td>
                                {!! $order->status_order !!}
                            </td>
                            <td>
                                <div style="width: 150px;">
                                    {{-- <div class="d-flex"> --}}
                                        <div class="float-start">
                                            {{ rupiahFormat($order->total) }}
                                        </div>
                                        <div class="float-end">
                                            @if ($order->voucher_id != null)
                                                <div class="badge bg-primary end-0" style="font-size: 10px">
                                                    {{ $order->promo->discount }}%
                                                </div>
                                            @endif
                                        </div>
                                    {{-- </div> --}}
                                    
                                    
                                </div>
                            </td>
                            <td>
                                <div style="width: 200px;">
                                    {{ @$order->user->name }}
                                </div>
                                <!-- Button trigger modal -->
                                <a href="!#" class="fw-bold" data-toggle="modal" data-target="#order{{ $order->id }}">
                                    Detail Pesanan <i class="fa fa-arrow-right"></i>
                                </a>
                                
                                <!-- Modal -->
                                <div class="modal fade" id="order{{ $order->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title fw-bold" id="exampleModalLabel">Pesanan #{{ $order->kode }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                            {{-- <div class="badge badge-{{ @$order->detail->status == 0 ? 'danger' : 'success' }} pull-right">{{ @$order->detail->status == 0 ? 'Belum konfirmasi' : 'Sudah Dikonfirmasi' }}</div> --}}
                                            <table>
                                                <tr>
                                                    <td>Tanggal Kebenrangkatan</td>
                                                    {{-- <td> : </td> --}}
                                                    <td> :  {{ @$order->detail->keberangkatan ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Jumlah Peserta</td>
                                                    {{-- <td> : </td> --}}
                                                    <td> :  {{ @$order->detail->jml_peserta ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Nama Peserta
                                                    </td>
                                                    <td> : {{ @$order->detail->name ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Tanggal Lahir
                                                    </td>
                                                    <td> : {{ @$order->detail->birthday ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Pasport
                                                    </td>
                                                    <td> : {{ @$order->detail->pasport ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        No. HP
                                                    </td>
                                                    <td> : {{ @$order->detail->phone ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Instagram
                                                    </td>
                                                    <td> : {{ @$order->detail->instagram ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Tiktok
                                                    </td>
                                                    <td> : {{ @$order->detail->tiktok ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Email
                                                    </td>
                                                    <td> : {{ @$order->detail->email ?? '-' }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                                        </div>
                                    </div>
                                    </div>
                                </div>
  
                            </td>
                            <td>
                                <div style="width: 300px;">
                                        {{ @$order->tour->name }} 
                                </div>
                            </td>
                            {{-- <td>
                                @if (@$order->user->phone)
                                <a href="https://api.whatsapp.com/send?phone={{ $order->user->phone }}"
                                    target="_blank">{{ $order->user->phone }}</a>  
                                @else
                                    -
                                @endif
                                
                            </td> --}}
                            
                            <td>
                                {{ $order->payment_type }}
                            </td>
                            <td class="text-success">
                                <div style="width: 150px;">
                                    {{ formatTanggalIndoWithTime($order->created_at, 'singkat') }}
                                </div>
                            </td>
                            <td class="text-success">
                                <div style="width: 150px;">
                                    {{ formatTanggalIndoWithTime($order->success_at, 'singkat') }}
                                </div>
                            </td>
                            {{-- <td>
                                <button class="btn btn-sm btn-danger delete-data"
                                    data-bs-toggle="tooltip"
                                    data-bs-original-title="Hapus"
                                    data-url="{{ route('admin.order.destroy', $order->id) }}"
                                    data-id="{{ $order->id }}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td> --}}
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10"
                                class="fw-bold text-center">
                                - Data Masih Kosong -
                            </td>
                        </tr>
                    @endforelse
                </table>
            </div>
            <div class="mt-3">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</x-admin-layout>