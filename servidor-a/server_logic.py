import json

class CameraIps:
    """ Cameras do RU 1 """
    ru1_cam1 = 'r1:1'
    ru1_cam2 = 'r1:2'
    ru1_cam3 = 'r1:3'
    ru1_cam4 = 'r1:4'
    ru1_cam5 = 'r1:5'

    ru1= [
        ru1_cam1,
        ru1_cam2,
        ru1_cam3,
        ru1_cam4,
        ru1_cam5,
    ]

    """ Cameras do RU 2 """
    ru2_cam1 = 'r2:1'
    ru2_cam2 = 'r2:2'
    ru2_cam3 = 'r2:3'
    ru2_cam4 = 'r2:4'
    ru2_cam5 = 'r2:5'

    ru2= [
        ru2_cam1,
        ru2_cam2,
        ru2_cam3,
        ru2_cam4,
        ru2_cam5,
    ]

def calc_queue_status(cameras, idx=0):
    """
    Função recursiva que determina o nível de ocupação em uma fila;
    TODO: explicar o pensamento por trás
    """

    if idx == len(cameras) or not cameras[idx]:
        return idx
    else:
        return calc_queue_status(cameras, idx+1)


def test_calc_queue_status():
    """
    teste de get_queue_status()
    """

    V = True
    F = False
    print(calc_queue_status([V,F,F,F,V], 0)) # 1
    print(calc_queue_status([F,F,F,F,V], 0)) # 0
    print(calc_queue_status([F,V,F,F,V], 0)) # 0
    print(calc_queue_status([V,V,F,F,V], 0)) # 2
    print(calc_queue_status([V,V,V,V,V], 0)) # 5
    print(calc_queue_status([V,V,V,V,F], 0)) # 4

def get_queue_info(cam_ips, source):
    cameras = []
    default_lvl = False

    # adicionar as cameras na ordem correta para detectar o status
    for ip in cam_ips:
        if ip in source.keys():
            cameras.append(source[ip])
        else:
            cameras.append(default_lvl)

    
    # verificar o nível da fila através das informações das cameras
    return calc_queue_status(cameras)

def prepare_ru_info(queue_lvls):
    rest_id_key = 'restaurant_id'
    queue_status_key = 'queue_status'

    ru_lvls = []

    # RU 1
    ru_lvls.append(
        {
         rest_id_key : 1,
            queue_status_key : get_queue_info(CameraIps.ru1, queue_lvls)
        }
    )

    # RU 2
    ru_lvls.append(
        {
         rest_id_key : 2,
            queue_status_key : get_queue_info(CameraIps.ru2, queue_lvls)
        }
    )

    return ru_lvls


def send_lvls(queue_lvls):
    return json.dumps(prepare_ru_info(queue_lvls))



def test_send_lvls():
    # pass
    MOCK = {
        "r1:1": True,
        "r1:3": True,
        "r1:2": False,
    }
    print(send_lvls(MOCK))

if __name__ == "__main__" :
    test_send_lvls()