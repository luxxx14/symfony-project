ymaps.ready(init);
let myMap, 
		myPlacemark;

function init(){ 
		myMap = new ymaps.Map("map", {
				center: [55.771403, 37.714902],
				zoom: 15
		}); 

		myPlacemark = new ymaps.Placemark([55.771403, 37.714902], {
				hintContent: ' Боровая ул., дом 7, корп. 2',
				balloonContent: 'КУРС'
		});

		myMap.geoObjects.add(myPlacemark);
}


console.log("yandex");