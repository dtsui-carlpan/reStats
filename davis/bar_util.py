# coding: utf-8

# with this type of format, everything works but you can't print each chinese
# word independently

hard_liquor = ['路易', '轩尼诗', '轩尼诗', '马爹利', '香槟', '威士忌']

red_white_wine = ['奔富', '拉菲', '柏图斯', '拉图', '杰卡斯西拉', '红葡萄', '奇异庄园']

chinese_wine = ['花雕', '茅台', '五粮液', '日本盛', '梅鹿液']

beer = ['喜力', '青岛']

fruit = ['木瓜', '西瓜', '火龙果', '提子', '淮山', '杞子', '甘草', '西柠', '柚', '茶',
		 '枣', '芷扬', '陈皮', '橙', '桔', '果']

soft_drinks = ['水', '可乐', '雪碧', '汁', '菊花', '茶']

# both liquor_name and each word in the three lists above are in unicode
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

# if __name__ == '__main__':
# 	liquor_name = '大号马爹利X.O'
# 	deter_liquor(liquor_name)
