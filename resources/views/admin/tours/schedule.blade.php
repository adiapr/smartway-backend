<x-admin-layout>
    <x-page-title 
        title="{{ $tour->name }}"
        sub="Create Schedule"
    />

    @push('styles')
        <style>
            .linimasa ul.timeline {
                list-style-type: none;
                position: relative;
            }
            .linimasa ul.timeline:before {
                content: ' ';
                background: #d4d9df;
                display: inline-block;
                position: absolute;
                left: 29px;
                width: 2px;
                height: 100%;
                z-index: 400;
            }
            .linimasa ul.timeline > li {
                margin: 20px 0;
                padding-left: 50px;
            }
            .linimasa ul.timeline > li:before {
                content: ' ';
                background: white;
                display: inline-block;
                position: absolute;
                border-radius: 50%;
                border: 3px solid #22c0e8;
                left: 20px;
                width: 20px;
                height: 20px;
                z-index: 400;
            }

            .linimasa ul.timeline > li.null-time:before {
                content: ' ';
                background: #f50c1c;
                display: inline-block;
                position: absolute;
                border-radius: 50%;
                border: 3px solid #22c0e8;
                left: 12px;
                width: 35px;
                height: 35px;
                z-index: 400;
            }
        </style>
    @endpush

    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">
                        Jadwal {{ $tour->name }}
                    </h1>
                </div>
                <div class="card-body">
                    <div class="linimasa">
                        <div class="row">
                            <div class="col-md-12">
                                {{-- <h4>Latest News</h4> --}}
                                <ul class="timeline"> 
                                    @forelse ($schedules as $item)
                                        <li class="{{ $item->time === null ? 'null-time' : '' }}">
                                            <span class="text-primary fw-bold">{{ $item->time }}</span>
                                            <a href="{{ route('paket-wisata.schedule.edit', ['uuid' => $tour->uuid, 'id' => $item->id]) }}" class="btn btn-primary float-right btn-sm ml-1"><i class="fas fa-pencil-alt"></i></a> 
                                            <button class="btn btn-sm btn-danger delete-data float-right"
                                                data-bs-toggle="tooltip"
                                                data-bs-original-title="Hapus"
                                                data-url="{{ route('paket-wisata.schedule.destroy', $item->id) }}"
                                                data-id="{{ $item->id }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                            <p>{!! $item->description !!}</p>
                                        </li>
                                    @empty
                                        <h4 class="fw-bold ml-5">
                                            - Jadwal belum ditambahkan -
                                        </h4>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">
                        Buat Jadwal 
                    </h1>
                </div>
                <div class="card-body">
                    <form action="{{ $url }}" method="post">
                        @csrf
                        <x-form.text 
                            name="order_by"
                            label="Nomor urut perjalanan"
                            type="number"
                            :value="@$schedules_number->order_by + 1 ?? @$item_schedule->order_by"
                            required
                            placeholder="Nomor urut perjalanan..."
                        />
                        <x-form.text 
                            name="time"
                            label="Waktu"
                            :value="@$item_schedule->time"
                            {{-- required --}}
                            placeholder="Misal 10.00 - 12.00..."
                        />
                        <x-form.textarea 
                            name="description"
                            label="Deskripsi"
                            placeholder="Bisa diisi keterangan tempat..."
                            {{-- required --}}
                            editor="2"
                            :value="@$item_schedule->description"
                        />
                        <button class="btn btn-primary btn-sm w-100 mt-4">{{ $method == 'put' ? 'Update' : 'Tambah' }} Jadwal</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('plugin.ckeditor5-classic')
    @include('button.delete')
</x-admin-layout>