<x-admin-layout>
    <x-page-title 
        title="Create Rent"
        sub="Rent"
    />
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Buat rental Mobil/Bus
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
                        <x-form.text 
                            name="name"
                            label="Nama Transportasi"
                            :value="@$item->name"
                            required
                            placeholder="Masukkan nama transportasi..."
                        />
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mt-6">
                                    <label for="" class="fw-bold">Lokasi</label>    
                                    {{-- <div class="row"> --}}
                                        {{-- @php
                                           $locationIds = json_decode(@$item->location_id, true) ?? [];
                                        @endphp --}}
                                        <select name="location_id" id="" class="form-control">
                                            <option value="">- Pilih Lokasi -</option>
                                            @foreach ($location as $data)
                                                <option value="{{ $data->id }}" {{ $data->id == @$item->location_id ? 'selected' : '' }}>{{ $data->location }}</option>
                                            @endforeach
                                        </select>
                                    {{-- </div> --}}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="fw-bold">Pilihan Bensin</label>
                                    <select name="bensin" id="" class="form-control">
                                        <option value="">- Pilih -</option>
                                        <option value="Belum termasuk BBM" {{ @$item->bensin == 'Belum termasuk BBM' ? 'selected' : '' }}>Belum termasuk BBM</option>
                                        <option value="Sudah termasuk BBM" {{ @$item->bensin == 'Sudah termasuk BBM' ? 'selected' : '' }}>Sudah termasuk BBM</option>
                                        <option value="Full to Full" {{ @$item->bensin == 'Full to Full' ? 'selected' : '' }}>Full to Full</option>
                                        <option value="Half to Half" {{ @$item->bensin == 'Half to Half' ? 'selected' : '' }}>Half to Half</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mt-3">
                                    <label for="" class="fw-bold">Termasuk Sopir?</label> <br>
                                    <input type="radio" name="include_driver" {{ @$item->include_driver == 'Iya' ? 'checked' : '' }} value="Iya" id="Ya" required> <label for="Ya">Iya</label> |
                                    <input type="radio" name="include_driver" {{ @$item->include_driver == 'Tidak' ? 'checked' : '' }} value="Tidak" id="Tidak" required> <label for="Tidak">Tidak</label>

                                    @error('include_driver')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <x-form.textarea 
                            name="description"
                            label="Deskripsi Mobil"
                            placeholder="Masukkan deskripsi atau keterangan..."
                            required
                            editor="4"
                            :value="@$item->description"
                        />  
                    </div>
                    <div class="col-md-6">
                        <x-form.textarea 
                            name="ketentuan"
                            label="Syarat dan ketentuan"
                            placeholder="Masukkan Syarat dan ketentuan rental mobi..."
                            required
                            editor="3"
                            :value="@$item->ketentuan"
                        />  
                    </div>
                    <div class="col-md-6">
                        <x-form.textarea 
                            name="include"
                            label="Sudah Termasuk"
                            placeholder="Sudah Termasuk..."
                            required
                            editor="2"
                            :value="@$item->include"
                        />  
                    </div>
                    <div class="col-md-6">
                        <x-form.textarea 
                            name="no_include"
                            label="Belum Termasuk"
                            placeholder="Belum Termasuk..."
                            required
                            editor="1"
                            :value="@$item->no_include"
                        />  
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mt-3">
                            <label for="" class="fw-bold">Embed Lokasi</label>
                            <textarea name="map" id="" cols="30" rows="5" required class="form-control mt-2" placeholder="Embed kode map bisa didapatkan dari google map">{{ @$item->map }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mt-3">
                            <label for="" class="fw-bold">Embed Youtube</label>
                            <textarea name="youtube" id="" cols="30" rows="5" required class="form-control mt-2" placeholder="Ambil kode embed dari youtube">{{ @$item->youtube }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mt-3">
                            <label for="" class="fw-bold">Jenis</label>
                            <select name="category"  id=""  class="form-control mt-1 @error('category') border-danger @enderror" required>
                                <option value="">- Pilih -</option>
                                <option value="Mobil" {{ old('category', @$item->category) == 'Mobil' ? 'selected' : '' }}>
                                    Mobil
                                </option>
                                <option value="Bus" {{ old('category', @$item->category) == 'Bus' ? 'selected' : '' }}>
                                    Bus
                                </option>
                            </select>
                            @error('category')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mt-3">
                            <label for="" class="fw-bold">Transmisi</label>
                            <select name="transmission"  id=""  class="form-control mt-1 @error('transmission') border-danger @enderror" required>
                                <option value="">- Pilih -</option>
                                <option value="Manual" {{ old('transmission', @$item->transmission) == 'Manual' ? 'selected' : '' }}>
                                    Manual
                                </option>
                                <option value="Automatic" {{ old('transmission', @$item->transmission) == 'Automatic' ? 'selected' : '' }}>
                                    Automatic
                                </option>
                            </select>
                            @error('transmission')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        
                        <x-form.text 
                            name="passenger_count"
                            label="Jumlah Kursi"
                            :value="@$item->passenger_count"
                            type="number"
                            required
                            placeholder="Total orang..."
                        />
                    </div>
                    <div class="col-md-3">
                        <x-form.text 
                            name="luggage_count"
                            label="Jumlah bagasi"
                            :value="@$item->luggage_count"
                            type="number"
                            required
                            placeholder="Muatan isi bagasi..."
                        />
                    </div>
                    <div class="col-md-3">
                        <x-form.text 
                            name="start_price"
                            label="Harga Coret"
                            :value="@$item->start_price"
                            type="number"
                            required
                            placeholder="Masukkan harga coret..."
                        />
                    </div>
                    <div class="col-md-3">
                        <x-form.text 
                            name="price"
                            label="Harga Asli"
                            :value="@$item->price"
                            type="number"
                            required
                            placeholder="Masukkan harga price..."
                        />
                    </div>
                    <div class="col-md-3">
                        <x-form.text 
                            name="ratings"
                            label="Rating"
                            :value="@$item->ratings"
                            type="number"
                            required
                            placeholder="Masukkan rating..."
                        />
                    </div>
                    <div class="col-md-3">
                        <x-form.text 
                            name="reviews_count"
                            label="Jumlah Review"
                            :value="@$item->reviews_count"
                            type="number"
                            required
                            placeholder="Masukkan jumlah review..."
                        />
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary mt-3 w-100">Simpan Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @include('plugin.ckeditor5-classic')
</x-admin-layout>
