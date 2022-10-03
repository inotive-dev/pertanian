<x-app-layout title="Manajemen User">
    <style>
        
        .form-group {
        margin-bottom: 1rem
        }
        .select2.select2-container.select2-container--default.select2-container--below.select2-container--focus {
            width: 100%;
        }

        .select2-container--default {
            width: 100% !important;
        }
    </style>
    <div class="row">
        <div class="col-md-6">
            <h4 class="fw-bold">Manajemen User</h4>
        </div>
        <div class="col-md-6 text-right">
            <button class="btn btn-success btn-create">Tambah</button>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                
                <div class="content table-responsive table-full-width p-2">
                    <table class="table table-hover">
                        <thead>
                            <th class="text-center text-success fw-bold">No</th>
                            <th class="text-center text-success fw-bold">Nama</th>
                            <th class="text-center text-success fw-bold">Email</th>
                            <th class="text-center text-success fw-bold">Kecamatan</th>
                            <th class="text-center text-success fw-bold">Aksi</th>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($users as $user)  
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->kecamatan->name}}</td>
                                    <td class="text-nowrap">
                                        <a style="text-decoration: none; color: green" href="javascript:void(0)" class="btn-edit" data-id="{{ $user->id }}" data-link="{{route('manajemen-user.update',$user->id)}}">
                                            <i data-feather="edit" class="align-middle"></i>
                                            <span class="fw-bold ms-1 align-middle">Edit</span>
                                        </a>
                                        <a style="text-decoration: none; color: rgba(0, 0, 0, 0.625); margin-top: 0.8em" href="javascript:void(0)" class=" btn-delete" data-id="{{ $user->id }}" data-link="{{route('manajemen-user.destroy',$user->id)}}">
                                            <span class="fw-bold ms-1 align-middle">Hapus</span>
                                        </a>
                                        {{-- <form method="POST" action="{{route('manajemen-user.destroy', $user->id)}}" id="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button  type="submit" onclick="return confirm('Apakah anda yakin untuk menghapus data user ini ?');"><i
                                                class="fas fa-trash-alt me-2"></i>Hapus</button>
                                        </form> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>


    </div>
    <div class="modal" tabindex="-1" role="dialog" id="create-modal">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title font-weight-bold">Tambah User</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            
            <form action="{{route('manajemen-user.store')}}" method="POST" autocomplete="off">
                @csrf
                <div class="modal-body">
                        <div class="form-group">
                            <label>Kecamatan <span class="text-danger">*</span></label>
                            <br>
                            <select type="text" class="form-control select-kecamatan" id="kecamatan-id" required name="kecamatan">
                                <option value="">--Pilih kecamatan--</option>
                                @foreach ($kecamatans as $kecamatan)
                                    <option value="{{$kecamatan->id}}">{{$kecamatan->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Hak Akses <span class="text-danger">*</span></label>
                            <select type="text" class="form-control" required name="role">
                                <option value="">--Pilih hak akses--</option>
                                @foreach ($roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Masukkan nama" required name="name">
                        </div>
                        <div class="form-group">
                            <label for="">Email <span class="text-danger">*</span></label>
                            <input name="email" type="email" onchange="emailCheck();" class="form-control" id="email" placeholder="Masukkan email" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password <span class="text-danger">*</span></label>
                            <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Masukkan password">
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
              <h4 class="modal-title font-weight-bold">Edit User</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            
            <form id="edit-form" method="POST" autocomplete="off">
                @method('PUT')
                @csrf
                <div class="modal-body">
                        <div class="form-group">
                            <label>Kecamatan <span class="text-danger">*</span></label>
                            <br>
                            <select type="text" class="form-control select-kecamatan-edit" id="kecamatan-edit" required name="kecamatan">
                                <option value="">--Pilih kecamatan--</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Hak Akses <span class="text-danger">*</span></label>
                            <select type="text" class="form-control" id="hak-akses-edit" required name="role">
                                <option value="">--Pilih hak akses--</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name-edit" placeholder="Masukkan nama" required name="name">
                        </div>
                        <div class="form-group">
                            <label>Email <span class="text-danger">*</span></label>
                            <input readonly name="email" onchange="emailEditCheck();" type="email" class="form-control" id="email-edit" aria-describedby="emailHelp" placeholder="Masukkan email" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input name="password" type="password" class="form-control" placeholder="Masukkan password">
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
              <h4 class="modal-title font-weight-bold">Hapus User</h4>
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
    <script>
        $(document).ready(function() {
            $('.select-kecamatan').select2({
                dropdownParent: $('#create-modal')
            });
            $('.select-kecamatan-edit').select2({
                dropdownParent: $('#edit-modal')
            });
            $('.select-komoditas-edit').select2({
                dropdownParent: $('#edit-modal')
            });
        });

        var table = $('.table').DataTable({});
        // create events
        $(".btn-create").on("click", function()
        {
            $("#create-modal").modal('show');
        });

        $(".btn-delete").on("click", function()
        {
            $("#delete-form").attr("action", $(this).data("link"));
            $("#delete-modal").modal('show');
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
                url: "{{ route('manajemen-user.get-detail-user') }}"
                }).done(function(response)
                {
                    console.log(response);
                    $("#email-edit").val(response.user.email);
                    $("#name-edit").val(response.user.name);
                    // console.log(response.account_code_kas);
                    $.each(response.kecamatans,function(key, value)
                    {
                        var data = value.name;
                        var option = new Option(data,value.id);
                        if(response.user.kecamatan_id == value.id){
                            option.selected = true;
                        }
                        
                        $("#kecamatan-edit").append(option)
                    });
                    
                    $.each(response.roles,function(key, value)
                    {
                        var data = value.name;
                        var option = new Option(data,value.id);
                        
                        if(response.user.user_role.role_id == value.id){
                            option.selected = true;
                        } 
                        $("#hak-akses-edit").append(option)
                    });
                });
                
            $("#edit-form").attr("action", $(this).data("link"));
            $("#edit-modal").modal('show');
        });

        function emailCheck()
        {
            var email = $("#email").val();
            $.ajax('/email-available-check', {
                type: 'GET',  // http method
                data: { email: email },  // data to submit
                success: function (data, status, xhr) {
                    if ( Object.keys(data).length > 0) {
                        alert('Email sudah digunakan');
                        $("#email").val('')
                    }
                }
            });
        };
        
        function emailEditCheck()
        {
            var email = $("#email-edit").val();
            $.ajax('/email-available-check', {
                type: 'GET',  // http method
                data: { email: email },  // data to submit
                success: function (data, status, xhr) {
                    if ( Object.keys(data).length > 0) {
                        console.log('masuk')
                        alert('Email sudah digunakan');
                        $("#email-edit").val('')
                    }
                }
            });
        };

    </script>
</x-app-layout>