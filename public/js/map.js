
class Map {

    //Default Position To Oxford Cuz Why Not
    constructor(map, position = {lat:51.75, lng:-1.26}) {
        this.position = position;
        this.markers = [];
        this.map = new google.maps.Map(map, {
                center: position,
                zoom: 6
        });        

        this.getLocationName(position)
       
    }

    getLocationName(position){

        var deferred = $.Deferred(),
            geocoder = new google.maps.Geocoder();
        var city ="WIFG", country;
        
        geocoder.geocode({'location': position}, function(results, status) {
            
            if (status === 'OK') {
              if (results[0]) {                
                let deets = results[0];                
                let locVal = "";                
                deets.address_components.map(cmp => {                   
                    
                    if(cmp.types.includes('locality')){    
                        city = cmp.long_name; 
                    }

                    if(cmp.types.includes('country')){    
                        country = cmp.short_name; 
                    } 

                });

                deferred.resolve({city, country});
                
                // $('#location').val(city + ', ' + country);
                
              } else {
                window.alert('No results found');
              }
            } else {
              window.alert('Geocoder failed due to: ' + status);
            }
          });

          return deferred.promise();

          
        //   return null;
    }
    
    

    //Add A Marker To The map
    addMarker(location){
        this.clearMarkers();
        let marker = new google.maps.Marker({
            position: location,
            map: this.map
        });
        this.markers.push(marker);
        this.map.setCenter(location);
    }

    getCurrentPosition(){
        return this.position;
    }

    //Remove ALL Markers From the map
    clearMarkers() {
        this.setMapOnAll(null);
    }

    //Requured to remove as i dont understand what it does
    setMapOnAll(map) {
        for (var i = 0; i < this.markers.length; i++) {
            this.markers[i].setMap(map);
        }
    }

}




















