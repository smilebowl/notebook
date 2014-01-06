Notebook
====

## History

* `todos.completed` , `todohistories.completed`  date type
* delete `recors.position`

## Nginx設定

```
location /notebook {
    alias D:/!MyWeb/webroot/notebook/webroot;
    index index.php;
    if (!-e $request_filename) {
        rewrite ^(.+)$ /notebook/index.php?q=$1 last;
    }
    location ~ ^/notebook/(.+\.php) {
        fastcgi_pass   127.0.0.1:9000;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $request_filename;
        include fastcgi_params;
    }
}
```

### start.vbs

```
Set objShell = WScript.CreateObject("WScript.Shell")
objShell.CurrentDirectory = "D:\nginx\"
Call objShell.Run("D:\nginx\nginx.exe", 0)
Call objShell.Run("D:\nginx\php\php-cgi.exe -b 127.0.0.1:9000 -c d:\nginx\php\php.ini", 0)
```

### stop.bat

```
@echo off
nginx.exe -s stop
taskkill /f /IM php-cgi.exe
@pause;
```
