/* global AudioManager */

var manager,
    canvas,
    canvasContext;

window.onload = function() {

    $('#sample').attr('width', $('.body').width() - 10);

    var isLoaded = false,
        isClicked = false;

    canvas = document.querySelector('canvas');
    canvasContext = canvas.getContext('2d');

    manager = (new AudioManager({
        fps             : 60,
        autoLoop        : false,
        onLoaded        : function() {
            isLoaded = true;
            this.onEnterFrame();
            if (isClicked) {
                this.play('bgm');
                this.startLoop();
            }
        },
        onEnterFrame    : function() {
            if (isLoaded) {
                var me  = this,
                    dat = me.analysers.bgm.getByteFrequencyData(128),
                    len = dat.length,
                    haf = len / 2,
                    rad = 30,
                    siz = 30;

                canvasContext.clearRect(0, 0, canvas.width, canvas.height);
                canvasContext.strokeStyle ='#fff';
                canvasContext.fillStyle ='#fff';
                canvasContext.lineWidth = 0.5;

                canvasContext.save();
                canvasContext.translate(canvas.width/2, canvas.height/2);
                canvasContext.beginPath();

                for (var i = 0; i < len; i++) {
                    canvasContext.moveTo(rad+(siz*Math.floor((dat[i]/255)*100)/100),0);
                    canvasContext.lineTo(rad-1,0);
                    canvasContext.rotate(Math.PI/haf);
                }

                canvasContext.stroke();
                canvasContext.translate(-canvas.width/2, -canvas.height/2);
                canvasContext.restore();
            }
        }
    })).init();

    manager.load({
        bgm: './audio/justUs.m4a'
        // bgm: '../audio/sample.mp3'
    });

    $('#sample').click(function() {
        isClicked = true;
        if (manager.isPlaying('bgm')) {
            manager.stop('bgm');
            manager.stopLoop();
        } else {
            if (isLoaded) {
                manager.play('bgm');
                manager.startLoop();
            }
        }
    });
};