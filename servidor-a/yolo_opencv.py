import cv2
import numpy as np
import os

CONFIG = "yolov3.cfg"
WEIGHTS = "yolov3.weights"
CLASSES = "yolov3.txt"

def get_output_layers(net):
    layer_names = net.getLayerNames()
    output_layers = [layer_names[i[0] - 1] for i in net.getUnconnectedOutLayers()]
    return output_layers


def draw_prediction(img, x, y, x_plus_w, y_plus_h):
    cv2.rectangle(img, (x,y), (x_plus_w,y_plus_h), (255, 255, 255), 2)

def load_classes():
    classes = None
    with open(CLASSES, 'r') as f:
        classes = [line.strip() for line in f.readlines()]
    return classes

def get_persons_rects(net, image, classes):
    Width = image.shape[1]
    Height = image.shape[0]
    scale = 0.00392

    
    blob = cv2.dnn.blobFromImage(image, scale, (416,416), (0,0,0), True, crop=False)

    net.setInput(blob)

    outs = net.forward(get_output_layers(net))

    class_ids = []
    confidences = []
    boxes = []
    conf_threshold = 0.5
    nms_threshold = 0.4


    for out in outs:
        for detection in out:
            scores = detection[5:]
            class_id = np.argmax(scores)
            confidence = scores[class_id]
            if classes[class_id] == "person" and confidence > 0.5:
                center_x = int(detection[0] * Width)
                center_y = int(detection[1] * Height)
                w = int(detection[2] * Width)
                h = int(detection[3] * Height)
                x = center_x - w / 2
                y = center_y - h / 2
                class_ids.append(class_id)
                confidences.append(float(confidence))
                boxes.append([x, y, w, h])


    indices = cv2.dnn.NMSBoxes(boxes, confidences, conf_threshold, nms_threshold)

    rects = []
    for i in indices:
        i = i[0]
        box = boxes[i]
        x = box[0]
        y = box[1]
        w = box[2]
        h = box[3]

        rects.append((round(x), round(y), round(x+w), round(y+h)))
    return rects


def draw_poly(img, poly, color):
    pts = np.array(poly, np.int32)
    pts = pts.reshape((-1,1,2))
    cv2.polylines(img,[pts],True,color)


net = cv2.dnn.readNet(WEIGHTS, CONFIG)

W = 1200
H = 800

rectPoints = {
    'A' : [0.31, 0.41250],
    'B' : [0.5, 0.6875],
    'C' : [0.33, 0.6875],
    'D' : [0.208, 0.4125],
    'E' : [0.54, 0.85],
    'F' : [0.208, 0.85],
    'G' : [0.11, 0.4375],
}

POLY_A = [
    rectPoints['A'],
    rectPoints['B'],
    rectPoints['C'],
    rectPoints['D'],
]

POLY_B = [
    rectPoints['D'],
    rectPoints['C'],
    rectPoints['B'],
    rectPoints['E'],
    rectPoints['F'],
    rectPoints['G'],
]

for name, point in rectPoints.items():
    rectPoints[name][0] = rectPoints[name][0] * W
    rectPoints[name][1] = rectPoints[name][1] * H

for f in os.listdir('.'):
    if not "jpg" in f: continue
    image = cv2.imread(f)
    image = cv2.resize(image, (W, H), interpolation = cv2.INTER_AREA)
    classes = load_classes()

    rects = get_persons_rects(net, image, classes)
    for rect in rects:
        draw_prediction(image, *rect)

    draw_poly(image, POLY_A, (255, 0, 0))
    draw_poly(image, POLY_B, (0, 255, 0))

    cv2.imshow("object detection", image)
    cv2.waitKey()
    
    
cv2.destroyAllWindows()
