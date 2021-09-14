from circuito import Circuito
import cv2

IP_LISTS = [f'r{i}:{j}' for i in [1, 2] for j in range(1, 6)]


imgs_t1 = { cd.get_ip() : cd.get_image() for cd in cds}
imgs_t2 = { cd.get_ip() : cd.get_image() for cd in cds}
imgs_t3 = { cd.get_ip() : cd.get_image() for cd in cds}
imgs_t1_1 = { cd.get_ip() : cd.get_image() for cd in cds}

cv2.imshow('a',imgs_t1['r1:1'])
cv2.waitKey()