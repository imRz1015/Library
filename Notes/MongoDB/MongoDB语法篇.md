# MongoDB语法篇 #

2017/11/28 17:06:50 TANGIMING

## 基础：增删改查 ##

### 创建数据库： ###

	use DATABASE_NAME

如果数据库不存在，则创建数据库，否则切换到指定数据库。

### 查看所有数据库： ###

	show dbs

Tips:新增的数据库如果没有数据的话是不会显示的。

### 插入文档： ###

	db.COLLECTION_NAME.insert(document)

例子：

	db.col.insert({ 
	    description: 'MongoDB 是一个 Nosql 数据库',
	    tags: ['mongodb', 'database', 'NoSQL'],
	    likes: 100
	})

col 是我们的集合名（表名），如果该集合不在该数据库中， MongoDB 会自动创建该集合并插入文档

### 查看文档： ###

	db.COLLECTION_NAME.find({})

{}为空则查看该文档所有集合

也可以保存一个变量再插入：

	document=({title: 'MongoDB 教程', 
	    description: 'MongoDB 是一个 Nosql 数据库',
	    tags: ['mongodb', 'database', 'NoSQL'],
	    likes: 100
	});

	db.col.insert(document)

 db.COLLECTION_NAME.insertOne():向指定集合中插入一条文档数据

 db.COLLECTION_NAME.insertMany():向指定集合中插入多条文档数据

### 更新、修改文档： ###

#### update() 方法用于更新已存在的文档。语法格式如下： ####

	db.collection.update(
	   <query>,
	   <update>,
	   {
	     upsert: <boolean>,
	     multi: <boolean>,
	     writeConcern: <document>
	   }
	)

query : update的查询条件，类似sql update查询内where后面的。


update : update的对象和一些更新的操作符（如$,$inc...）等，也可以理解为sql update查询内set后面的

upsert、multi、writeConcern可选

语法例子：

	db.col.update({'title':'MongoDB 教程'},{$set:{'title':'MongoDB'}})

将MongoDB 教程修改为MongoDB

#### 修改数组某一个值的方法: ####

	db.userInfo.update({"test.name":"q1777"},{$set:{"test.$.age":"999"}})

"test.name":"q1777"为查询条件，指test数组下name=q1777的元素；

$set：修改符

"test.$.age":"999"：这个$在这里表示下标，如果你明确知道下标，可以直接写出来，比如：

	"test.1.age":"88"

但是大多数时候我们是不知道下标的，所以用$代替，指向被查找到的元素下标

#### save() 方法通过传入的文档来替换已有文档。语法格式如下： ####

	db.collection.save(
	   <document>,
	   {
	     writeConcern: <document>
	   }
	)

document : 文档数据。

语法例子：

	db.col.save({
	    "_id" : ObjectId("56064f89ade2f21f36b03136"),
	    "title" : "MongoDB",
	    "description" : "MongoDB 是一个 Nosql 数据库",
	    "tags" : [
	            "mongodb",
	            "NoSQL"
	    ],
	    "likes" : 110
	})

db.collection.updateOne() 向指定集合更新单个文档

db.collection.updateMany() 向指定集合更新多个文档

### 删除文档： ###

删除文档（主要）：
	
	db.userInfo.update({"name":"qqq"},{"$pull":{"address":{"name":"q2"}}})
name=qqq为查询条件
$pull为删除
address为数组

删除集合下全部文档

	db.collection.deleteMany({})

删除 status 等于 A 的全部文档：

	db.inventory.deleteMany({ status : "A" })

删除 status 等于 D 的一个文档：

	db.inventory.deleteOne( { status: "D" } )


### 查询文档： ###

	db.collection.find(query, projection)

条件为空则返回该集合所有文档

### 导入、导出表 ###

#### 导入表 ####

先将需要导入的表格保存为csv格式或者json格式，然后执行控制台命令:

	mongoimport -d test -c res --type csv --headerline --file D:\test.csv

-d：数据库名称;

-c：集合名称（表名称）;

--type：导入的表类型，csv或者JSON;

--headerline：将第一行作为字段名称，是列名

--file：导入的文件路径

#### 导出表 ####

	mongoexport -d test -c res -o D:\result.csv

-d：数据库名称;

-c：集合名称（表名称）;

-o：导出的路径和格式