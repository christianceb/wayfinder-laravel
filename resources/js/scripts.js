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
