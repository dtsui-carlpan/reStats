# coding: utf-8

from bar_util import *
import csv
import matplotlib.pyplot as plt

# returns a dictionary from the csv file
# key: the unique id 物资编码 of each item (int)
# values: [品名, 规格, 单位, 批次, 帐存数量, 实存数量, 实耗数量, 单价, 实存金额, 实耗金额
#           0     1    2     3      4        5        6      7      8        9
def read_csv(csv_filename):
	# keeps track of if I'm reading in the first line of the csv file or not
	tracker = 0

	result = {}

	with open(csv_filename, 'rb') as csvfile:
		reader = csv.reader(csvfile)
		for row in reader:
			# reading in the first line
			if tracker == 0:
				keys = []
				for i in row:
					keys.append(i)
				# you will never come into this loop again
				tracker += 1
				continue

			# if 物资编码 doesn't exist, skip
			# if 帐存数量 doesn't exist, skip
			if row[0] == '' or row[5] == '':
				# print 'skip!'
				continue

			item_id = row[0]

			result[item_id] = []
			for i in range(len(keys)):
				if i == 0:
					continue

				result[item_id].append(row[i])

	return result

def get_sales(bar_dict, category):
	sum_amount = 0.0

	for key in bar_dict:
		item_name = bar_dict[key][0]
		# check if the item is given or not
		if '赠送' in item_name:
			continue

		liquor_type = deter_liquor(item_name)

		# print len(bar_dict[key][6])
		# when bar_dict[key][6] is "empty", it is really ' ', with a white space

		if liquor_type == category:
			# there is 实耗数量 and 单价
			if bar_dict[key][6] != ' ':
				num_unit = float(bar_dict[key][6])
				unit_price = float(bar_dict[key][7])
				sum_amount += num_unit * unit_price

	return sum_amount

# takes in the dictionary as outputed above
def get_hard_liquor_sales(bar_dict):
	s = get_sales(bar_dict, 'hard_liquor')
	return s

# takes in the dictionary as outputed above
def get_red_white_wine_sales(bar_dict):
	s = get_sales(bar_dict, 'red_white_wine')
	return s

# takes in the dictionary as outputed above
def get_chinese_wine_sales(bar_dict):
	s = get_sales(bar_dict, 'chinese_wine')
	return s

def get_beer_sales(bar_dict):
	s = get_sales(bar_dict, 'beer')
	return s

def get_soft_drinks_sales(bar_dict):
	s = get_sales(bar_dict, 'soft_drinks')
	return s

def get_fruit_sales(bar_dict):
	s = get_sales(bar_dict, 'fruit')
	return s

def get_others_sales(bar_dict):
	s = get_sales(bar_dict, 'others')
	return s

def plot_pie_chart(s_hard, s_r_w, s_c, s_b, s_s_d, s_f, s_o):
	total = s_hard + s_r_w + s_c + s_b + s_s_d + s_f + s_o
	fracs = [s_hard/total, s_r_w/total, s_c/total, s_b/total, s_s_d/total, s_f/total, s_o/total]
	labels = ['hard_liquor', 'red_white', 'chinese_wine', 'beer', 'soft_drinks', 'fruit', 'others']
	colors = ['gold', 'pink', 'white', 'green', 'red', 'orange', 'lightskyblue']

	plt.pie(fracs, labels = labels, colors = colors, autopct = '%1.1f%%', shadow = True, startangle = 90)

	plt.axis('equal')
	plt.savefig('bar_pie_chart_Jan.png')
	plt.show


if __name__ == '__main__':
	print ''
	d = read_csv('../data14/Jan/bar/bar.csv')
	# this decoding here is necessary to print each of the chinese characters individually
	# type unicode
	#print result['12010105'][0].decode('utf-8')[0]
	#print type(result['12010105'][0].decode('utf-8')[0])
	s_hard = get_hard_liquor_sales(d)
	print 'hard_liquor sale: ' + str(s_hard)

	s_r_w = get_red_white_wine_sales(d)
	print 'red or white wine sale: ' + str(s_r_w)

	s_c = get_chinese_wine_sales(d)
	print 'chinese wine sale: ' + str(s_c)

	s_b = get_beer_sales(d)
	print 'beer sale: ' + str(s_b)

	s_s_d = get_soft_drinks_sales(d)
	print 'soft drinks sale: ' + str(s_s_d)

	s_f = get_fruit_sales(d)
	print 'fruit sale: ' + str(s_f)

	s_o = get_others_sales(d)
	print 'others sale: ' + str(s_o)

	plot_pie_chart(s_hard, s_r_w, s_c, s_b, s_s_d, s_f, s_o)
