<div id="univModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelheader"></h4>
            </div>
            <form id="ItemForm" name="ItemForm" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nama Project :</label>
                        <input type="text" name="project_name" class="form-control" id="project_name"
                            placeholder="Isi disini.." required>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Alamat :</label>
                        <textarea class="form-control" name="address" id="address" cols="30" rows="4" placeholder="Masukan di sini ... !" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Daerah :</label>
                        <select class="form-control" name="id_daerah" id="id_daerah">
                            <option value="" disabled selected>-- Pilih --</option>
                            @foreach ($daerah as $d)
                                <option value="{{$d->id}}">{{$d->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Penanggung jawab :</label>
                        <select class="form-control" name="id_user" id="id_user">
                            <option value="" disabled selected>-- Pilih --</option>
                            @foreach ($user as $d)
                                <option value="{{$d->id}}">{{$d->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="batal" class="btn btn-danger" data-dismiss="modal">BATAL</button>
                    <button type="submit" id="simpan" class="btn btn-primary">SIMPAN</button>
                </div>
            </form>
        </div>
    </div>
</div>