<div class="container min-h-full mx-auto" id="content-clock">
    <div class="flex flex-row-reverse p-1">
        <div class="w-10 h-9 text-center hover:rounded rounded-full transition duration-200 bg-opacity-25 hover:bg-gray-200 cursor-pointer" id="settings">
            <span class="text-2xl">
                <i class="fas fa-cog"></i>
            </span>
        </div>
    </div>
    <div class="flex flex-wrap content-center h-52">
        <div class="text-center w-full">
            <span class="text-9xl text-white" id="timer"><span id="time-left"></span></span>
        </div>
    </div>
    <div class="flex justify-center h-20 pt-1" id="play-reset">

        <div class="mr-7 ml-7">
            <div class="flex flex-wrap content-center h-16 ">
                <span class="text-white text-5xl cursor-pointer" id="btnReset"><i class="fas fa-stop"></i></span>
            </div>
        </div>
        <div class="mr-7">
            <div class="flex flex-wrap content-center h-16">
                <span class="text-white text-5xl cursor-pointer" id="btnPlay"><i class="fas fa-play"></i></span>
            </div>
        </div>
                
    </div>
    <div class="flex justify-center h-20 pt-1 hidden" id="pause">

        <div class="mr-7 ml-7">
            <div class="flex flex-wrap content-center h-16 ">
                <span class="text-white text-5xl cursor-pointer" id="btnPause"><i class="fas fa-pause"></i></span>
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
    <div class="flex flex-wrap content-center justify-center p-1 h-56">
        <div class="grid grid-rows-3 h-full grid-flow-col gap-4">
            <div class="row-span-3 w-20">
                <div class="grid grid-rows-4 h-full grid-flow-col gap-4">
                    <div class="text-center w-20 pt-3"><span class="font-mono text-sm">Pomodoro</span></div>
                    <div class="w-20">
                        <button class="w-20 h-full rounded-md text-lg bg-blue-600 text-white" id="pomodoro-increment"> + </button>
                    </div>
                    <div class="text-center pt-2 font-mono text-xl" id="time-pomodoro">
                        25
                    </div>
                    <div class="w-20">
                        <button class="w-20 h-full rounded-md text-lg bg-red-600 text-white" id="pomodoro-decrement"> - </button>
                    </div>
                </div>
            </div>
            <div class="row-span-3 w-20">
                <div class="grid grid-rows-4 h-full grid-flow-col gap-4">
                    <div class="text-center w-20 pt-3">
                        <span class="font-mono text-xs">Pausa curta</span>
                    </div>
                    <div class="w-20">
                        <button class="w-20 h-full rounded-md text-lg bg-blue-600 text-white" id="breakFast-increment"> + </button>
                    </div>
                    <div class="text-center pt-2 font-mono text-xl" id="time-breakFast-pomodoro">
                        5
                    </div>
                    <div class="w-20">
                        <button class="w-20 h-full rounded-md text-lg bg-red-600 text-white" id="breakFast-decrement"> - </button>
                    </div>
                </div>
            </div>
            <div class="row-span-3 w-20">
                <div class="grid grid-rows-4 h-full grid-flow-col gap-4">
                    <div class="text-center w-20 pt-3"><span class="font-mono text-xs">Pausa longa</span></div>
                    <div class="w-20">
                        <button class="w-20 h-full rounded-md text-lg bg-blue-600 text-white" id="longBreak-increment"> + </button>
                    </div>
                    <div class="text-center pt-2 font-mono text-xl" id="time-longBreak-pomodoro">
                        15
                    </div>
                    <div class="w-20">
                        <button class="w-20 h-full rounded-md text-lg bg-red-600 text-white" id="longBreak-decrement"> - </button>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="grid grid-rows-1 grid-flow-col mt-3">
            <div class="row-span-1 w-72 h-7 text-center font-mono">
                <span class="">Pomodoros até a pausa longa: </span>
            </div>
        </div>
        <div class="grid grid-rows-1 grid-flow-col">
            <div class="row-span-1 w-72 h-7 text-center font-mono">
                <select class="w-full border border-gray-300 bg-white rounded outline-none hover:border-gray-700" id="configNumberPomodoro">
                    <option class="py-1" value="5">5 Pomodoros</option>
                    <option class="py-1" value="6">6 Pomodoros</option>
                    <option class="py-1" value="7">7 Pomodoros</option>
                    <option class="py-1" value="8">8 Pomodoros</option>
                    <option class="py-1" value="9">9 Pomodoros</option>
                    <option class="py-1" value="10">10 Pomodoros</option>
                    
                </select>
            </div>
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
        const sessionPomodoro = document.getElementById('time-pomodoro');
        const sessionBreakFast = document.getElementById('time-breakFast-pomodoro');
        const sessionLongBreak = document.getElementById('time-longBreak-pomodoro');
        const incPomodoro = document.getElementById('pomodoro-increment');
        const decPomodoro = document.getElementById('pomodoro-decrement');
        const incBreak = document.getElementById('breakFast-increment');
        const decBreak = document.getElementById('breakFast-decrement');
        const incLongBreak = document.getElementById('longBreak-increment');
        const decLongBreak = document.getElementById('longBreak-decrement');
        const getNumberPomodoros = document.getElementById('configNumberPomodoro');
        // timer.configNumberPomodoros = parseInt(getNumberPomodoros.options[getNumberPomodoros.selectedIndex].value);

        const btnPlay = document.getElementById('btnPlay');
        const btnPause = document.getElementById('btnPause');
        const reset = document.getElementById('btnReset');
        const play_reset = document.getElementById('play-reset');
        const pause = document.getElementById('pause');
        const timeLeft = document.getElementById('time-left');
        
        let click = new Audio('/audios/click.mp3');
        let finishedSession = new Audio('/audios/bell.mp3');
        
        btnPlay.addEventListener('click', startTimer);
        btnPause.addEventListener('click', pauseTimer);
        reset.addEventListener('click', resetTimer);

        incPomodoro.addEventListener('click', function(e){
            let timePomodoro = parseInt(sessionPomodoro.innerHTML);
            timePomodoro += 1;
            timer.runningTime = timePomodoro * 60;
            sessionPomodoro.innerHTML = timePomodoro;
            timeLeft.innerHTML = timer.getTime();

        });
        decPomodoro.addEventListener('click', function(e){
            let timePomodoro = parseInt(sessionPomodoro.innerHTML);
            timePomodoro -= 1;
            timer.runningTime = timePomodoro * 60;
            sessionPomodoro.innerHTML = timePomodoro;
            timeLeft.innerHTML = timer.getTime();

        });
        incBreak.addEventListener('click', function(e){
            let timeBreak = parseInt(sessionBreakFast.innerHTML);
            timeBreak += 1;
            sessionBreakFast.innerHTML = timeBreak;
        });
        decBreak.addEventListener('click', function(e){
            let timeBreak = parseInt(sessionBreakFast.innerHTML);
            timeBreak -= 1;
            sessionBreakFast.innerHTML = timeBreak;

        });
        incLongBreak.addEventListener('click', function(e){
            let timeLongBreak = parseInt(sessionLongBreak.innerHTML);
            timeLongBreak += 1;  
            sessionLongBreak.innerHTML = timeLongBreak;

        });
        decLongBreak.addEventListener('click', function(e){
            let timeLongBreak = parseInt(sessionLongBreak.innerHTML);
            timeLongBreak -= 1;
            sessionLongBreak.innerHTML = timeLongBreak;

        });
        getNumberPomodoros.addEventListener('change', function(e){
            timer.configNumberPomodoros = parseInt(getNumberPomodoros.options[getNumberPomodoros.selectedIndex].value);
            console.log(timer.configNumberPomodoros);
        });

        function startTimer(e){
            
            play_reset.classList.add('hidden');
            pause.classList.remove('hidden');
            timer.startTimer();
            click.play();
        }

        function pauseTimer(e){
            
            play_reset.classList.remove('hidden');
            pause.classList.add('hidden');
            timer.stopTimer()
        }

        function resetTimer(){
            
            timer.resetTime();
        }

        var timer = {
            totalSeconds: null,
            runningTime: null,
            timeHandler: null,	
            isWorkTime: true,	            
            countSessions: null,
            typeNotification: null,
            configNumberPomodoros: parseInt(getNumberPomodoros.options[getNumberPomodoros.selectedIndex].value),

            getTime: function(){
                function formating(value){
                    value = value.toString();
                    if(value.length < 2){
                        return '0' + value;
                    } else {
                        return value;
                    }
                }
                var minutes = Math.floor(this.runningTime / 60);
                var totalSeconds = this.runningTime - (minutes * 60);
                return formating(minutes) + " : " + formating(totalSeconds);
            },
            resetTime: function(){
                this.stopTimer();
                this.isWorkTime = true;
                this.countSessions = null;
                this.setTimer();
        
            },
            startTimer: function(){
                var that = this; 
                
                this.timeHandler = setInterval(function(){

                    if(that.runningTime > 0){
                        that.runningTime--;
                        
                    } else{
                        that.stopTimer();
                        that.isWorkTime = !that.isWorkTime;	
                        
                        that.setTimer();
                        finishedSession.play();
                        play_reset.classList.remove('hidden');
                        pause.classList.add('hidden');

                        if(Notification.permission === "granted"){
                            that.showNotification(that.typeNotification);
                        }
                        
                    }
                    
                    timeLeft.innerHTML = that.getTime();

                }, 1000);

            },
            stopTimer: function(){
                clearInterval(this.timeHandler);
            },
            setTimer: function(){
                var timerId = null;
                
                if(this.isWorkTime){
                    timerId = sessionPomodoro.innerHTML;                   
                    this.typeNotification = 'work';
                    document.getElementById('content-clock').classList.remove('bg-blue-400');
                    document.getElementById('content-clock').classList.remove('bg-green-500');
                    document.getElementById('content-clock').classList.add('bg-red-400');

                } else {
                    this.countSessions += 1;
                   
                    if(this.countSessions >= this.configNumberPomodoros){
                        timerId = sessionLongBreak.innerHTML;
                        this.countSessions = null;
                        this.typeNotification = 'longbreak'; 
                        document.getElementById('content-clock').classList.remove('bg-green-500');
                        document.getElementById('content-clock').classList.remove('bg-red-400');  
                        document.getElementById('content-clock').classList.add('bg-blue-400');
               
                    }else{
                        timerId = sessionBreakFast.innerHTML;               
                        this.typeNotification = 'breakfast';
                        document.getElementById('content-clock').classList.remove('bg-red-400');  
                        document.getElementById('content-clock').classList.remove('bg-blue-400');
                        document.getElementById('content-clock').classList.add('bg-green-500');

                    }

                }

                var seconds = parseInt(timerId) * 60;
                this.totalSeconds = seconds;
                this.runningTime = seconds;
                timeLeft.innerHTML = this.getTime();

            },

            getIsWorkTime: function(){
                return this.isWorkTime;

            }, 

            showNotification: function(typeNotification){
                if (typeNotification == 'work') {
                    const notification = new Notification("App Todo",{
                        body: "Hora de produzir"
                    });
                } else if(typeNotification == 'breakfast'){
                    const notification = new Notification("App Todo",{
                        body: "Hora da parada rápida"
                    });
                }else{
                    const notification = new Notification("App Todo",{
                        body: "Hora da parada longa"
                    });
                }
                
            },
            
        };

        timer.setTimer();

        if(Notification.permission !== 'denied'){
            Notification.requestPermission();
        }

    </script>

@endpush