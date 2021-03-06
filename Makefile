WEB_DIR = /var/www/html
CONFIG_DIR = /usr/local/etc
WEB_FILES = $(WEB_DIR)/drawing.js $(WEB_DIR)/drawing_page.html $(WEB_DIR)/save_drawing.php $(WEB_DIR)/show_drawing.php $(WEB_DIR)/show_latest.php

all: update

$(CONFIG_DIR)/drawingsdb_config.php: drawingsdb_config.php
	cp $< $@
	chown www-data.www-data $@
	chmod 600 $@

$(WEB_DIR)/%: %
	cp $< $@

update: $(CONFIG_DIR)/drawingsdb_config.php $(WEB_FILES)
	@[ -d $(WEB_DIR)/imgs ] || mkdir $(WEB_DIR)/imgs

dbinstall:
	mysql < setup.sql
