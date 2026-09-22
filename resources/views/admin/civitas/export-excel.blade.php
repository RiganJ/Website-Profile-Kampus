<table>
    <thead>
        <tr>
            @foreach($headers as $header)
                <th>{{ $header }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($civitasRows as $civitas)
            <tr>
                <td>{{ $civitas->nip }}</td>
                <td>{{ $civitas->nama }}</td>
                <td>{{ $civitas->jenis_kelamin }}</td>
                <td>{{ $civitas->pendidikan_terakhir }}</td>
                <td>{{ $civitas->asal_pendidikan }}</td>
                <td>{{ $civitas->tanggal_masuk_kerja }}</td>
                <td>{{ $civitas->jabatan }}</td>
                <td>{{ $civitas->keterangan }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
