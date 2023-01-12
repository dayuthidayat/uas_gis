@include('layout.header')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">

                    <div id='map'></div>

                </div><!-- /.col -->
                <!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <script>
        const cities = L.layerGroup();

        const sade = L.marker([-8.839351, 116.292393]).bindPopup('Masjid Nur Syahada.').addTo(cities);
        const mGolden = L.marker([-8.843677, 116.283471]).bindPopup('Masjid Nurul Huda.').addTo(cities);

        const mbAttr = 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>';
        const mbUrl = 'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';

        const streets = L.tileLayer(mbUrl, {
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            attribution: mbAttr
        });

        const osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        });

        const map = L.map('map', {
            center: [-8.6880339,116.2519892],
            zoom: 14.1,
            layers: [osm, cities]
        });

        const baseLayers = {
            'OpenStreetMap': osm,
            'Streets': streets
        };

        const overlays = {
            'Masjid': cities,
        };

        const layerControl = L.control.layers(baseLayers, overlays).addTo(map);
        const crownHill = L.marker([-8.838253555441392, 116.28667949006866]).bindPopup('Rumah Saya');
        const rubyHill = L.marker([-8.834468700936664, 116.29302401207026]).bindPopup('SMKN 3 PUJUT');

        const Masjid = L.layerGroup([crownHill, rubyHill]);

        const satellite = L.tileLayer(mbUrl, {
            id: 'mapbox/satellite-v9',
            tileSize: 512,
            zoomOffset: -1,
            attribution: mbAttr
        });
        layerControl.addBaseLayer(satellite, 'Satellite');
        layerControl.addOverlay(Masjid, 'Umum');
        var desa = {
            'color': "red",
            'weight': 1,
            'opacity': 0.5
        }

        function popUp(f,l){
    var out = [];
    if (f.properties){
        for(key in f.properties){
            out.push(key+": "+f.properties[key]);
        }
        l.bindPopup(out.join("<br />"));
    }
}

        L.geoJSON([renteng], {
            style: desa
        }).addTo(map);

        L.geoJSON([],{onEachFeature:popUp,}).addTo(map);
    </script>
    @include('layout.footer')