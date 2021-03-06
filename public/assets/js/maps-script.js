var GoogleMaps = function() {

    var map;

    map = new GMaps({
        div: '#map',
        lat: -7.791615672503019,
        lng: 110.37277221679688,
        zoom: 12
    });

    map.addControl({
        position: 'top_right',
        content: 'Geolocate',
        style: {
            margin: '5px',
            padding: '1px 6px',
            border: 'solid 1px #717B87',
            background: '#fff'
        },
        events: {
            click: function(){
                GMaps.geolocate({
                    success: function(position){
                        map.addMarker({
                            lat: position.coords.latitude,
                            lng: position.coords.longitude,
                            title: 'location',
                            infoWindow: {
                                content: '<p>Your current location!</p>'
                            }
                        });
                    },
                    error: function(error){
                        alert('Geolocation failed: ' + error.message);
                    },
                    not_supported: function(){
                        alert("Your browser does not support geolocation");
                    }
                });
            }
        }
    });

    GMaps.on('click', map.map, function(event) {
        var index = map.markers.length;
        var lat = event.latLng.lat();
        var lng = event.latLng.lng();

        $('#latitude').val(lat);
        $('#longitude').val(lng);

        map.addMarker({
            lat: lat,
            lng: lng,
            title: 'Data ' + index
        });
    });

} ();