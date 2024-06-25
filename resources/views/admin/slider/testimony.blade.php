<x-admin-layout>
    <x-page-title 
        title="List Testimony"
        sub="Testimony"
    />
    @push('styles')
        <style>
            iframe{
                width: 100%;
                aspect-ratio: '9/16';
                object-fit: cover;
                border-radius: 8px;
            }
        </style>
    @endpush
    <div class="row">
        <div class="col-md-8">
            <div class="row">
                @foreach ($videos as $video)
                    <div class="col-md-3 px-1">
                        <iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/{{ $video->name }}&amp;controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        <div class="d-flex justify-content-between">
                            <div>
                                <a href="{{ route('content.testimony.edit', $video->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                <button class="btn btn-sm btn-danger delete-data"
                                    data-bs-toggle="tooltip"
                                    data-bs-original-title="Hapus"
                                    data-url="{{ route('content.testimony.destroy', $video->id) }}"
                                    data-id="{{ $video->id }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                            <div>
                                <label class="switch">
                                    <input type="checkbox"
                                        class="tampilkan"
                                        data-id="11"
                                        id="publish-event-{{ $video->id }}"
                                        {{ $video->publishment == 'published' ? 'checked' : '' }}
                                        onclick="updatePublished('testimony_videos', {{ $video->id }}, `publish-event-{{ $video->id }}`)">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title fw-bold">{{ $method == 'post' ? 'Tambah' : 'Update' }} Data</h1>
                </div>
                <div class="card-body">
                    <form action="{{ $url }}" enctype="multipart/form-data" method="post">
                        @csrf
                        @if ($method == 'put')
                            @method('PUT')
                        @endif
                        Untuk memasukkan video short youtube, bisa klik  bagikan, lalu pada link setalah tanga "/" bisa di copy dan di paste bawah.
                        <x-form.text 
                            name="name"
                            label="https://youtube.com/shorts/"
                            :value="@$item->name"
                            required
                            placeholder="Lanjutkan isi link..."
                        />
                        <button type="submit" class="btn btn-primary w-100">
                            {{ $method == 'post' ? 'Simpan' : 'Update' }}
                        </button>
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