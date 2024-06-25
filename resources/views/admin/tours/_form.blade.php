<x-admin-layout>
    <x-page-title 
        title="Create Tours"
        sub="Tours"
    />
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">
                Buat Wisata
            </h1>
        </div>
        <div class="card-body">
            <form action="{{ $url }}" method="post" enctype="multipart/form-data">
                @if (@$method == 'put')
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
                        <x-form.text 
                            name="name"
                            label="Nama Lokasi"
                            :value="@$item->name"
                            required
                            placeholder="Input tour title..."
                        />
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mt-2">
                                    <label for="type" class="fw-semibold">Jenis Paket Wisata </label>
                                    <select name="type"  id=""  class="form-control mt-1 @error('type') border-danger @enderror" required>
                                        <option value="">- Pilih -</option>
                                        <option value="Domestik" {{ old('type', @$item->type) == 'Domestik' ? 'selected' : '' }}>
                                            Domestik
                                        </option>
                                        <option value="Internasional" {{ old('type', @$item->type) == 'Internasional' ? 'selected' : '' }}>
                                            Internasional
                                        </option>
                                    </select>
                                    @error('type')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mt-2">
                                    <label for="location" class="fw-semibold">Lokasi </label>
                                    <select name="location_id"  id=""  class="form-control mt-1 @error('location') border-danger @enderror" required>
                                        <option value="">- Pilih Lokasi -</option>
                                        @foreach ($location as $data)
                                            <option value="{{ $data->id }}" {{ old('location', @$item->location) ==  $data->location ? 'selected' : '' }}>
                                                {{ $data->location }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('location')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <x-form.text 
                            name="duration"
                            label="Durasi"
                            :value="@$item->duration"
                            type="number"
                            required
                            placeholder="Masukkan dalam hitungan jam..."
                        />
                    </div>
                    <div class="col-md-3">
                        <x-form.text 
                            name="group_size"
                            label="Kuota"
                            :value="@$item->group_size"
                            type="number"
                            required
                            placeholder="Total orang..."
                        />
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mt-2">
                            <label for="transportation" class="fw-semibold">Transportasi </label>
                            <select name="transportation"  id=""  class="form-control mt-1 @error('transportation') border-danger @enderror" required>
                                <option value="">- Pilih Transportasi -</option>
                                    <option value="Mobil" {{ old('transportation', @$item->transportation) ==  'Mobil' ? 'selected' : '' }}>
                                        Mobil
                                    </option>
                                    <option value="Bus" {{ old('transportation', @$item->transportation) ==  'Bus' ? 'selected' : '' }}>
                                        Bus
                                    </option>
                                    <option value="Pesawat" {{ old('transportation', @$item->transportation) ==  'Pesawat' ? 'selected' : '' }}>
                                        Pesawat
                                    </option>
                            </select>
                            @error('transportation')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mt-2">
                            <label for="free_cancel" class="fw-semibold">Bisa Batal? </label>
                            <select name="free_cancel"  id=""  class="form-control mt-1 @error('free_cancel') border-danger @enderror" required>
                                <option value="">- Pilih Transportasi -</option>
                                    <option value="Ya" {{ old('free_cancel', @$item->free_cancel) ==  'Ya' ? 'selected' : '' }}>
                                        Ya
                                    </option>
                                    <option value="Tidak" {{ old('free_cancel', @$item->free_cancel) ==  'Tidak' ? 'selected' : '' }}>
                                        Tidak
                                    </option>
                            </select>
                            @error('free_cancel')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <x-form.textarea 
                    name="description"
                    label="Deskripsi singkat"
                    placeholder="Input tours descriptions..."
                    required
                    :value="@$item->description"
                    editor="1"
                />
                <div class="row">
                    <div class="col-md-6">
                        <x-form.textarea 
                            name="destination"
                            label="Destinasi yang dikunjungi"
                            placeholder="Destinasi yang dikunjungi..."
                            required
                            editor="2"
                            :value="@$item->destination"
                        /> 
                    </div>
                    <div class="col-md-6">
                        <label for="map" class="fw-bold mt-4">Embed Map</label>
                        <textarea name="map" id="" cols="30" rows="10" required class="form-control mt-2" placeholder="Embed kode map bisa didapatkan dari google map">{{ @$item->map }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <x-form.textarea 
                            name="packet"
                            label="Paket Termasuk"
                            placeholder="Paket Termasuk..."
                            required
                            editor="3"
                            :value="@$item->packet"
                        /> 
                    </div>
                    <div class="col-md-6">
                        <x-form.textarea 
                            name="no_packet"
                            label="Paket belum termasuk"
                            placeholder="Paket Termasuk..."
                            required
                            editor="4"
                            :value="@$item->no_packet"
                        /> 
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100 mt-3">Simpan Data</button>
            </form>
        </div>
    </div>

    @include('plugin.ckeditor5-classic')
</x-admin-layout>