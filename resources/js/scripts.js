document.addEventListener("DOMContentLoaded", () => {
  const locations_by_type = [[], [], []];
  const location_type = document.querySelector("select.location-type")
  const parent_location = document.querySelector('.location-parent')
  const spinner = document.querySelector(".spinner");

  if (document.querySelector("select.location-type") !== null) {
    location_type.addEventListener('change', maybeQueryLocations);
    maybeQueryLocations();
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
      return value;
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
