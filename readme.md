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
