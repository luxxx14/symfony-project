ymaps.ready(init);
var myMap; 
var myPlacemark;

function init(){ 
		
	var address = document.querySelector('.address').innerText;
	var index = address.indexOf(", ");
	  $.get( "https://geocode-maps.yandex.ru/1.x/?format=json&geocode="+address, function( data ) {
			
			var lon = data.response.GeoObjectCollection.featureMember[0].GeoObject.Point.pos.split(" ")[0];
			var lat = data.response.GeoObjectCollection.featureMember[0].GeoObject.Point.pos.split(" ")[1];	
			myMap = new ymaps.Map("map", {
					center: [lat, lon],
					zoom: 15
			}); 
			myPlacemark = new ymaps.Placemark([lat, lon], {				  
					hintContent: address.slice(index+1, address.length),
					balloonContent: 'КУРС'
			});
			myMap.geoObjects.add(myPlacemark);

			});	  
}
