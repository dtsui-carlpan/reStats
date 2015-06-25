# coding: utf-8

from bar_util import *
import numpy as np
import matplotlib.pyplot as plt
import matplotlib.colors

# returns the month that the csv file belongs to in string
# example: 'Jan', 'Feb', ...
def get_csvfile_month(csvfile_name):
	l = csvfile_name.split('/')
	month = l[2]
	return month

# returns the list of 12 sales of each category in a monthly order
def get_year_sales(category):
	# all 12 months of csv files
	csvfiles = ['../data14/Jan/bar/bar.csv',
					 '../data14/Feb/bar/bar.csv',
					 '../data14/Mar/bar/bar.csv',
					 '../data14/Apr/bar/bar.csv',
					 '../data14/May/bar/bar.csv',
					 '../data14/Jun/bar/bar.csv',
					 '../data14/Jul/bar/bar.csv',
					 '../data14/Aug/bar/bar.csv',
					 '../data14/Sep/bar/bar.csv',
					 '../data14/Oct/bar/bar.csv',
					 '../data14/Nov/bar/bar.csv',
					 '../data14/Dec/bar/bar.csv']

	# list of dictionaries
	month_dict = {}
	for csvfile in csvfiles:
		d = csv_to_dict(csvfile)
		month = get_csvfile_month(csvfile)
		month_dict[month] = d

	# sales by month
	sales = {}
	for key in month_dict:
		sale = get_sales(month_dict[key], category)
		sales[key] = sale

	return sales

'''
	Investigation #1: study the sale of each category of items per month for the entire year 2014

	Categories:
				1) Red/White Wine
				2) Hard_Liquor
				3) Chinese Wine
				4) Beer
				5) Fruit
				6) Others
'''

# takes in the list of sales outputed as above
def plot_sales(sales, category_name):
	months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
	sales_list = []
	for month in months:
		sale = sales[month]
		sales_list.append(sale)

	pos = np.arange(len(months))
	width = 0.7

	ax = plt.axes()
	ax.set_xticks(pos + (width / 2))
	ax.set_xticklabels(months)

	plt.bar(pos, sales_list, width, color = 'r')

	title = category_name + ' Sales 2014'
	plt.title(title)
	plt.xlabel('Month')
	plt.ylabel('Used Value (RMB)')
	save_name = 'plots/' + category_name + '.png'
	print save_name
	plt.savefig(save_name)
	plt.show()
	plt.close()


def plot_sales_wrapper():
	# Red/White Wine
	red_white_wine_sales = get_year_sales('red_white_wine')
	plot_sales(red_white_wine_sales, 'Red_White_Wine')

	# Hard Liquor
	hard_liquor_sales = get_year_sales('hard_liquor')
	plot_sales(hard_liquor_sales, 'Hard_Liquor')

	# Chinese Wine
	chinese_wine_sales = get_year_sales('chinese_wine')
	plot_sales(chinese_wine_sales, 'Chinese_Wine')

	# Beer
	beer_sales = get_year_sales('beer')
	plot_sales(beer_sales, 'Beer')

	# Fruit
	fruit_sales = get_year_sales('fruit')
	plot_sales(fruit_sales, 'Fruit')

	# Others
	others_sales = get_year_sales('others')
	plot_sales(others_sales, 'Others')


'''
	Investigation #2: Study the proportion of sales of each category per month. Make pie chart for every month.

'''

tiffany_green = (152, 223, 138)
light_teal = (23, 190, 207)
light_orange = (255, 221, 113)
light_pink = (247, 182, 210)
navy = (31, 119, 180)
grey = (165, 172, 175)

colors = [tiffany_green, light_pink, light_orange, light_teal, navy, grey]


def mk_pie_charts():
	categories = ['hard_liquor', 'red_white_wine', 'chinese_wine', 'beer', 'fruit', 'others']
	months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']

	rgb_list = []
	for color in colors:
		rgb = (float(color[0])/255.0, float(color[1])/255.0, float(color[2])/255.0)
		rgb_list.append(rgb)

	sales_dict = {}
	for category in categories:
		sales = get_year_sales(category)
		sales_dict[category] = sales

	for month in months:
		sizes = []
		labels = []
		for key in sales_dict:
			labels.append(key)
			sizes.append(sales_dict[key][month])

		fig = plt.figure(0,figsize=(8,8))
		ax = fig.add_subplot(111,aspect='equal')

		plt.pie(sizes, labels = labels, colors = rgb_list)

		plt.title(month)

		plt.show()
		plt.close()
		# check if the numbers match up each month
		print 'Month is: ' + month
		print 'Total bar sales this month is: ' + str(check_total_bar_sales(sizes))
		print 'Total hard liquor sale this month is: ' + str(sizes[0])
		print 'Total red_white_wine sale this month is: ' + str(sizes[1])
		print 'Total chinese_wine sale this month is: ' + str(sizes[2])
		print 'Total beer sale this month is: ' + str(sizes[3])
		print 'Total fruit sale this month is: ' + str(sizes[4])
		print 'Total others sale this month is: ' + str(sizes[5])
		print ''



def check_total_bar_sales(sizes):
	total = 0.0
	for size in sizes:
		total += size
	return total



if __name__ == '__main__':
	#plot_sales_wrapper()
	mk_pie_charts()






