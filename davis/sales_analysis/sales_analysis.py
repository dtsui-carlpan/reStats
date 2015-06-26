# coding: utf-8

from colors import *
import csv
import matplotlib.pyplot as pyplot


# returns a list of dictionaries, with each dictionary being one line (one item) in the csv file
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
	Questions:

		1. What are the top 3 items that bring the most revenue?
		   What is the proportion of each of them with respect to the total revue?
		2. 
'''
# returns a float, the item_revenue
def get_item_revenue(d):
	item_revenue = d['ITEM_REVENUE']
	# need to get rid of the "," and float it
	item_revenue = item_revenue.replace(',', '')
	item_revenue = float(item_revenue)
	return item_revenue


def get_total_revenue(dict_list):
	total_revenue = 0.0
	for d in dict_list:
		item_revenue = get_item_revenue(d)
		total_revenue += item_revenue

	return total_revenue


# returns a list of tuples: (item_revenue, item_name) with the MOST revenues
def top_k_revenue(dict_list, k):
	# first make a list of tuples: (item_revenue, item_name)
	# and then we can sort the list however we want
	all_list = []
	for d in dict_list:
		item_revenue = get_item_revenue(d)
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


def top_k_quantity(dict_list, k):
	all_list = []
	for d in dict_list:
		# ITEM_QUANTITY is a string
		item_quantity = d['ITEM_QUANTITY']
		item_quantity = item_quantity.replace(',', '')
		item_quantity = float(item_quantity)
		item_name = d['ITEM_NAME']
		tup = (item_quantity, item_name)
		all_list.append(tup)
	# you can sort this in the reverse way as well
	all_list.sort(reverse = True)
	
	# make top k list now
	top_k_list = []
	for i in range(k):
		top_k_list.append(all_list[i])

	return top_k_list

# top 5 in price
def top_k_price(dict_list, k):
	all_list = []
	for d in dict_list:
		# UNIT_PRICE is string
		unit_price = d['UNIT_PRICE']
		unit_price = unit_price.replace(',', '')
		unit_price = float(unit_price)
		item_name = d['ITEM_NAME']
		tup = (unit_price, item_name)
		all_list.append(tup)
	# you can sort this in the reverse way as well
	all_list.sort(reverse = True)
	
	# make top k list now
	top_k_list = []
	for i in range(k):
		top_k_list.append(all_list[i])

	return top_k_list

# plots a pie chart with the top k items and others as the combined sum of the rest of the items
# we look at revenue first
def mk_revenue_pi_chart(total_revenue, top_k_revenue_list):
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
	pyplot.savefig('top_revenue.png')
	pyplot.show()

def write_analysis_txt(dict_list, category_name):
	filename = category_name + '.txt'
	f = open(filename, 'w')

	# TOTAL REVENUE
	total_revenue = get_total_revenue(dict_list)
	s = 'Total revenue for Jan 2015 ' + category_name + ' is: $' + str(total_revenue) + '\n'
	f.write(s)

	f.write('\n')

	k = 7
	# TOP K REVENUE
	top_k_revenue_list = top_k_revenue(dict_list, k)
	s = 'Top ' + str(k) + ' in terms of revenue: \n'
	f.write(s)
	for tup in top_k_revenue_list:
		s = tup[1] + ': ' + '$' + str(tup[0]) + '\n'
		f.write(s)

	f.write('\n')

	# TOP K QUANTITY
	top_k_quantity_list = top_k_quantity(dict_list, k)
	s = 'Top ' + str(k) + ' in terms of quantity: \n'
	f.write(s)
	for tup in top_k_quantity_list:
		s = tup[1] + ': ' + str(tup[0]) + '\n'
		f.write(s)

	f.write('\n')

	# TOP K PRICE
	top_k_price_list = top_k_price(dict_list, k)
	s = 'Top ' + str(k) + ' in terms of price: \n'
	f.write(s)
	for tup in top_k_price_list:
		s = tup[1] + ': ' + '$' + str(tup[0]) + '\n'
		f.write(s)

	f.write('\n')

	# REVENUE PIE CHART
	mk_revenue_pi_chart(total_revenue, top_k_revenue_list)
	s = 'Top Revenue Pi Chart for ' + category_name + ' saved as top_revenue.png\n'
	f.write(s)



if __name__ == '__main__':
	# EXPENSIVE ENTREE
	entree_expensive_dict_list = csv_to_dict('data/sales_Jan_2014/Entree_expensive.csv')
	write_analysis_txt(entree_expensive_dict_list, 'entree_expensive')

	entree_general_dict_list = csv_to_dict('data/sales_Jan_2014/Entree_general.csv')
	write_analysis_txt(entree_general_dict_list, 'entree_general')


