import cv2
import numpy as np
import os
from .const import NET, CLASSES, W, H
from .geometry import get_lower_points, get_mid_point, is_point_inside_poly, get_polys
from .yolo import get_persons_rects



def draw_prediction(img, x, y, x_plus_w, y_plus_h):
    cv2.rectangle(img, (x,y), (x_plus_w,y_plus_h), (255, 255, 255), 2)


def draw_poly(img, poly, color):
    pts = np.array(poly, np.int32)
    pts = pts.reshape((-1,1,2))
    cv2.polylines(img,[pts],True,color)


def process_image(image, classes, net, img_shape, big_poly, small_poly, show_image=False):
    image = cv2.resize(image, img_shape, interpolation = cv2.INTER_AREA)
    
    countInsideSmall = 0
    countInsideBig = 0

    rects = get_persons_rects(net, image, classes)
    for rect in rects:
        feet = get_lower_points(*rect)
        mid_point = get_mid_point(*feet)
        
        in_big = is_point_inside_poly(mid_point, big_poly)
        in_small = is_point_inside_poly(mid_point, small_poly)

        if in_big:
            countInsideBig += 1
            if in_small: countInsideSmall += 1

            if show_image:
                draw_prediction(image, *rect)
                if in_small: cv2.circle(image, mid_point, 2, (255, 0, 0), 2)
                else: cv2.circle(image, mid_point, 2, (0, 0, 255), 2)

    if show_image:
        draw_poly(image, big_poly, (255, 0, 0))
        draw_poly(image, small_poly, (0, 255, 0))
        cv2.imshow("object detection", image)
        cv2.waitKey()
        cv2.destroyAllWindows()

    return (countInsideSmall > 0 and countInsideBig > countInsideSmall)


def process_images(imgs):
    small_poly, big_poly = get_polys(W, H)

    outputs = dict()
    for name, img in imgs.items():
      outputs[name] = process_image(img, CLASSES, NET, (W, H), big_poly, small_poly)

    return outputs


def main_test():
  imgs = dict()
  for f in os.listdir('imgs'):
    if not "jpg" in f: continue
    f = os.path.join('imgs', f)

    imgs[f] = cv2.imread(f)

  print(process_images(imgs))

    

if __name__ == "__main__":
  main_test()
    
