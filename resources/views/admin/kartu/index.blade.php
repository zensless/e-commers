@extends('admin.layout.appadmin')

@section('content')
@if (Auth::user()->role != 'staff')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tables</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank"
            href="https://datatables.net">official DataTables documentation</a>.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Diskon</th>
                            <th>Iuran</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Diskon</th>
                            <th>Iuran</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @php
                            $id = 1;
                        @endphp
                        @foreach ($kartu as $k)
                            <tr>
                                <td>{{$id++}}</td>
                                <td>{{$k->kode}}</td>
                                <td>{{$k->nama}}</td>
                                <td>{{$k->diskon}}</td>
                                <td>{{$k->iuran}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@else
    @include('admin.notfound')
@endif
    
@endsection