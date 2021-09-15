let map;
let markers;
let infowindow;

function mapInitialize() {
    let mapOptions = {
        zoom: 15,
        minZoom: 3,
        maxZoom: 20,
        disableDefaultUI: true,
        scrollwheel: true,
        draggable: true,
        gestureHandling: 'cooperative',
        zoomControl: true,
        styles: [
            {
                "featureType": "administrative",
                "elementType": "labels.text",
                "stylers": [
                    {
                        "visibility": "on"
                    },
                    {
                        "color": "#8e8e8e"
                    }
                ]
            },
            {
                "featureType": "administrative",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "color": "#7f7f7f"
                    }
                ]
            },
            {
                "featureType": "administrative",
                "elementType": "labels.text.stroke",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "administrative.province",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "visibility": "on"
                    },
                    {
                        "weight": "0.69"
                    }
                ]
            },
            {
                "featureType": "administrative.locality",
                "elementType": "geometry",
                "stylers": [
                    {
                        "visibility": "simplified"
                    }
                ]
            },
            {
                "featureType": "landscape",
                "elementType": "all",
                "stylers": [
                    {
                        "saturation": "0"
                    }
                ]
            },
            {
                "featureType": "landscape.man_made",
                "elementType": "all",
                "stylers": [
                    {
                        "color": "#f9e9ec"
                    }
                ]
            },
            {
                "featureType": "landscape.natural",
                "elementType": "all",
                "stylers": [
                    {
                        "color": "#f9e9ec"
                    }
                ]
            },
            {
                "featureType": "poi",
                "elementType": "all",
                "stylers": [
                    {
                        "color": "#fada8a"
                    },
                    {
                        "visibility": "on"
                    }
                ]
            },
            {
                "featureType": "poi.attraction",
                "elementType": "all",
                "stylers": [
                    {
                        "visibility": "on"
                    },
                    {
                        "saturation": "0"
                    }
                ]
            },
            {
                "featureType": "poi.attraction",
                "elementType": "labels",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "poi.business",
                "elementType": "all",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "poi.government",
                "elementType": "all",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "poi.medical",
                "elementType": "all",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "poi.park",
                "elementType": "all",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "poi.park",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#fada8a"
                    },
                    {
                        "visibility": "on"
                    }
                ]
            },
            {
                "featureType": "poi.park",
                "elementType": "labels",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "poi.place_of_worship",
                "elementType": "all",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "poi.school",
                "elementType": "all",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "poi.sports_complex",
                "elementType": "all",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "poi.sports_complex",
                "elementType": "labels",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "poi.sports_complex",
                "elementType": "labels.text",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "road",
                "elementType": "all",
                "stylers": [
                    {
                        "saturation": "-100"
                    },
                    {
                        "lightness": "50"
                    },
                    {
                        "gamma": "1"
                    }
                ]
            },
            {
                "featureType": "road",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#fcf7f8"
                    },
                    {
                        "saturation": "0"
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "all",
                "stylers": [
                    {
                        "visibility": "simplified"
                    },
                    {
                        "saturation": "0"
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#f2f2f2"
                    },
                    {
                        "saturation": "0"
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#fcf7f8"
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "labels",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "labels.text",
                "stylers": [
                    {
                        "visibility": "simplified"
                    }
                ]
            },
            {
                "featureType": "road.arterial",
                "elementType": "all",
                "stylers": [
                    {
                        "saturation": "0"
                    }
                ]
            },
            {
                "featureType": "road.arterial",
                "elementType": "labels.text",
                "stylers": [
                    {
                        "visibility": "simplified"
                    }
                ]
            },
            {
                "featureType": "road.arterial",
                "elementType": "labels.icon",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "road.local",
                "elementType": "all",
                "stylers": [
                    {
                        "visibility": "simplified"
                    }
                ]
            },
            {
                "featureType": "road.local",
                "elementType": "geometry",
                "stylers": [
                    {
                        "lightness": "0"
                    },
                    {
                        "gamma": "1"
                    },
                    {
                        "saturation": "0"
                    }
                ]
            },
            {
                "featureType": "road.local",
                "elementType": "labels.text",
                "stylers": [
                    {
                        "visibility": "simplified"
                    }
                ]
            },
            {
                "featureType": "transit",
                "elementType": "all",
                "stylers": [
                    {
                        "visibility": "on"
                    }
                ]
            },
            {
                "featureType": "transit",
                "elementType": "labels",
                "stylers": [
                    {
                        "hue": "#ff0000"
                    },
                    {
                        "saturation": "-100"
                    },
                    {
                        "visibility": "simplified"
                    }
                ]
            },
            {
                "featureType": "water",
                "elementType": "all",
                "stylers": [
                    {
                        "color": "#fcf7f8"
                    },
                    {
                        "visibility": "on"
                    }
                ]
            },
            {
                "featureType": "water",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "saturation": "0"
                    }
                ]
            },
            {
                "featureType": "water",
                "elementType": "labels",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "water",
                "elementType": "labels.text",
                "stylers": [
                    {
                        "visibility": "simplified"
                    }
                ]
            }
        ]
    };
    map = new google.maps.Map(document.getElementById('map'), mapOptions);
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            let center = new google.maps.LatLng(parseFloat(position.coords.latitude), parseFloat(position.coords.longitude));
            map.setCenter(center);
        });
    }
    infowindow = new google.maps.InfoWindow();
    getMarkers();
}

function getMarkers() {
    let markerData = [];
    markers = new Map();
    $.ajax({
        url: site_url + '/maps/getAllUsers',
        method: "POST",
        dataType: "JSON",
        success: function (result) {
            if (result !== null) {
                for (let m in result) {
                    markerData.push({
                        id: result[m].id,
                        full_name: result[m].full_name,
                        location: [result[m].latitude, result[m].longitude],
                        profile_img_url: site_url + '/assets/images/ic_launcher-playstore.png',
                        email: result[m].email,
                        phone: result[m].phone,
                        speed: result[m].speed,
                        update: result[m].timeFormat,

                    });
                }
                setMarkers(markerData);
            }
        }
    }).complete(function () {
        setTimeout(function () {
            clearMarkers();
            getMarkers();
        }, 300000);
    });
}

function clearMarkers() {
    for (let value of markers.values()) {
        value.setMap(null);
    }
}

function setMarkers(markerData) {
    let latlngbound = new google.maps.LatLngBounds();
    for (let k = 0; k < markerData.length; k++) {
        let contentString = '';
        let data = markerData[k];
        let myLatLng = new google.maps.LatLng(data.location[0], data.location[1]);
        let marker = new google.maps.Marker({
            id: data.id,
            position: myLatLng,
            map: map,
            title: data.full_name,
            icon: site_url + "/assets/images/marker.png"
        });
        marker.latitude = data.location[0];
        marker.longitude = data.location[1];

        /* info window content */
        contentString += '<div style="float:left"><img src="' + data.profile_img_url + '" height="140" width="140"></div>' +
            '<div style="float:right; padding: 10px;"><b>' + data.full_name + '</b><br/>' +
            '<b>Email address : </b>' + data.email + '<br/> ' +
            '<b>Phone number : </b>' + data.phone + '<br/>' +
            '<b>Speed : </b>' + data.speed + ' Km/hr <br/>' +
            '<b>Last updated : </b>' + data.update + '<br/>';
        contentString += '</div>';

        /* mouse hover event to show info window */
        marker.addListener('mouseover', function () {
            infowindow.setContent(contentString);
            infowindow.open(map, marker);
        });
        marker.addListener('click', function () {
            infowindow.setContent(contentString);
            infowindow.open(map, marker);
        });
        /* mouse oit event to hide info window */
        marker.addListener('mouseout', function () {
            infowindow.close();
        });

        /* Push marker to markers array*/
        markers.set(data.fleter_id, marker);
        latlngbound.extend(marker.position);
    }
    /*Center map and adjust Zoom based on the position of all markers.*/
    map.setCenter(latlngbound.getCenter());
    map.fitBounds(latlngbound);
}
