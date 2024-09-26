<x-form.text 
    name="urutan"
    label="Nomor Urut"
    :value="@$item->urutan ?? $urutan"
    required
    type="number"
    placeholder="Masukkan urutan paket ke berapa"
/>
<x-form.text 
    name="name"
    label="Nama paket"
    :value="@$item->name"
    required
    placeholder="Masukkan Nama paket harga"
/>
<x-form.text 
    name="pax"
    label="Jumlah Pax"
    type="number"
    :value="@$item->pax"
    required
    placeholder="Masukkan Nama paket harga"
/>
<x-form.text 
    name="start_price"
    label="Harga Coret"
    :value="@$item->start_price"
    type="number"
    required
    placeholder="Harga sebelum promo..."
/>
<x-form.text 
    name="price"
    label="Harga Asli"
    :value="@$item->price"
    type="number"
    required
    placeholder="Harga asli..."
/>