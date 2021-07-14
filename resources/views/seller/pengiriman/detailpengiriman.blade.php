@extends('layouts.adminlte')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            Detail Pengiriman
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    ID Transaksi: <b><a href="{{route('merchant.transaksi.detail',$data->transaksi_idtransaksi)}}">TRX-{{$data->transaksi_idtransaksi}}</a></b>
                    <br>
                    Tanggal Pengiriman: <b>{{$data->tanggal_pengiriman}}</b>
                    <br>
                    Nomor Resi: <b> {{$data->nomor_resi}} </b>
                    <br>
                    Status Pengiriman: <b>{{$data->status_pengiriman}}</b>
                    <br>
                    Biaya pengiriman: <b> Rp. {{number_format($data->biaya_pengiriman)}} </b>
                    <br>
                    Keterangan Pengiriman: <b>{{$data->keterangan}}</b>
                    <br>
                    Tipe Pembayaran: <b>{{$data->tipepembayaran}}</b>
                    <br>
                    Status Kurir: <b> {{$data->status}}
                </div>
                <div class="col">

                    @if($data->status == "MenungguPengiriman")
                    <div class="form-group">
                        <label for="inputpengantar">Pilih Pengantar</label>
                        <select id="inputpengantar" class="form-control">
                            <option selected>Choose...</option>
                            @foreach ($dataPengantar as $key => $value)
                            <option value="{{$value->idpetugaspengantar}}">{{$value->nama}}.</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <button id="proseskurir" class="btn btn-success" style="margin-right: 5px;">
                        <i class="fas fa-edit"></i>Proses ke kurir
                    </button>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-footer">

        </div>
    </div>
    <div class="card">
        <div class="card-header">
            Google Maps Pengiriman
        </div>
        <div class="card-body">
            <div id="map" style="height:250px;width100%;">
            </div>
        </div>
        <div class="card-footer">

        </div>
    </div>
</div>

@section('js')


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k&callback=initMap&libraries=&v=weekly" async>
</script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

<script type="text/javascript">
    $(document).ready(function() {
        @if(session('berhasil'))
        //toastr.success('{{session('berhasil')}}');
        alert("{{session('berhasil')}}");
        @endif
        //http://localhost:8000/seller/pengiriman/status/1/ProsesKeKurir/nonAjax
        //alert("{{url('seller/pengiriman/status')}}/" + "{{$data->idpengiriman}}" + "/" + "ProsesKeKurir" + "/" + "nonAjax");
        /*
        var counter = 0;
        var timer = setInterval(function() {
            counter++;
            alert(counter);
            if (counter >= 10) {
                clearInterval(timer)
            }
        }, 3000);
        */
        initMap();
    });
    $("#proseskurir").click(function() {
        // windows.location = 
        window.location.href = "{{url('seller/pengiriman/status')}}/" + "{{$data->idpengiriman}}" + "/" + "ProsesKeKurir" + "/" + "nonAjax" + "/" + 1;
    });

    function initMap() {
        // const myLatLng = {
        //     lat: -25.363,
        //     lng: 131.044
        // };
        // const map = new google.maps.Map(document.getElementById("map"), {
        //     zoom: 4,
        //     center: myLatLng,
        // });
        // new google.maps.Marker({
        //     position: myLatLng,
        //     map,
        //     title: "Hello World!",
        // });

        //DARI SINI

        var myLatlng = new google.maps.LatLng("{{$data->latitude_user}}", "{{$data->longitude_user}}");
        var latlng = new google.maps.LatLng("{{$data->latitude_merchant}}", "{{$data->longitude_merchant}}");

        var mapOptions = {
            zoom: 15,
            center: myLatlng
        }
        var map = new google.maps.Map(document.getElementById("map"), mapOptions);
        var marker = new google.maps.Marker({
            position: myLatlng,
            title: "Hello World!",
            label: "Lokasi Pembeli"
        });

        // To add the marker to the map, call setMap();
        marker.setMap(map);

        var marker2 = new google.maps.Marker({
            position: latlng,
            title: "Hello World!",
            label: "Lokasi Penjual"
        });
        marker.setMap(map);
        marker2.setMap(map);

        //SAMPE SINI

        // let infoWindow = new google.maps.InfoWindow({
        //     content: "Sentuh Peta Untuk Memilih Lokasi",
        //     position: myLatlng,
        // });
        // infoWindow.open(map);
        // // Configure the click listener.
        // map.addListener("click", (mapsMouseEvent) => {
        //     // Close the current InfoWindow.
        //     infoWindow.close();
        //     // Create a new InfoWindow.
        //     infoWindow = new google.maps.InfoWindow({
        //         position: mapsMouseEvent.latLng,
        //     });
        //     infoWindow.setContent(
        //         JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)
        //     );
        //     infoWindow.open(map);
        // });

    }
</script>
@endsection

@endsection