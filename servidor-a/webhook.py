import requests

def send_ru_status(requestBody):
    with open('../servidor-b/.env', 'r+') as file:
        lines = file.readlines()
        lines = list(map(
            lambda line: line.replace('\n', '').split('='),
            lines
        ))
        print(lines)
        base_url = list(filter(lambda item: item[0] == 'APP_URL', lines))[0][1]
        print(base_url)

    # send post to the server B webhook
    r = requests.post(base_url + '/api/webhook', json=requestBody)
    # print(r.status_code)