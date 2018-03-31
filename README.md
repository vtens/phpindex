# PHPINDEX
> PHPINDEX 是WINDOWS下WEB开发环境下默认INDEX文件列表的替换入口, 一直个人使用, 现在共享大家使用. 同时希望有能力的开发者可以共同完善这个项目.
---

==用法==
- 下载index.php文件, 放入网站根目录即可.
- APACHE配置文件(httpd.conf)修改3处
1. Options Indexes FollowSymLinks (去掉Indexes)
2. ErrorDocument 404 /?error (没有添加)
3. ErrorDocument 403 /?error (没有添加)
- 如果获取服务器局域网IP失败, 请自行检查exec函数是否开启?
