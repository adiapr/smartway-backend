<x-admin-layout>
    <x-page-title 
        title="Create Article"
        sub="Article"
    />

    <div class="card">
        <div class="card-body pt-3">
            <form action="{{ $url }}" method="post" enctype="multipart/form-data">
                @if ($method == 'put')
                    @method('PUT')
                @endif
                <div class="row">
                    @csrf
                    @if ($errors->any())
                        <div class="col-12">
                            <div class="alert alert-danger">
                                <b>Oops, ada kesalahan nih. Yuk perbaiki dulu:</b>
                                <ul>
                                    @foreach ($errors->all() as $item)
                                        <li>{{ $item }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="" class="fw-bold">Judul Artikel <sup class="text-danger">*</sup></label>
                            <input type="text" name="name" value="{{ @$article->name ?? old('name') }}" placeholder="Masukkan judul artikel anda" class="form-control mt-2" required>
                        </div>
                        <div class="form-group mt-4">
                            <label for="" class="fw-bold">Kategori <sup class="text-danger">*</sup></label>
                            <input type="text" name="category" value="{{ @$article->category ?? old('category') }}" placeholder="Masukkan kategori artikel anda" class="form-control mt-2" required>
                        </div>
                    </div>
                    {{-- {{ $article->cover_url }} --}}
                    <div class="col-md-4">
                        <div class="form-group">  
                            <x-form.file 
                                :data="@$article"
                                :method="$method"
                            />
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="" class="fw-bold">Deskripsi Singkat <sup class="text-danger">*</sup> <sub>(Wajib isi antara 250 - 500 karakter)</sub></label>
                            <textarea type="text" oninput="HitungText(this)" name="caption" placeholder="Masukkan deskripsi singkat antara 250 - 500 karakter" class="form-control mt-2" required>{{ @$article->caption ?? old('caption') }}</textarea>
                            <div class="fw-bold mt-2" style="display: block; font-size: 12px; font-weight:bold !important; color: #949494 !important;">
                                Karakter (<span id="hasil">0/500</span>)
                                <span id="keterangan" style="color: red;"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-4">
                        <label for="" class="fw-bold">Isi Artikel <sup class="text-danger">*</sup> <sub>(Wajib isi antara 250 - 500 karakter)</sub></label>
                        <div class="form-group fw-semibold mt-2 @error('deskripsi') has-error @enderror">
                            <textarea name="body"
                                class="form-control mt-3"
                                id="editor1"
                                rows="10">{{ @$article->body ?? old('body') }}</textarea>
                            @error('body')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary position-fixed w-auto m-5" style="bottom: 0; right: 10px"><i class="bi bi-save"></i> Simpan Artikel</button>
                </div>
            </form>
        </div>
    </div>
    @include('plugin.ckeditorartikel')
    @push('scripts')
    <script language='javascript'>
        function HitungText(inputElement) {
            var teks = inputElement.value;
            var total = document.getElementById('hasil');
            var keterangan = document.getElementById('keterangan');
    
            total.innerHTML = teks.length + '/500';
    
            if (teks.length < 250) {
                keterangan.innerHTML = 'Teks terlalu pendek';
                keterangan.style.color = 'red';
            } else if (teks.length >= 250 && teks.length <= 500) {
                keterangan.innerHTML = 'Sudah sesuai';
                keterangan.style.color = 'green';
            } else {
                keterangan.innerHTML = 'Teks terlalu panjang';
                keterangan.style.color = 'red';
            }
        }
    </script>
    @endpush
</x-admin-layout>