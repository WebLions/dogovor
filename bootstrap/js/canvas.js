function canvas_render(){
    var lineHeightCounter;
    var text;
    var maxWidth = 524; //размер поле, где выводится текст
    var lineHeight = 15;
    var Header = 200;
    var marginLeft = 15;
    var marginTop = 40;
    var canvas = document.getElementById("canvas");
    var context = canvas.getContext("2d");

    context.clearRect(0, 0, canvas.width, canvas.height);

    function title(){

        context.font = "18pt Arial"
        context.fillStyle = "#000";
        marginLeft = maxWidth / 2 - 60;

    }
    function paragraph() {

        context.font = "11pt Arial"
        context.fillStyle = "#000";
        marginLeft = 15;
    }
    function list(){

        context.font = "18pt Arial"
        context.fillStyle = "#000";
        marginLeft = maxWidth / 2 - 60;

    }
    function colunms(){

        context.font = "18pt Arial"
        context.fillStyle = "#000";
        marginLeft = maxWidth / 2 - 60;

    }

    function get_text_type(){


    }


        $.post( "/document/data_for_canvas_buysale",$('#document_form').serialize(),function( data ) {

        $.each( data , function(key , val){

            text += val['text'];

            context.font = "11pt Calibri";
            context.fillStyle = "#000";

        })

        function printContent(context,text,marginLeft,marginTop,maxWidth,lineHeight)
        {
            var words = text.split(" ");
            var wordsLength = words.length;
            var line = "";
            for(var i = 0; i < wordsLength; i++){

                var checkLine = line + words[i] + " ";
                var checkWidth = context.measureText(checkLine).width;
                if(checkWidth > maxWidth){
                    context.fillText(line,marginLeft,marginTop)
                    line = words[i] + " ";
                    marginTop += lineHeight;
                }
                else{
                    line = checkLine;
                }
            }
        }
        printContent(context,text,marginLeft,marginTop,maxWidth,lineHeight);
    },"json"
    );
}
