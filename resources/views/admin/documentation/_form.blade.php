<x-admin-layout>
    <x-page-title 
        title="Create Documentation Service"
        sub="Documentation"
    />
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Buat rental Layanan dokumentasi
            </h3>
        </div>
        <div class="card-body">
            <form action="{{ $url }}" method="post" enctype="multipart/form-data">
                @if (@$method == 'PUT')
                    @method('PUT')
                @endif
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <x-form.file 
                            :data="@$item"
                            :method="$method"
                        />
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-12">
                                <x-form.text 
                                    name="name"
                                    label="Nama Kategori"
                                    :value="@$item->name"
                                    required
                                    placeholder="Masukkan Nama Kategori..."
                                />
                            </div>
                            <div class="col-md-6">
                                <x-form.text 
                                    name="start_price"
                                    label="Harga Coret"
                                    :value="@$item->start_price"
                                    type="number"
                                    required
                                    placeholder="Masukkan Harga Coret..."
                                />
                            </div>
                            <div class="col-md-6">
                                <x-form.text 
                                    name="price"
                                    label="Harga Asli"
                                    :value="@$item->price"
                                    type="number"
                                    required
                                    placeholder="Masukkan Harga Asli..."
                                />
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <x-form.textarea 
                            name="description"
                            label="Deskripsi Atas"
                            placeholder="Masukkan deskripsi atau keterangan..."
                            required
                            editor="4"
                            :value="@$item->description"
                        /> 
                        <x-form.text 
                            name="include1"
                            label="Inlcude 1"
                            :value="@$item->include1"
                            required
                            placeholder="Masukkan include atas..."
                        />

                        <x-form.text 
                            name="include2"
                            label="Inlcude 2"
                            :value="@$item->include2"
                            required
                            placeholder="Masukkan include kedua..."
                        />

                        <x-form.text 
                            name="q1"
                            label="Reschedule policy"
                            :value="@$item->q1"
                            required
                            placeholder="Masukkan Reschedule policy..."
                        />
                        <x-form.text 
                            name="q2"
                            label="Cancellation policy"
                            :value="@$item->q2"
                            required
                            placeholder="Masukkan Cancellation policy..."
                        />
                        <x-form.text 
                            name="q3"
                            label="Get your photos in 48 hours"
                            :value="@$item->q3"
                            required
                            placeholder="Masukkan Get your photos in 48 hours..."
                        />
                        <x-form.text 
                            name="q4"
                            label="Photographer transportation and entrance fees"
                            :value="@$item->q4"
                            required
                            placeholder="Masukkan Photographer transportation and entrance fees..."
                        />
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary mt-3 pull-right">Simpan Data</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
    @include('plugin.ckeditor5-classic')
</x-admin-layout>