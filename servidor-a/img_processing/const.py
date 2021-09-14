import cv2

CONFIG_FILE = "yolov3.cfg"
WEIGHTS_FILE = "yolov3.weights"
CLASSES_FILE = "yolov3.txt"

POINTS = {
    'A' : [0.31, 0.41250],
    'B' : [0.5, 0.6875],
    'C' : [0.33, 0.6875],
    'D' : [0.208, 0.4125],
    'E' : [0.54, 0.85],
    'F' : [0.208, 0.85],
    'G' : [0.11, 0.4375],
}

CONF_THRESHOLD = 0.5
NMS_THRESHOLD = 0.4
W = 1200
H = 800


NET = cv2.dnn.readNet(WEIGHTS_FILE, CONFIG_FILE)

def load_classes():
    classes = None
    with open(CLASSES_FILE, 'r') as f:
        classes = [line.strip() for line in f.readlines()]
    return classes

CLASSES = load_classes()