#UTM-Penta_IntellST
Scanner thermique intelligent IntellST

Installation Project
1. Checkout
2. cd docker
3. docker-compose up -d
4. docker-compose exec workspace bash
5. composer install

Installation Cron
1. Checkout root
2. sudo apt update
3. sudo apt install cron
4. sudo systemctl enable cron
5. Cron jobs are recorded and managed in a special file known as a crontab. Each user profile on the system can have their own crontab where they can schedule jobs, which is stored under /var/spool/cron/crontabs/.
6. crontab -e
7. choose 1
8. SYMFONY_ENV=prod  * * * * * php /home/UTM-Penta_IntellST/bin/console app:remove-cases 

   example: * * * * * cd /var/www/path/to/symphonyappdir/ && php mysymphonything.php
 
For information: https://www.digitalocean.com/community/tutorials/how-to-use-cron-to-automate-tasks-ubuntu-1804 