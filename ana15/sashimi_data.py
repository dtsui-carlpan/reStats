# coding: utf-8

import csv
import numpy as np
import matplotlib.pyplot as plt
import matplotlib.patches as mpatches
import matplotlib.cm as cm
import pylab
import sys

# Field number 
ITEM_ID = 0
ITEM_NAME = 1
ITEM_SIZE = 2
ITEM_UNIT = 3
STARTING_AMOUNT = 5
LEFTOVER_AMOUNT = 6
USED_AMOUNT =  7
ITEM_PRICE = 8
LEFTOVER_VALUE = 9 
USED_VALUE = 10

# All csv file names under seafood department
csvfile_name15 = ['../../data15/Jan/seafood/sashimi.csv',
                  '../../data15/Feb/seafood/sashimi.csv',
                  '../../data15/March/seafood/sashimi.csv',
                  '../../data15/April/seafood/sashimi.csv']
#months = ['Jan', 'Feb', 'March', 'April']#, 'May', 'Jun', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']

csvfile15 = {'Jan': '../data15/Jan/seafood/sashimi.csv',
             'Feb': '../data15/Feb/seafood/sashimi.csv',
             'March': '../data15/March/seafood/sashimi.csv',
             'April': '../data15/April/seafood/sashimi.csv'}

def autolabel(rects, ax):
    for rect in rects:
        height = rect.get_height()
        ax.text(rect.get_x()+rect.get_width()/2., 1.05*height, '%d'%int(height),
                ha='center', va='bottom')

##################################
# Importing data to dictionaries #
##################################

# reading section sales data
def read_section_sale(f):
    leftover = 0
    used = 0
    data = {}
    with open(f) as csvfile:
        datareader = csv.reader(csvfile,delimiter=',',skipinitialspace=True)
        #datareader = csv.reader(utf_8_encoder(csvfile),delimiter=',',skipinitialspace=True)
        next(datareader,None)
        for row in datareader:
            if row[ITEM_ID] != '':
                continue
            leftover = row[LEFTOVER_VALUE].replace(',','') 
            used = row[USED_VALUE].replace(',','')
            data[unicode(row[ITEM_NAME], 'utf-8')] = {'unsold':float(leftover), 'sold': float(used),
                                'bought':float(leftover)+float(used)}
        return data


# create dictionary with all month sale data
def compile_month_data(months):
    meat = {}
    vegetable = {}
    product = {} 
    for month in months:
        # get per-month data dictionary
        csvfile = csvfile15[month]
        data = read_section_sale(csvfile)
        # fill the dictionaries defined
        meat[month] = data[u'肉类'].get('sold')
        vegetable[month] = data[u'蔬菜'].get('sold')
        product[month] = data[u'食品'].get('sold')
    # plotting 
    ind = np.arange(len(months))
    width = 0.25
    fig, ax = plt.subplots()
    # meat
    meat_plot = ax.bar(ind, meat.values(), width, color='r')
    # vegetable
    vege_plot = ax.bar(ind+width, vegetable.values(), width, color='b')
    # product
    product_plot = ax.bar(ind+2*width, product.values(), width, color='y')      
    # add labels etc
    ax.set_xticks(ind+width)
    ax.set_xticklabels(tuple(months))
    # legend
    ax.legend((meat_plot[0], vege_plot[0], product_plot[0]), (u'肉类',u'蔬菜',u'食品'))
    # auto label
    autolabel(meat_plot, ax)
    autolabel(vege_plot, ax)
    autolabel(product_plot, ax)
    
    return plt      
            

def plot_section_sold(d):
    category = {}
    for id_key in d:
        category[id_key] = d[id_key].get('sold')
    # plotting
    plt.bar(range(len(category)), category.values(), align="center")
    plt.xticks(range(len(category)), list(category.keys()))
    plt.xlabel("Category")
    return plt

def plot_section_sold_percentage(d):
    percent= {}
    percentage = 0
    for id_key in d:
        percentage = d[id_key].get('sold')/d[id_key].get('bought')
        percent[id_key] = percentage
    # sorting and make list
    percent_list = sorted(percent.values())
    label_list = sorted(percent,key=percent.get)
    # plotting pie chart
    fig = plt.figure(0,figsize=(8,8))
    #cs = cm.Set1(np.arange(22)/22.)
    cs = ['yellowgreen', 'gold', 'lightskyblue']
    ax = fig.add_subplot(111,aspect='equal')
    plt.pie(percent_list, labels=label_list, colors = cs, autopct='%1.1f%%')
    return plt



def main():
    #if len(sys.argv) == 2:
    #    infile = sys.argv[1]

    months = ['Jan', 'Feb', 'March', 'April']
    canvas = compile_month_data(months)
    canvas.show()
    # save file to output

    # Read in data 
    #section_sold_data = read_section_sale(infile)

    ###########################################
    # Compare section sold amount (per month) #
    ###########################################
    # plot the data
    #section_sold_canvas = plot_section_sold(section_sold_data)
    #section_sold_canvas.show()

    ###################################
    # Compare section sold percentage #
    ###################################
    #section_percent_canvas = plot_section_sold_percentage(section_sold_data)
    #section_percent_canvas.show()

    ################################
    # Compare section sold monthly #
    ################################
    

if __name__ == '__main__':
    main()







    
    
    
            
