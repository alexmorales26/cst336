$(document).ready(function(){
   var url="https://api.walmartlabs.com/v1/",
   mode ="search",
   //input,
   itemName,
    key="?apiKey=7mmxjmxatawbb6w5a8k84eqb";
    
   $("#submit").click(function(){
      document.getElementById("game").innerHTML=" ";
      var cat = $('#category').val();
      if(cat=="default"){
          cat=$("#item").val();
      }
      var temp=$("#item").val();
      itemName=encodeURI(cat);
      $.ajax({
         url: url+mode+key+"&query="+itemName,
         dataType: "jsonp",
         success: function(data){
         for(var x=0; x <10; x++){
             var quo="'";
             document.getElementById("techno").innerHTML+= data.items[x].name+
             "<br><img src="+quo+data.items[x].thumbnailImage+quo+"class=image width='200'><br><br>";
             
            //document.getElementById("game").innerHTML+=
           // "<button id="+quo+data.items[x].itemId+quo+" class='info' >info</button><br>";
            item();
            $(".info").click(function(){
               information($(this)).attr("id");
            });
         }
         addToDb();
         }
      });
   });
    
    
});

function addToDb(){
    
    var obj = $("#item").val();
    if(obj.length >1){
        obj=$('#item').val();
    }
    $.ajax({
       type:"POST",
       data:{'itemsz':obj},
       url:"addToDB.php",
       
       success:function(data){
           console.log(data);
       }
    });
}

function item() {
        var obj=$("#item").val();
        if(obj.length<2)
        {
            obj=$("#category").val();
        }
        $.ajax({
            type: "GET",
            url: "retrieveDB.php",
            dataType: "json",
            data: { "itemsz": obj},
            success: function(data,status) {
                var avail=" ",counter=0;
               for(var i=0;i<data.length;i++){
               if (data[i].object!=$("#item").val()&&data[i].object!=$("#category").val()) {
                   avail+=" ";
               } else {
                   avail+="<br> date searched in inventory: </strong>"+data[i].date+"<br>";
                   counter++;
               }
              }
            document.getElementById("game").innerHTML="The key word: "+obj+" has been searched: "+"("+counter+") times "+avail;
            }
            });
    }

function category()
{
    var obj=$("#category").val();
    $("item").val=obj;
     $.ajax({
            url: 'https://api.walmartlabs.com/v1/search/?apiKey=7mmxjmxatawbb6w5a8k84eqb&query='+obj,
            dataType: 'jsonp',
            success: function(data) {
             console.log(data.items[0].offerType);
             for(var i=0;i<10;i++){
                 var quo="'";
             document.getElementById("games").innerHTML+= data.items[i].name+"<br><img src="+quo+data.items[i].thumbnailImage+quo+"class=pic width='200'><br><br><br>";
             
             document.getElementById("games").innerHTML+="<button id="+quo+data.items[i].name+quo+" class='success' >info</button><br>";
             
             $(".success").click(function(){
                //getinfo($(this).attr("id"));
                
            });
               
             }
  
            }
        });
}
    