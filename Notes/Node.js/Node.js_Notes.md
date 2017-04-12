# Node.js的入门与帮助理解
### Node.js是一个是一个可以让 JavaScript 运行在服务器端的平台。
### 与Python\PHP\Ruby等多线程区别：
* 1.采用了单线程、异步式I/O、事件驱动式的程序设计模型；
* 2.Node.js并不是一门独立的语言；
* 3.Node可以作为服务器，不同于Windows下基于PHP的WAMP；


**类似于iOS和Android的系统运行机制：**
		
**安卓系统在运行多任务时，会将多个程序同时缓存在RAM当中，利用多线程、高并发的处理机制，在多核和大RAM下方便多个任务的执行和切换。**


**iOS在运行时只有单独的一个线程，当前任务在执行时会利用资源跑当前任务，多任务时会将非当前的任务“冻结”在后台缓存，保证当前任务的效率和流畅性能。**

这两者的原理是完全不同的，但是思路可以相互借鉴。

在Node.js安装按成后可以使用Node.js的cmd程序来运行、编译js文件：

`node script.js`

其中script为js文件名字。

### 理解Node.js的异步I/O和事件驱动： 

例.

**通过异步方式读取文件：**

<pre><code>
	//FileName:  readFile.js

	var fs=require('fs');	//引入模块fs
	fs.readFile('file.txt','utf-8',function(err,data){	//参数为fileName,转码，回调函数(err,data)为定值，不可能改。
	//当readFile方法读取文件之后解析为utf-8，将结果传递给data
		if(err){
			console.log(err.stack);
		}else{
			console.log(data);	//输出data的值（为file.txt的内容）
		}
	});
	console.log('Run end !');
</pre></code>

**其执行结果为：**
``` 	

	Run end!
	hello node!
	
```

**Run end!显示在data之前的原因：**


**当readFile执行后，会继续运行下面的代码，当readFile执行完毕，会将回调函数内的代码执行，此时’Run end!’已经输出，遍输出在‘Run end!‘后方**

### 利用Node.js“require('http')”来声明服务器：
```
	var http = require('http');	//引用http服务器模块
	var isWebServer=http.createServer(function(request,response){	//创建Server服务器
		response.writeHead(200,{'Content-Type':'text/plain'});		//声明内容类型：纯文本
		response.end('Hello NodeJs!\n');				//输出Hello NodeJs！
});
isWebServer.listen(8888);	//启用监听在8888端口					

		
```
																			编辑于4/12/2017

