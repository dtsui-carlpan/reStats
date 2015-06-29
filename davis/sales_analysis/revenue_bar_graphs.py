from os import listdir
import numpy as np
import matplotlib.pyplot as plt


# reads in the text files outputed by sales_analysis_txt.py
# creates a dictionary with each dept_name as the key and each value being another dictionary with
# each month being the key (so 12 keys) and the value being the the corresponding revenue of each
# month, each department
def mk_month_dept_revenue_dict():
	d = {}

	years = listdir('output/')
	# 2014, 2015
	for year in years:
		d[year] = {}
		text_files = listdir('output/' + year + '/texts')
		for text_file in text_files:
			# reading in the file starts here:
			# each file has many depts
			month = text_file.split('.')[0]
			d[year][month] = {}
			with open('output/' + year + '/texts/' + text_file, 'r') as f:
				for row in f:
					# identify the total revenue row
					if 'Total revenue for' in row:
						dept_name = row.split(' ')[3]
						# this is in string, so you need to float it
						tot_rev = float(row.split('$')[1])
						#print dept_name, tot_rev
						d[year][month][dept_name] = tot_rev

	return d


# takes the dictionary outputed as above
# plots a bar graph graph of all 12 months with the 
def plot_bar_graph(d, year, dept_name):
	# the key is the month
	dept_revenue = {}

	for key in d[year]:
		# key will be the month
		try:
			dept_revenue[key] = d[year][key][dept_name]
		except:
			dept_revenue[key] = 0.0
			print year + ' ' + key + ' ' + dept_name + ' has no revenue'

	months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
	revenue = []
	for month in months:
		revenue.append(dept_revenue[month])


	pos = np.arange(len(months))
	width = 0.7

	ax = plt.axes()
	ax.set_xticks(pos + (width / 2))
	ax.set_xticklabels(months)

	light_blue = (float(162)/255.0, float(200)/255.0, float(236)/255.0)

	plt.bar(pos, revenue, width, color = light_blue)

	title = year + ' ' + dept_name + ' Revenue'
	plt.title(title)
	plt.xlabel('Month')
	plt.ylabel('Revenue (RMB)')
	plt.grid(True)


	save_name = 'output/' + year + '/plots/' +  dept_name + '_' + year + '_bar' + '.png'
	plt.savefig(save_name)
	plt.show()
	plt.close()
 
def plot_bar_graph_wrapper(d, year):
	dept_names = ['Appetizers', 'Entree_expensive', 'Entree_general', 'Dimsum', 'Seafood', 'Soup', 'Luxury', 'Product', 'Bar']
	for dept_name in dept_names:
		plot_bar_graph(d, year, dept_name)

def main():
	d = mk_month_dept_revenue_dict()
	plot_bar_graph_wrapper(d, '2014')

if __name__ == '__main__':
	main()
