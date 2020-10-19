document.addEventListener("DOMContentLoaded", () => {
  const locations_by_type = [[], [], []]
  const location_type = document.querySelector("select.location-type")
  const parent_location = document.querySelector('.location-parent')
  const spinner = document.querySelector(".spinner")
  const default_coordinates = [115.8605, -31.9529]; // Perth!
  const default_fp_image = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mO8pa5bDwAEwAGvybgUugAAAABJRU5ErkJggg==";

  // Location selector (AJAX)
  if (document.querySelector("select.location-type") !== null) {
    location_type.addEventListener('change', maybeQueryLocations)
    maybeQueryLocations()
  }

  gateDelete()
  datetimePicker()
  attachmentUploader()
  mapbox()

  function mapbox()
  {
    let mapbox_map;
    let mapbox_geocoder;
    let mapbox_selected_point;
    let mapbox_canvas;
    let mapbox_point_features;
    let mapbox_point_held;
    let mapbox_overlay_source;

    initialiseMapbox()

    function initialiseMapbox() {
      mapboxgl.accessToken = "pk.eyJ1IjoiY2hyaXN0aWFuY2ViIiwiYSI6ImNrZDN4MzQyODEwcTMyc251ZGJnY3R2aDYifQ.Iip2TLYYP-vYS145IdHWXQ";

      if ($("#mapbox").length) {
        let
          predefined_coordinates = {
            lng: $("#mapbox").data('lng'),
            lat: $("#mapbox").data('lat')
          },
          mapbox_map_options = {
            container: 'mapbox',
            style: 'mapbox://styles/mapbox/streets-v11'
          }

        if ($("#mapbox").data('interactive') == false) {
          mapbox_map_options.interactive = false;
        }

        if ($("#mapbox").data('zoom')) {
          mapbox_map_options.zoom = $("#mapbox").data('zoom');
        } else {
          mapbox_map_options.zoom = 17;
        }

        if (von(predefined_coordinates.lat) && von(predefined_coordinates.lng)) {
          mapbox_map_options.center = [predefined_coordinates.lng, predefined_coordinates.lat];
          mapbox_selected_point = new mapboxgl.Marker().setLngLat([predefined_coordinates.lng, predefined_coordinates.lat])
        }
        else {
          mapbox_map_options.center = default_coordinates; // Perth!
        }

        // Instantiate Mapbox
        window.mapbox_map = mapbox_map = new mapboxgl.Map(mapbox_map_options);

        // If there was a predefined coordinate, then it is likely defining a location, not just a point in the map to center to. Add the marker
        if (mapbox_selected_point != null) {
          mapbox_selected_point.addTo(mapbox_map);
        }

        // Do we need (reverse) geocoding? fire subroutines
        if ($("#mapbox").data('geocoding')) {
          // Navigation controls
          mapbox_map.addControl(new mapboxgl.NavigationControl())
  
          // Initialise on-map control geocoder and events handler when geocoder runs
          mapbox_geocoder = (new MapboxGeocoder({
            accessToken: mapboxgl.accessToken,
            mapboxgl: mapboxgl,
            countries: "au",
            type: "poi,address",
            marker: {
              color: '#3FB1CE'
            },
            filter: function (item) {
              return item.context
                .map(function (i) {
                  return (i.id.split('.').shift() === 'region' && i.text === 'Western Australia');
                })
                .reduce(function (acc, cur) {
                  return acc || cur;
                });
            },
          })).on('result', function(e) {
            setLocationMeta(e.result.place_name, e.result.id, [e.result.center[0], e.result.center[1]]);

            if (mapbox_selected_point != null) {
              mapbox_selected_point.remove();
            }
          }).on('clear', function() {
            //console.log("clear");
          })

          // Add recently initialised on-map control geocoder into map
          mapbox_map.addControl( mapbox_geocoder,'top-left')

          // Map click handler to reverse geocode
          mapbox_map.on('click', async function(e) {
            let query_var_obj = new URLSearchParams({
              "access_token": mapboxgl.accessToken,
              "country": "au",
              "limit": 1,
              "types": "poi,address"
            });
  
            $.ajax(`https://api.mapbox.com/geocoding/v5/mapbox.places/${e.lngLat.lng},${e.lngLat.lat}.json?${query_var_obj.toString()}`)
              .done((data) => {
                mapbox_geocoder.clear();
  
                if (typeof mapbox_selected_point !== "undefined") {
                  mapbox_selected_point.remove();
                }
  
                if (data.features.length) {
                  mapbox_selected_point = new mapboxgl.Marker().setLngLat([e.lngLat.lng, e.lngLat.lat]).addTo(mapbox_map);
                  setLocationMeta(data.features[0].place_name, data.features[0].id, [e.lngLat.lng, e.lngLat.lat]);
                }
              });
          });
        }
        // Are we on a floor designer? run subroutines
        else if ($("#mapbox").data('floor-designer')) {
          mapbox_map.on('load', () => {
            primeOverlayHandleEvents();
            floorDesignerLocationChange();

            $('#building').on("change", (e) => {floorDesignerLocationChange(e)});
          });
        }
      }
    }

    function primeOverlayHandleEvents() {
      // Based on the recent op, run the values through the corner finders
      const corners = squareArea({lng: parseFloat(default_coordinates[0]), lat: parseFloat(default_coordinates[1])});
      mapbox_point_features = {
        'type': 'FeatureCollection',
        'features': [
          {
            // SW
            'type': 'Feature',
            'properties': {'id': 'swPoint'},
            'geometry': {
              'type': 'Point',
              'coordinates': [corners.sw.lng, corners.sw.lat]
            },
          },
          {
            // NE
            'type': 'Feature',
            'properties': {'id': 'nePoint'},
            'geometry': {
              'type': 'Point',
              'coordinates': [corners.ne.lng, corners.ne.lat]
            },
          },
        ]
      };

      // Need to hoist canvas to be accessible from this scope
      mapbox_canvas = mapbox_map.getCanvasContainer();

      // Hover in/out of point states and modifiers
      mapbox_map.on('mouseenter', 'point', () => {
        mapbox_canvas.style.cursor = 'move';
      });
      mapbox_map.on('mouseleave', 'point', () => {
        mapbox_canvas.style.cursor = '';
      });

      // When a point is held
      mapbox_map.on('mousedown', 'point', (e) => {
        /**
         * Because it is impossible to pass this value on the events defined below while still retaining the capability
         * to remove the event listeners, this needs to be set on a higher scope and later accessed by the event handlers
         */
        mapbox_point_held = e.features[0].properties.id;

        // Prevent the default map drag behavior.
        e.preventDefault();
        
        mapbox_canvas.style.cursor = 'grab';

        // Get current overlay image source so we don't have to rerun it every movement (spicy expensive!)
        mapbox_overlay_source = mapbox_map.getSource('fpoverlayimage');
        
        mapbox_map.on('mousemove', onMove);
        mapbox_map.once('mouseup', onUp);
      });
    }

    function onMove(e) {
      let coordinates = e.lngLat;
      let indexToUpdate;
      let ne, sw;

      // Set a UI indicator for dragging.
      mapbox_canvas.style.cursor = 'grabbing';

      // Map corners based on which order is being held
      if (mapbox_point_held == "nePoint") {
        indexToUpdate = 1;
        ne = coordinates;
        sw = {"lng": mapbox_point_features.features[0].geometry.coordinates[0], "lat": mapbox_point_features.features[0].geometry.coordinates[1]};
      } else {
        indexToUpdate = 0;
        ne = {"lng": mapbox_point_features.features[1].geometry.coordinates[0], "lat": mapbox_point_features.features[1].geometry.coordinates[1]};
        sw = coordinates;
      }

      // Update point being held to its new coordinates
      mapbox_point_features.features[indexToUpdate].geometry.coordinates = [coordinates.lng, coordinates.lat];
      mapbox_map.getSource('point').setData(mapbox_point_features);

      // Square current coordinates to be applied later
      const squared = new mapboxgl.LngLatBounds(
        new mapboxgl.LngLat(sw.lng, sw.lat),
        new mapboxgl.LngLat(ne.lng, ne.lat)
      );

      // Update overlay to its new square
      mapbox_overlay_source.setCoordinates(translateToCorners(squared))
    }

    function onUp(e) {
      mapbox_canvas.style.cursor = '';
        
      // Unbind mouse/touch events
      mapbox_map.off('mousemove', onMove);
      mapbox_map.off('touchmove', onMove);
    }
    
    function floorDesignerLocationChange() {
      let dataset = null;
  
      // Determine if we use placeholder coordinates or use data passed from the events parameter.
      if (arguments.length > 0) {
        dataset = arguments[0].target.selectedOptions[0].dataset;
      } else {
        dataset = {
          lng: default_coordinates[0],
          lat: default_coordinates[1]
        }
      }
  
      // Based on the recent op, run the values through the corner finders
      const corners = squareArea({lng: parseFloat(dataset.lng), lat: parseFloat(dataset.lat)});
      const squared = new mapboxgl.LngLatBounds(
        new mapboxgl.LngLat(corners.sw.lng, corners.sw.lat),
        new mapboxgl.LngLat(corners.ne.lng, corners.ne.lat)
      );
  
      // Overlay handling
      const source = mapbox_map.getSource('fpoverlayimage');
      if (source === undefined) {
        // Instantiate overlay source and layer if it doesn't exist yet.
        mapbox_map.addSource("fpoverlayimage", {
          "type": "image",
          "url": default_fp_image,
          "coordinates": translateToCorners(squared)
        });

        mapbox_map.addLayer({
          "id": 'fpoverlaylayer',
          "source": "fpoverlayimage",
          "type": 'raster',
        });
      }
      else {
        // Modify existing source
        source.setCoordinates(translateToCorners(squared))
      }
  
      // Overlay "handles" handling
      const point = mapbox_map.getSource('point');
      if (point === undefined) {
        // Because source "point" hasn't been added yet, let's add them now.
        mapbox_map.addSource('point', { 
          'type': 'geojson',
          'data': mapbox_point_features
        });
  
        mapbox_map.addLayer({
          'id': 'point',
          'type': 'circle',
          'source': 'point',
          'paint': {
            'circle-radius': 5,
            'circle-color': '#da272d'
          }
        });
      } else {
        // Source has been instantiated. Now we just have to update it.
        mapbox_point_features.features[0].geometry.coordinates = [corners.sw.lng, corners.sw.lat]; // SW
        mapbox_point_features.features[1].geometry.coordinates = [corners.ne.lng, corners.ne.lat]; // NE
        
        // Update current data set in point "source"
        mapbox_map.getSource('point').setData(mapbox_point_features);
      }
      
      // Finally fly you fool
      mapbox_map.flyTo({
        center: [dataset.lng, dataset.lat],
      })
    }
  
    function squareArea(coordinates) {
      const buffer = 0.00050000; // About the size of a campus? (lol)
  
      return {
        sw: {
          lng: coordinates.lng - buffer,
          lat: coordinates.lat - buffer
        },
        ne: {
          lng: coordinates.lng + buffer,
          lat: coordinates.lat + buffer
        }
      }
    }
  
    function setLocationMeta(address, id, coordinates) {
      $("input[name=address]").val(address);
      $("input[name=mp_id]").val(id);
      $("input[name=mp_lng]").val(coordinates[0]);
      $("input[name=mp_lat]").val(coordinates[1]);
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

    document.querySelectorAll("[data-upload-attachment-fp]").forEach( async (element) => {
      if (von(element.dataset.uploadEndpoint) !== null) {
        let attachment_hidden_field = document.querySelector("#attachment_id");

        let dropzone_instance = new Dropzone(element, {
          url: element.dataset.uploadEndpoint,
          previewsContainer: "#upload-preview",
          addRemoveLinks: true,
          maxFiles: 1,
          params: {
            "_token": von(element.dataset.uploadCsrf) // Append CSRF token
          },
          autoProcessQueue: false
        }).on("addedfile", function(file) {
          this.previewsContainer.classList.add("dropzone");
          this.element.classList.add("d-none");

          const reader = new FileReader();
          reader.readAsDataURL(file);
          reader.onload = () => {
            let source = window.mapbox_map.getSource('fpoverlayimage')
            source.updateImage({
              url: reader.result,
              coordinates: source.coordinates
            })
          }
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
    
    // I don't even remember what are these for anymore :'(
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

  function translateToCorners(bounds) {
    let boundsObjects = [
      bounds.getNorthWest(),
      bounds.getNorthEast(),
      bounds.getSouthEast(),
      bounds.getSouthWest()
    ];

    return boundsObjects.map((bound) => { return [bound.lng, bound.lat] });
  }
});
