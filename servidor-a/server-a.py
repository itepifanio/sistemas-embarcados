# based on https://stackoverflow.com/a/33671049

from bottle import route, run

@route('/queue')
def hello():
    return {"maria": 123}

run(host='localhost', port=8080, debug=True)