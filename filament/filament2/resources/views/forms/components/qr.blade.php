<x-dynamic-component
    :component="$getFieldWrapperView()"
    :id="$getId()"
    :label="$getLabel()"
    :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText()"
    :hint="$getHint()"
    :hint-action="$getHintAction()"
    :hint-color="$getHintColor()"
    :hint-icon="$getHintIcon()"
    :required="$isRequired()"
    :state-path="$getStatePath()"
>
    <script src="/libs/jsQR.js"></script>

    <div x-data="{ 
            state: $wire.entangle('{{ $getStatePath() }}'),
            update: function() {
                this.state = '';
                procesarFrame().then((result) => {
                    this.state = result;
                });             
            },     
        }">
        <div x-text="state"></div>
        <button @click="update"
            class="filament-button filament-button-size-md inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors outline-none 
            focus:ring-offset-2 focus:ring-2 focus:ring-inset min-h-[2.25rem] px-4 text-sm text-white shadow focus:ring-white border-transparent 
            bg-green-600 hover:bg-green-500 focus:bg-green-700 focus:ring-offset-green-700 filament-page-button-action mb-2">
        Iniciar lectura</button><br>

        <div id="loadingMessage" hidden="">⌛ Cargando...</div>
        <canvas id="canvas" height="240" width="320"></canvas>
    </div><br>
    <script>
        // VARIABLES --------------------------------------------------------------
        var video = document.createElement("video");
        var canvasElement = document.getElementById("canvas");
        var canvas = canvasElement.getContext("2d");
        var loadingMessage = document.getElementById("loadingMessage");

        initVideo();

        // FUNCTIONS 'HELPERS' ----------------------------------------------------

        function drawLine(begin, end, color) {
            canvas.beginPath();
            canvas.moveTo(begin.x, begin.y);
            canvas.lineTo(end.x, end.y);
            canvas.lineWidth = 4;
            canvas.strokeStyle = color;
            canvas.stroke();
        }

        function initVideo() {
            // Use facingMode: environment to attemt to get the front camera on phones
            navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } }).then(function(stream) {
                video.srcObject = stream;
                video.setAttribute("playsinline", true); // required to tell iOS safari we don't want fullscreen
                video.play();
            });
        }

        // FUNCTIONS 'MAIN' -------------------------------------------------------

        function getQR() {
            procesarFrame().then((result) => {
                return result;
            });
        }

        function procesarFrame() {
            return new Promise((resolve) => {
                requestAnimationFrame(() => {
                    result = tick();
                    if(result){
                        resolve(result);
                    } else {
                        resolve(procesarFrame());
                    }
                });
            });
        }

        function tick() {
            loadingMessage.innerText = "⌛ Loading video..."
            if (video.readyState === video.HAVE_ENOUGH_DATA) {
                loadingMessage.hidden = true;
                canvasElement.hidden = false;

                canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);
                var imageData = canvas.getImageData(0, 0, canvasElement.width, canvasElement.height);
                var code = jsQR(imageData.data, imageData.width, imageData.height, {
                    inversionAttempts: "dontInvert",
                });
                if (code) {
                    drawLine(code.location.topLeftCorner, code.location.topRightCorner, "#FF3B58");
                    drawLine(code.location.topRightCorner, code.location.bottomRightCorner, "#FF3B58");
                    drawLine(code.location.bottomRightCorner, code.location.bottomLeftCorner, "#FF3B58");
                    drawLine(code.location.bottomLeftCorner, code.location.topLeftCorner, "#FF3B58");
                    return code.data;
                } else {
                    return false;
                }
            }
        }     

    </script>
</x-dynamic-component>