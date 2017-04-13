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


    	Run end!
    	hello node!
	


**Run end!显示在data之前的原因：**


**当readFile执行后，会继续运行下面的代码，当readFile执行完毕，会将回调函数内的代码执行，此时’Run end!’已经输出，遍输出在‘Run end!‘后方**

### 利用Node.js“require('http')”来声明服务器：

    	var http = require('http');	//引用http服务器模块
    	var isWebServer=http.createServer(function(request,response){	//创建Server服务器
    		response.writeHead(200,{'Content-Type':'text/plain'});		//声明内容类型：纯文本
    		response.end('Hello NodeJs!\n');				//输出Hello NodeJs！
	 });
    	isWebServer.listen(8888);	//启用监听在8888端口					
    
    		


### Module.exports、exports、require区别：
	
**涉及部分：Node.js的包和模块**

require：引入/引用模块，可以直接引用系统模块或第三方加载过的模块。但是在引用自建模块时需要在被引用的function前加上Module.exports或exports来导出此模块

		//add.js
		var add=function(a,b){
			return a+b;
		}					
	
		exports.add=add;	//使用epxorts导出模块，才能在index.js中require引用

		//index.js
		var useAdd=require("./add");
		useAdd.add(1,2);

### Module.exports、exports的区别

* 两者初始化都为{}
* exports为Module.exports的值的引用：
		
	    //exports.js
	    var add=function(a,b){
	    	return a+b;	
	    }
	    
	    var minu=function(a,b){
	    	return a-b;
	    }

		var single=function(a){
			console.log(a);
		}
	    
	    exports.add=add;			//exports指向add();
	    module.exports=add;			//module.exports指向add();

		exports.minu=minu;			//exports指向minu();
		//module.exports和exports指向相同
		//module.exports指向minu();

		module.exports=single;		//module.exports指向single();
		//但是此时exports为依然指向minu而非single；

*当exports发生变化时，module.exports会跟随变化，当module.exports被赋新值后，exports依然为上一次的值，而非module.exports现在的值*

**也就是说，当需要创建/导出一个公共模块的时候，可以使用exports；当使用新的独立模块，可以使用module.exports防止被导出的模块所覆盖。**





