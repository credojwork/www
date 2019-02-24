var do_maps;
(function ($, g) {

    var geo = null;

    /* matches a valid lat/long value */
    function is_valid_latlng(address) {
        return address.match(/^([-+]?[1-8]?\d(\.\d+)?|90(\.0+)?),?\s*([-+]?180(\.0+)?|[-+]?((1[0-7]\d)|([1-9]?\d))(\.\d+)?)(,\d+z)?$/);
    }

    function resolve_address(address, callback) {
        if (address === null || $.trim(address) === '') {
            return false;
        }

        var position = is_valid_latlng(address);
        if ($.isArray(position)) {
            callback(new google.maps.LatLng(position[1], position[4]));
        } else {
            geo.geocode({'address': address}, function (results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    callback(results[0].geometry.location);
                }
                return null;
            });
        }
    }

    function add_new_marker(address, title, image, map) {
        resolve_address(address, function (position) {
            var marker = new google.maps.Marker({
                map: map,
                position: position,
                icon: image
            });

            if (title.trim() !== '') {
                var infowindow = new google.maps.InfoWindow({
                    content: '<div class="maps-pro-content">' + title + '</div>'
                });
                google.maps.event.addListener(marker, 'click', function () {
                    infowindow.open(map, marker);
                });
            }
        });
    }

    do_maps = function do_maps(el) {
        geo = new google.maps.Geocoder();
        var items = $('.module.module-maps-pro', el);
         if(el && el.hasClass('module-maps-pro') && el.hasClass('module')){
            items = items.add(el);
        }
        items.each(function () {
            if ($(this).find('.maps-pro-canvas').length < 1) {
                return;
            }

            var $this = $(this),
                config = JSON.parse(window.atob($this.data('config'))),
                map_options = {};

            map_options.zoom = parseInt(config.zoom);
            map_options.center = new google.maps.LatLng(-34.397, 150.644);
            map_options.mapTypeId = google.maps.MapTypeId[ config.type ];
            map_options.scrollwheel = config.scrollwheel === 'enable';
            map_options.draggable = config.draggable === 'enable';
            map_options.disableDefaultUI = config.disable_map_ui === 'yes';

            if (typeof map_pro_styles !== 'undefined' && config.style_map !== '') {
                map_options.styles = map_pro_styles[config.style_map];
            }

            if (typeof builderMapsPro !== 'undefined' && builderMapsPro.styles) {
                map_options.styles = builderMapsPro.styles[ config.style_map ];
            }

            var node = $this.find('.maps-pro-canvas');
            var map = new google.maps.Map(node[0], map_options);

            google.maps.event.addListenerOnce(map, 'idle', function () {
                $('body').trigger('builder_maps_pro_loaded', [$this, map]);
            });

            /* store a copy of the map object in the dom node, for future reference */
            node.data('gmap_object', map);

            resolve_address(config.address, function (position) {
                map.setCenter(position);
            });

            /* add map markers */
            // first add all the markers with valid lat/lng
            $this.find('.maps-pro-marker').each(function () {
                var marker = $(this);
                if (is_valid_latlng(marker.data('address'))) {
                    add_new_marker(marker.data('address'), marker.html(), marker.data('image'), map);
                    marker.addClass('processed');
                }
            });

            // add markers that need to resolve the address first
            var markers = $this.find('.maps-pro-marker:not(.processed)');
            function setup_markers(i) {
                var marker = $(markers[i]); // get single marker
                add_new_marker(marker.data('address'), marker.html(), marker.data('image'), map);
                if (i < markers.length) {
                    setTimeout(function () {
                        i++;
                        setup_markers(i);
                    }, 350); /* wait 350ms before loading the new marker */
                }
            }
            setup_markers(0);
        });
    };

    function loader(el, type) {
        if (typeof google === 'object' && typeof google.maps === 'object') {
            do_maps(el);
        } else {
            Themify.LoadAsync('//maps.google.com/maps/api/js?sensor=false&callback=do_maps&key=' + themify_vars.map_key, false, true, true, function () {
                return typeof google === 'object' && typeof google.maps === 'object';
            });
        }
    }
    loader();
    if (!Themify.is_builder_active) {
        /* reload the map when switching tabs (Builder Tabs module) */
        $('body').on('tb_tabs_switch', function (e, activeTab, tabs) {
            if ($(activeTab).find('.module-maps-pro').length > 0) {
                $(activeTab).find('.module-maps-pro').each(function () {
                    var mapInit = $(this).find('.map-container').data('gmap_object'),
                            center = mapInit.getCenter();
                    google.maps.event.trigger(mapInit, 'resize');
                    mapInit.setCenter(center);
                });
            }
        });
    }
    else {
        $('body').on('builder_load_module_partial', function (e, el, type) {
            loader(el, type);
        });
    }

})(jQuery);