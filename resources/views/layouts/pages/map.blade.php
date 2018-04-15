<div id="map"></div>


@section("scripts")
<script>
    var map;
    function initMap() {
        var defaultLat = -34.5892671959861;
        var defaultLon = -58.43098330510253;
        var uluru = {lat: -25.363, lng: 131.044};
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 16,
             heading: 90,
             tilt: 45,
            center: {lat: defaultLat, lng: defaultLon},
            styles: [
                {
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "weight": "2.00"
                        }
                    ]
                },
                {
                    "elementType": "geometry.stroke",
                    "stylers": [
                        {
                            "color": "#9c9c9c"
                        }
                    ]
                },
                {
                    "elementType": "labels.text",
                    "stylers": [
                        {
                            "visibility": "on"
                        }
                    ]
                },
                {
                    "featureType": "landscape",
                    "stylers": [
                        {
                            "color": "#f2f2f2"
                        }
                    ]
                },
                {
                    "featureType": "landscape",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#ffffff"
                        }
                    ]
                },
                {
                    "featureType": "landscape.man_made",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#ffffff"
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "stylers": [
                        {
                            "saturation": -100
                        },
                        {
                            "lightness": 45
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#eeeeee"
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#7b7b7b"
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "labels.text.stroke",
                    "stylers": [
                        {
                            "color": "#ffffff"
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
                    "featureType": "road.highway",
                    "stylers": [
                        {
                            "visibility": "simplified"
                        }
                    ]
                },
                {
                    "featureType": "transit",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "stylers": [
                        {
                            "color": "#46bcec"
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
                            "color": "#c8d7d4"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#070707"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "labels.text.stroke",
                    "stylers": [
                        {
                            "color": "#ffffff"
                        }
                    ]
                }
            ]
        });
        map.setTilt(10);


        loadSites(map);

    }

    var infoWindows = [];
    var markers = [];




    function loadSites(map) {
        google.maps.event.addListener(map, 'click', function () {
            hideAllInfoWindows();
        });

        var oms = new OverlappingMarkerSpiderfier(map, {
            markersWontMove: true,
            markersWontHide: true,
            basicFormatEvents: true
        });


        var myoverlay = new google.maps.OverlayView();
        myoverlay.draw = function () {
            this.getPanes().markerLayer.id = 'markerLayer';
        };
        myoverlay.setMap(map);

        $.ajax({
            url: 'https://s3.amazonaws.com/meetworks/sites.json',
            data: {
                format: 'json'
            },
            error: function () {
                $('#info').html('<p>An error has occurred</p>');
            },
            dataType: 'json',
            success: function (data) {

                /*  var marker = new google.maps.Marker({
                 position: uluru,
                 map: map
                 });*/

                for (var i = 0; i < data.data.length; i++) {
                    var dataSite = data.data[i];

                    var contentString = '<div onclick="goToSpace('+dataSite.id+',\''+dataSite.name+'\')" class="container-popup-map"><img src="https://s3.amazonaws.com/meetworks/thumbnails/' + dataSite.id + '/' + dataSite.images[0].url + '"><div class="conainer-text-popup"><h3>' + dataSite.name + '</h3><p>' + dataSite.address + '</p></div></div>';

                    var infowindow = new google.maps.InfoWindow({
                        content: contentString
                    });


                    google.maps.event.addListener(infowindow, 'domready', function () {

                        // Reference to the DIV that wraps the bottom of infowindow
                        var iwOuter = $('.gm-style-iw');

                        /* Since this div is in a position prior to .gm-div style-iw.
                         * We use jQuery and create a iwBackground variable,
                         * and took advantage of the existing reference .gm-style-iw for the previous div with .prev().
                         */
                        var iwBackground = iwOuter.prev();

                        // Removes background shadow DIV
                        iwBackground.children(':nth-child(2)').css({'display': 'none'});

                        // Removes white background DIV
                        iwBackground.children(':nth-child(4)').css({'display': 'none'});

                        var iwCloseBtn = iwOuter.next();

                        // Apply the desired effect to the close button
                        iwCloseBtn.css({opacity: '1'});

                        // If the content of infowindow not exceed the set maximum height, then the gradient is removed.
                        if ($('.iw-content').height() < 140) {
                            $('.iw-bottom-gradient').css({display: 'none'});
                        }

                        // The API automatically applies 0.7 opacity to the button after the mouseout event. This function reverses this event to the desired value.
                        iwCloseBtn.mouseout(function () {
                            $(this).css({opacity: '1'});
                        });
                    });

                    var marker = new google.maps.Marker({
                        position: {lat: parseFloat(dataSite.lat), lng: parseFloat(dataSite.lon)},
                        map: map,
                        title: dataSite.name,
                        infowindow: infowindow,
                        icon: 'https://s3.amazonaws.com/meetworks/thumbnails/' + dataSite.id + '/logo/' + dataSite.logo.replace("full", "small")

                    });

                    markers.push(marker);

                    google.maps.event.addListener(marker, 'spider_click', function () {
                        hideAllInfoWindows(map);
                        this.infowindow.open(map, this);
                    });

                    oms.addMarker(marker);  // adds the marker to the spiderfier _and_ the map


                    
                    var site = '<div  class="col-12 col-md-6 place">';
                    site += '<div class="thumbnail">';
                    site += '<img src="https://s3.amazonaws.com/meetworks/thumbnails/' + dataSite.id + '/' + dataSite.images[0].url + '" alt="...">';
                    site += ' <div class="caption">';
                    site += '<h4>' + dataSite.name + '</h4>';
                    site += '<p>' + dataSite.address + '</p>';
                    site += '<div class="services">';
                    for (var s = 0; s < dataSite.services.length; s++) {
                        site += '<div class="service_label ">';
                        site += '<img src="https://s3.amazonaws.com/staticthigs/hot_desk.png" alt="icon">';
                        site += '<p>Puesto de trabajo</p>';
                        site += '</div> ';
                    }


                    site += '</div>';
                    site += '</div>';
                    site += '</div>';
                    site += '</div>';
                    $(".container-places").append(site);
                }

            },
            type: 'GET'
        });


    }

function goToSpace(id,name){
 window.location=""+id+"/"+slugify(name);
}

function slugify(text)
{
  return text.toString().toLowerCase()
    .replace(/\s+/g, '-')           // Replace spaces with -
    .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
    .replace(/\-\-+/g, '-')         // Replace multiple - with single -
    .replace(/^-+/, '')             // Trim - from start of text
    .replace(/-+$/, '');            // Trim - from end of text
}

    function hideAllInfoWindows(map) {
        markers.forEach(function (marker) {
            marker.infowindow.close(map, marker);
        });
    }

</script>

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBLHQyGfUbvl5o5zHoZ0FUy_lwRGGgdpSg&callback=initMap">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OverlappingMarkerSpiderfier/1.0.3/oms.min.js"></script>


@stop