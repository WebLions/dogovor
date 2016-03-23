var CanvasText = function(position, size) {
    this._textStack = [];

    if (position === null || position === undefined) {
        position = {
            x: 0,
            y: 0
        }
    }

    if (size === null || size === undefined) {
        size = {
            width: 100,
            height: 100
        }
    }

    this._position = position;
    this._size = size;

}

CanvasText.prototype = {
    _position: null,
    _size: null,
    _textStack: null,
    _currentOptionSet: null,

    _newOptionSet: function() {
        if (this._currentOptionSet != null) {
            return;
        }

        this._currentOptionSet = {
            text: '',
            family: '',
            size: '',
            weight: '',
            style: '',
            color: ''
        };
    },

    position: function(x, y) {
        this._position.x = x;
        this._position.y = y;
    },

    family: function(family) {
        this._newOptionSet();
        this._currentOptionSet.family = family;
        return this;
    },

    size: function(size) {
        this._newOptionSet();
        this._currentOptionSet.size = size;
        return this;
    },

    weight: function(weight) {
        this._newOptionSet();
        this._currentOptionSet.weight = weight;
        return this;
    },

    style: function(style) {
        this._newOptionSet();
        this._currentOptionSet.style = style;
        return this;
    },

    color: function(color) {
        this._newOptionSet();
        this._currentOptionSet.color = color;
        return this;
    },

    append: function(text) {
        this._newOptionSet();
        this._currentOptionSet.text = text;
        this._textStack.push(this._currentOptionSet);
        this._currentOptionSet = null;
        return this;
    },

    newLine: function() {
        this.append('\n');
        return this;
    },

    render: function() {

        if (this._textStack.length == 0) {
            return;
        }

        var previousFontOptions = {
            text: '',
            family: '',
            size: '',
            weight: '',
            style: ''
        };

        textAdjustment = {
            x: 0,
            y: 0
        };

        context.save();

        for (var i = 0, textStackLen = this._textStack.length; i < textStackLen; i++) {

            var currentFontOptions = this._textStack[i];

            // we must store previous font options so we can override any single one of them without losing previously stored settings
            if (currentFontOptions.family) {
                previousFontOptions.family = currentFontOptions.family;
            }

            if (currentFontOptions.size) {
                previousFontOptions.size = currentFontOptions.size;
            }

            if (currentFontOptions.weight) {
                previousFontOptions.weight = currentFontOptions.weight;
            }

            if (currentFontOptions.style) {
                previousFontOptions.style = currentFontOptions.style;
            }

            context.font = jQuery.trim(previousFontOptions.weight + ' ' + previousFontOptions.style + ' ' + previousFontOptions.size + ' ' + previousFontOptions.family);

            // we don't need to store previous color, and can instead use the context to remember the previously used color
            if (currentFontOptions.color) {
                context.fillStyle = currentFontOptions.color;
            }

            var textToDraw = currentFontOptions.text;
            var wordsArray = textToDraw.split(' ');

            for (var j = 0, wordsArrayLen = wordsArray.length; j < wordsArrayLen; j++) {
                var currentWord = ' ' + wordsArray[j];
                var currentWordWidth = context.measureText(currentWord).width;

                // word wrap code here
                if (textAdjustment.x + currentWordWidth > this._size.width || textToDraw == '\n') {
                    textAdjustment.x = 0;
                    textAdjustment.y += parseInt(previousFontOptions.size, 10);
                }

                // we don't want to draw anything for new line characters, nor apply textAdjustment additions
                if (textToDraw == '\n') {
                    continue;
                }

                context.fillText(
                    currentWord,                            // text
                    this._position.x + textAdjustment.x,    // x position
                    this._position.y + textAdjustment.y     // y position

                );

                textAdjustment.x += currentWordWidth;
            }
        }

        context.restore();
    }
}


function canvas_render(link){
    var column_indicator = 1;
    var text_type;
    var text;
    var maxWidth = $('#sticky').width(); //размер поле, где выводится текст
    var lineHeight = 16;
    var marginLeft = 0;
    var marginTop = 70;
    canvas = document.getElementById("canvas");
    context = canvas.getContext("2d");
    var checkTop;


    function printText(text,marginTop,lineHeight,maxWidth){

        console.log(text_type);
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
                    marginLeft = $('#sticky').width()/2 - lineLength
                    if(lineLength+100 > maxWidth || words.length == (key+1)){
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
                    var lineLength = context.measureText(baseLine+" "+words[key+1]+" ").width+5;
                    marginLeft = $('#sticky').width()/2 - lineLength/2;
                    if(lineLength > maxWidth || words.length == (key+1)){
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
                marginLeft = maxWidth - context.measureText(words[1]).width*2;
                context.fillText(words[1],marginLeft,marginTop);
                lineHeight = 20;
                break;
            case '^4':
                marginTop += lineHeight;
                marginLeft = 0;
                lineHeight = 16;

                var myText = new CanvasText({
                    x: marginLeft,
                    y: marginTop
                },{
                    width: maxWidth-100,
                    height: 20
                });

                myText
                    .family('Arial')
                    .size('13px')
                    .color('black')
                    .append(text_type[1])
                    .render();
                marginTop+= textAdjustment.y+lineHeight;
                break;
            case '^5':
                //marginTop += lineHeight;
                marginLeft = 60;
                lineHeight = 16;

                var myText = new CanvasText({
                    x: marginLeft,
                    y: marginTop
                },{
                    width: maxWidth-100,
                    height: 20
                });

                myText
                    .family('Arial')
                    .size('13px')
                    .color('black')
                    .append(text_type[1])
                    .render();
                marginTop+= textAdjustment.y+lineHeight;
                break;
            case '^6':
                marginTop += lineHeight;
                checkTop = marginTop;
                context.font = "13px Arial";
                context.fillStyle = 'black';
                var words = text_type[1].split("^6*");

                column_left = words[0].split('^+');
                column_right = words[1].split('^+');
                $.each(column_left,function(key,value){
                    marginTop += lineHeight;
                    marginLeft = 0;
                    context.fillText(value,marginLeft,marginTop);
                    lineHeight = 16;
                });
                marginTop += 50;
                $.each(column_right,function(key,value){
                    marginTop += lineHeight;
                    marginLeft = 0;
                    context.fillText(value,marginLeft,marginTop);
                    lineHeight = 16;
                });
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
