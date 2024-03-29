# virtupanel

## Prerequisites

- Apache 2
- PHP 8.0
- sudo

If not installed :
```bash
apt update
apt install sudo apache2 php libapache2-mod-php php-cli php-mysql php-zip php-curl php-xml
```

## Setup

Clone this repository
```bash
git clone https://github.com/Sc4ndium90/virtupanel.git /usr/share/virtupanel
```

In `/etc/apache2/conf-enabled`, create `virtupanel.conf` file and insert :
```cfg
Alias /virtupanel /usr/share/virtupanel
<Directory /usr/share/virtupanel>
	Options Indexes FollowSymLinks
	DirectoryIndex index.php
	Require all granted
</Directory>
```

Modify with `visudo` the rights for www-data user

```cfg
# User privilege specification
www-data ALL:NOPASSWD: /usr/bin/kill, /usr/bin/mkdir, /usr/bin/touch, /usr/bin/rm
```

Put www-data in the `adm` group
```bash
usermod -G adm www-data
```

Restart apache2 to apply these changes

And the web panel is ready ;)


