import matplotlib.pyplot as plt
from os import listdir

# a set of rgb values of some beautiful colors
creamy_green = (152, 223, 138)
creamy_orange = (255, 193, 86)
light_blue = (162, 200, 236)
teal = (23, 190, 207)
maroon = (200, 82, 0)
grey = (143, 135, 130)

colors = [creamy_green, creamy_orange, light_blue, maroon, teal, grey]

# converts each value in the rgb tuple from 0 - 255 to 0 - 1
def rgb_scale_down(colors):
	final = []
	for c in colors:
		tup = (float(c[0])/255.0, float(c[1])/255.0, float(c[2])/255.0)
		final.append(tup)
	return final

########################################################################
########################################################################

# takes in a dictionary with each key being the dept name and each corresponding value being the revenue
def graph_pie_chart(d, write_filename, month, year):
	labels = []
	sizes = []
	for key in d:
		# d[key] is a string, you need to float it
		labels.append(key)
		sizes.append(float(d[key]))
	plt.pie(sizes, labels = labels, autopct='%1.1f%%')
	plt.axis('equal')
	plt.title(month + ' ' + year + ' Pie Chart')
	plt.savefig(write_filename)
	plt.show()




# outputs a pie chart for each month with each department being an individual section
def mk_monthly_pie_chart():
	years = listdir('output/')
	for year in years:
		text_files = listdir('output/' + year + '/texts/')
		# each text file represents a month
		for text_file in text_files:
			d = {}
			# the name of the pie chart that will be saved
			month = text_file.split('.')[0]
			write_filename = 'output/' + year + '/pie_charts/' + month + '_pie.png'
			# read in the monthly text file now"
			with open('output/' + year + '/texts/' + text_file, 'r') as f:
				for row in f:
					# identify the total revenue row
					if 'Total revenue for' in row:
						dept_name = row.split(' ')[3]
						dept_revenue = row.split('$')[1]
						d[dept_name] = dept_revenue
			# done reading in the monthly text file, plot the monthly pie chart now
			# everything is in the dictionary d
			graph_pie_chart(d, write_filename, month, year)


def main():
	mk_monthly_pie_chart()

if __name__ == '__main__':
	main()




















