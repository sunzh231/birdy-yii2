server {
    listen       8000;
    server_name  localhost;

    root   "D:/work/www/birdy-dev/api-server/web";
    index  index.html index.htm index.php;

    #charset koi8-r;

    location / {
      proxy_pass http://localhost:8001;
    }

    location /api {
      try_files $uri $uri/ /index.php?$args;
    }

    location /webapp {
      proxy_pass http://localhost:8002/;
    }

    location /webapp/static/ {
      alias "D:/work/www/birdy-dev/mobile-ui/dist/static/";
    }

    # pass the PHP scripts to FastCGI server listening on 127.0.0.1:9000
    location ~ \.php(.*)$  {
            fastcgi_pass   127.0.0.1:9000;
            fastcgi_index  index.php;
            fastcgi_split_path_info  ^((?U).+\.php)(/?.+)$;
            fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
            fastcgi_param  PATH_INFO  $fastcgi_path_info;
            fastcgi_param  PATH_TRANSLATED  $document_root$fastcgi_path_info;
            include        fastcgi_params;
        }

    # deny access to .htaccess files, if Apache's document root
    # concurs with nginx's one
    #
    location ~ /\.(ht|svn|git) {
      deny  all;
    }
  }


  server {
    listen       8001;
    server_name  localhost;

    #charset koi8-r;

    location / {
      root   "D:/work/www/birdy-dev/admin-ui/dist";
      index  index.html index.htm;
    }

    # deny access to .htaccess files, if Apache's document root
    # concurs with nginx's one
    #
    location ~ /\.(ht|svn|git) {
      deny  all;
    }
  }

  server {
    listen       8002;
    server_name  localhost;

    #charset koi8-r;

    location / {
      root   "D:/work/www/birdy-dev/mobile-ui/dist";
      index  index.html index.htm;
    }

    location /static/ {
      alias "D:/work/www/birdy-dev/mobile-ui/dist/static/";
    }

    # deny access to .htaccess files, if Apache's document root
    # concurs with nginx's one
    #
    location ~ /\.(ht|svn|git) {
      deny  all;
    }
  }