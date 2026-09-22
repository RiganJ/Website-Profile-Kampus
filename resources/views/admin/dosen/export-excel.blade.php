<table>
    <thead>
        <tr>
            @foreach($headers as $header)
                <th>{{ $header }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($dosens as $dosen)
            <tr>
                <td>{{ $dosen->nip }}</td>
                <td>{{ $dosen->nama }}</td>
                <td>{{ $dosen->jenis_kelamin }}</td>
                <td>{{ $dosen->pendidikan_terakhir }}</td>
                <td>{{ $dosen->asal_pendidikan }}</td>
                <td>{{ $dosen->tanggal_masuk_kerja }}</td>
                <td>{{ $dosen->jabatan }}</td>
                <td>{{ $dosen->keterangan }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
