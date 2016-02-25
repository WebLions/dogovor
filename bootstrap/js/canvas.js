function canvas_render(){
    var start = true;
    var text_type;
    var text;
    var maxWidth = 524; //размер поле, где выводится текст
    var lineHeight = 15;
    var marginLeft = 15;
    var defaultTop = 55;
    var marginTop = 40;
    var canvas = document.getElementById("canvas");
    var context = canvas.getContext("2d");

    context.clearRect(0, 0, canvas.width, canvas.height);

    function title(){

        context.font = "12pt Arial"
        context.fillStyle = "#000";
        marginLeft = maxWidth / 2 - 60;

    }
    function paragraph() {

        context.font = "11pt Arial"
        context.fillStyle = "#000";
        marginLeft = 30;
    }
    function list(){

        context.font = "11pt Arial"
        context.fillStyle = "#000";
        marginLeft = 50

    }
    function colunms(){

        context.font = "11pt Arial"
        context.fillStyle = "#000";
        marginLeft = 50

    }

    function get_text_type(text_type){

        if(text_type == 'title') title();
        if(text_type == 'paragraph') paragraph();
        if(text_type == 'list') list();
        if(text_type == 'columns') colunms();

    }

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
        return marginTop;
    }


        $.post( "/document/data_for_canvas_buysale",$('#document_form').serialize(),function( data ) {

        $.each( data , function(key , val){

            if(start == true) {
                marginTop += defaultTop;
                start = false;
            }
            text_type = val['text-type'];
            get_text_type(text_type);

            text = val['text'];
            marginTop = printContent(context,text,marginLeft,marginTop,maxWidth,lineHeight);

        });
    },"json"
    );
}
