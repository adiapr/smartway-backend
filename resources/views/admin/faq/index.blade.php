<x-admin-layout>
    <x-page-title 
        title="Data FAQ"
        sub="FAQ"
    />

    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title fw-bold">
                        List Data FAQ
                    </h1>
                </div>
                <div class="card-body">
                    <div class="accordion" id="accordionExample">
                        @foreach ($data as $item)
                            <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center" id="headingTwo">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed fw-bold" style="font-size: 18px;" type="button" data-toggle="collapse" data-target="#collapse{{ $item->id }}" aria-expanded="false" aria-controls="collapse{{ $item->id }}">
                                        <i class="fa fa-chevron-down"></i> &nbsp; {{ $item->category }}
                                    </button>
                                </h5>
                                <div>
                                    <a href="{{ route('faq.edit', $item->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil-alt"></i> Edit</a>
                                    <button class="btn btn-sm btn-danger delete-data"
                                        data-bs-toggle="tooltip"
                                        data-bs-original-title="Hapus"
                                        data-url="{{ route('faq.destroy', $item->id) }}"
                                        data-id="{{ $item->id }}">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </button>
                                </div>
                            </div>
                            <div id="collapse{{ $item->id }}" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                <div class="card-body">
                                    {!! $item->description !!}
                                </div>
                            </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div style="position: sticky; top:100px">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title fw-bold">
                            {{ $method == 'PUT' ? 'Edit' : 'Tambah' }} Data
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ $url }}" method="post">
                            @if ($method == 'PUT')
                                @method('PUT')
                            @endif
                            @csrf
                                <x-form.text 
                                    name="category"
                                    label="Kategori"
                                    :value="@$faq->category"
                                    type="text"
                                    required
                                    placeholder="Masukkan kategori..."
                                />
                                <x-form.textarea 
                                    name="description"
                                    label="FAQ"
                                    placeholder="Masukkan FAQ disini..."
                                    required
                                    editor="4"
                                    :value="@$faq->description"
                                /> 
    
                                <button type="submit" class="btn btn-primary mt-3 mx-auto ml-3 pull-right">
                                    {{ $method == 'PUT' ? 'Update' : 'Simpan' }} Data
                                </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('plugin.ckeditor5-classic')
    @push('scripts')
    @include('button.delete')
        <script>
            $(document).ready(function() {
    // Event listener ketika accordion dibuka
            $('#accordionExample .collapse').on('show.bs.collapse', function () {
                $(this).prev('.card-header').find('.btn i').removeClass('fa-chevron-down').addClass('fa-chevron-up');
            });

            // Event listener ketika accordion ditutup
            $('#accordionExample .collapse').on('hide.bs.collapse', function () {
                $(this).prev('.card-header').find('.btn i').removeClass('fa-chevron-up').addClass('fa-chevron-down');
            });
        });

        </script>
    @endpush
</x-admin-layout>