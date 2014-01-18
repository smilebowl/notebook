Notebook
====

## Migrations

### generate

```
cake Migrations.migration generate -f
```

### run

```
cake Migrations.migration run
or
cake Migrations.migration run all
or
cake Migrations.migration run all -p
```

## Nginx設定

```
location /notebook {
    alias D:/!MyWeb/webroot/notebook/webroot;
    index index.php;
    if (!-e $request_filename) {
        rewrite ^(.+)$ /notebook/index.php?q=$1 last;
    }
    location ~ \.php$ {
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
Set objEnv = objShell.Environment("Volatile")
objEnv.Item("PHP_FCGI_MAX_REQUESTS") = 0
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
