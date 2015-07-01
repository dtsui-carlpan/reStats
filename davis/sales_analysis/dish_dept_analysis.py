from sales_monthly_dept_analysis import csv_to_dict
from sales_monthly_dept_analysis import get_item_entry
from os import listdir

months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']

# Since there are too many dishes within a department, I will only look at the top 5 items
# that generate the most revenue.
def convert_txt_file_to_dictionary():
	d = {}
	years = listdir('output/')
	for year in years:
		d[year] = {}
		text_files = listdir('output/' + year + '/texts/monthly_dept/')
		for text_file in text_files:
			month = text_file.split('.')[0]
			d[year][month] = {}
			with open('output/' + year + '/texts/monthly_dept/' + text_file) as f:
				for row in f:
					# identify the dept
					if 'Dept: ' in row:
						dept_name = row.split(' ')[1].strip('\n')
						d[year][month][dept_name] = {}
					# identify the top 5 revenue items
					if 'of total revenue' in row:
						item_name = row.split(':')[0]
						item_revenue = row.split('|')[0].split('$')[1]
						d[year][month][dept_name][item_name] = float(item_revenue)
	return d

# returns a list of revenues in the order of months
def helper(item_name, dept, year):
	result = []
	temp = {}

	months_folder = listdir('data/' + year + '/')
	for month in months_folder:
		try:
			csv_filename = 'data/' + year + '/' + month + '/' + dept + '.csv'
			dict_list = csv_to_dict(csv_filename)
		except:
			continue

		for d in dict_list:
			if d['ITEM_NAME'] == item_name:
				item_revenue = get_item_entry(d, 'ITEM_REVENUE')
				temp[month] = item_revenue

	for month in months:
		try:
			revenue = temp[month]
		except:
			revenue = 0.0
		result.append(revenue)

	return result


def mk_sth(d):
	# dd[year][dept][item_name] = [revenues]
	dd = {}

	for year in d:
		dd[year] = {}
		for month in d[year]:
			for dept in d[year][month]:
				dd[year][dept] = {}
				for item_name in d[year][month][dept]:
					l = helper(item_name, dept, year)
					dd[year][dept][item_name] = l

	return dd

def write_txt_file(dd):
	for year in dd:
		for dept in dd[year]:
			write_filename = 'output/' + year + '/texts/dept_dish/' + dept + '.txt'
			f = open(write_filename, 'w')
			s = '******** ' + dept + ' ********\n'
			f.write(s)
			f.write('\n')
			for item_name in dd[year][dept]:
				s = item_name + '\n'
				f.write(s)
				revenue_list = dd[year][dept][item_name]
				# both revenue_list and months is 12 long
				for i in range(12):
					s = '	' + months[i] + ': $' + str(revenue_list[i]) + '\n'
					f.write(s)
				f.write('\n\n')


if __name__ == '__main__':
	d = convert_txt_file_to_dictionary()
	dd = mk_sth(d)
	write_txt_file(dd)