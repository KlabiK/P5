var city =  document.getElementById('ville').value;
var key = document.getElementById('key').value;
var map;
if(city == "") {
    city = "Paris"
}else{
    city = document.getElementById('ville').value;
}

var cultura ="http://open.mapquestapi.com/nominatim/v1/search.php?key="+key+"&format=json&q="+city+"+cultura+[librairie]&addressdetails=0&limit=5&countrycodes=fr&viewbox=-1.99%2C52.02%2C0.78%2C50.94";
var fnac ="http://open.mapquestapi.com/nominatim/v1/search.php?key="+key+"&format=json&q="+city+"+fnac+[librairie]&addressdetails=0&limit=5&countrycodes=fr&viewbox=-1.99%2C52.02%2C0.78%2C50.94";


class Map{
    constructor(gameMap) {
        this.gameMap = gameMap;
        this.SelectionVille();
    }
    initMap() {//initialisation de la map
      
            var cityLoc ="http://open.mapquestapi.com/nominatim/v1/search.php?key="+key+"&format=json&q=Paris+&addressdetails=0&limit=1&countrycodes=fr&viewbox=-1.99%2C52.02%2C0.78%2C50.94";
            fetch(cityLoc)
            .then(res => res.json())
            .then((resJson => {
                let lat = resJson['0']['lat']
                let lon = resJson['0']['lon']
                     map = L.map('map').setView([lat,lon],13)
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            })
            .addTo(map)
        }))

        
    }

    marker(shop) { //initialisation des markers
        let LeafIcon = L.Icon.extend({
            options: {
                iconSize: [40, 50],
                iconAnchor: [0, 50],
                popupAnchor: [21, -45]
            }
        });
        const baliseFnac = new LeafIcon({iconUrl: "./public/images/website/FnacV2.png"});
        const baliseCultura = new LeafIcon({iconUrl: './public/images/website/culturaV2.png'});
        const baliseOther = new LeafIcon({iconUrl: './public/images/website/book.png'})
        var shopName = shop.adresse.substring(0, 4)

        //Attribution marker en fonction du type de lieu
        if(shopName == "Fnac"){
            L.marker(shop.Coordonnees, {icon: baliseFnac})
            .addTo(map)
            .bindPopup(shop.adresse)
            .openPopup()
        }else if(shopName == "Cult") {
            L.marker(shop.Coordonnees, {icon: baliseCultura})
            .addTo(map)
            .bindPopup(shop.adresse)
            .openPopup()
        }else if(shopName) {
            L.marker(shop.Coordonnees, {icon: baliseOther})
            .addTo(map)
            .bindPopup(shop.adresse)
            .openPopup()
        }
    }
    // choix ville et recherche des points de vente
    SelectionVille(){
    
        $('#envoyer').on('click', function(){
            if(shops){
                shops = [];              
            }
            if(map){
                 city = document.getElementById('ville').value;
                 cultura ="http://open.mapquestapi.com/nominatim/v1/search.php?key="+key+"&format=json&q="+city+"+cultura+[librairie]&addressdetails=0&limit=5&countrycodes=fr&viewbox=-1.99%2C52.02%2C0.78%2C50.94";
                 fnac ="http://open.mapquestapi.com/nominatim/v1/search.php?key="+key+"&format=json&q="+city+"+fnac+[librairie]&addressdetails=0&limit=5&countrycodes=fr&viewbox=-1.99%2C52.02%2C0.78%2C50.94";
                 var cityLoc ="http://open.mapquestapi.com/nominatim/v1/search.php?key="+key+"&format=json&q="+city+"+&addressdetails=0&limit=10&countrycodes=fr&viewbox=-1.99%2C52.02%2C0.78%2C50.94";    
                  fetch(cityLoc)
                 .then(res => res.json())
                 .then((resJson => {
                     let lat = resJson['0']['lat']
                     let lon = resJson['0']['lon']
                map.flyTo(new L.LatLng(lat,lon),13)
                fetchData(cultura);
                fetchData(fnac)        
            }))
        }
        
    })
    }
}
var shops = [];
var gameMap = new Map(map);

function fetchData(url) {
    fetch(url)
    .then(res => res.json())
    .then(data =>manageData(data))
    .catch(err => console.error(err))
};
function manageData(datas) {
    datas.map(data => {
        shops.push({
            Coordonnees:  data,
            adresse: data.display_name
        });
        shops.map(shop => {
            gameMap.marker(shop)
        });
    })
}
document.addEventListener("DOMContentLoaded", (event) =>{
    gameMap.initMap();
    fetchData(cultura);
    fetchData(fnac)
})