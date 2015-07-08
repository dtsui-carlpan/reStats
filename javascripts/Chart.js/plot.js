(function() {
	var $id = function(id) {
		return document.getElementById(id);
	}
	var helpers = Chart.helpers;
	
	var contexts = {
		bar: $id('report-bar').getContext('2d'),
		pie: $id('report-pie').getContext('2d')
	};
	var chartInstances = [];
	
	var red = "#bf616a",
		blue = "#5B90BF",
		orange = "#d08770",
		yellow = "#ebcb8b",
		green = "#a3be8c",
		teal = "#96b5b4",
		pale_blue = "#8fa1b3",
		purple = "#b48ead",
		brown = "#ab7967";
	
	// data for plots
	var data = {
		// for bar chart
		multiSets: {
			labels: ["January", "February", "March", "April", "May", "June", "July"],
			datasets: [
				{
		            label: "My First dataset",
		            fillColor: "rgba(220,220,220,0.5)",
		            strokeColor: "rgba(220,220,220,0.8)",
		            highlightFill: "rgba(220,220,220,0.75)",
		            highlightStroke: "rgba(220,220,220,1)",
		            data: [65, 59, 80, 81, 56, 55, 40]
				}
			]
		},
		// for pie chart
		segments : [
			{
				value : 25,
				color : orange,
				highlight : Colour(orange, 10),
				label : "Orange"
			},
			{
				value: 14,
				color: blue,
				highlight : Colour(blue, 10),
				label : "Blue"
			},
			{
				value: 6,
				color: yellow,
				highlight : Colour(yellow, 10),
				label : "Yellow"
			},
			{
				value : 28,
				color : purple,
				highlight : Colour(purple, 10),
				label : "Purple"
			},
			{
				value: 18,
				color: teal,
				highlight: Colour(teal, 10),
				label: "Teal"
			}
		]
	}
	
	var config = {
		animation: false,
		onAnimationComplete: function() {
			this.options.animation = true;
		},
		responsive: true
	};
	
	chartInstances.push(new Chart(contexts.bar).Bar(data.multiSets, config));
	chartInstances.push(new Chart(contexts.pie).Pie(data.segments, config));
	
	
	var iteratePosition = (function() {
		var position = 1;
		
		return function() {
			position++;
			return (position > chartInstances.length) ? position = 1 : position;
		}
	})();
	
	var carousel = $id('js-carousel');
	
	helpers.addEvent(carousel, 'click', function() {
		var positionPrefix = 'position-',
			carouselPosition = iteratePosition(),
			chartToScrollTo = chartInstances[carouselPosition-1];
			
			this.className = this.className.replace(new RegExp(positionPrefix+'[1-2]'), positionPrefix+carouselPosition);
			
			chartToScrollTo.clear();
			chartToScrollTo.render();
		
	});
	
	function Colour(col, amt) {
		var usePound = false;
		if (col[0] == "#") {
			col = col.slice(1);
			usePound = true;
		}

		var num = parseInt(col,16);

		var r = (num >> 16) + amt;

		if (r > 255) r = 255;
		else if  (r < 0) r = 0;

		var b = ((num >> 8) & 0x00FF) + amt;

		if (b > 255) b = 255;
		else if  (b < 0) b = 0;

		var g = (num & 0x0000FF) + amt;

		if (g > 255) g = 255;
		else if (g < 0) g = 0;

		return (usePound?"#":"") + (g | (b << 8) | (r << 16)).toString(16);
	}

})();



