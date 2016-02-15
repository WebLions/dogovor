
$.getJSON( "/document/data_for_canvas", function( data ) {

    var lineHeightCounter;
    var canvas = document.getElementById("canvas");
    var context = canvas.getContext("2d");
    var maxWidth = 525; //размер поле, где выводится текст
    var lineHeight = 15;
    var marginLeft = 15;
    var marginTop = 40;


    $.each( data , function(key , val){

        var text = val['text'];
        context.textBaseline = val['align'] ;
        context.font = "13pt "+val['style'];
        context.font = " Calibri";
        context.fillStyle = "#000";

        printContent(context,text,marginLeft,marginTop,maxWidth,lineHeight);


        function printContent(context,text,marginLeft,marginTop,maxWidth,lineHeight)
        {
            context.fillText(text,marginLef,lineHeightCounter);

            lineHeightCounter += lineHeight;


        }



        /*function wrapText(context, text, marginLeft, marginTop, maxWidth, lineHeight)
         {
         var words = text.split(" ");
         var countWords = words.length;
         var line = "";
         for (var n = 0; n < countWords; n++) {
         var testLine = line + words[n] + " ";
         var testWidth = context.measureText(testLine).width;
         if (testWidth > maxWidth) {
         context.fillText(line, marginLeft, marginTop);
         line = words[n] + " ";
         marginTop += lineHeight;
         }
         else {
         line = testLine;
         }
         }
         context.fillText(line, marginLeft, marginTop);
         }*/

        //wrapText(context, text, marginLeft, marginTop, maxWidth, lineHeight);





    })



});