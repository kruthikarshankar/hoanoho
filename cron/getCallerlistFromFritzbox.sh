#!/bin/bash

# CSV runterladen
php -f /var/www/hoanoho/includes/fritzbox_api/fritzbox_get_foncallslist.php &>/dev/null

# php zum import in mysql aufrufen
php -f /var/www/hoanoho/includes/import_anruferliste.php &> /dev/null