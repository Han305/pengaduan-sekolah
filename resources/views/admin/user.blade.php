@extends('admin.templateAdmin')

@section('body')
    <h4>Data User</h4>
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
    <div class="pt-3">
        <a href="{{ route('datauser.create') }}" class="btn btn-primary btn-md">
            + Tambah User
        </a>
    </div>
    <div class="table-reponsive pt-3">
        <table class="table table-striped border">
            <thead>
                <tr class="table-dark">
                    <th scope="col">No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">category</th>                    
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
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->username }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->category }}</td>                        
                        <td>
                            <a href="{{ route('datauser.edit', ['id' => $item->id]) }}"
                                class="btn btn-warning btn-sm">Edit</a>
                            <a href="{{ route('datauser.destroy', ['id' => $item->id]) }}" class="btn btn-danger btn-sm"
                                onclick="return deleteConfirm()">Hapus</a>                                                    
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
