function canvas_render(){
    var prev_text_type;
    var text_type;
    var text;
    var maxWidth = 560; //размер поле, где выводится текст
    var lineHeight;
    var marginLeft = 0;
    var marginTop = 40;
    var canvas = document.getElementById("canvas");
    var context = canvas.getContext("2d");

    context.clearRect(0, 0, canvas.width, canvas.height);

    function title(){

        context.font = "13pt Arial";
        context.fillStyle = "#000";
        marginLeft = 120;
        lineHeight = 25;

    }
    function paragraph() {

        context.font = "11pt Arial";
        context.fillStyle = "#000";
        marginLeft = 15;
        lineHeight = 16;
    }
    function list(){

        context.font = "11pt Arial";
        context.fillStyle = "#000";
        marginLeft = 35;
        lineHeight = 16;

    }
    function columns_left(){

        context.font = "11pt Arial";
        context.fillStyle = "#000";
        marginLeft = 35;
        lineHeight = 16;

    }
    function columns_right(){

        context.font = "11pt Arial";
        context.fillStyle = "#000";
        marginLeft = 385;
        lineHeight = 16;

    }
    function header(){

        context.font = "13pt Arial";
        context.fillStyle = "#000";
        marginLeft = 235;
        lineHeight = 16;

    }

    function get_text_type(text_type){

        if(text_type == 'title') title();
        if(text_type == 'paragraph') paragraph();
        if(text_type == 'list') list();
        if(text_type == 'columns-left')columns_left();
        if(text_type == 'columns-right')columns_right();
        if(text_type == 'header') header();

    }

    function printContent(context,text,marginLeft,marginTop,maxWidth,lineHeight,text_type)
    {
        //if(text_type == 'columns-left' || text_type == 'columns-right')
        var words = text.split(" ");
        var wordsLength = words.length;
        var line = "";
        for(var i = 0; i < wordsLength; i++){
            var checkLine = line + words[i] + " ";
            var checkWidth = context.measureText(checkLine).width;

            if(checkWidth > maxWidth){
                context.fillText(line,marginLeft,marginTop);
                line = words[i] + " ";
                marginTop += lineHeight;
                }
            else{
                line = checkLine;
                context.fillText(line,marginLeft,marginTop);
            }

        }
        marginTop += lineHeight;
        return marginTop;
    }

        $.post( "/document/data_for_canvas_buysale",$('#document_form').serialize(),function( data ) {
        $.each( data , function(key , val){
            /*
            console.log(val['text-type']);
            console.log(val['text']);
            */
            text = val['text'];
            text_type = val['text-type'];
            get_text_type(text_type,prev_text_type);
            marginTop = printContent(context,text,marginLeft,marginTop,maxWidth,lineHeight,text_type);

        });

    },"json"
    );
}
