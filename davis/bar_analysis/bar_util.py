# coding: utf-8

import csv

# with this type of format, everything works but you can't print each chinese
# word independently

hard_liquor = ['路易', '轩尼诗', '轩尼诗', '马爹利', '香槟', '威士忌']

red_white_wine = ['奔富', '拉菲', '柏图斯', '拉图', '杰卡斯西拉', '红葡萄', '奇异庄园']

chinese_wine = ['花雕', '茅台', '五粮液', '日本盛', '梅鹿液']

beer = ['喜力', '青岛']

fruit = ['木瓜', '西瓜', '火龙果', '提子', '淮山', '杞子', '甘草', '西柠', '柚', '茶',
		 '枣', '芷扬', '陈皮', '橙', '桔', '果']

soft_drinks = ['水', '可乐', '雪碧', '汁', '菊花', '茶']

def deter_liquor(liquor_name):
	for word in hard_liquor:
		if word in liquor_name:
			return 'hard_liquor'

	for word in red_white_wine:
		if word in liquor_name:
			return 'red_white_wine'

	for word in chinese_wine:
		if word in liquor_name:
			return 'chinese_wine'

	for word in soft_drinks:
		if word in liquor_name:
			return 'soft_drinks'

	for word in beer:
		if word in liquor_name:
			return 'beer'

	for word in fruit:
		if word in liquor_name:
			return 'fruit'

	return 'others'


###############################
######  Field Variables #######
###############################
ITEM_ID = 0
ITEM_NAME = 1
ITEM_SIZE = 2
ITEM_UNIT = 3
PI_CI = 4
STARTING_AMOUNT = 5
LEFTOVER_AMOUNT = 6
USED_AMOUNT =  7
ITEM_PRICE = 8
LEFTOVER_VALUE = 9
USED_VALUE = 10

keys = ['item_id', 'name', 'size', 'unit', 'pi_ci', 'starting_amount', 'leftover_amount',
		'used_amount', 'unit_price', 'leftover_value', 'used_value']

# returns a dictionary from the csv file
# key: ITEM_NAME (1)
# value is a dictionary with keys specified as above
def csv_to_dict(csv_filename):
	d = {}
	# keeps track of if I'm reading in the first line of the csv file or not
	tracker = 0

	with open(csv_filename, 'rb') as csvfile:
		reader = csv.reader(csvfile)
		for row in reader:
			# first (header) line, skip it
			if tracker == 0:
				tracker += 1
				continue

			# if there is no starting amount, skip
			if row[STARTING_AMOUNT] == '':
				continue

			name = row[ITEM_NAME]
			d[name] = {}

			for i in range(2, 11):
				key = keys[i]
				d[name][key] = row[i]

	return d


def get_sales(bar_dict, category):
	sum_amount = 0.0

	# key is the item_name
	for key in bar_dict:
		# check if the item is given or not
		if '赠送' in key:
			continue

		liquor_type = deter_liquor(key)

		if liquor_type == category:
			# there is 实耗数量
			if bar_dict[key]['used_amount'] != ' ' and bar_dict[key]['used_value'] != ' ':
				used_value = bar_dict[key]['used_value']
				if ',' in used_value:
					used_value = used_value.replace(',', '')
				used_value = float(used_value)
				sum_amount += used_value

	return sum_amount

