<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>News page</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="/test1/css/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>   
        <style>p1 {
        font-size: 10.0pt;
        
        }
         </style>
        <!-- begin header -->
        <div id="header">
            <h1>News <span> Page</span></h1>
        </div>
        <!-- end header -->

         
         <div id="container">
            <div id="content">
               
                <!-- begin editing main content -->
                <h2>Latest news</h2>
                <?php foreach ($newsList as $newsItem):?>
                <h3> <a href="/test1/news/<?php echo $newsItem['id'];?>"> <?php echo $newsItem['title']; ?> </a></h3>
                    <p>  <?php echo $newsItem['short_content']; ?> </p>
                    <p1 id="right">  <?php echo $newsItem['date']; ?> </p1>
                <!-- end editing content -->
                <?php endforeach;?> 
                
            </div>
            
             
             
            <!-- begin footer -->
            <div id="footer">
                <p>Copyright&copy; 2006 You <br />
                    |&nbsp;XHTML template by <a href="http://www.karenblundell.com" target="_blank">Karen Blundell</a>&nbsp;|&nbsp;<a href="http://validator.w3.org/check?uri=referer" target="_blank">Valid XHTML</a>&nbsp;|&nbsp;<a href="http://jigsaw.w3.org/css-validator/" target="_blank">Valid CSS</a>&nbsp;|</p>
            </div>
            <!-- end footer -->
        </div>
    </body>
</html>