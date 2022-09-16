<x-app-layout title="Saran">
    <div class="row">
        <div class="col-md-6">
            <h4 class="fw-bold">Saran</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                
                <div class="content table-responsive table-full-width">
                    <table class="table table-hover">
                        <thead>
                            <th class="text-center text-success fw-bold">No</th>
                            <th class="text-center text-success fw-bold">Nama</th>
                            <th class="text-center text-success fw-bold">Saran</th>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($sarans as $saran)  
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$saran->user_name}}</td>
                                    <td>{{$saran->saran}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>


    </div>
    <script>
    var table = $('.table').DataTable({});
    </script>
</x-app-layout>