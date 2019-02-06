@extends('layouts.app')

@section('content')
<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Kategori</h3>
            </div>
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-group fa-fw"></i> List Kategori
                </div>
                <br>
                <div class="panel-body top-operation">
                    <div class="col-lg-5 search-head-outer">
                        <form class="form-inline" role="form" method="GET" action="{{ route('kategori-search' )}}">
                            <div class="input-group search-head">
                                <input type="text" class="form-control input-sm" name="keyword" placeholder="Nama Kategori">
                                <div class="input-group-btn">
                                    <button class="btn btn-default btn-sm" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <a href="#" data-toggle="modal" data-target="#createModal"><div class="btn btn-sm btn-primary pull-right"><i class="fa fa-plus-circle"></i> Tambah </div></a>
                </div>
                <div class="panel-body">
                    <div class="table-responsive table-data">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kategori</th>
                                    <th class="text-right"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($kategori as $kt)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $kt->nama_kategori }}</td>
                                        <td class="text-right">
                                            <a class="detail-info" href="#">
                                                <button
                                                    class="btn btn-primary"
                                                    onclick="editModal('{{ $kt->id_kategori }}')"
                                                    data-toggle="modal"
                                                    data-target="#editModal">
                                                    <i class="fa fa-edit fa-fw"></i>
                                                    Edit
                                                </button>
                                            </a>
                                            <form
                                                id="deleteKategori{{ $kt->id_kategori }}"
                                                action="{{ route('kategori-remove') }}"
                                                method="POST"
                                                style="display: none;">
                                                {{ csrf_field() }}
                                                <input
                                                    type="hidden"
                                                    value="{{ $kt->id_kategori }}"
                                                    name="id-kategori-remove"
                                                    id="id-kategori-remove">
                                            </form>
                                            <a href="{{ route('kategori-remove') }}" onclick="event.preventDefault();
                                                document.getElementById('deleteKategori'+{{ $kt->id_kategori }}).submit();">
                                                <button class="btn btn-danger">
                                                    <i class="fa fa-trash fa-fw"></i>Delete
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="pull-right" id="page-control">
                            <ul class="pagination">
                                {{ $kategori->links() }}
                            </ul>
                        </div>
                    </div>
                </div>
                 <!-- Modal Create -->
                <div class="modal fade" id="createModal" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <form action="{{ route('kategori-publish') }}" method="POST">
                                @csrf
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Tambah Kategori</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="nama-kategori">Nama Kategori</label>
                                        <input type="text" class="form-control" name="nama-kategori" required id="nama-kategori" placeholder="Nama Kategori">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Modal Edit -->
                <div class="modal fade" id="editModal" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <form action="{{ route('kategori-put') }}" method="POST">
                                @csrf
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Edit Kategori</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="hidden" name="id-kategori" id="edit-id-kategori">
                                        <label for="nama-kategori">Nama Kategori</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="nama-kategori"
                                            required
                                            id="edit-nama-kategori"
                                            placeholder="Nama Kategori">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function editModal(idKategori) {
        $.ajax({
            type: "GET",
            url: "{{ url('kategori/') }}"+'/'+idKategori,
            data: "data",
            dataType: "json",
            success: function (response) {
                console.log(response[0]);
                $('#edit-id-kategori').val(response[0].id_kategori);
                $('#edit-nama-kategori').val(response[0].nama_kategori);
            }
        });
    }
</script>

@endsection
