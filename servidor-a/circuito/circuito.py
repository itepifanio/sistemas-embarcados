import cv2

class Circuito:

    def __init__(self, ip):
        self.ip = ip
        self.t = 1

    def get_ip(self):
        return self.ip

    def get_image(self):
        r = self.ip.split(":")[0]
        img = self.ip.split(":")[-1]
        path = f"circuito/imgs/{r}/t{self.t}/{img}.jpg"
        print(f"Getting image from {path}!")

        self.t = 1 if self.t == 3 else self.t + 1

        return cv2.imread(path)

IP_LISTS = [f'r{i}:{j}' for i in [1, 2] for j in range(1, 6)]
CIRCUITS = [Circuito(ip ) for ip in IP_LISTS]