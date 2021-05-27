<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Draw GeoJSON points</title>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no" />
    <script src="https://unpkg.com/maplibre-gl@1.14.0/dist/maplibre-gl.js"></script>
    <link href="https://unpkg.com/maplibre-gl@1.14.0/dist/maplibre-gl.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js" integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og==" crossorigin=""></script>
    <style>
        body {
            margin: 0;
        }

        #map {
            height: 70vh;
        }
        .blue_marker {
            background-image: url('./img/blue_marker.png');
            background-size: 100% 100%;
            width: 50px;
            height: 50px;
            cursor: pointer;
        }

        .green_marker {
            background-image: url('./img/green_marker.png');
            background-size: 100% 100%;
            width: 50px;
            height: 50px;
            cursor: pointer;
        }

        .pink_marker {
            background-image: url('./img/pink_marker.png');
            background-size: 100% 100%;
            width: 50px;
            height: 50px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div id="map"></div>
    

    <script>
        var user_id='<?PHP echo $_GET['id']?>';
        
        mapStyle = {
            "version": 8,
            "name": "Blank",
            "center": [0, 0],
            "zoom": 0,
            "sources": {
                "raster-tiles": {
                    "type": "raster",
                    "tiles": [
                        "https://a.tile.openstreetmap.org/{z}/{x}/{y}.png",
                        "https://b.tile.openstreetmap.org/{z}/{x}/{y}.png",
                        "https://c.tile.openstreetmap.org/{z}/{x}/{y}.png"
                    ],
                    "tileSize": 256,
                    "minzoom": 0,
                    "maxzoom": 19
                }
            },
            "sprite": "https://open-indoor.github.io/sprite/sprite",
            "glyphs": "https://app.openindoor.io/fonts/{fontstack}/{range}.pbf",
            "layers": [
                {
                    "id": "background",
                    "type": "background",
                    "paint": {
                        "background-color": "#e0dfdf"
                    }
                },
                {
                    "id": "simple-tiles",
                    "type": "raster",
                    "source": "raster-tiles"
                }
            ],
            "id": "blank"
        }
        
        let map = new maplibregl.Map({
            'container': 'map',
            'center': [2.3596569, 48.8765734],
            'pitch': 60,
            'bearing': -60,
            'zoom': 16,
            'style': mapStyle
        });

        let xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = () => {
        // La transaction est terminée ?
            if(xmlhttp.readyState == 4){
            // Si la transaction est un succès
                if(xmlhttp.status == 200){
                // On traite les données reçues
                let donnees = JSON.parse(xmlhttp.responseText)

                
                
                // On boucle sur les données (ES8)
                Object.entries(donnees.greports).forEach(greport => {
                    var popup = new maplibregl.Popup({ offset: 25 }).setText(
                        greport[1].nom
                    );
                    
                    var el = document.createElement('div');
                        if(greport[1].rep_stat == 'deleted'){
                            el.className = 'pink_marker';;
                        }
                        else if(greport[1].rep_stat == 'fixed'){
                            el.className = 'green_marker';
                        }
                        else{
                            el.className = 'blue_marker';
                        }
                    
                    if(user_id == greport[1].rep_userid){
                    var marker = new maplibregl.Marker(el)
                        .setLngLat([greport[1].lon, greport[1].lat])
                        .setPopup(popup)
                        .addTo(map);
                    }
                })
                }
                else{
                    console.log(xmlhttp.statusText);
                }
                
            }
        }

    xmlhttp.open("GET", "./includes/Maplibre/liste_reports/liste_simple.php");

    xmlhttp.send(null);
    
    </script>

</body>

</html>