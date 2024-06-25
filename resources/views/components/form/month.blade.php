<select name="month" id="" class="form-control" {{ request()->routeIs('admin.analytic.order.bulanan') ? '' : 'required' }}>
    <option value="">- PIlih Bulan -</option>
    @php
        $no = 1;
        $data_bulan = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
    @endphp
    @foreach ($data_bulan as $item)
      @php
          $a = $no++;
          $bulan = $a < 10 ? '0'.$a : $a 
      @endphp
      <option value="{{ $bulan }}" {{ $bulan == @$_GET['month'] ? 'selected' : '' }}>{{ $item }}  </option>
    @endforeach
</select>