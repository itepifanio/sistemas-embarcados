import requests
import json

def send_ru_status(requestBody):
    with open('../servidor-b/.env', 'r+') as file:
        lines = file.readlines()
        lines = list(map(
            lambda line: line.replace('\n', '').split('='),
            lines
        ))
        base_url = list(filter(lambda item: item[0] == 'APP_URL', lines))[0][1]

    # send post to the server B webhook
    r = requests.post(base_url + '/api/queue-status/', json=json.loads(requestBody))