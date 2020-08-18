L01 Laravel 教程 - Web 开发实战入门 的实操代码

部署:

1.git clone
```
git clone git@github.com:xgq07/learnku_weibo.git
```

2.给文件夹权限
```
chmod -R learnku_weibo
```

3.composer 安装后生成vendor文件夹
```
composer install 
```

4..env文件生成
```
cp .env.example .env
```

5.生成APP_KEY
```
php artisan key:generate
```
6.安装对应版本的fpm
```
sudo apt-get install php7.2-fpm
```
7.nginx 配置
```
server {
        # 监听 HTTP 协议默认的 [80] 端口。
        listen 8000;
        # 绑定主机名 [example.com]。
        server_name 122.51.23.117;
        # 服务器站点根目录 [/example.com/public]。
        root /home/ubuntu/php/learnku_weibo/public;

        # 添加几条有关安全的响应头；与 Google+ 的配置类似，详情参见文末。
        add_header X-Frame-Options "SAMEORIGIN";
        add_header X-XSS-Protection "1; mode=block";
        add_header X-Content-Type-Options "nosniff";

        # 站点默认页面；可指定多个，将顺序查找。
        # 例如，访问 http://example.com/ Nginx 将首先尝试「站点根目录/index.html」是否存在，不存在则继续尝试「站点根目录/index.htm」，以此类推...
        index index.html index.htm index.php;

        # 指定字符集为 UTF-8
        charset utf-8;

        # Laravel 默认重写规则；删除将导致 Laravel 路由失效且 Nginx 响应 404。
        location / {
            try_files $uri $uri/ /index.php?$query_string;
        }

        # 关闭 [/favicon.ico] 和 [/robots.txt] 的访问日志。
        # 并且即使它们不存在，也不写入错误日志。
        location = /favicon.ico { access_log off; log_not_found off; }
        location = /robots.txt  { access_log off; log_not_found off; }

        # 将 [404] 错误交给 [/index.php] 处理，表示由 Laravel 渲染美观的错误页面。
        error_page 404 /index.php;

        # URI 符合正则表达式 [\.php$] 的请求将进入此段配置
        location ~ \.php$ {
            # 配置 FastCGI 服务地址，可以为 IP:端口，也可以为 Unix socket。
            #fastcgi_pass unix:/run/php/php7.2-fpm.sock;
            fastcgi_pass 127.0.0.1:9000;
            # 配置 FastCGI 的主页为 index.php。
            fastcgi_index index.php;
            # 配置 FastCGI 参数 SCRIPT_FILENAME 为 $realpath_root$fastcgi_script_name。
            fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
            # 引用更多默认的 FastCGI 参数。
            include fastcgi_params;
        }
        # 通俗地说，以上配置将所有 URI 以 .php 结尾的请求，全部交给 PHP-FPM 处理。

        # 除符合正则表达式 [/\.(?!well-known).*] 之外的 URI，全部拒绝访问
        # 也就是说，拒绝公开以 [.] 开头的目录，[.well-known] 除外
        location ~ /\.(?!well-known).* {
            deny all;
        }
    }
```
8.启动nginx与fpm
```
sudo service php-fpm start
sudo sbin/nginx -c conf/laravel.conf
```

9.生成测试数据
```
php artisan migrate:refresh --seed
```
10.密码 123456
```
$2y$10$eYpg0d2Ni84ZCxQxs2pm2ukK4LJZBMVK0hQnSH0RCbpYhkT6WPo2u
```
---
前端页面

1.导入bootstrap
```
npm cache clear --force
npm install cross-env
npm install
```
2.生成css
```
npm run dev

一直监测:
npm run watch-poll
```
