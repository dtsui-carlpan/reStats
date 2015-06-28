import os
from os import listdir

# running this file can rename every csv file in the data/month_year folder whose name contains 'Table 1',
# an unfortuante name that numbers decides to add onto the output file name


def find_csv_filenames(path_to_dir, suffix):
    filenames = listdir(path_to_dir)
    return [filename for filename in filenames if filename.endswith(suffix)]

def clean_csv_filename():
	# . specifies current directory
	# folders will be: 2014, 2015
	years = listdir('data/')

	suffix = '.csv'
	for year in years:
		months = listdir('data/' + year)
		for month in months:
			path_to_dir = 'data/' + year + '/' + month + '/'
			csv_filenames = find_csv_filenames(path_to_dir, suffix)

			for csv_filename in csv_filenames:
				if 'Table' in csv_filename:
					# a space is represented differently in the command line
					old_csvfile_name = path_to_dir + csv_filename.split('-')[0] + '-Table\ 1.csv'
					new_csv_filename = path_to_dir + csv_filename.split('-')[0] + '.csv'
					script = 'mv ' + old_csvfile_name + ' ' + new_csv_filename
					print script
					os.system(script)

if __name__ == '__main__':
	clean_csv_filename()