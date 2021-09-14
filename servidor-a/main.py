import CircuitManager


cm = CircuitManager()
IP_LISTS = [
  "r1:1", # camera 1 do r1
]

def main():
  imgs_from_ips = dict()
  for ip in IP_LISTS:
    imgs_from_ips[ip] = cm.get_img(ip) # carregar a imagem usando opencv

  queue_lvls = process_imgs(imgs_from_ips)

  send_lvls(queue_lvls)


if __name__ == "__main__":
  main()