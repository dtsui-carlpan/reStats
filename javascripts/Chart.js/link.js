(function() {
	var data = [
	    {
	        value: 300,
	        color:"#F7464A",
	        highlight: "#FF5A5E",
	        label: "Red"
	    },
	    {
	        value: 50,
	        color: "#46BFBD",
	        highlight: "#5AD3D1",
	        label: "Green"
	    },
	    {
	        value: 100,
	        color: "#FDB45C",
	        highlight: "#FFC870",
	        label: "Yellow"
	    }
	];

	$(document).ready( 
	    function () {
	        var ctx = document.getElementById("report-bar").getContext("2d");
	        var myNewChart = new Chart(ctx).Pie(data);

	        $("#report-bar").click( 
	            function(evt){
	                var activePoints = myNewChart.getSegmentsAtEvent(evt);
	                var url = "http://example.com/?label=" + activePoints[0].label + "&value=" + activePoints[0].value;
					window.location.href = url;
	            }
	        );                  
	    }
	);
})();
