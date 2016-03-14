function canvas_render(link){
    var column_indicator = 1;
    var text_type;
    var text;
    var maxWidth = $('#sticky').width(); //размер поле, где выводится текст
    var lineHeight = 16;
    var marginLeft = 0;
    var marginTop = 70;
    var canvas = document.getElementById("canvas");
    var context = canvas.getContext("2d");

    function printText(text,marginTop,lineHeight,maxWidth){

        var text_type = text.split('/');

        switch(text_type[0]){
            case '^1':
                var words = text_type[1].split(" ");
                var Line = "";
                context.font = "16px Arial";
                context.fillStyle = 'black';
                lineHeight = 16;
                $.each(words, function(key,value){
                    var baseLine = Line + value + " ";
                    var lineLength = context.measureText(baseLine).width+5;
                    marginLeft = $('#sticky').width()/2 - lineLength;
                    console.log(marginLeft);
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

                break;
            case '^2':
                marginTop += lineHeight;
                var words = text_type[1].split(" ");
                var baseLine = "";
                context.font = "16px Arial";
                context.fillStyle = 'black';
                lineHeight = 16;
                $.each(words, function(key,value){
                    baseLine += value + " ";
                    var lineLength = context.measureText(baseLine+words[key+1]+" ").width+5;
                    marginLeft = $('#sticky').width()/2 - lineLength + 150;
                    if(lineLength+10 > maxWidth || words.length == (key+1)){
                        context.fillText(baseLine,marginLeft,marginTop);
                        baseLine = "";
                        marginTop += lineHeight;
                    }
                });

                break;
            case '^3':
                marginTop += lineHeight;
                context.font = "13px Arial";
                context.fillStyle = 'black';
                var words = text_type[1].split("^3*");
                marginLeft = 0;
                context.fillText(words[0],marginLeft,marginTop);
                marginLeft = 470;
                context.fillText(words[1],marginLeft,marginTop);
                lineHeight = 20;

                break;
            case '^4':
                marginTop += lineHeight;
                var words = text_type[1].split(" ");
                var baseLine = "";
                marginLeft = 0;
                lineHeight = 16;
                context.font = "13px Arial";
                context.fillStyle = 'black';
                $.each(words, function(key,value ){
                    baseLine += value + " ";
                    var lineLength = context.measureText(baseLine+words[key+1]+" ").width;
                    if(lineLength > maxWidth || words.length == (key+1)){
                        context.fillText(baseLine,marginLeft,marginTop);
                        baseLine = "";
                        marginTop += lineHeight;
                    }
                });

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
                    if(lineLength > maxWidth || words.length == (key+1)){
                        context.fillText(baseLine,marginLeft,marginTop);
                        Line = value + " ";
                        marginTop += lineHeight;
                    }
                    else
                    {
                        Line = baseLine;
                    }

                });
                //marginTop += lineHeight;
                break;

        }
        result = {marginTop: marginTop,column_indicator:column_indicator};
        return result;
    }

        var doc = $('#document_form');


        $.post(link, doc.serialize(),function( data ) {
                $('#canvas').attr('width',maxWidth-100);
                context.clearRect(0, 0, canvas.width, canvas.height);
                context.font = "16px Arial";
                context.fillStyle = 'blue';
                context.fillText("Предварительный просмотр документа",150,30);
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
            //console.log(column_indicator);

        });

    },"json"
    );
}
