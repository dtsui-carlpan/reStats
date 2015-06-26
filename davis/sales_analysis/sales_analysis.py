# coding: utf-8

import csv
import matplotlib.pyplot as pyplot

'''
	Helper functions for pie chart colors and reading in a csvfile into a dictionary
'''
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

# returns a list of dictionaries, with each dictionary being one line (one item) in the csv file
# Best way to do it, this function is general
def csv_to_dict(csv_filename):
	dict_list = []
	# with will implicity close the file after it is done being used
	with open(csv_filename) as csvfile:
		# the csv DictReader knows to use the first line as the fieldnames automatically.
		reader = csv.DictReader(csvfile)
		for row in reader:
			# each row is a line in the csv file and is a dictionary
			dict_list.append(row)

	return dict_list


'''
	Questions investigated:

		1. Top k items in terms of revenue generated (from high to low)
		2. Top k items in terms of quantity sold (from high to low)
		2. Top k items in terms of price (from high to low)
		3. A pie chart of the top k items (with the rest of the items being the combined 'others') in terms of revenue
		4. What is the proportion of the total revenue that each item generates

'''
# returns a float, the item_revenue
# entry here can be 'ITEM_REVENUE', 'ITEM_QUANTITY' or whatever that is a field name in the csvfilea
# nd is a string that is actually a float
def get_item_entry(d, entry_name):
	item_revenue = d[entry_name]
	# need to get rid of the "," and float it
	item_revenue = item_revenue.replace(',', '')
	item_revenue = float(item_revenue)
	return item_revenue


def get_total_revenue(dict_list):
	total_revenue = 0.0
	for d in dict_list:
		item_revenue = get_item_entry(d, 'ITEM_REVENUE')
		total_revenue += item_revenue

	return total_revenue


# returns a list of tuples: (item_entry, item_name) from high to low order
# entry_name here can be: 'ITEM_REVENUE', 'ITEM_QUANTITY', 'UNIT_PRICE', whatever that is a fieldname
def top_k_item_entry(dict_list, k, entry_name):
	# first make a list of tuples: (item_revenue, item_name)
	# and then we can sort the list however we want
	all_list = []
	for d in dict_list:
		item_revenue = get_item_entry(d, entry_name)
		item_name = d['ITEM_NAME']
		tup = (item_revenue, item_name)
		all_list.append(tup)
	# you can sort this in the reverse way as well
	all_list.sort(reverse = True)
	
	# make top k list now
	top_k_list = []
	for i in range(k):
		top_k_list.append(all_list[i])

	return top_k_list


def write_txt_file(dict_list, k, dept_name, data_date, write_filename):
	f = open(write_filename, 'w')

	# Introduction/header of the file
	s = 'Dept: ' + dept_name + '\n' + 'Data Date: ' + data_date + '\n\n'
	f.write(s)

	# TOTAL REVENUE
	total_revenue = get_total_revenue(dict_list)
	s = 'Total revenue for ' + dept_name + ' in ' + data_date + ' is: $' + str(total_revenue) + '\n\n'
	f.write(s)

	# TOP K REVENUE
	top_k_revenue_list = top_k_item_entry(dict_list, k, 'ITEM_REVENUE')
	s = 'Top ' + str(k) + ' in terms of revenue:\n'
	f.write(s)
	for tup in top_k_revenue_list:
		s = tup[1] + ': ' + '$' + str(tup[0]) + '\n'
		f.write(s)
	f.write('\n')

	# TOP K QUANTITY
	top_k_quantity_list = top_k_item_entry(dict_list, k, 'ITEM_QUANTITY')
	s = 'Top ' + str(k) + ' in terms of quantity:\n'
	f.write(s)
	for tup in top_k_quantity_list:
		s = tup[1] + ': ' + str(tup[0]) + '\n'
		f.write(s)
	f.write('\n')

	# TOP K PRICE
	top_k_price_list = top_k_item_entry(dict_list, k, 'UNIT_PRICE')
	s = 'Top ' + str(k) + ' in terms of price:\n'
	f.write(s)
	for tup in top_k_price_list:
		s = tup[1] + ': ' + '$' + str(tup[0]) + '\n'
		f.write(s)
	f.write('\n')

	f.close()


# plots a pie chart with the top k items and others as the combined sum of the rest of the items
# we look at revenue first
def mk_revenue_pi_chart():
	total_revenue = get_total_revenue(dict_list)
	top_k_revenue_list = top_k_item_entry(dict_list, k, 'ITEM_REVENUE')

	sizes = []
	labels = []
	for tup in top_k_revenue_list:
		# tup[0] is already a float
		item_revenue = tup[0]
		item_name = tup[1]

		sizes.append(item_revenue)
		labels.append(item_name)

		total_revenue -= item_revenue

	l = []
	for label in labels:
		l.append(label.decode('utf-8'))

	# now total_revenue is the left over revenue, thus the others revenue
	sizes.append(total_revenue)
	l.append('others')

	# use some beautiful colors

	colors_list = rgb_scale_down(colors)

	pyplot.axis('equal')
	pyplot.pie(sizes, labels = l, autopct='%1.1f%%', colors = colors_list)
	pyplot.title('Top Revenue')
	pyplot.savefig('output/top_revenue.png')
	pyplot.show()



if __name__ == '__main__':
	# EXPENSIVE ENTREE
	dict_list = csv_to_dict('data/sales_Jan_2014/Entree_expensive.csv')
	k = 5
	dept_name = 'Entree Expensive'
	data_date = 'Jan 2015'
	write_filename = 'output/entree_expesive_Jan_2015.txt'
	write_txt_file(dict_list, k, dept_name, data_date, write_filename)

	mk_revenue_pi_chart()


