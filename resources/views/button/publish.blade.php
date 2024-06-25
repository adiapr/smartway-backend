@push('styles')
<style type="text/css">
    /* The switch - kotak di sekitar slider */
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 24px;
    }

    /* Sembunyikan checkbox HTML secara default */
    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    /* The slider */
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 16px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    .round {
        border-radius: 5px;
    }
</style>

@endpush
@push('scripts')

    <script>
        function updatePublished(table, id, id_element) {
            console.log(table);
            console.log(id);
            console.log(id_element);

            let value = $(`#${id_element}`).is(':checked') ? 'published' : 'draft';

            $.ajax({
                type: "post",
                url: '{{ route('update.publish') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    table: table,
                    id: id,
                    value: value
                },
                success: function(response) {

                    if (response.status == 'success') {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'success',
                            title: response.message
                        })
                    } else {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'error',
                            title: response.message
                        })
                    }

                }
            });
        }
    </script>
@endpush
