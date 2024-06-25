<x-admin-layout>
    <x-page-title 
        title="List Article"
        sub="Article"
    />
    <div class="card">
        <div class="card-header">
            <h4 class="card-title pull-left">List Data Artikel</h4>

        </div>
        <div class="card-body">
            <form>
                <div class="row">
                    <div class="col-2 pr-md-0 mb-3 mb-md-0">
                        <x-row />
                    </div>
                    <div class="col-md-5 mb-3 ml-auto">
                        <div class="custom-search">
                            <select name="status" id="" class="form-control" onchange="this.form.submit()">
                                <option value="">- Status Artikel -</option>
                                <option value="review">Review</option>
                                <option value="published">Published</option>
                                <option value="reject">Reject</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5 mb-3 ml-auto">
                        <div class="custom-search">
                            <input type="text" class="form-control" name="search" placeholder="Cari artikel..."
                                value="{{ @$_GET['search'] }}">
                        </div>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-bordered table-hover  text-nowrap">
                    <thead>
                        <tr>

                            <th rowspan="2">#</th>
                            <th rowspan="2">Tanggal Terbit</th>
                            <th rowspan="2">Status</th>
                            
                            {{-- <th colspan="2">Statistik</th> --}}
                            <th rowspan="2">Aksi</th>
                            <th rowspan="2">Judul</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($article as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    {{ Carbon\Carbon::parse(@$data->created_at)->format('d M Y - H:i') }}
                                </td>
                                <td>
                                    @if ($data->publishment == 'draft')
                                        <span class="badge alert-warning">
                                    @endif
                                    @if ($data->publishment == 'published')
                                        <span class="badge alert-success">
                                    @endif
                                    @if ($data->publishment == 'rejected')
                                        <span class="badge alert-danger">
                                    @endif
                                        {{ $data->publishment }}
                                    </span>
                                </td>
                                
                                {{-- <td>
                                    {{ $data->visitors_count }}
                                </td>
                                <td>{{ $data->likes_count }}</td> --}}
                                <td>
                                    <div style="width: 200px">
                                        <a class="btn btn-primary btn-sm text-white"
                                            href="{{ route('article.edit', @$data->slug) }}" data-toggle="tooltip"
                                            data-placement="top" title="Edit article"><i class="fas flaticon-pen"></i></a>
                                        <a class="btn btn-success btn-sm text-white"
                                            href="{{ route('admin.article.publish', @$data->id) }}" data-toggle="tooltip"
                                            data-placement="top" title="Publish"><i class="fa fa-check"></i></a>
                                        <a class="btn btn-warning btn-sm text-white"
                                            href="{{ route('admin.article.reject', @$data->id) }}" data-toggle="tooltip"
                                            data-placement="bottom" title="Reject"><i class="fa fa-times"></i></a>
                                        <button onClick="Delete(this.id)" class="btn btn-sm btn-danger"
                                            data-toggle="tooltip" data-placement="top" title="Hapus"
                                            id="{{ @$data->id }}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                                <td>
                                    {{ @$data->name }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" align="center">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-12">
                    {{ $article->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        function Delete(id) {
            var id = id;
            var token = $("meta[name='_token']").attr("content");
            swal({
                title: "APAKAH KAMU YAKIN ?",
                text: "INGIN MENGHAPUS DATA INI!",
                icon: "warning",
                buttons: [
                    'TIDAK',
                    'YA'
                ],
                dangerMode: true,
            }).then(function(isConfirm) {
                if (isConfirm) {
                    //ajax delete
                    jQuery.ajax({
                        url: "/admin/article/delete/" + id,
                        data: {
                            "id": id,
                            "_token": token
                        },
                        type: 'DELETE',
                        success: function(response) {
                            if (response.status == "success") {
                                swal({ 
                                    title: 'BERHASIL!',
                                    text: 'ARTIKEL BERHASIL DIHAPUS!', 
                                    icon: 'success',
                                    timer: 1000,
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                    buttons: false,
                                }).then(function() {
                                    location.reload();
                                });
                            } else {
                                swal({
                                    title: 'GAGAL!',
                                    text: 'ARTIKEL GAGAL DIHAPUS!',
                                    icon: 'error',
                                    timer: 1000,
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                    buttons: false,
                                }).then(function() {
                                    location.reload();
                                });
                            }
                        }
                    });
                } else {
                    return true;
                }
            })
        }
    </script>
    @endpush
</x-admin-layout>