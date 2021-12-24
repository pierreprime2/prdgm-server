install-deb:
	sudo apt -y install nmap php7.4 php7.4-xml php7.4-json git
routes:
	php bin/console debug:router
cc:
	php bin/console cache:clear
profiler:
	firefox localhost:8000/_profiler
start:
	php bin/console server:start
run:
	php bin/console server:run
stop:
	php bin/console server:stop
log:
	tail -f var/log/dev.log