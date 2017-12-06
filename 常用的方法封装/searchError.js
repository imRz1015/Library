window.onerror = e =>
    (window.location = `https://www.baidu.com/baidu?&ie=utf-8&word=${
        e.message
    }`);
