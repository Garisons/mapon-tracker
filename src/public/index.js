
function initMap() {
    const coord = initCoord;
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 7,
        center: initCoord,
    });
    const marker = new google.maps.Marker({
        position: initCoord,
        map: map,
    });

    // var latlng = new google.maps.LatLng(opt.lat, opt.lng);
    // const gMap = new google.maps.Map(map, {
    //     zoom: 5,
    //     center: latlng
    // });
}
