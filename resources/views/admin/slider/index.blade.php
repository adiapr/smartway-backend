<x-admin-layout>
    <x-page-title 
        title="List Slider"
        sub="Slider"
    />

    <div class="row">
        <div class="col-md-8">
            @foreach ($sliders as $article)  
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <img src="{{ $article->cover_url }}" alt="" class="img-thumbnail">
                            </div>
                            <div class="col-md-9">
                                <h4 class="fw-bold">
                                    {{ $article->name }}
                                </h4>
                                <p>{{ $article->description }}</p>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a href="{{ route('content.slider.edit', $article->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
                                        <button class="btn btn-sm btn-danger delete-data"
                                            data-bs-toggle="tooltip"
                                            data-bs-original-title="Hapus"
                                            data-url="{{ route('content.slider.destroy', $article->id) }}"
                                            data-id="{{ $article->id }}">
                                            <i class="fas fa-trash-alt"></i> Hapus
                                        </button>
                                    </div>
                                    <div>
                                        <label class="switch">
                                            <input type="checkbox"
                                                class="tampilkan"
                                                data-id="11"
                                                id="publish-event-{{ $article->id }}"
                                                {{ $article->publishment == 'published' ? 'checked' : '' }}
                                                onclick="updatePublished('sliders', {{ $article->id }}, `publish-event-{{ $article->id }}`)">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>
                                
                                
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title fw-bold">
                        {{ $method == 'post' ? 'Tambah' : 'Update' }} slider
                    </h1>
                </div>
                <div class="card-body">
                    <form action="{{ $url }}" enctype="multipart/form-data" method="post">
                        @if ($method == 'put')
                            @method('PUT')
                        @endif
                        
                        @csrf
                        <x-form.file 
                            :data="@$item"
                            :method="$method"
                        />
                        <span>Pastikan gambar rasio 16/9 agar gambar sempurna</span>
                        <x-form.text 
                            name="name"
                            label="Judul"
                            :value="@$item->name"
                            required
                            placeholder="Masukkan Judul..."
                        />
                        <x-form.text 
                            name="description"
                            label="Deskripsi"
                            :value="@$item->name"
                            required
                            placeholder="Masukkan Deskripsi..."
                        />
                        <button type="submit" class="btn btn-primary w-100 mt-3">{{ $method == 'post' ? 'Simpan' : 'Update' }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        @include('button.publish')
        @include('button.delete')
    @endpush
</x-admin-layout>