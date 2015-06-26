# a set of rgb values of some beautiful colors

creamy_green = (152, 223, 138)
creamy_orange = (255, 193, 86)
light_blue = (162, 200, 236)
teal = (23, 190, 207)
maroon = (200, 82, 0)
grey = (143, 135, 130)

colors = [creamy_green, creamy_orange, light_blue, maroon, teal, grey]

# converts each value in the rgb tuple from 0 - 255 to 0 - 1
def rgb_scale_down(colors):
	final = []
	for c in colors:
		tup = (float(c[0])/255.0, float(c[1])/255.0, float(c[2])/255.0)
		final.append(tup)
	return final

