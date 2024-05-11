import config from "./config.mjs"
const googleMapsApiKey = config.googleMapsApiKey;

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

  
  map = new Map(document.getElementById("map"), {
    center: { lat: 41, lng: 2 },
    zoom: 8,
    mapId: "mimapa_id",
  });

  let data = await getData();

  for (let item of data){
    let marker = new AdvancedMarkerElement({
      map: map,
      // content: pinElement.element,
      position: {lat:item.latitud, lng:item.longitud},
      title:item.title
    });

    markers.push(marker);

    let contentString = `<h1>${item.title}</h1>`;

    let infowindow = new InfoWindow({
      content: contentString,
      ariaLabel: item.title,
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

  console.log(markers);
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