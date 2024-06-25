<x-admin-layout>
    <x-page-title 
        title="List Rent"
        sub="Rent"
    />
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">
                List Rental Mobil
            </h1>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Bagasi/Kursi</th>
                            <th>Harga</th>
                            <th>Rating</th>
                            <th>Aksi</th>
                        </tr>
                        @forelse ($rents as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <div>
                                            <img src="{{ $item->cover_url }}" class="img-thumbnail mt-1" style="width: 100px; height:50px; object-fit: cover" alt="">
                                        </div>
                                        <div class="ml-2">
                                            {{ $item->name }}
                                            <p style="font-size: 10px; line-height: 20px">
                                                {{ $item->category }} / {{ $item->transmission }}
                                            </p>
                                            <p style="font-size: 10px; line-height: 0px; margin-top: -11px">
                                                Driver : {{ $item->include_driver }}
                                            </p>
                                        </div>
                                    </div>
                                    
                                    
                                </td>
                                <td>
                                    {{ $item->passenger_count }}/{{ $item->luggage_count }}
                                </td>
                                <td>
                                    <s>Rp.{{ number_format($item->start_price,0,',','.') }}</s> <br>
                                    Rp.{{ number_format($item->price,0,',','.') }}
                                </td>
                                <td>
                                    {{ $item->ratings }}/{{ number_format($item->reviews_count) }}
                                </td>
                                <td>
                                    <div style="width: 200px"></div>
                                    <a href="{{ route('rent-car.edit', $item->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
                                    <button class="btn btn-sm btn-danger delete-data"
                                        data-bs-toggle="tooltip"
                                        data-bs-original-title="Hapus"
                                        data-url="{{ route('rent-car.destroy', $item->id) }}"
                                        data-id="{{ $item->id }}">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </button>
                                </td>
                            </tr>
                        @empty
                            
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        @include('button.delete')
    @endpush
</x-admin-layout>