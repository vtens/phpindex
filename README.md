#### 项目介绍

> phpindex 是替换php环境下默认主页的一种解决方案, 感兴趣朋友可以共同完善这个项目.

#### 配置教程
APACHE 配置修改 (httpd.conf)

Options Indexes FollowSymLinks (去掉Indexes)

ErrorDocument 404 /?error

ErrorDocument 403 /?error

NGINX 配置修改(nginx.conf)

error_page 404 403 /?error;

#### 使用说明

直接下载此 index.php 文件至网站根目录即可, 子目录无需添加.

#### 使用技巧

1. @ 开头的文件夹, 会隐藏不显示
2. 搜索框可以即时显示搜索的项目文件夹, 当显示为第一个时,直接回车即可打开.
3. 密码登录功能,更好地保护你的项目. (密码为 123 + 当天星期几数字, 比如 1237)
4. 非局域网用户禁止访问, 同时加入白名单wlist,允许部分外网或内网访问.
5. 内网手机可以扫描二维码进行多平台测试.
6. 404提示错误页面
7. 403提示禁止访问
8. 当项目下没有主页,会提醒创建主页
9. 子目录深度为3层, 防止项目子目录过多问题, 优化你的项目
10. 更多...

#### 部分截图

![1.png](https://i.loli.net/2018/06/30/5b371e26ec0e4.png)
![5.png](https://i.loli.net/2018/06/30/5b371e27a3c5b.png)
![2.png](https://i.loli.net/2018/06/30/5b371e27a3d91.png)
![6.png](https://i.loli.net/2018/06/30/5b371e27a3f23.png)
![4.png](https://i.loli.net/2018/06/30/5b371e27a3f9e.png)
![7.png](https://i.loli.net/2018/06/30/5b371e27a3a07.png)
![3.png](https://i.loli.net/2018/06/30/5b371e27ad42e.png)
