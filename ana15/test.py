def read_sashimi_data(f):
    data = {}
    with open(f) as csvfile:
        datareader = csv.reader(csvfile,delimiter=',',skipinitialspace=True)
        next(datareader,None)
        for row in datareader:
            if row[ITEM_ID] == ' ': 
                break
            else:
                if row[USED_AMOUNT] < 0:
                    aggregate = row[LEFTOVER_AMOUNT]
                else:
                    aggregate = row[STARTING_AMOUNT]

                data[row[ITEM_ID]] = {'item':row[ITEM_NAME], 'aggregate':float(row[aggregate]),
                        'unsold':float(row[LEFTOVER_VALUE]), 'sold':float(row[USED_VALUE])}
        return data
