### 1. install composer
https://getcomposer.org/download/

### 2. run command
```
php composer.phar create-project hostlink/property-project public_html
```

dev mode
```
php composer.phar create-project hostlink/property-project:dev-main public_html
```



### 3. install api
```
cd api
php composer.phar install
```


### 4. install cms
```
cd cms
php composer.phar install
```

### 5. change base path and config
```
cms/vendor/mathsgod/puxt-vx/www/index.html
cms/vendor/mathsgod/puxt-vx/www/config.json
```



