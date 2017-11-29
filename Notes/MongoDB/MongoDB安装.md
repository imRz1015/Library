# MongoDB安装部署踩坑攻略 #


## 1.下载安装 ##

在下载之后直接下一步安装

安装完毕之后，数据库的数据目录结构会储存在db目录下，**这个目录是不会自动创建的，需要我们主动创建**

在C盘或者D盘根目录下创建data文件夹，在data文件夹内创建db文件夹和log文件夹，conf文件夹



## 命令行下运行 MongoDB 服务器 ##


在命令行下运行有几个注意的点（坑）：


- 必须用管理员身份运行cmd；
- 运行前必须要在你想存放你的数据库的地方先创建号上面的几个文件夹
- 为了防止每一次使用命令行运行mongoDB都要cd到相应路径，可以将其添加到环境变量

在环境变量-系统变量-path中，新增一个变量，值为安装的mongoDB的路径，比如我的环境变量值为：

	C:\Program Files\mongoDB\3.4\bin

就可以在cmd中直接运行而不需要cd到该目录下。

### 启动： ###

主要的为 1.mongod   启动数据库服务 ；  2.mongo 启动mongo命令行

启动服务：

	mongod --dbpath=D:\mongodb\db
	dbpath就是刚才你创建的文件夹里的db路径，为数据库路径	

好了，现在数据库已经启动了，你可以在命令行里面为所欲为了！

坑爹的是.......

当你关闭命令行的时候，emmmm.......数据库也会跟着关闭了...

所以我们需要将它作为系统服务的形式后台运行，一直保持打开的状态：

	mongod --dbpath=D:\mongodb\db --logpath=D:\mongodb\log\MongoDB.log --install --serviceName "MongoDB"

	dbpath为数据库路径，logpath为日志文件路径
	以上语句意思为，启动数据库mongodb\db，日志文件为MongoDB.log,安装为系统服务

等待完成之后，直接嘀嘀嘀：

	net start MongoDB

输入之后，就会提示成功啦，这样关闭命令行也不会关闭数据库了。








