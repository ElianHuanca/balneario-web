var mapDiv = document.getElementById("map");
// const cor = { lat: -17.783290, lng: -63.182073};
let map;
//------------------------------------------------------------------------------
function initMap(latitud = -17.78329, longitud = -63.182073) {
    var variable = typeof coordenada;
    coordenadas =
        variable === "undefined" ? { lat: latitud, lng: longitud } : coordenada;
    generarMapa(coordenadas, 12, true);
    cargarInputs();
}

function setMap(latitud = -17.78329, longitud = -63.182073) {
    var variable = typeof coordenada;
    coordenadas =
        variable === "undefined" ? { lat: latitud, lng: longitud } : coordenada;
    generarMapa(coordenadas, 12, false);
}

//------------------------------------------------------------------------------
function generarMapa(coordenadas, zoom, desplazar) {
    var mapa = new google.maps.Map(mapDiv, {
        center: coordenadas,
        zoom: zoom,
    });

    marcador = new google.maps.Marker({
        map: mapa,
        draggable: desplazar,
        position: coordenadas,
    });
}
//------------------------------------------------------------------------------
function cargarInputs() {
    marcador.addListener("dragend", function (event) {
        document.getElementById("latitud").value = this.getPosition().lat();
        document.getElementById("longitud").value = this.getPosition().lng();
    });
}
