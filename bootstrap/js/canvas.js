function canvas_render(link){
    var column_indicator = 1;
    var text_type;
    var text;
    var maxWidth = 560; //размер поле, где выводится текст
    var lineHeight = 16;
    var marginLeft = 0;
    var marginTop = 70;
    var canvas = document.getElementById("canvas");
    var context = canvas.getContext("2d");

    console.log(link);

    context.clearRect(0, 0, canvas.width, canvas.height);

    context.font = "16px Arial";
    context.fillStyle = 'blue';
    context.fillText("Предварительный просмотр документа",150,30);

    function printText(text,marginTop,lineHeight,maxWidth){

        var text_type = text.split('/');

        switch(text_type[0]){
            case '^1':
                var words = text_type[1].split(" ");
                var Line = "";
                marginLeft = 250;
                context.font = "16px Arial";
                context.fillStyle = 'black';
                lineHeight = 35;
                $.each(words, function(key,value){
                    var baseLine = Line + value + " ";
                    var lineLength = context.measureText(baseLine).width+5;
                    console.log(lineLength);
                    if(lineLength > maxWidth || words.length == (key+1)){
                        baseLine = value + " ";
                        context.fillText(baseLine,marginLeft,marginTop);
                        marginTop += lineHeight;
                    }
                    else
                    {
                        Line = baseLine;
                        context.fillText(baseLine,marginLeft,marginTop);

                    }

                });
                marginTop += lineHeight;
                break;
            case '^2':
                var words = text_type[1].split(" ");
                var Line = "";
                marginLeft = 100;
                context.font = "16px Arial";
                context.fillStyle = 'black';
                lineHeight = 30;
                $.each(words, function(key,value){
                    var baseLine = Line + value + " ";
                    var lineLength = context.measureText(baseLine).width+5;
                    if(lineLength > maxWidth || words.length == (key+1)){
                        baseLine = value + " ";
                        context.fillText(baseLine,marginLeft,marginTop);
                        marginTop += lineHeight;

                    }
                    else
                    {
                        context.fillText(baseLine,marginLeft,marginTop);
                        Line = baseLine;

                    }
                });
                marginTop += lineHeight;
                break;
            case '^3':
                context.font = "13px Arial";
                context.fillStyle = 'black';
                var words = text_type[1].split("^3*");
                marginLeft = 50;
                context.fillText(words[0],marginLeft,marginTop);
                marginLeft = 420;
                context.fillText(words[1],marginLeft,marginTop);
                lineHeight = 20;
                break;
            case '^4':
                var words = text_type[1].split(" ");
                var Line = "";
                marginLeft = 25;
                lineHeight = 16;
                context.font = "13px Arial";
                context.fillStyle = 'black';
                $.each(words, function(key,value ){
                    var baseLine = Line + value + " ";
                    var lineLength = context.measureText(baseLine).width;
                    if(lineLength+10 > maxWidth || words.length == (key+1)){
                        context.fillText(baseLine,marginLeft,marginTop);
                        Line = value + " ";
                        marginTop += lineHeight;
                    }
                    else
                    {
                        Line = baseLine;
                        context.fillText(baseLine,marginLeft,marginTop);
                    }
                });
                marginTop += lineHeight;
                break;
            case '^5':
                var words = text_type[1].split(" ");
                var Line = "";
                marginLeft = 80;
                context.font = "13px Arial";
                context.fillStyle = 'black';
                lineHeight = 16;
                $.each(words, function(key,value){
                    var baseLine = Line + value + " ";
                    var lineLength = context.measureText(baseLine).width+5;
                    if(lineLength > maxWidth || words.length == (key.length)+10){
                        context.fillText(baseLine,marginLeft,marginTop);
                        Line = value + " ";
                        marginTop += lineHeight;
                    }
                    else
                    {
                        Line = baseLine;
                        context.fillText(baseLine,marginLeft,marginTop);
                    }

                });
                marginTop += lineHeight;
                break;

        }
        result = {marginTop: marginTop,column_indicator:column_indicator};
        return result;
    }



        $.post(link,$('#document_form').serialize(),function( data ) {
        $.each( data , function(key , val){
            /*
            console.log(val['text-type']);
            console.log(val['text']);
            */
            text = val['text'];
            text_type = val['text-type'];

            var print_data = printText(text,marginTop,lineHeight,maxWidth);
            marginTop = print_data.marginTop;
            column_indicator = print_data.column_indicator;
            console.log(column_indicator);

        });

    },"json"
    );
}
