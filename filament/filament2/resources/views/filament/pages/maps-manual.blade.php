<x-filament::page>
    <script src="https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js"></script>
    <div id="map"></div>
    
    <script>
        const googleMapsApiKey = "{{config('filament-google-maps.key')}}";
        const pins = @json($pins);

        console.log(pins);


        let map;

        async function initMap() {
        const { Map, InfoWindow } = await google.maps.importLibrary("maps");
        const  {AdvancedMarkerElement, Marker, PinElement}  = await google.maps.importLibrary("marker");

        const markers = [];
        // Personalizar Pin
        // https://developers.google.com/maps/documentation/javascript/reference/advanced-markers?hl=es-419#PinElementOptions
        // const pinElement = new PinElement({
        //   background: "#00FF00",
        // });
        // const pinElement = new PinElement();

        // https://developers.google.com/maps/documentation/javascript/advanced-markers/html-markers?hl=es-419#maps_advanced_markers_html_simple-javascript
        const pin = document.createElement("div");
        pin.className = "marcador";
        pin.textContent = "HOLI";

        
        map = new Map(document.getElementById("map"), {
            center: { lat: 41, lng: 2 },
            zoom: 8,
            mapId: "mimapa_id",
        });
        // Recorrer pins
        // let data = await getData();

        for (let item of pins){
            let marker = new AdvancedMarkerElement({
            map: map,
            position: {lat:item.latitud, lng:item.longitud}//,
            //content: pin
            // title:item.title
            });

            //marker.element.style.zIndex = 1;

            markers.push(marker);

            let ariaLabel = ` ${item.nombre} `;
            let contentString = `<div><p style='font-size:20px; position:absolute; margin-top:-35px; font-weight:bold'>TITULO</p><button style='background-color:red' onclick='console.log("holi")'>HOLIWI</button><b>${item.nombre}</b><br><p>descripción muy larga ble ble ble</p><br><p>Valor de otro campo.</p></div>`;

            let infowindow = new InfoWindow({
            content: contentString,
            ariaLabel: ariaLabel,
            });

            marker.addListener("click", () => {
            infowindow.open({
                anchor: marker,
                map,
            });
            });
        }

        // Add a marker clusterer to manage the markers.
        new markerClusterer.MarkerClusterer({ markers, map });

        centrarMapa();
        }

        async function getData(){
        const response = await fetch('data.json');
        const data = await response.json();
        return data;
        }

        function centrarMapa(){
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
            (position) => {
                const pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude,
                };
                map.setCenter(pos);
            },
            () => {
                // handleLocationError(true, infoWindow, map.getCenter());
            }
            );
        } else {
            // Browser doesn't support Geolocation
            // handleLocationError(false, infoWindow, map.getCenter());
        }
        }

        // (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})
        //         ({key: googleMapsApiKey, v: "weekly"});

        (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({
            key: googleMapsApiKey,
            // Add other bootstrap parameters as needed, using camel case.
            // Use the 'v' parameter to indicate the version to load (alpha, beta, weekly, etc.)
        });

        initMap();

    </script>

    <style>
        #map {
            height: 500px;
            width: 100%;
            /* background-color: aqua; */
        }

        .marcador {
            background-color: blue;
            colo
        }
    </style>
</x-filament::page>
