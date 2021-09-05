import requests

file  = open('../servidor-b/.env', 'r+')
lines = file.readlines()
lines = list(map(
    lambda line: line.replace('\n', '').split('='),
    lines
))
print(lines)
base_url = list(filter(lambda item: item[0] == 'APP_URL', lines))[0][1]
print(base_url)
file.close()

# send post to the server B webhook
r = requests.post(base_url + '/api/webhook')