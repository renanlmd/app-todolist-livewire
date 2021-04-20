<div class="container min-h-full mx-auto bg-red-400">
    <div class="flex flex-row-reverse p-1">
        <div class="w-10 h-9 text-center hover:rounded rounded-full transition duration-200 bg-opacity-25 hover:bg-gray-200 cursor-pointer" id="settings">
            <span class="text-2xl">
                <i class="fas fa-cog"></i>
            </span>
        </div>
    </div>
    <div class="flex flex-wrap content-center h-52 bg-gray-500">
        <div class="text-center w-full">
            <span class="text-9xl text-white" id="timer"><span id="time-left"></span></span>
        </div>
    </div>
    <div class="flex justify-center h-20 pt-1">

        <div class="mr-7 ml-7">
            <div class="flex flex-wrap content-center h-16 ">
                <span class="text-white text-5xl cursor-pointer" id="reset"><i class="fas fa-stop"></i></span>
            </div>
        </div>
        <div class="mr-7">
            <div class="flex flex-wrap content-center h-16">
                <span class="text-white text-5xl cursor-pointer" id="start_stop"><i class="fas fa-play"></i></span>
            </div>
        </div>
                
    </div>
</div>
<div class="absolute container bg-white hidden min-h-full w-3/6 top-0 right-0 transition duration-75" id="session-settings">
    <div class="flex flex-row-reverse p-1">
        <div class="w-10 h-9 text-center hover:rounded rounded-full transition duration-200 bg-opacity-25 hover:bg-gray-200 cursor-pointer" id="hide-settings">
            <span class="text-2xl">
                <i class="fas fa-times"></i>
            </span>
        </div>
    </div>
</div>

@push('scripts-pomodoro')
    <script>
        
        document.getElementById('settings').onclick = function() {
            document.getElementById("session-settings").classList.remove("hidden");
           

        }
        document.getElementById('hide-settings').onclick = function() {
            document.getElementById("session-settings").classList.remove("visibility");
            document.getElementById("session-settings").classList.add("hidden");
        }     

    </script>

    <script>

        //get all needed DOM elements
       
        const start_stop = document.getElementById('start_stop');
        const reset = document.getElementById('reset');
        const timeLeft = document.getElementById('time-left');
        let setSession = document.getElementById('time-left');

        
        start_stop.addEventListener('click', startStop);
        reset.addEventListener('click', resetTimer);

        let sessionTimer = 25 * 60;  //convert to seconds
        let breakTimer = 5 * 60;  //convert to seconds
        
        let timerSession = 25;
        let timerBreak = 5;
        setSession.innerHTML = timerSession + ":00";

        //makes sure there is leading zeroes when min or sec is less than 10 (i.e. 9 wrong, 09 correct)
        Number.prototype.pad = function(size) {
            var s = String(this);
            while (s.length < (size || 2)) {s = "0" + s;}
            return s;
        }

        let timerPaused = true;


        function startStop(e){
            e.preventDefault();
            if(e.target.classList.contains('fa-play')){
                e.target.classList.remove('fa-play');
                e.target.classList.add("fa-pause");
                timerPaused=false;
                
            }   
            else{
                // timerLabel.innerHTML = "Session Paused";
                timerPaused = true;
                e.target.classList.add("fa-play")
            }
        }

        function resetTimer(){
            timerPaused =true;
            // timerLabel.innerHTML = "Session Timer";
            
            timeLeft.innerHTML = parseInt(25).pad() + ":00";
            sessionTimer = parseInt(25) * 60;
            breakTimer = parseInt(25) * 60;
        }

        const timer = setInterval(function(){ 
            if(!timerPaused){
                if(sessionTimer>0){
                    // timerLabel.innerHTML = "Currently in Session";
                    var m = Math.floor(sessionTimer / 60).pad();
                    var s = (sessionTimer % 60).pad();
                    timeLeft.innerHTML = m+ ":"+ s; 
                    sessionTimer--;
                }
                else{
                    if(sessionTimer > -2){
                        sessionTimer--;
                    }
                    else if(breakTimer>0){
                        // timerLabel.innerHTML = "Currently in Break";
                        var m = Math.floor(breakTimer / 60).pad();
                        var s = (breakTimer % 60).pad();
                        timeLeft.innerHTML = m+ ":"+ s; 
                        breakTimer--;
                    }
                    else if(breakTimer==0){
                        sessionTimer = parseInt(sessionLength.innerHTML) * 60;
                        breakTimer = parseInt(breakLength.innerHTML) * 60;
                    }
                }
            }
            

        }, 1000);

    </script>

@endpush