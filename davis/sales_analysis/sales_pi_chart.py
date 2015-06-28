import matplotlib.pyplot as pyplot

# # plots a pie chart with the top k items and others as the combined sum of the rest of the items
# # we look at revenue first
# def mk_revenue_pi_chart() :
# 	total_revenue = get_total_revenue(dict_list)
# 	top_k_revenue_list = top_k_item_entry(dict_list, k, 'ITEM_REVENUE')

# 	sizes = []
# 	labels = []
# 	for tup in top_k_revenue_list:
# 		# tup[0] is already a float
# 		item_revenue = tup[0]
# 		item_name = tup[1]

# 		sizes.append(item_revenue)
# 		labels.append(item_name)

# 		total_revenue -= item_revenue

# 	l = []
# 	for label in labels:
# 		l.append(label.decode('utf-8'))

# 	# now total_revenue is the left over revenue, thus the others revenue
# 	sizes.append(total_revenue)
# 	l.append('others')

# 	# use some beautiful colors

# 	colors_list = rgb_scale_down(colors)

# 	pyplot.axis('equal')
# 	pyplot.pie(sizes, labels = l, autopct='%1.1f%%', colors = colors_list)
# 	pyplot.title('Top Revenue')
# 	pyplot.savefig('output/top_revenue_pie_chart.png')
# 	pyplot.show()