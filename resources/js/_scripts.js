document.addEventListener("DOMContentLoaded", () => {
  const locations_by_type = [[], [], []]
  const location_type = document.querySelector("select.location-type")
  const parent_location = document.querySelector('.location-parent')
  const spinner = document.querySelector(".spinner")

  // Location selector (AJAX)
  if (document.querySelector("select.location-type") !== null) {
    location_type.addEventListener('change', maybeQueryLocations)
    maybeQueryLocations()
  }

  gateDelete()
  datetimePicker()
  attachmentUploader()
  osm()
  mapbox()

  function mapbox()
  {
    mapboxgl.accessToken = "pk.eyJ1IjoiY2hyaXN0aWFuY2ViIiwiYSI6ImNrZDN4MzQyODEwcTMyc251ZGJnY3R2aDYifQ.Iip2TLYYP-vYS145IdHWXQ";

    var map = new mapboxgl.Map({
      container: 'mapbox',
      style: 'mapbox://styles/mapbox/streets-v11',
      center: [115.8605, -31.9529],
      zoom: 10,
    });

    var canvas = map.getCanvasContainer();
    var geojson = {
      'type': 'FeatureCollection',
      'features': [{
        'type': 'Feature',
        'geometry': {
          'type': 'Point',
          'coordinates': [115.8605, -31.9529]
        }
      }]
    };

    function onMove(e) {
      var coords = e.lngLat;

      // Set a UI indicator for dragging.
      canvas.style.cursor = 'grabbing';

      // Update the Point feature in `geojson` coordinates
      // and call setData to the source layer `point` on it.
      geojson.features[0].geometry.coordinates = [coords.lng, coords.lat];
      map.getSource('point').setData(geojson);
    }

    function onUp(e) {
      var coords = e.lngLat;
        
      // Print the coordinates of where the point had
      // finished being dragged to on the map.

      wapmap.getSource('myImageSource').setCoordinates(translateToCorners(L.latLngBounds([coords.lat, coords.lng],[-31.948760310593066, 115.86193584209832])))

      canvas.style.cursor = '';

      console.log(coords);
        
      // Unbind mouse/touch events
      map.off('mousemove', onMove);
      map.off('touchmove', onMove);
    }

    window.wapmap = map;

    function translateToCorners(bounds) {
      let boundsObjects = [
        bounds.getNorthWest(),
        bounds.getNorthEast(),
        bounds.getSouthEast(),
        bounds.getSouthWest()
      ];

      return boundsObjects.map((bound) => { return [bound.lng, bound.lat] });
    }

    // map.on("click", function(e) {
    //   console.log(e.lngLat);
    // })

    map.on("load", function() {
      let cords = translateToCorners(L.latLngBounds([-31.947438577452445, 115.86018153393837],[-31.948760310593066, 115.86193584209832]));

      //wapmap.getSource('myImageSource').setCoordinates(translateToCorners(L.latLngBounds([-31.947438577452445, 115.86018153393837],[-31.94937136551703, 115.86411613781672])))

      map.addSource("myImageSource", {
        "type": "image",
        "url": "https://upload.wikimedia.org/wikipedia/commons/thumb/7/7c/Sydney_Opera_House_-_Dec_2008.jpg/1024px-Sydney_Opera_House_-_Dec_2008.jpg",
        "coordinates": cords
      });

      map.addLayer({
        "id": 'imagelayer',
        "source": "myImageSource",
        "type": 'raster',
      });

      // Add a single point to the map
      map.addSource('point', {
        'type': 'geojson',
        'data': geojson
      });

      map.addLayer({
        'id': 'point',
        'type': 'circle',
        'source': 'point',
        'paint': {
          'circle-radius': 5,
          'circle-color': '#3887be'
        }
      });

      // When the cursor enters a feature in the point layer, prepare for dragging.
      map.on('mouseenter', 'point', function() {
        map.setPaintProperty('point', 'circle-color', '#3bb2d0');
        canvas.style.cursor = 'move';
      });

      map.on('mouseleave', 'point', function() {
        map.setPaintProperty('point', 'circle-color', '#3887be');
        canvas.style.cursor = '';
      });

      map.on('mousedown', 'point', function(e) {
        // Prevent the default map drag behavior.
        e.preventDefault();
        
        canvas.style.cursor = 'grab';
        
        map.on('mousemove', onMove);
        map.once('mouseup', onUp);
      });

      map.on('touchstart', 'point', function(e) {
        if (e.points.length !== 1) return;

        // Prevent the default map drag behavior.
        e.preventDefault();

        map.on('touchmove', onMove);
        map.once('touchend', onUp);
      });
    })

    class HelloWorldControl {
      constructor(imageUrl) {
        this.imageUrl = imageUrl
      }

      onAdd(map) {
        this._map = map;
        this._container = document.createElement('div');
        this._container.className = 'mapboxgl-ctrl';
        this._container.textContent = 'Hello, world';

        return this._container;
      }

      onRemove() {
        this._container.parentNode.removeChild(this._container);
        this._map = undefined;
      }
    }
    map.addControl(new mapboxgl.NavigationControl())

    map.addControl(
      (new MapboxGeocoder({
        accessToken: mapboxgl.accessToken,
        mapboxgl: mapboxgl,
        countries: "au",
        type: "poi, address"
      }))
      .on('result', function(result) { console.log(result); })
      .on('clear', function() { /* TODO: on clear */ }),
      'top-left'
    )
  }

  function osm()
  {
    let leaflet_map;
    let leaflet_marker
  
    initializeLeafletJS();
    initializeS2Nominatim();
    initializeS2();
  
    function initializeLeafletJS() {
      if ( $( "#leaflet" ).length > 0 ) {
        leaflet_marker = L.marker();
        const default_zoom = 13;
        const default_location = {
          x: -31.9529,
          y: 115.8605
        }; // Perth
        leaflet_map = L.map('leaflet');
        let set_zoom = $( "#leaflet" ).data( "zoom" );
        let zoom;
        
        let mp_id = $( "#leaflet" ).data( "mp-id" );
        let mp_type = $( "#leaflet" ).data( "mp-type" );
  
        if ( set_zoom != "" ) {
          zoom = set_zoom;
        } else {
          zoom = default_zoom;
        }
  
        if ( mp_id && mp_type ) {
          // TODO: always geolocate because mp_id and long/lat pair may not match
          $.get(
            "https://nominatim.openstreetmap.org/reverse",
            {
              format: 'json',
              osm_id: mp_id,
              osm_type: mp_type.toUpperCase(),
            }, ( data ) => {
              leaflet_map.setView( [ data.lat, data.lon ], zoom);
              setMarker( data.lat, data.lon );
            } 
          );
  
        } else {
          leaflet_map.setView( [ default_location.x, default_location.y ], zoom);
        }
  
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          maxZoom: 19,
          attribution: '&copy; <a href="https://openstreetmap.org/copyright">OpenStreetMap contributors</a>'
        }).addTo(leaflet_map);
        
        leaflet_map.on('click', function ( e ) {
          // Honor preventing of moving the pin
          if (typeof e.originalEvent.target.dataset.noPinMove === 'undefined') {
            $.get(
              "https://nominatim.openstreetmap.org/reverse",
              {
                format: 'json',
                lat: e.latlng.lat,
                lon: e.latlng.lng,
              }, ( data ) => {
                leaflet_map.setView( [ data.lat, data.lon ], zoom);
                setMarker( data.lat, data.lon );
                setMapPostData( data.osm_id, data.osm_type, data.display_name );
  
                // Clear location search values
                $('#geolocate').val("").trigger('change');
              } 
            );
          }

        } );
      }
    }
  
    /**
     * Initializes S(elect)2 and Nominatim (geocode)
     */
    function initializeS2Nominatim() {
      if ( $( "#geolocate" ).length > 0 ) {
        $( "#geolocate" ).select2( {
          width: "100%",
          placeholder: "Search for a location",
          ajax: {
            url: 'https://nominatim.openstreetmap.org/search',
            dataType: 'json',
            delay: 250,
            data: function ( params ) {
              return {
                format: 'json',
                limit: 5,
                countrycodes: 'au',
                q: params.term
              };
            },
            processResults: function ( data ) {
              return {
                results: data.map( function( result ) {
                  return {
                    id: result.osm_id,
                    text: result.display_name,
                    lat: result.lat,
                    lon: result.lon,
                    mp_id: result.osm_id,
                    mp_type: result.osm_type,
                  }
                } )
              };
            }
          },
          templateSelection: function ( data ) {
            // Set data attributes
            $(data.element).attr('data-lat', data.lat);
            $(data.element).attr('data-lon', data.lon);
            $(data.element).attr('data-mp-id', data.mp_id);
            $(data.element).attr('data-mp-type', data.mp_type);
    
            return data.text;
          },
          minimumInputLength: 3,
        } );
  
        $( "#geolocate" ).on( "change", ( event ) => {
          let selected = $( '#geolocate' ).find( ':selected' );
          let lat = $( selected ).data( 'lat' ), lon = $( selected ).data( 'lon' );
          let zoom = $( "#leaflet" ).data( "zoom" );
  
          // For some reason, clicking on the map triggers changes in this select2 instance. WTF?
          if ( lat && lon ) {
            setMapPostData(
              $( selected ).data( 'mp-id' ),
              $( selected ).data( 'mp-type' ),
              $( selected ).text()
            );
            setMarker( lat, lon );
            leaflet_map.setView( [ lat, lon ], zoom);
          }
        } )
      }
    }
    
    function initializeS2() {
      $( '.select2-normal' ).select2();
    }
  
    function setMapPostData( mp_id, mp_type, address ) {
      $( "input[name=mp_id]" ).val( mp_id );
      $( "input[name=address]" ).val( address );
      
      if ( mp_type ) {
        // OSM/Nominatim specific idenfier
        $( "input[name=mp_type]" ).val( mp_type.substr(0,1) );
      } else {
        $( "input[name=mp_type]" ).val( "" );
      }
    }
  
    function setMarker( lat, lng ) {
      // Ensure we don't flood layer and that we clear it everytime map is clicked
      if ( leaflet_map.hasLayer( leaflet_marker ) ) {
        leaflet_map.removeLayer( leaflet_marker );
      }
  
      leaflet_marker = L.marker( [ lat, lng ] ).addTo( leaflet_map );
    }
  }

  function gateDelete()
  {
    // Gate delete buttons with a confirmation
    document.querySelectorAll("[data-confirm-delete]").forEach((element) => {
      element.addEventListener("click", (event) => {
        let should_delete = confirm("Are you sure you want to delete this entry?");

        if (!should_delete) {
          event.preventDefault();
        }
      });
    });
  }

  function datetimePicker()
  {
    // Flatpickr for datetime fields
    flatpickr("[data-datetime-picker]", {
      enableTime: true,
      defaultDate: "today",
      altInput: true,
      altFormat: "j F, Y h:i K"
    });
  }

  function attachmentUploader() {
    document.querySelectorAll("[data-upload-attachment]").forEach( async (element) => {
      if (von(element.dataset.uploadEndpoint) !== null) {
        let attachment_hidden_field = document.querySelector("#attachment_id");

        let dropzone_instance = new Dropzone(element, {
          url: element.dataset.uploadEndpoint,
          previewsContainer: "#upload-preview",
          addRemoveLinks: true,
          maxFiles: 1,
          params: {
            "_token": von(element.dataset.uploadCsrf) // Append CSRF token
          }
        }).on("addedfile", function(file, xhr, formData) {
          this.previewsContainer.classList.add("dropzone");
          this.element.classList.add("d-none");
        }).on("removedfile", function(file) {
          this.previewsContainer.classList.remove("dropzone");
          this.element.classList.remove("d-none");

          // Unset hidden field value
          if (attachment_hidden_field !== null) {
            attachment_hidden_field.value = null;
          }
        }).on("success", function(file, response) {
          // Set hidden field value
          if (attachment_hidden_field !== null) {
            attachment_hidden_field.value = response.upload.id;
          }
        });

        if ( attachment_hidden_field !== null
          && von(attachment_hidden_field.value) !== null
          && von(attachment_hidden_field.dataset.uploadQueryUrl) !== null ) {
            let meta = await queryUploadMeta({
              url: attachment_hidden_field.dataset.uploadQueryUrl,
              id: attachment_hidden_field.value
            });

            dropzone_instance.displayExistingFile({
              "name": meta.title,
              "size": meta.size
            }, meta.url);
        }
      }
    });
  }

  async function queryUploadMeta(resource) {
    let url = `${resource.url}/${resource.id}`;
    let meta = null;

    await fetch(url)
      .then((response) => {
        if (!response.ok) {
          throw new Error(response.status);
        }

        return response.json()
      })
      .then((data) => {
        meta = data.upload;
      })
      .catch((error) => {
        if (error.message == "404") {
          console.log("Could not find upload given the ID on the hidden field");
        }
        else {
          console.log("Error retrieving uploaded image metadata on hidden field");
        }
      });
    return meta;
  }

  async function maybeQueryLocations()
  {
    hide(spinner, false);
    hide(parent_location, true)

    // Don't query if our location type can have no parent
    if (location_type.value > 0) {
      let query_type = location_type.value - 1;
      let resource = `${location_type.dataset.resource}/${query_type}`;
      let populate_ok = false;

      if (locations_by_type[location_type.value].length === 0) {
        if (typeof location_type.dataset.resource !== 'undefined') {
          await fetch(resource)
            .then((response) => {
              if (!response.ok) {
                throw new Error(response.status);
              }

              return response.json()
            })
            .then((data) => {
              locations_by_type[query_type] = data.locations;
              populate_ok = true;
            })
            .catch((error) => {
              if (error.message == "404") {
                // OK to populate but locations list is just empty
                populate_ok = true;
              }
              else {
                alert("There was an error querying locations");
              }
            });
        }
      }
      else {
        populate_ok = true;
      }

      if (populate_ok) {
        hide(parent_location, false);
        populateLocatedAt(locations_by_type[query_type]);
      }
    }

    hide(spinner, true);
  }

  function populateLocatedAt(items) {
    const parent = document.querySelector('.location-parent select');
    const original = von(parent.dataset.originalValue);
    const current = von(parent.dataset.currentLocation);

    if (parent !== null) {
      // Clear existing values
      while (parent.firstChild) {
        parent.firstChild.remove();
      }

      // Placeholder option
      let placeholder = document.createElement("option");
      placeholder.disabled = true;

      // There is an item in the list, but if the item is current, then it can't be selected
      let cant_select = false;
      if (items.length === 1) {
        if (items[0].id == current) {
          // Match found
          cant_select = true;
        }
      }

      if (items.length && !cant_select) {
        placeholder.innerText = "Choose a location";
      }
      else {
        placeholder.selected = true;
        placeholder.innerText = "No selectable locations";
      }

      parent.appendChild(placeholder);

      // Loop through items and append them (if any)
      items.forEach((location) => {
        // Bail early if the location is `this` location
        if (current !== null && current == location.id) {
          return;
        }

        let option = document.createElement("option");
        option.innerText = location.name;
        option.value = location.id;

        // If original is set
        if (original !== null && original == location.id) {
          option.selected = true;
        }

        parent.appendChild(option);
      });
    }
  }

  /**
   * (v)alue (o)r (n)ull. Useful when getting values from vars where there's a chance for it returning
   * undefined
   * 
   * @param mixed value value to evaluate
   */
  function von(value) {
    if (typeof value !== "undefined") {
      if (value !== "") {
        return value;
      }
    }

    return null;
  }
  
  /**
   * Hide element given using bootstrap classes
   * 
   * @param object element Element to hide
   * @param bool hide true to hide, false otherwise
   */
  function hide(element, hide) {
    element.classList.remove("d-none")

    if (hide) {
      element.classList.add("d-none")
    }
  }
});
