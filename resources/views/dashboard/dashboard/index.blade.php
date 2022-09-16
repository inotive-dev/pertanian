<x-app-layout title="Dashboard">
    
    <style>
        /*
        CSS for the main interaction
        */
        .tabset > input[type="radio"] {
            position: absolute;
            left: -200vw;
        }

        .tab-panels  {
            width: 75vw !important;
        }

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
        padding: 30px 0;
        border-top: 1px solid #ccc;
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

        #chartActivity {
            max-width: 90%;
            /* overflow: hidden;
            overflow-x: scroll; */
        }

        span.ct-label.ct-vertical.ct-start {
            width: 50px !important;
        }
    </style>
    <div class="row">
        <div class="col-md-6">
            <h4 class="fw-bold">Dashboard</h4>
        </div>
    </div>
    <div class="row">
        
        <div class="card">
            <div class="tabset">
                <!-- Tab 1 -->
                <input {{$type == 'buah' ? 'checked' : ''}} type="radio" onclick="reloadWithType('buah')" name="tabset" id="tab1" aria-controls="buah" >
                <label for="tab1">Buah</label>
                <!-- Tab 2 -->
                <input {{$type == 'sayur' ? 'checked' : ''}} type="radio" onclick="reloadWithType('sayur')" name="tabset" id="tab2" aria-controls="sayur">
                <label for="tab2">Sayur</label>
                <!-- Tab 3 -->
                <input {{$type == 'biofarmaka' ? 'checked' : ''}} type="radio" onclick="reloadWithType('biofarmaka')" name="tabset" id="tab3" aria-controls="biofarmaka">
                <label for="tab3">Biofarmaka</label>
                <!-- Tab 3 -->
                
                <div class="tab-panels">
                    <section id="buah" class="tab-panel">
                        <div class="content row">
                            <div class="card-header col-sm-3">
                                <div class="form-group">
                                    <label for="">Wilayah</label>
                                    <select class="select-wilayah" name="wilayah" id="wilayah-buah">
                                        <option value="kecamatan" {{$wilayah=='kecamatan' ? 'selected' : ''}}>Kecamatan</option>
                                        <option value="desa" {{$wilayah=='desa' ? 'selected' : ''}}>Desa</option>
                                    </select>
                                </div>  
                                <div class="form-group">
                                    <label for="">Komoditas</label>
                                    <select class="select-komoditas" name="komoditas" id="komoditas-buah">
                                        @foreach ($comodities as $key => $comodity)
                                            @if ($comodityId == $comodity->id)
                                                <option selected value="{{$comodity->id}}">{{$comodity->name}}</option>
                                            @else
                                                <option value="{{$comodity->id}}">{{$comodity->name}}</option>    
                                            @endif
                                        @endforeach
                                    </select>
                                </div>  
                                <div class="form-group">
                                    <label for="">Kategory</label>
                                    <select class="select-kategori" name="kategori" id="kategori-buah">
                                        <option value="luas_tanam" {{$category=='luas_tanam' ? 'selected' : ''}}>Luas Tanam</option>
                                        <option value="tanam_hasil" {{$category=='tanam_hasil' ? 'selected' : ''}}>Tanam Hasil</option>
                                        <option value="jumlah_produksi" {{$category=='jumlah_produksi' ? 'selected' : ''}}>Produksi</option>
                                        <option value="provitas" {{$category=='provitas' ? 'selected' : ''}}>Provitas</option>
                                    </select>
                                </div>  
                            </div>
                            <div class="card-body col-sm-6">
                                <div id="chartPreferencesBuah" class="ct-chart ct-perfect-fourth"></div>
                            </div>
                            <div class="card-footer col-sm-3">
                                <div class="legend row">
                                    @foreach ($wilayahArray as $key => $wilayah)
                                        <div class="col-sm-6">
                                            <i class="fa fa-circle" style="color: {{$colorArray[$key]}}"></i> {{$wilayah}}
                                        </div>
                                    @endforeach
                                </div>
                                <hr>
                                <div class="stats">
                                    <i class="fa fa-clock-o"></i> Campaign sent 2 days ago
                                </div>
                            </div>
                        </div>
                    </section>
                    <section id="sayur" class="tab-panel">
                        <div class="content row">
                            <div class="card-header col-sm-3">
                                <div class="form-group">
                                    <label for="">Wilayah</label>
                                    <select class="select-wilayah" name="wilayah" id="wilayah-sayur">
                                        <option value="kecamatan" selected>Kecamatan</option>
                                        <option value="desa">Desa</option>
                                    </select>
                                </div>  
                                <div class="form-group">
                                    <label for="">Komoditas</label>
                                    <select class="select-komoditas" name="komoditas" id="komoditas-sayur">
                                        @foreach ($comodities as $key => $comodity)
                                            @if ($key == 0)
                                                <option selected value="{{$comodity->id}}">{{$comodity->name}}</option>
                                            @else
                                                <option value="{{$comodity->id}}">{{$comodity->name}}</option>    
                                            @endif
                                        @endforeach
                                    </select>
                                </div>  
                                <div class="form-group">
                                    <label for="">Kategory</label>
                                    <select class="select-kategori" name="kategori" id="kategori-sayur">
                                        <option value="luas_tanam" selected>Luas Tanam</option>
                                        <option value="tanam_hasil">Tanam Hasil</option>
                                        <option value="jumlah_produksi">Produksi</option>
                                        <option value="provitas">Provitas</option>
                                    </select>
                                </div>  
                            </div>
                            <div class="card-body col-sm-6">
                                <div id="chartPreferencesSayur" class="ct-chart ct-perfect-fourth"></div>
                            </div>
                            <div class="card-footer col-sm-3">
                                <div class="legend row">
                                    @foreach ($wilayahArray as $key => $wilayah)
                                        <div class="col-sm-6">
                                            <i class="fa fa-circle" style="color: {{$colorArray[$key]}}"></i> {{$wilayah}}
                                        </div>
                                    @endforeach
                                </div>
                                <hr>
                                <div class="stats">
                                    <i class="fa fa-clock-o"></i> Campaign sent 2 days ago
                                </div>
                            </div>
                        </div>
                    </section>
                    <section id="biofarmaka" class="tab-panel">
                        <div class="content row">
                            <div class="card-header col-sm-3">
                                <div class="form-group">
                                    <label for="">Wilayah</label>
                                    <select class="select-wilayah" name="wilayah" id="wilayah-biofarmaka">
                                        <option value="kecamatan" selected>Kecamatan</option>
                                        <option value="desa">Desa</option>
                                    </select>
                                </div>  
                                <div class="form-group">
                                    <label for="">Komoditas</label>
                                    <select class="select-komoditas" name="komoditas" id="komoditas-biofarmaka">
                                        @foreach ($comodities as $key => $comodity)
                                            @if ($key == 0)
                                                <option selected value="{{$comodity->id}}">{{$comodity->name}}</option>
                                            @else
                                                <option value="{{$comodity->id}}">{{$comodity->name}}</option>    
                                            @endif
                                        @endforeach
                                    </select>
                                </div>  
                                <div class="form-group">
                                    <label for="">Kategory</label>
                                    <select class="select-kategori" name="kategori" id="kategori-biofarmaka">
                                        <option value="luas_tanam" selected>Luas Tanam</option>
                                        <option value="tanam_hasil">Tanam Hasil</option>
                                        <option value="jumlah_produksi">Produksi</option>
                                        <option value="provitas">Provitas</option>
                                    </select>
                                </div>  
                            </div>
                            <div class="card-body col-sm-6">
                                <div id="chartPreferencesBiofarmaka" class="ct-chart ct-perfect-fourth"></div>
                            </div>
                            <div class="card-footer col-sm-3">
                                <div class="legend row">
                                    @foreach ($wilayahArray as $key => $wilayah)
                                        <div class="col-sm-6">
                                            <i class="fa fa-circle" style="color: {{$colorArray[$key]}}"></i> {{$wilayah}}
                                        </div>
                                    @endforeach
                                </div>
                                {{-- <hr> --}}
                                {{-- <div class="stats">
                                    <i class="fa fa-clock-o"></i> Campaign sent 2 days ago
                                </div> --}}
                            </div>
                        </div>
                    </section>
                </div>
                
            </div>
            <hr>
            <div class="legend row" style="padding: 3em">
                <div class="col-sm-2">
                    <i class="fa fa-circle text-info"></i> Harga Produsen
                </div>
                <div class="col-sm-2">
                    <i class="fa fa-circle text-danger"></i> Harga Grosir
                </div>
                <div class="col-sm-2">
                    <i class="fa fa-circle text-warning"></i> Harga Eceran
                </div>
                <div class="col-sm-6 text-right">
                    <select class="select-tahun" name="tahun" id="select-tahun">
                        <option value="2019" {{$year == '2019' ? 'selected' : ''}}>2019</option>
                        <option value="2020" {{$year == '2020' ? 'selected' : ''}}>2020</option>
                        <option value="2021" {{$year == '2021' ? 'selected' : ''}}>2021</option>
                        <option value="2022" {{$year == '2022' ? 'selected' : ''}}>2022</option>
                    </select>
                </div>
            </div>
            <div id="chartActivity" class="ct-chart ct-perfect-fourth" style="margin-left: 5em"></div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.select-wilayah').select2({});
            $('.select-komoditas').select2({});
            $('.select-kategori').select2({});
        });
    </script>
    <script type="text/javascript">
    	$(document).ready(function(){
            var wilayah = {!! json_encode($wilayahArray) !!};
            var sum = {!! json_encode($sumKategoryPerWilayah) !!};
            var color = {!! json_encode($colorArray) !!};
            var colorBarArray = {!! json_encode($colorBarArray) !!};
            var arrSumHargaProdusen = {!! json_encode($arrSumHargaProdusen) !!};
            var arrSumHargaGrosir = {!! json_encode($arrSumHargaGrosir) !!};
            var arrSumHargaEceran = {!! json_encode($arrSumHargaEceran) !!};
            var comodities = {!! json_encode($arrKomoditas) !!};

            console.log(wilayah,sum);
        	demo.initChartist(wilayah,sum,color,colorBarArray,arrSumHargaProdusen,arrSumHargaGrosir,arrSumHargaEceran,comodities);

    	});
	</script>
    <script>
        function reloadWithType(type)
        {
            window.location = "{{route('dashboard.index')}}?type="+type;
        }
        $("#select-tahun" ).change(function() {
            var tahun = $(this).val();
            window.location = "{{route('dashboard.index')}}?year="+tahun;
        });

        $("#wilayah-buah" ).change(function() {
            var type = "{{$type}}";
            var wilayah = $(this).val();
            var komoditasId = "{{$komoditasId}}";
            var category = "{{$category}}";
            window.location = "{{route('dashboard.index')}}?type="+type+"&wilayah="+wilayah+"&komoditasId="+komoditasId+"&category="+category;
        });

        $("#wilayah-sayur" ).change(function() {
            var type = "{{$type}}";
            var wilayah = $(this).val();
            var komoditasId = "{{$komoditasId}}";
            var category = "{{$category}}";
            window.location = "{{route('dashboard.index')}}?type="+type+"&wilayah="+wilayah+"&komoditasId="+komoditasId+"&category="+category;
        });

        $("#wilayah-biofarmaka" ).change(function() {
            var type = "{{$type}}";
            var wilayah = $(this).val();
            var komoditasId = "{{$komoditasId}}";
            var category = "{{$category}}";
            window.location = "{{route('dashboard.index')}}?type="+type+"&wilayah="+wilayah+"&komoditasId="+komoditasId+"&category="+category;
        });

        $("#komoditas-buah" ).change(function() {
            var type = "{{$type}}";
            var wilayah = "{{$wilayah}}";
            var komoditasId = $(this).val();
            var category = "{{$category}}";
            window.location = "{{route('dashboard.index')}}?type="+type+"&wilayah="+wilayah+"&komoditasId="+komoditasId+"&category="+category;
        });

        $("#komoditas-sayur" ).change(function() {
            var type = "{{$type}}";
            var wilayah = "{{$wilayah}}";
            var komoditasId = $(this).val();
            var category = "{{$category}}";
            window.location = "{{route('dashboard.index')}}?type="+type+"&wilayah="+wilayah+"&komoditasId="+komoditasId+"&category="+category;
        });

        $("#komoditas-biofarmaka" ).change(function() {
            var type = "{{$type}}";
            var wilayah = "{{$wilayah}}";
            var komoditasId = $(this).val();
            var category = "{{$category}}";
            window.location = "{{route('dashboard.index')}}?type="+type+"&wilayah="+wilayah+"&komoditasId="+komoditasId+"&category="+category;
        });

        $("#kategori-buah" ).change(function() {
            var type = "{{$type}}";
            var wilayah = "{{$wilayah}}";
            var komoditasId = "{{$komoditasId}}";
            var category = $(this).val();
            window.location = "{{route('dashboard.index')}}?type="+type+"&wilayah="+wilayah+"&komoditasId="+komoditasId+"&category="+category;
        });

        $("#kategori-sayur" ).change(function() {
            var type = "{{$type}}";
            var wilayah = "{{$wilayah}}";
            var komoditasId = "{{$komoditasId}}";
            var category = $(this).val();
            window.location = "{{route('dashboard.index')}}?type="+type+"&wilayah="+wilayah+"&komoditasId="+komoditasId+"&category="+category;
        });

        $("#kategori-biofarmaka" ).change(function() {
            var type = "{{$type}}";
            var wilayah = "{{$wilayah}}";
            var komoditasId = "{{$komoditasId}}";
            var category = $(this).val();
            window.location = "{{route('dashboard.index')}}?type="+type+"&wilayah="+wilayah+"&komoditasId="+komoditasId+"&category="+category;
        });
    </script>
</x-app-layout>
