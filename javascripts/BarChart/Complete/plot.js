var margin = {top: 20, right: 20, bottom: 30, left: 40},
var width = 960 - margin.left - margin.right;
var height = 500 - margin.top - margin.bottom;

// x and y
var x = d3.scale.ordinal().rangeRoundBands([0, width], .1);
var y = d3.scale.linear().range([height, 0]);

// x-axis and y-axis
var xAxis = d3.svg.axis().scale(x).orient("bottom");
var yAxis = d3.svg.axis().scale(y).orient("left").ticks(10, "%");

// make svg element
var svg = d3.select("body").append("svg")
			.attr("width", width + margin.left + margin.right)
			.attr("height", height + margin.top + marign.bottom)
			.append("g")  // add a g element to offset the origin of the chart area by top-left margin
.attr("transform", "translate(" + margin.left + "," + margin.top + ")"); 


// read in data and make plot
d3.tsv("data.tsv", type, function(error, data) {
	if (error) throw error;
	
	x.domain(data.map(function(d) { return d.letter; }));
	y.domain([0, d3.max(data, function(d) { return d.frequency; })]);
	
	// x-axis labels
	svg.append("g")
		.attr("class", "x axis")
		.attr("transform", "translate(0," + height + ")")
	.call(xAxis);
	
	// y-axis labels
	svg.append("g")
		.attr("class", "y axis")
		.call(yAxis)
		.append("text")
		.attr("transform", "rotate(-90)")
		.attr("y", 6)
		.attr("dy", ".71em")
		.style("text-achor", "end")
	.text("Frequency");
	
	// actual bar data plot
	svg.selectAll(".bar")
		.data(data)
		.enter().append("rect")
		.attr("class", "bar")
		.attr("x", function(d) { return x(d.letter); })
		.attr("width", x.rangeBand())
		.attr("y", function(d) { return y(d.frequency); })
	.attr("height", function(d) { return height - y(d.frequency); });	
});

function type(d) {
	d.frequency = +d.frequency;
	return d;
}