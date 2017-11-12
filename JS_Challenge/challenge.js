function jsfunction()
{
    var num1 = document.getElementById('num1').value;
    var num2 = document.getElementById('num2').value;
    var num3 = document.getElementById('num3').value;
    
    var arr =[num1, num2, num3];
    
   var arrx= arr.sort();
    
   var arrL = arrx.length;
  //  for(var i =0; i < arrL ; i++ )
  //  {
   //     if(arrx[i] > 1 && arrx[i]<50 && i ==0)
  //      {
        console.log(arrx[0]);
   //     }
   // }
}