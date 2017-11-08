function confirmCheckOut()
{
   if(confirm("Do you wish to check out ?")){
      location.href='removeItem.php';
     // window.open("removeItem.php");
   }
   else{
       return;
   }
}
$("#checkoutBtn").click(function(){
    confirmCheckOut();
});
