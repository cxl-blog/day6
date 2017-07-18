/**
 * Created by YOGA on 2017/7/16.
 */
module.exports={
  /*  入口，及输入的js包也可以在hello中添加包的依赖
     比如在hello.js中写入
     document.write(require('./js/function.js'))
     那么久可以在入口处只添加一个文件，同理多个以上一样的
     添加第三方包、、三方包可以在自建js中加依赖添加进去*/

     entry:{
     one:"./app/one.js",
     two:"./app/two.js"
     },
     output:{
     path:"./build/",
     filename:"[name].js"
     },
     module:{
     loaders:[
     {
     test:/.*\.css$/,
     loaders:["style","css"],
     exclude:'./node_modules/'
     }
     ]
     },
     resolve:{
     extensions:['','.css','.js','jsx']
     }
};