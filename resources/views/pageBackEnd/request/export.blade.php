<table>
    <thead>
        <tr>
            <th>Batch Code</th>
            <th>Nama Produk</th>
            <th>SN</th>
            <th>PIN</th>
            <th>Link</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $key => $dt)
            <tr>
                <td>{{ $batch_code[$key]->batch_code }}</td>
                <td>{{ $dt->nama_produk }}</td>
                <td>{{ $dt->serial_number }}</td>
                <td>{{ $dt->pin}}</td>
                <td>{{ url('/scan',$dt->serial_number); }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
