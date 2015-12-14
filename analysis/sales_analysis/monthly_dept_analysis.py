# coding: utf-8

import csv
from os import listdir

'''
	Helper function to read a csv into a list of dictionaries
'''

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
		
			* I also specified each item's proportion of revenue relative to the toal revenue of
			  its respective department

'''
# returns a float, the item_revenue
# entry here can be 'ITEM_REVENUE', 'ITEM_QUANTITY' or whatever that is a field name in the csvfile and is a string that is actually a float
def get_item_entry(d, entry_name):
	item_entry = d[entry_name]
	# need to get rid of the "," and float it
	item_entry = item_entry.replace(',', '')
	item_entry = float(item_entry)
	return item_entry

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
	# if k is greater than the number of items that exist in that department, than use the min value of the two
	k = min(k, len(all_list))
	for i in range(k):
		top_k_list.append(all_list[i])

	return top_k_list

# returns the percent of total revenue that the item has generated
def find_pct_total_revenue(dict_list, item_name):
	total_revenue = get_total_revenue(dict_list)
	for d in dict_list:
		name = d['ITEM_NAME']
		if name == item_name:
			item_revenue = get_item_entry(d, 'ITEM_REVENUE')
			break
	pct_tot = round(item_revenue/total_revenue, 10)
	pct_tot = round(pct_tot * 100, 2)
	return pct_tot

# this is a general function that works with all 
def write_txt_file(dict_list, k, dept_name, data_date, f):
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
		pct_tot = round(tup[0]/total_revenue, 5)
		pct_tot = pct_tot * 100
		s = tup[1] + ': $' + str(tup[0]) + ' | ' + str(pct_tot) + '%' + ' of total revenue' + '\n'
		f.write(s)
	f.write('\n')

	# TOP K QUANTITY
	top_k_quantity_list = top_k_item_entry(dict_list, k, 'ITEM_QUANTITY')
	s = 'Top ' + str(k) + ' in terms of quantity:\n'
	f.write(s)
	for tup in top_k_quantity_list:
		pct_tot = find_pct_total_revenue(dict_list, tup[1])
		s = tup[1] + ': $' + str(tup[0]) + ' | ' + str(pct_tot) + '%' + ' of total revenue' + '\n'
		f.write(s)
	f.write('\n')

	# TOP K PRICE
	top_k_price_list = top_k_item_entry(dict_list, k, 'UNIT_PRICE')
	s = 'Top ' + str(k) + ' in terms of price:\n'
	f.write(s)
	for tup in top_k_price_list:
		pct_tot = find_pct_total_revenue(dict_list, tup[1])
		s = tup[1] + ': $' + str(tup[0]) + ' | ' + str(pct_tot) + '%' + ' of total revenue' + '\n'
		f.write(s)
	f.write('\n')

# got this from the internet
# http://stackoverflow.com/questions/9234560/find-all-csv-files-in-a-directory-using-python
def find_csv_filenames(path_to_dir, suffix):
    filenames = listdir(path_to_dir)
    return [filename for filename in filenames if filename.endswith(suffix)]

# this function goes over every csvfile in the data folder and writes the output all in one file
def write_txt_file_wrapper(k, path_to_dir, month, year):
	suffix = '.csv'
	csv_filenames = find_csv_filenames(path_to_dir, suffix)

	write_filename = 'output/' + year + '/texts/monthly_dept/' + month + '.txt'
	f = open(write_filename, 'w')

	for csv_filename in csv_filenames:
		# EXPENSIVE ENTREE
		filename = path_to_dir + '/' + csv_filename
		dict_list = csv_to_dict(filename)
		dept_name = csv_filename.split('.')[0]
		data_date = month + '_' + year
		write_txt_file(dict_list, k, dept_name, data_date, f)
		f.write('#######################################################\n')
		f.write('#######################################################\n\n')

	f.close()

# this function goes over all the folders within the data folder
# within each of the folders that it goes over is a set of csv files	
def wrapper_wrapper(k):
	# folders is the list of folder names within the data folder
	years = listdir('data/')
	
	for year in years:
		months = listdir('data/' + year)
		for month in months:
			path_to_dir = 'data/' + year + '/' + month
			write_txt_file_wrapper(k, path_to_dir, month, year)



if __name__ == '__main__':
	k = 5
	wrapper_wrapper(k)



