var google_map = function()
{
	function Google_map()
	{
		var self = this;

		self.map = null;
		self.InfoWindow = null;
		self.lat = 42.8461609;
		self.lng = 74.5916296;
		self.zoom = 15;
		self.center = new google.maps.LatLng(self.lat, self.lng);

		// Создание маркера.
		self.createMarker = function()
		{
			var marker = new google.maps.Marker({
				icon: 'img/marker.png',
				position: self.center,
				map: self.map
			});

			marker.addListener('click', function() {
				if(self.InfoWindow) self.InfoWindow.close();

				// marker.InfoWindow = new google.maps.InfoWindow();
				// marker.InfoWindow.setContent('html content');
				// marker.InfoWindow.open(self.map, marker);

				self.InfoWindow = marker.InfoWindow; // Создаем глабальную перменную для последующего закрытия.
			});
		};

		// Инициализация карты
		self.init = function()
		{
			var options = {
				zoom: self.zoom,
				center: self.center,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};

			self.map = new google.maps.Map(document.getElementById('google__map'), options);

			self.map.addListener('click', function() {});

			self.createMarker();
			
		};
	};

	return new Google_map();
}();