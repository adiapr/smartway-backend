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
                        <th>Nama</th>
                        <th>Produk</th>
                        <th>Nomor HP</th>
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
                            </td>
                            <td>
                                <div style="width: 300px;">
                                        {{ @$order->tour->name }} 
                                </div>
                            </td>
                            <td>
                                @if (@$order->user->phone)
                                <a href="https://api.whatsapp.com/send?phone={{ $order->user->phone }}"
                                    target="_blank">{{ $order->user->phone }}</a>  
                                @else
                                    -
                                @endif
                                
                            </td>
                            
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