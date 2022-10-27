var request = new XMLHttpRequest();
const keyInit = document.getElementById('key').value;
request.onreadystatechange = function() {
    if (this.readyState == XMLHttpRequest.DONE && this.status == 200) {
        var response = JSON.parse(this.responseText);
    }
};
request.open("GET","http://open.mapquestapi.com/nominatim/v1/search.php?key="+keyInit+"&format=json&q=Île-de-France+cultura+[librairie]&addressdetails=0&limit=3&countrycodes=fr&viewbox=-1.99%2C52.02%2C0.78%2C50.94");
request.send();
