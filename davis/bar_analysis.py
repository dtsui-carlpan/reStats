# coding: utf-8

from bar_util import *
import numpy as np
import matplotlib.pyplot as plt

def get_year_sales(category):
	# all 12 months of csv files
	csvfile_names = ['../data14/Jan/bar/bar.csv',
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
	dict_list = []
	for csvfile in csvfile_names:
		d = csv_to_dict(csvfile)
		dict_list.append(d)

	sales = []
	for d in dict_list:
		sale = get_sales(d, category)
		sales.append(sale)

	return sales

# takes in the list of sales outputed as above
def plot_sales(sales, category_name):
	months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']

	pos = np.arange(len(months))
	width = 0.7

	ax = plt.axes()
	ax.set_xticks(pos + (width / 2))
	ax.set_xticklabels(months)

	plt.bar(pos, sales, width, color = 'r')

	title = category_name + ' Sales 2014'
	plt.title(title)
	plt.xlabel('Month')
	plt.ylabel('Used Value (RMB)')
	plt.show()
	# save_name = 'plots/' + category_name + '.png'
	# print save_name
	# plt.savefig(save_name)
	plt.close()

def plot_red_white_wine_sales():
	red_white_wine_sales = get_year_sales('red_white_wine')
	plot_sales(red_white_wine_sales, 'Red_White_Wine')

def plot_hard_liquor_sales():
	hard_liquor_sales = get_year_sales('hard_liquor')
	plot_sales(hard_liquor_sales, 'Hard_Liquor')

def plot_chinese_wine_sales():
	chinese_wine_sales = get_year_sales('chinese_wine')
	plot_sales(chinese_wine_sales, 'Chinese_Wine')

def plot_beer_sales():
	beer_sales = get_year_sales('beer')
	plot_sales(beer_sales, 'Beer')

def plot_fruit_sales():
	fruit_sales = get_year_sales('fruit')
	plot_sales(fruit_sales, 'Fruit')

def plot_others_sales():
	others_sales = get_year_sales('others')
	plot_sales(others_sales, 'Others')

if __name__ == '__main__':
	plot_red_white_wine_sales()
	plot_hard_liquor_sales()
	plot_chinese_wine_sales()
	plot_beer_sales()
	plot_fruit_sales()
	plot_others_sales()
