<x-app-layout title="Saran">
    @php
        function rupiah($angka){
	
            $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
            return $hasil_rupiah;
        
        }
    @endphp
    <style>
        /*
        CSS for the main interaction
        */
        .tabset > input[type="radio"] {
            position: absolute;
            left: -200vw;
        }

        /* .tab-panels  {
            width: 75vw !important;
        } */

        .tabset .tab-panel {
         display: none;
        }

        .tabset > input:first-child:checked ~ .tab-panels > .tab-panel:first-child,
        .tabset > input:nth-child(3):checked ~ .tab-panels > .tab-panel:nth-child(2),
        .tabset > input:nth-child(5):checked ~ .tab-panels > .tab-panel:nth-child(3),
        .tabset > input:nth-child(7):checked ~ .tab-panels > .tab-panel:nth-child(4),
        .tabset > input:nth-child(9):checked ~ .tab-panels > .tab-panel:nth-child(5),
        .tabset > input:nth-child(11):checked ~ .tab-panels > .tab-panel:nth-child(6) {
        display: block;
        }


        .tabset > label {
        position: relative;
        display: inline-block;
        padding: 15px 15px 25px;
        border: 1px solid transparent;
        border-bottom: 0;
        cursor: pointer;
        font-weight: 600;
        }

        .tabset > label::after {
        content: "";
        position: absolute;
        left: 15px;
        bottom: 10px;
        width: 22px;
        height: 4px;
        background: #8d8d8d;
        }

        .tabset > label:hover,
        .tabset > input:focus + label {
        color: #50A365;
        }

        .tabset > label:hover::after,
        .tabset > input:focus + label::after,
        .tabset > input:checked + label::after {
        background: #50A365;
        }

        .tabset > input:checked + label {
        border-color: #ccc;
        border-bottom: 1px solid #fff;
        margin-bottom: -1px;
        }

        .tab-panel {
        padding: 30px 5px;
        width: 100%;
        }

        .tabset {
        max-width: 65em;
        }

            .select2.select2-container.select2-container--default.select2-container--below.select2-container--focus {
                width: 100%;
            }

            .select2-container--default {
                width: 100% !important;
            }

        .dataTables_wrapper .row{
            overflow-x: auto !important;
            /* max-width: 100%; */
        }
        
    </style>

    <div class="row">
        <div class="col-md-6">
            <h4 class="fw-bold">Laporan</h4>
        </div>
        
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="d-flex">
                <div style="margin-top: 3px">
                    Tahun 
                </div>
                <div style="margin-left: 7px">
                    <select class="select-tahun js-example-basic-single " name="tahun" id="select-tahun" style="width: 120px">
                        @foreach ($years as $year)
                            <option value="{{$year}}" {{$selectedYear == $year ? 'selected' : ''}}>{{$year}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-6 text-right">
            <button class="btn btn-success btn-create">Tambah</button>
        </div>
    </div>
    <div class="row" style="margin-top: 10px">
        <div class="col-md-12">
            
            <div class="card">
                <div class="tabset">
                    <!-- Tab 1 -->
                    <input type="radio" name="tabset" id="tab1" aria-controls="buah" checked>
                    <label for="tab1">Buah</label>
                    <!-- Tab 2 -->
                    <input type="radio" name="tabset" id="tab2" aria-controls="sayur">
                    <label for="tab2">Sayur</label>
                    <!-- Tab 3 -->
                    <input type="radio" name="tabset" id="tab3" aria-controls="biofarmaka">
                    <label for="tab3">Biofarmaka</label>
                    <!-- Tab 3 -->
                    <input type="radio" name="tabset" id="tab4" aria-controls="verifikasi">
                    <label for="tab4">Verifikasi</label>
                    
                    <div class="tab-panels">
                        <section id="buah" class="tab-panel">
                            <div class="content">
                                <table class="table table-buah table-hover table-responsive">
                                    <thead>
                                        <th class="text-center text-success fw-bold">No</th>
                                        <th class="text-center text-success fw-bold">Nama Komoditas</th>
                                        <th class="text-center text-success fw-bold">Luas Tanam</th>
                                        <th class="text-center text-success fw-bold">Tanam Hasil</th>
                                        <th class="text-center text-success fw-bold">Produksi</th>
                                        <th class="text-center text-success fw-bold">Provitas</th>
                                        <th class="text-center text-success fw-bold">Harga Produsen</th>
                                        <th class="text-center text-success fw-bold">Harga Grosir</th>
                                        <th class="text-center text-success fw-bold">Harga Eceran</th>
                                        <th class="text-center text-success fw-bold">Aksi</th>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($fruits as $fruit)
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>{{$fruit->comodity->name}}</td>
                                                <td>{{$fruit->luas_tanam}}</td>
                                                <td>{{$fruit->tanam_hasil}}</td>
                                                <td>{{$fruit->jumlah_produksi}}</td>
                                                <td>{{$fruit->provitas}}</td>
                                                <td>{{$fruit->harga_produsen ? rupiah($fruit->harga_produsen) : 0}}</td>
                                                <td>{{$fruit->harga_grosir ? rupiah($fruit->harga_grosir) : 0}}</td>
                                                <td>{{$fruit->harga_eceran ? rupiah($fruit->harga_eceran) : 0}}</td>
                                                <td class="text-nowrap">
                                                    <a href="#" data-id="{{$fruit->id}}" data-link="{{route('laporan.update', $fruit->id)}}" style="text-decoration: none; color: green" class="btn-edit">Edit</a>
                                                    <a href="#" data-link="{{route('laporan.destroy', $fruit->id)}}" class="btn-delete" style="text-decoration: none; color: rgba(0, 0, 0, 0.625);">Hapus</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </section>
                        <section id="sayur" class="tab-panel">
                            <div class="content">
                                <table class="table table-sayur table-hover">
                                    <thead>
                                        <th class="text-center text-success fw-bold">No</th>
                                        <th class="text-center text-success fw-bold">Nama Komoditas</th>
                                        <th class="text-center text-success fw-bold">Luas Tanam</th>
                                        <th class="text-center text-success fw-bold">Tanam Hasil</th>
                                        <th class="text-center text-success fw-bold">Produksi</th>
                                        <th class="text-center text-success fw-bold">Provitas</th>
                                        <th class="text-center text-success fw-bold">Harga Produsen</th>
                                        <th class="text-center text-success fw-bold">Harga Grosir</th>
                                        <th class="text-center text-success fw-bold">Harga Eceran</th>
                                        <th class="text-center text-success fw-bold">Aksi</th>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($vegetables as $vegetable)
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>{{$vegetable->comodity->name}}</td>
                                                <td>{{$vegetable->luas_tanam}}</td>
                                                <td>{{$vegetable->tanam_hasil}}</td>
                                                <td>{{$vegetable->jumlah_produksi}}</td>
                                                <td>{{$vegetable->provitas}}</td>
                                                <td>{{$vegetable->harga_produsen ? rupiah($vegetable->harga_produsen) : 0}}</td>
                                                <td>{{$vegetable->harga_grosir ? rupiah($vegetable->harga_grosir) : 0}}</td>
                                                <td>{{$vegetable->harga_eceran ? rupiah($vegetable->harga_eceran) : 0}}</td>
                                                <td class="text-nowrap">
                                                    <a href="#" data-id="{{$vegetable->id}}" data-link="{{route('laporan.update', $vegetable->id)}}" class="btn-edit"  style="text-decoration: none; color: green">Edit</a>
                                                    <a href="#" data-link="{{route('laporan.destroy', $vegetable->id)}}" class="btn-delete" style="text-decoration: none; color: rgba(0, 0, 0, 0.625);">Hapus</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </section>
                        <section id="biofarmaka" class="tab-panel">
                            <div class="content">
                                <table class="table table-biofarmaka table-hover">
                                    <thead>
                                        <th class="text-center text-success fw-bold">No</th>
                                        <th class="text-center text-success fw-bold">Nama Komoditas</th>
                                        <th class="text-center text-success fw-bold">Luas Tanam</th>
                                        <th class="text-center text-success fw-bold">Tanam Hasil</th>
                                        <th class="text-center text-success fw-bold">Produksi</th>
                                        <th class="text-center text-success fw-bold">Provitas</th>
                                        <th class="text-center text-success fw-bold">Harga Produsen</th>
                                        <th class="text-center text-success fw-bold">Harga Grosir</th>
                                        <th class="text-center text-success fw-bold">Harga Eceran</th>
                                        <th class="text-center text-success fw-bold">Aksi</th>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($biopharmaceuticals as $biopharmaceutical)
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>{{$biopharmaceuticals->comodity->name}}</td>
                                                <td>{{$biopharmaceuticals->luas_tanam}}</td>
                                                <td>{{$biopharmaceuticals->tanam_hasil}}</td>
                                                <td>{{$biopharmaceuticals->jumlah_produksi}}</td>
                                                <td>{{$biopharmaceuticals->provitas}}</td>
                                                <td>{{$biopharmaceuticals->harga_produsen ? rupiah($biopharmaceuticals->harga_produsen) : 0}}</td>
                                                <td>{{$biopharmaceuticals->harga_grosir ? rupiah($biopharmaceuticals->harga_grosir) : 0}}</td>
                                                <td>{{$biopharmaceuticals->harga_eceran ? rupiah($biopharmaceuticals->harga_eceran) : 0}}</td>
                                                <td class="text-nowrap">
                                                    <a href="#" data-id="{{$biopharmaceuticals->id}}" data-link="{{route('laporan.update', $biopharmaceuticals->id)}}" class="btn-edit" style="text-decoration: none; color: green">Edit</a>
                                                    <a href="#" data-link="{{route('laporan.destroy', $biopharmaceuticals->id)}}" class="btn-delete" style="text-decoration: none; color: rgba(0, 0, 0, 0.625);">Hapus</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </section>
                        <section id="verifikasi" class="tab-panel">
                            <div class="content">
                                <table class="table table-verifikasi table-hover">
                                    <thead>
                                        <th class="text-center text-success fw-bold">No</th>
                                        <th class="text-center text-success fw-bold">Nama Komoditas</th>
                                        <th class="text-center text-success fw-bold">Luas Tanam</th>
                                        <th class="text-center text-success fw-bold">Tanam Hasil</th>
                                        <th class="text-center text-success fw-bold">Produksi</th>
                                        <th class="text-center text-success fw-bold">Provitas</th>
                                        <th class="text-center text-success fw-bold">Harga Produsen</th>
                                        <th class="text-center text-success fw-bold">Harga Grosir</th>
                                        <th class="text-center text-success fw-bold">Harga Eceran</th>
                                        <th class="text-center text-success fw-bold">Aksi</th>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($not_verifieds as $not_verified)
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>{{$not_verified->comodity->name}}</td>
                                                <td>{{$not_verified->luas_tanam}}</td>
                                                <td>{{$not_verified->tanam_hasil}}</td>
                                                <td>{{$not_verified->jumlah_produksi}}</td>
                                                <td>{{$not_verified->provitas}}</td>
                                                <td>{{$not_verified->harga_produsen ? rupiah($not_verified->harga_produsen) : 0}}</td>
                                                <td>{{$not_verified->harga_grosir ? rupiah($not_verified->harga_grosir) : 0}}</td>
                                                <td>{{$not_verified->harga_eceran ? rupiah($not_verified->harga_eceran) : 0}}</td>
                                                <td><a href="javascript::void(0)" data-link="{{route('verify-laporan',$not_verified->id)}}" class="btn btn-success btn-verify">Verifikasi</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </section>
                    </div>
                    
                </div>
                  
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" role="dialog" id="create-modal">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title font-weight-bold">Tambah Laporan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            
            <form action="{{route('laporan.store')}}" method="POST">
                @csrf
                <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Desa <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <select type="text" class="select-desa form-control" id="desa-id" required name="desa">
                                    <option value="">--Pilih Desa--</option>
                                    @foreach ($villages as $village)
                                        <option value="{{$village->id}}">{{$village->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Nama Komoditas <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <select type="text" class="select-komoditas form-control" id="komoditas-id " required name="komoditas">
                                    <option value="">--Pilih Komoditas--</option>
                                    @foreach ($comodities as $comoditie)
                                        <option value="{{$comoditie->id}}">{{$comoditie->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Luas Tanam <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" placeholder="Masukkan luas tanam" required name="luas_tanam">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Tanam Hasil <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" placeholder="Masukkan tanam hasil" required name="tanam_hasil">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Produksi <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" placeholder="Masukkan jumlah produksi" required name="produksi">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Provitas <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" placeholder="Masukkan provitas" required name="provitas">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Harga Produsen <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" id="harga-produsen" class="form-control" placeholder="Masukkan harga produsen" required name="harga_produsen">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Harga Grosir <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" id="harga-grosir" class="form-control" placeholder="Masukkan harga grosir" required name="harga_grosir">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Harga Eceran <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" id="harga-eceran" class="form-control" placeholder="Masukkan harga eceran" required name="harga_eceran">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                </div>
            
            </form>
          </div>
        </div>
      </div>
      <div class="modal" tabindex="-1" role="dialog" id="edit-modal">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title font-weight-bold">Edit Laporan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            
            <form id="edit-form" method="POST">
                @method('PUT')
                @csrf
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Desa <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <select type="text" class="form-control select-desa-edit form-control" id="desa-id-edit" required name="desa">
                                <option value="">--Pilih Desa--</option>
                                
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Nama Komoditas <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <select type="text" class="form-control select-komoditas-edit form-control" id="komoditas-id-edit" required name="komoditas">
                                <option value="">--Pilih Komoditas--</option>
                                
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Luas Tanam <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="luas-tanam-edit" placeholder="Masukkan luas tanam" required name="luas_tanam">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Tanam Hasil <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="tanam-hasil-edit" placeholder="Masukkan tanam hasil" required name="tanam_hasil">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Produksi <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="jumlah-produksi-edit" placeholder="Masukkan jumlah produksi" required name="produksi">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Provitas <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="provitas-edit" placeholder="Masukkan provitas" required name="provitas">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Harga Produsen <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="harga-produsen-edit" placeholder="Masukkan harga produsen" required name="harga_produsen">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Harga Grosir <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="harga-grosir-edit" placeholder="Masukkan harga grosir" required name="harga_grosir">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Harga Eceran <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="harga-eceran-edit" placeholder="Masukkan harga eceran" required name="harga_eceran">
                        </div>
                    </div>
            </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-success">Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                </div>
            
            </form>
          </div>
        </div>
      </div>
      <div class="modal" tabindex="-1" role="dialog" id="delete-modal">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title font-weight-bold">Hapus Laporan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            
            <form method="POST" id="delete-form">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>Tindakan ini akan menghapus data tersebut dan data yang dihapus tidak dapat di kembalikan, apakah Anda yakin ingin melanjutkan?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Ya, saya yakin</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                </div>
            </form>
          </div>
        </div>
      </div>
      <div class="modal" tabindex="-1" role="dialog" id="verify-modal">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title font-weight-bold">Verifikasi Laporan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            
            <div class="modal-body">
                <p>Silahkan melakukan verifikasi laporan</p>
                <div class="row text-center">
                    <a class="btn btn-success btn-terima">Terima</a>
                    <a class="btn btn-danger btn-tolak">Tolak</a>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
            </div>
          </div>
        </div>
      </div>
    <script>
        var tableBuah = $('.table-buah').DataTable({responsive: true});
        var tableSayur = $('.table-sayur').DataTable({responsive: true});
        var tableSayur = $('.table-biofarmaka').DataTable({responsive: true});
        var tableVerifikasi = $('.table-verifikasi').DataTable({responsive: true});

        $(".btn-create").on("click", function()
        {
            $("#create-modal").modal('show');
        });

        $(".btn-delete").on("click", function()
        {
            $("#delete-form").attr("action", $(this).data("link"));
            $("#delete-modal").modal('show');
        });

        $(".btn-verify").on("click", function()
        {
            var linkTerima = $(this).data("link")+"?status=terima";
            var linkTolak = $(this).data("link")+"?status=tolak";
            $(".btn-terima").attr("href", linkTerima);
            $(".btn-tolak").attr("href", linkTolak);
            $("#verify-modal").modal('show');
        });

        $(".btn-edit").on("click", function()
        {
            var id = $(this).data('id');
            $("#edit-form").trigger("reset");

            $.ajax({
                method: "GET",
                data: {
                    id : id
                },
                url: "{{ route('laporan.get-detail-laporan') }}"
                }).done(function(response)
                {
                    console.log(response);
                    $("#tanam-hasil-edit").val(response.laporan.tanam_hasil);
                    $("#luas-tanam-edit").val(response.laporan.luas_tanam);
                    $("#jumlah-produksi-edit").val(response.laporan.jumlah_produksi);
                    $("#provitas-edit").val(response.laporan.provitas);
                    $("#harga-produsen-edit").val(formatRupiah(response.laporan.harga_produsen));
                    $("#harga-grosir-edit").val(formatRupiah(response.laporan.harga_grosir));
                    $("#harga-eceran-edit").val(formatRupiah(response.laporan.harga_eceran));
                    // console.log(response.account_code_kas);
                    $.each(response.comodities,function(key, value)
                    {
                        var data = value.name;
                        var option = new Option(data,value.id);
                        if(response.laporan.comodity_id == value.id){
                            option.selected = true;
                        }
                        
                        $("#komoditas-id-edit").append(option).trigger('change')
                    });
                    
                    $.each(response.villages,function(key, value)
                    {
                        var data = value.name;
                        var option = new Option(data,value.id);
                        
                        if(response.laporan.desa_id == value.id){
                            option.selected = true;
                        } 
                        $("#desa-id-edit").append(option).trigger('change')
                    });
                });
                
            $("#edit-form").attr("action", $(this).data("link"));
            $("#edit-modal").modal('show');
        });

        $(document).ready(function() {
            $('.select-desa').select2({
                dropdownParent: $('#create-modal')
            });
            $('.select-komoditas').select2({
                dropdownParent: $('#create-modal')
            });
            $('.select-desa-edit').select2({
                dropdownParent: $('#edit-modal')
            });
            $('.select-komoditas-edit').select2({
                dropdownParent: $('#edit-modal')
            });
        });

        $("#harga-produsen").on("input", function()
        {
            $(this).val(formatRupiah($(this).val(), ''))
        });
        $("#harga-grosir").on("input", function()
        {
            $(this).val(formatRupiah($(this).val(), ''))
        });
        $("#harga-eceran").on("input", function()
        {
            $(this).val(formatRupiah($(this).val(), ''))
        });

        $("#harga-produsen-edit").on("input", function()
        {
            $(this).val(formatRupiah($(this).val(), ''))
        });
        $("#harga-grosir-edit").on("input", function()
        {
            $(this).val(formatRupiah($(this).val(), ''))
        });
        $("#harga-eceran-edit").on("input", function()
        {
            $(this).val(formatRupiah($(this).val(), ''))
        });

        /* Fungsi formatRupiah */
        function formatRupiah(angka, prefix){
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split   		= number_string.split(','),
            sisa     		= split[0].length % 3,
            rupiah     		= split[0].substr(0, sisa),
            ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if(ribuan){
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
        }
        
        $("#select-tahun" ).change(function() {
            var tahun = $(this).val();
            window.location = "{{route('laporan.index')}}?select_year="+tahun;
        });
    </script>
</x-app-layout>