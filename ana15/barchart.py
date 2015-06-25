#coding: utf-8
import matplotlib.pyplot as plt

d = {u'肉类':2049.60, u'蔬菜':1629.63, u'食品':6444.31}

print d.values()

plt.bar(range(len(d)), d.values(), align='center')
plt.xticks(range(len(d)), list(d.keys()))

plt.show()
