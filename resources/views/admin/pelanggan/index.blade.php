@extends('admin.layout.appadmin')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tables</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank"
            href="https://datatables.net">official DataTables documentation</a>.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{route('pelanggan.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Tempat Tanggal Lahir</th>
                            <th>Tgl Lahir</th>
                            <th>Email</th>
                            <th>Jenis Kartu</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Tempat Tanggal Lahir</th>
                            <th>Tgl Lahir</th>
                            <th>Email</th>
                            <th>Jenis Kartu</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @php
                            $id = 1;
                        @endphp
                        @foreach ($pelanggan as $pl)
                            <tr>
                                <td>{{$id++}}</td>
                                <td>{{$pl->kode}}</td>
                                <td>{{$pl->nama}}</td>
                                <td>{{$pl->jk}}</td>
                                <td>{{$pl->tmp_lahir}}</td>
                                <td>{{$pl->tgl_lahir}}</td>
                                <td>{{$pl->email}}</td>
                                <td>{{$pl->kartu->nama}}</td>
                                <td>
                                    {{-- <a href="{{route('pelanggan.show', $jenis->id)}}"><button class="btn btn-sm btn-info"><i class="fas fa-eye"></i></button></a> --}}
                                    <a href="{{route('pelanggan.edit',$pl->id)}}"><button class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></button></a>
                                    <a href="{{ route('pelanggan.destroy', $pl->id) }}" class="btn btn-sm btn-danger" data-confirm-delete="true"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
@endsection