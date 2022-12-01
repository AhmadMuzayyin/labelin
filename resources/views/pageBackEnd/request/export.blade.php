<table>
    <thead>
        <tr>
            <th>Nama Produk</th>
            <th>SN</th>
            <th>PIN</th>
            <th>Link</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $dt)
            <tr>
                <td>{{ $dt->nama_produk }}</td>
                <td>{{ $dt->serial_number }}</td>
                <td>{{ $dt->pin}}</td>
                <td>{{ url('/scan',$dt->serial_number); }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
