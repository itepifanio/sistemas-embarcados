from crontab import CronTab
cron = CronTab(user='username') #substituir username pelo username usado no sistema em questão
job = cron.new(command='get_image()') #substituir get_image() pela forma que irá requisitar as imagens para os circuitos 
job.minute.every(1) #a imagem será solicitada, nesse caso, a cada 1 minuto
cron.write() #escrevendo no arquivo cron

