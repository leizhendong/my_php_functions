# laravel-helpers laravel 助手函数

## 加载使用  2种方法任选
### 1. composer.json 加载
文件composer.json   autoload 部分里 添加 "files":["app/helpers.php"]

```
"autoload": {
    "classmap": [
        "database",
        "resources/org/pay"
    ],
    "psr-4": {
        "App\\": "app/"
    },
    "files":["app/helpers.php"]
},
```
然后运行
```
composer dump-autoload
```

### 2. 写入加载文件autoload.php
bootstrap目录下的autoload.php 在中间或者是最后一行插入如下代码：
```
if(file_exists(__DIR__ . '/../app/helpers.php'))  
{  
    require __DIR__ . '/../app/helpers.php';  
}
```
