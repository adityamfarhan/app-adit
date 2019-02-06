@extends('layouts.app')

@section('content')
<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Kerudung</h3>
            </div>
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-group fa-fw"></i> List Kerudung
                </div>
                <br>
                <div class="panel-body top-operation">
                    <div class="col-lg-5 search-head-outer">
                        <form class="form-inline" role="form" method="GET" action="{{ route('kerudung-search' )}}">
                            <div class="input-group search-head">
                                <input type="text" class="form-control input-sm" name="keyword" placeholder="Nama Kerudung">
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
                                    <th>Nama Kerudung</th>
                                    <th>Ukuran</th>
                                    <th>Harga</th>
                                    <th>Warna</th>
                                    <th>Gambar</th>
                                    <th class="text-right"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($kerudung as $kr)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $kr->nama_kerudung }}</td>
                                        <td>{{ $kr->ukuran }}</td>
                                        <td>{{ $kr->harga }}</td>
                                        <td>{{ $kr->warna }}</td>
                                        <td>
                                            <div
                                                class="image"
                                                style="
                                                    background-image: url({{ asset('img/gallery/thumbnails/'.$kr->gambar) }});
                                                ">
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <a class="detail-info" href="#">
                                                <button
                                                    class="btn btn-primary"
                                                    onclick="editModal('{{ $kr->id_kerudung }}')"
                                                    data-toggle="modal"
                                                    data-target="#editModal">
                                                    <i class="fa fa-edit fa-fw"></i>
                                                    Edit
                                                </button>
                                            </a>
                                            <form
                                                id="deleteKerudung{{ $kr->id_kerudung }}"
                                                action="{{ route('kerudung-remove') }}"
                                                method="POST"
                                                style="display: none;">
                                                {{ csrf_field() }}
                                                <input
                                                    type="hidden"
                                                    value="{{ $kr->id_kerudung }}"
                                                    name="id-kerudung-remove"
                                                    id="id-kerudung-remove">
                                            </form>
                                            <a href="{{ route('kerudung-remove') }}" onclick="event.preventDefault();
                                                document.getElementById('deleteKerudung'+{{ $kr->id_kerudung }}).submit();">
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
                                {{ $kerudung->links() }}
                            </ul>
                        </div>
                    </div>
                </div>
                 <!-- Modal Create -->
                <div class="modal fade" id="createModal" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <form action="{{ route('kerudung-publish') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Tambah Kerudung</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="selectKategori">Pilih Kategori</label>
                                        <select class="form-control" name="id-kategori" id="sel1">
                                            @foreach ($kategori as $kt)
                                                <option value="{{ $kt->id_kategori }}">{{ $kt->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama-kerudung">Nama Kerudung</label>
                                        <input type="text" class="form-control" name="nama-kerudung" required id="nama-kerudung" placeholder="Nama Kerudung">
                                    </div>
                                    <div class="form-group">
                                        <label for="ukuran">Ukuran</label>
                                        <input type="text" class="form-control" name="ukuran" required id="ukuran" placeholder="Ukuran">
                                    </div>
                                    <div class="form-group">
                                        <label for="harga">Harga</label>
                                        <input type="text" class="form-control" name="harga" required id="harga" placeholder="Harga">
                                    </div>
                                    <div class="form-group">
                                        <label for="warna">Warna</label>
                                        <input type="text" class="form-control" name="warna" required id="warna" placeholder="Warna">
                                    </div>
                                    <div class="form-group">
                                        <label for="gambar">Pilih Gambar</label>
                                        <input type="file" name="gambar" id="gambar" required>
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
                            <form action="{{ route('kerudung-put') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Edit Kerudung</h4>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="id-kerudung" id="edit-id-kerudung">
                                    <div class="form-group">
                                        <label for="selectKategori">Pilih Kategori</label>
                                        <select class="form-control" name="id-kategori" id="sel1">
                                            @foreach ($kategori as $kt)
                                                <option value="{{ $kt->id_kategori }}">{{ $kt->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama-kerudung">Nama Kerudung</label>
                                        <input type="text" class="form-control" name="nama-kerudung" required id="edit-nama-kerudung" placeholder="Nama Kerudung">
                                    </div>
                                    <div class="form-group">
                                        <label for="ukuran">Ukuran</label>
                                        <input type="text" class="form-control" name="ukuran" required id="edit-ukuran" placeholder="Ukuran">
                                    </div>
                                    <div class="form-group">
                                        <label for="harga">Harga</label>
                                        <input type="text" class="form-control" name="harga" required id="edit-harga" placeholder="Harga">
                                    </div>
                                    <div class="form-group">
                                        <label for="warna">Warna</label>
                                        <input type="text" class="form-control" name="warna" required id="edit-warna" placeholder="Warna">
                                    </div>
                                    <div class="form-group">
                                        <label for="gambar">Pilih Gambar</label>
                                        <input type="file" name="gambar" id="edit-gambar" required>
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
    function editModal(idKerudung) {
        $.ajax({
            type: "GET",
            url: "{{ url('/detail-kerudung/') }}"+'/'+idKerudung,
            data: "data",
            dataType: "json",
            success: function (response) {
                console.log(response[0]);
                $('.kategori').removeAttr('selected');
                $('#kategori-'+response[0].id_kategori).attr('selected', 'true');
                $('#edit-id-kerudung').val(response[0].id_kerudung);
                $('#edit-nama-kerudung').val(response[0].nama_kerudung);
                $('#edit-ukuran').val(response[0].ukuran);
                $('#edit-harga').val(response[0].harga);
                $('#edit-warna').val(response[0].warna);
                $('#edit-gambar').val(response[0].gambar);
            }
        });
    }
</script>

@endsection
