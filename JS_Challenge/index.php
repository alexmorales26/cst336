<!DOCTYPE html>
<html>
    <head>
        <title>Sorting Numbers </title>
        <script>
         function jsfunction()
            {
                var num1 = document.getElementById('num1').value;
                var num2 = document.getElementById('num2').value;
                var num3 = document.getElementById('num3').value;
                
                var arr =[num1, num2, num3];
                
               var arrx= arr.sort(function(a,b){return b-a});
               
               if(arrx[0] > 1 && arrx[0] <50)
               {
                   document.getElementById('ouput').innerHTML+=arrx[0];
               }
            
        </script>
    </head>
    <body>
    <h2>Enter 3 numbers from 1 to 50</h2>
    <form method="get">
    Number 1: 
    <input type="text" id="num1"><br>
    Number2:
    <input type="text" id="num2"><br>
    Number 3:
    <input type="text" id="num3"><br>
    <input type="button" name="submit" id="sorting" onclick="jsfunction();">
    </form>
    <div id="output">
        
        
        
    </div>
 
    </body>
</html>