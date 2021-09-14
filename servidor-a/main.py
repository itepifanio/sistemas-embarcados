import time
from circuito.circuito import CIRCUITS
from img_processing.processor import process_images
from server_logic import send_lvls
from webhook import send_ru_status


def main():
  while True:
    imgs_from_ips = dict()
    for c in CIRCUITS:
      imgs_from_ips[c.get_ip()] = c.get_image() # carregar a imagem usando opencv

    queue_lvls = process_images(imgs_from_ips)


    send_ru_status(send_lvls(queue_lvls))
    time.sleep(1)


if __name__ == "__main__":
  main()