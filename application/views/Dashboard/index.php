<div class="container">
    <h1><?= $title; ?></h1>
    <a href="#form" data-toggle="modal" class="btn btn-primary" onclick="submit('tambah')">Tambah Data</a>
    <p id="berhasil"></p>
    <table id="tables" class=" table table-hover">
        <thead>
            <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Jurusan</th>
                <td>Action</td>
            </tr>
        </thead>
        <tbody id="target">

        </tbody>
    </table>
</div>




<script type="text/javascript">
    ambilData();


    function ambilData() {
        $.ajax({
            type: "POST",
            url: "<?= base_url('Mahasiswa/ambilData') ?>",
            dataType: "json",
            success: function(data) {
                var baris = '';
                for (let i = 0; i < data.length; i++) {
                    baris +=
                        '<tr>' +
                        '<td>' +
                        data[i].nim +
                        '</td>' +
                        '<td>' +
                        data[i].nama +
                        '</td>' +
                        '<td>' +
                        data[i].jurusan +
                        '</td>' +
                        '<td><a href="#form" data-toggle="modal"  onclick="submit(' + data[i].id +
                        ')" class="btn btn-warning"> <i class="far fa-edit"></i></a> <a  onclick="hapusdata(' + data[i].id +
                        ')" class="btn btn-danger"> <i class="fas fa-trash"></i></a></td>' +
                        '</tr>'
                }

                $('#target').html(baris);
            }
        })
    }

    function tambahdata() {
        var nim = $("[name='nim']").val();
        var nama = $("[name='nama']").val();
        var jurusan = $("[name='jurusan']").val();



        $.ajax({
            type: 'POST',
            data: {
                nim: nim,
                nama: nama,
                jurusan: jurusan
            },
            url: '<?= base_url('Mahasiswa/tambah') ?>',
            dataType: 'JSON',
            success: function(data) {

                if (data['status'] == 1) {
                    $("#form").modal('hide');
                    $("#berhasil").html(data['message']);
                    ambilData();
                } else if (data['status'] == 0) {
                    if (data['nim'] != "") {
                        $("#nim-error").html(data['nim']).addClass('invalid-feedback d-block');
                        $("#nim").addClass('is-invalid');
                    } else {
                        $("#nim-error").html('').removeClass('invalid-feedback d-block');
                        $("#nim").removeClass('is-invalid');
                    }
                    if (data['nama'] != "") {
                        $("#nama-error").html(data['nama']).addClass('invalid-feedback d-block');
                        $("#nama").addClass('is-invalid');
                    } else {
                        $("#nama-error").html('').removeClass('invalid-feedback d-block');
                        $("#nama").removeClass('is-invalid');
                    }
                    if (data['jurusan'] != "") {
                        $("#jurusan-error").html(data['jurusan']).addClass('invalid-feedback d-block');
                        $("#jurusan").addClass('is-invalid');
                    } else {
                        $("#jurusan-error").html('').removeClass('invalid-feedback d-block');
                        $("#jurusan").removeClass('is-invalid');
                    }

                }

            }
        })
    }

    function submit(x) {
        if (x == 'tambah') {
            $("#btn-tambah").show();
            $("#btn-ubah").hide();
        } else {
            $("#btn-tambah").hide();
            $("#btn-ubah").show();

            $.ajax({
                type: 'POST',
                data: {
                    id: x
                },
                url: '<?= base_url('Mahasiswa/getId') ?>',
                dataType: 'JSON',
                success: function(data) {
                    $("[name='id']").val(data[0].id);
                    $("[name='nim']").val(data[0].nim);
                    $("[name='nama']").val(data[0].nama);
                    $("[name='jurusan']").val(data[0].jurusan);
                }
            })
        }
    }

    function ubahdata() {
        var id = $("[name='id']").val();
        var nim = $("[name='nim']").val();
        var nama = $("[name='nama']").val();
        var jurusan = $("[name='jurusan']").val();

        $.ajax({
            type: 'POST',
            data: {
                id: id,
                nim: nim,
                nama: nama,
                jurusan: jurusan
            },
            url: '<?= base_url('Mahasiswa/ubah') ?>',
            dataType: 'JSON',
            success: function(data) {
                if (data['status'] == 1) {
                    $("#form").modal('hide');
                    $("#berhasil").html(data['message']);
                    ambilData();
                } else if (data['status'] == 0) {
                    if (data['nim'] != "") {
                        $("#nim-error").html(data['nim']).addClass('invalid-feedback d-block');
                        $("#nim").addClass('is-invalid');
                    } else {
                        $("#nim-error").html('').removeClass('invalid-feedback d-block');
                        $("#nim").removeClass('is-invalid');
                    }
                    if (data['nama'] != "") {
                        $("#nama-error").html(data['nama']).addClass('invalid-feedback d-block');
                        $("#nama").addClass('is-invalid');
                    } else {
                        $("#nama-error").html('').removeClass('invalid-feedback d-block');
                        $("#nama").removeClass('is-invalid');
                    }
                    if (data['jurusan'] != "") {
                        $("#jurusan-error").html(data['jurusan']).addClass('invalid-feedback d-block');
                        $("#jurusan").addClass('is-invalid');
                    } else {
                        $("#jurusan-error").html('').removeClass('invalid-feedback d-block');
                        $("#jurusan").removeClass('is-invalid');
                    }
                }
            }
        })
    }

    function hapusdata(id) {
        var tanya = confirm('Apakah anda yakin ingin menghapus nya?');
        if (tanya) {
            $.ajax({
                type: "POST",
                url: "<?= base_url('Mahasiswa/hapus') ?>",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(data) {
                    $("#berhasil").html(data['message']);
                    ambilData();
                }
            })
        }
    }
</script>

<!-- Modal -->
<div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" value="">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nim</label>
                    <input type="text" class="form-control" name="nim" id="nim" aria-describedby="emailHelp" placeholder="Masukan nim">
                    <span id="nim-error"></span>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Nama</label>
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukan nama">
                    <span id="nama-error"></span>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Jurusan</label>
                    <input type="text" class="form-control" name="jurusan" id="jurusan" placeholder="Masukan jurusan">
                    <span id="jurusan-error"></span>
                </div>
            </div>
            <div class=" modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="btn-tambah" onclick="tambahdata()" class="btn btn-primary">Tambah</button>
                <button type="button" id="btn-ubah" onclick="ubahdata()" class="btn btn-primary">Ubah</button>
            </div>
        </div>
    </div>
</div>