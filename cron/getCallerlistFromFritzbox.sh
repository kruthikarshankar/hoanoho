#!/bin/bash

# CSV runterladen
php -f ${HOANOHO_DIR}/includes/fritzbox_api/fritzbox_get_foncallslist.php &>/dev/null

# php zum import in mysql aufrufen
php -f ${HOANOHO_DIR}/includes/import_anruferliste.php &> /dev/null