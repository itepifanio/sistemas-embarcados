import numpy as np
from const import POINTS


def get_polys(w, h):
  points = dict()
  for name in POINTS.keys():
    points[name] = (POINTS[name][0] * w, POINTS[name][1] * h)

  small_poly = [
    points['A'],
    points['B'],
    points['C'],
    points['D'],
  ]

  big_poly = [
    points['A'],
    points['B'],
    points['E'],
    points['F'],
    points['G'],
  ]

  return small_poly, big_poly


def cross_product(a, b, c):
    x = (a[0] - c[0], a[1] - c[1])
    y = (b[0] - c[0], b[1] - c[1])
    return np.cross(x, y)


def is_point_inside_poly(point, poly):
    crosses = []
    for i in range(len(poly)):
        a = i
        b = i - 1 if i > 0 else len(poly) - 1
        crosses.append(cross_product(poly[a], poly[b], point))
    return len(set((x/abs(x) for x in crosses))) == 1


def get_mid_point(a, b):
    return ((a[0]+b[0]) // 2, (a[1]+b[1]) // 2)


def get_lower_points(x, y, x_plus_w, y_plus_h):
    return [(x, y_plus_h), (x_plus_w, y_plus_h)]