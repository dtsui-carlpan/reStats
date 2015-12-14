from os import listdir
import numpy as np
import matplotlib.pyplot as plt

years = ['2014', '2015']
months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
dept_names = ['Appetizers', 'Entree_expensive', 'Entree_general', 'Dimsum', 'Seafood', 'Soup', 'Luxury', 'Product', 'Bar']

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
	monthly_revenues = []

	for month in months:
		# right now 2015 still only has 4 months
		try:
			monthly_revenues.append(d[year][month][dept_name])
		except:
			#print year + ' ' + month + ' ' + dept_name + ' has no revenue'
			monthly_revenues.append(0.0)


	pos = np.arange(len(months))
	width = 0.7

	ax = plt.axes()
	ax.set_xticks(pos + (width / 2))
	ax.set_xticklabels(months)

	light_blue = (float(162)/255.0, float(200)/255.0, float(236)/255.0)

	plt.bar(pos, monthly_revenues, width, color = light_blue)

	title = year + ' ' + dept_name + ' Revenue'
	plt.title(title)
	plt.xlabel('Month')
	plt.ylabel('Revenue (RMB)')
	plt.grid(True)


	save_name = 'output/' + year + '/plots/' +  dept_name + '_' + year + '_bar' + '.png'
	plt.savefig(save_name)
	#plt.show()
	plt.close()
 
def plot_bar_graph_wrapper(d, year):
	dept_names = ['Appetizers', 'Entree_expensive', 'Entree_general', 'Dimsum', 'Seafood', 'Soup', 'Luxury', 'Product', 'Bar']
	for dept_name in dept_names:
		plot_bar_graph(d, year, dept_name)

# plots the toal revenue of each month
def plot_monthly_revenue(d, year):
	revenues = []

	for month in months:
		monthly_revenue = 0.0
		for dept_name in dept_names:
			try:
				monthly_revenue += d[year][month][dept_name]
			except:
				monthly_revenue += 0.0
		revenues.append(monthly_revenue)

	pos = np.arange(len(months))
	width = 0.7

	ax = plt.axes()
	ax.set_xticks(pos + (width / 2))
	ax.set_xticklabels(months)

	light_blue = (float(162)/255.0, float(200)/255.0, float(236)/255.0)

	plt.bar(pos, revenues, width, color = light_blue)

	title = year + ' Total Monthly Revenue'
	plt.title(title)
	plt.xlabel('Month')
	plt.ylabel('Revenue (RMB)')
	plt.ylim((0.0, 2000000.0))
	plt.grid(True)


	save_name = 'output/' + year + '/plots/' + 'total_monthly_revenue_' + year + '_bar' + '.png'
	plt.savefig(save_name)
	#plt.show()
	plt.close()


def main():
	d = mk_month_dept_revenue_dict()

	for year in years:
		plot_bar_graph_wrapper(d, year)
		plot_monthly_revenue(d, year)

if __name__ == '__main__':
	main()
