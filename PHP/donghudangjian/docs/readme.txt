 ----------------------------------------
|     WaiKuCMS 产品使用说明             |
 ----------------------------------------

一、平台需求
1.Windows 平台：
IIS/Apache/Nginx + PHP5 + + MySQL4/5
如果在windows环境中使用，建议用WAMPServer等相关服务器集成软件.

2.Linux/Unix 平台
Apache + PHP5 + MySQL4/5 (PHP必须在非安全模式下运行)

建议使用平台：Linux + Apache2.2 + PHP5.2/PHP5.3 + MySQL5.0

3.PHP必须环境或启用的系统函数：
GD扩展库
MySQL扩展库
系统函数 —— phpinfo、dir

4.基本目录结构
/
..../install     安装程序目录，安装完后可删除[安装时必须有可写入权限]
..../Admin        后台管理项目(应用)
..../Web     	  前台显示项目(应用)
..../User     	  用户中心项目(应用)
..../Public       公共文件夹
..../Core     ThinkPHP框架
..../index.php    前台项目单一入口文件
..../admin.php    后台项目单一入口文件
..../user.php    后台项目单一入口文件

5.PHP环境容易碰到的不兼容性问题
  (1)Public/Uploads目录没有写入权限,将导致系统相关附件上传功能不能使用；
  (2)伪静态设置详情见:rewrite.txt

二、程序安装使用
1.下载程序解压到本地目录;
2.上传程序目录中的/uploads到网站根目录
3.运行http://www.yourname.com/install/index.php(yourname表示你的域名),按照安装提速说明进行程序安装
 
三、相关资源
WaiKuCMS官方主站       www.waikucms.com
WaiKuCMS官方论坛       bbs.waikucms.com