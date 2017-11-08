            var selectedWord="";
            var selectedHint="";
            var board="";
            var remainingGuesses=6;
            var words = [{word:"snake",hint:"It's a reptile"},
                        {word:"monkey",hint:"It's a mammal"},
                        {word:"beetle",hint:"It's an insect"}];
            var alphabet = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 
                'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 
                'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];

            //console.log(words[0]);
            var randomInt = Math.floor(Math.random() * words.length);
            selectedWord = words[randomInt];
            
            startGame();
            
            function startGame()
            {
                pickWord();
                initBoard();
                updateBoard();
               createLetters();
            }
            function initBoard(){
                for( var letter in selectedWord){
                    board +="_";
                }
            }
            
            function pickWord(){
                var randomInt = Math.floor(Math.random()*words.length);
                selectedWord=words[randomInt];
                selectedWord=words[randomInt].word.toUpperCase();
                selectedHint=words[randomInt].hint;
            }
            
           function updateBoard() {
                $("#word").empty();
                
              for(var letter of board){
                  document.getElementById("word").innerHTML+=letter+" ";
              }
                
                $("#word").append("<br />");
                $("#word").append("<span class='hint'>Hint: " + selectedHint + "</span>")
            }
            
            $("#letterBtn").click(function(){
                var boxVal=$("#letterBox").val();
               // console.log("You pressed the butoon and it had the value: " + boxVal);
            }) 
            
            function createLetters(){
                for(var letter of alphabet){
                    $("#letters").append("<button class='letter' id='" + letter + "'>" + letter + "</button>");
                }
            }
            $(".letter").click(function(){
                checkLetter($(this).attr("id"));
                disableButton($(this));
                //updateBoard();
                console.log($(this).attr("id"));
            });
            function replaceAt(str,index,value){
                return str.substr(0,index)+value+str.substr(index+value.length);
            }
            function checkLetter(letter){
                var positions= new Array();
                
                // put all the existing letters into array
                for(var i=0; i < selectedWord.length;i++){
                    if(letter == selectedWord[i]){
                        positions.push(i);
                    }
                }
                if(positions.length >0){
                    updateWord(positions,letter);
                    if(!board.includes('_')){
                        endGame(true);
                    }
                }
                else{
                    if(remainingGuesses <=0)
                {
                    endGame(false);
                }
                    remainingGuesses-=1;
                    updateMan();
                }
                
            }
            
            $(".replayBtn").on("click",function(){
                location.reload();
            });
            function updateWord(positions, letter) {
                    for (var pos in positions) {
                    board = replaceAt(board, pos, letter);
                    }
                    
                    updateBoard(board);
                    
                    // Check to see if this is a winning guess
                    if (!board.includes('_')) {
                    endGame(true);
                    }
            }
            
            function updateMan()
            {
                $("#hangImg").attr("src","img/stick_"+(6-remainingGuesses) +".png");
            }
            
            
            function endGame(win)
            {
                $("#letters").hide();
                
                
                if(win)
                {
                    $("#won").show();
                }
                else{
                    $("#lost").show();
                }
            }
            
            
            function disableButton(btn)
            {
                btn.prop("disabled",true);
                btn.attr("class","btn btn-danger");
            }