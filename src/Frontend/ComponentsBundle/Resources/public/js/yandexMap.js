ymaps.ready(init);
var myMap; 
var myPlacemark;

function init(){ 
		var address = document.querySelector('.address').innerText;
		myMap = new ymaps.Map("map", {
				center: [55.771403, 37.714902],
				zoom: 15
		}); 

		myPlacemark = new ymaps.Placemark([55.771403, 37.714902], {
				hintContent: address,
				balloonContent: 'КУРС'
		});

		myMap.geoObjects.add(myPlacemark);
}
