//解决safari下底部输入框点击input之后被弹出的输入法挡住的问题
//需要jq
$("input").on("click", function() {
        setTimeout(function(){ 
            document.body.scrollTop = document.body.scrollHeight; 
        },300); 