@extends('admin.templateAdmin')

@section('body')
    <h4>Riwayat Pengaduan</h4>
    @error('message')
        <div class="alert alert-danger small py-3 mb-2">
            {{ $message }}
        </div>
    @enderror
    @if (session('message'))
        <div class="alert alert-success small py-3 mb-2">
            {{ session('message') }}
        </div>
    @endif    
    <div class="table-reponsive pt-3">
        <table class="table table-striped border">
            <thead>
                <tr class="table-dark">
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Keluhan</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($posts as $item)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->kelas }}</td>
                        <td><img src="{{ asset($item->image) }}" alt="Post Image" style="width: 100px;"></td>
                        <td>{{ $item->keluhan }}</td>
                        <td>{{ $item->status }}</td>
                        <td>                            
                            <a href="{{ route('riwayat.destroy', ['post' => $item->id]) }}"
                                class="btn btn-danger btn-sm" onclick="return deleteConfirm()">Hapus</a>                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('script')
    <script>
        function deleteConfirm() {
            let approve = confirm('Apakah anda yakin ingin menghapus data?');
            return approve;
        }
    </script>
@endsection