<!-- ANIMATION CONTAINER: 100% width, 400px height -->
<div class="relative w-full h-[300px] bg-sky-50 bg-gradient-to-b from-sky-200 to-gray-100 overflow-hidden shadow-xl">
    
    <!-- Background Elements: Utility Poles, Wires, and Solar Panels -->
    <div class="absolute inset-0 z-0">
        <!-- Main Wires (Static elements for context) -->
        <svg class="absolute top-16 w-full h-20" xmlns="http://www.w3.org/2000/svg">
            <!-- Top Wire -->
            <polyline points="0,10 100,15 200,5 300,18 400,10 500,20 600,8 700,22 800,12 900,25 10000,10" 
                       fill="none" stroke="#666" stroke-width="2" vector-effect="non-scaling-stroke" />
            <!-- Bottom Wire -->
            <polyline points="0,40 100,45 200,35 300,48 400,40 500,50 600,38 700,52 800,42 900,55 10000,40" 
                       fill="none" stroke="#666" stroke-width="2" vector-effect="non-scaling-stroke" />
        </svg>

        <!-- Pole 1 (Front) -->
        <div class="utility-pole left-[10%]">
            <div class="w-full h-4 bg-gray-600 absolute top-20"></div>
        </div>
        <!-- Pole 2 (Mid-distance) -->
        <div class="utility-pole left-[45%] opacity-70 scale-90">
             <div class="w-full h-4 bg-gray-600 absolute top-20"></div>
        </div>
        <!-- Pole 3 (Far-distance) -->
        <div class="utility-pole left-[80%] opacity-50 scale-80">
            <div class="w-full h-4 bg-gray-600 absolute top-20"></div>
        </div>

        <!-- Solar Panel Array (Distant Background Element) -->
        <div class="absolute top-24 left-[20%] w-40 h-10 bg-gray-700 transform skew-x-[-20deg] rounded shadow-inner z-5">
            <div class="absolute inset-1 bg-sky-800/80 grid grid-cols-4 gap-0.5 p-0.5">
                <div class="bg-blue-600/50 h-full"></div>
                <div class="bg-blue-600/50 h-full"></div>
                <div class="bg-blue-600/50 h-full"></div>
                <div class="bg-blue-600/50 h-full"></div>
            </div>
            <p class="text-[8px] text-white/50 absolute bottom-[-15px] left-0">Solar Solutions</p>
        </div>

        <!-- Electricity Spark 1 (Near the wire, front pole) -->
        <!--<div class="spark top-[55px] left-[12%] w-10 h-10 bg-cyan-400" style="animation-delay: 0.5s; animation-duration: 1.5s;"></div>
        <!-- Electricity Spark 2 (Abstract, mid-air) -->
        <!--<div class="spark top-[120px] left-[50%]" style="animation-delay: 1.2s;"></div>
        <!-- Electricity Spark 3 (Near the wire, far pole) -->
        <!--<div class="spark top-[45px] left-[80%] w-5 h-5" style="animation-delay: 0.8s; animation-duration: 2.5s;"></div>-->
    </div>
    
    <!-- Ground Layer (Pavement/Road) -->
    <div class="ground-layer"></div>

    <!-- The Electrician Character (The animated element) -->
    <div class="electrician-character absolute bottom-20 left-0 z-20">
        
        <!-- Character Group (Moves the head/body slightly up and down) -->
        <div class="head-body relative">
            
            <!-- Hard Hat (Brighter Yellow, more details) -->
            <div class="w-12 h-12 bg-yellow-400 rounded-full mx-auto border-4 border-yellow-800 shadow-md" title="Hard Hat">
                 <!-- Headlamp/Logo Detail -->
                <div class="w-2 h-2 bg-white rounded-full absolute top-3 left-1/2 -translate-x-1/2 shadow-inner"></div>
            </div>
            
            <!-- Body (Blue Overalls/Uniform) - Added Collar/Patch for detail -->
            <div class="w-16 h-24 bg-blue-700 rounded-t-lg mx-auto shadow-lg relative">
                <!-- Collar -->
                <div class="absolute top-0 w-full h-3 bg-blue-800 rounded-t-lg"></div>
                <!-- ID/Patch -->
                <div class="w-4 h-4 bg-red-500 absolute top-8 left-2 rounded-sm border border-white/50"></div>
                <div class="w-4 h-4 bg-red-500 absolute top-8 right-2 rounded-sm border border-white/50"></div>
            </div>
            
            <!-- Arms -->
            <div class="absolute -left-4 top-12 w-4 h-16 bg-blue-600 rounded-full transform rotate-12 origin-top-center"></div>
            
            <!-- Toolbox Arm (The swinging arm with a more detailed toolbox) -->
            <div class="arm-toolbox absolute -right-2 top-12 w-4 h-16 bg-blue-600 rounded-full transform rotate-[-12deg] origin-top-center">
                <!-- Hand -->
                <div class="w-4 h-4 bg-gray-400 rounded-full absolute bottom-0 -left-1"></div>
                <!-- Toolbox (more prominent handle and tools) -->
                <div class="absolute bottom-[-10px] left-[-20px] w-12 h-8 bg-gray-800 rounded-md border-2 border-gray-400 shadow-xl">
                    <!-- Handle -->
                    <div class="w-8 h-2 bg-yellow-400 absolute top-[-5px] left-2 rounded-b-sm rounded-t-lg border-2 border-yellow-500"></div>
                    <!-- Mock Tools Inside -->
                    <div class="w-1 h-3 bg-red-600 absolute top-2 left-3"></div>
                    <div class="w-1 h-3 bg-white absolute top-2 left-5"></div>
                    <div class="w-1 h-3 bg-yellow-600 absolute top-2 left-7"></div>
                </div>
            </div>

        </div>

        <!-- Legs -->
        <div class="flex justify-center mt-[-4px] relative z-10">
            <!-- Back Leg -->
            <div class="leg w-6 h-16 bg-blue-900 rounded-full mx-1 leg-back transform -rotate-6">
                 <div class="w-8 h-6 bg-yellow-700 absolute bottom-0 -left-1 rounded-t-sm rounded-b-lg shadow-inner"></div> <!-- Boot -->
            </div>
            <!-- Front Leg -->
            <div class="leg w-6 h-16 bg-blue-900 rounded-full mx-1 leg-front transform rotate-6">
                <div class="w-8 h-6 bg-yellow-700 absolute bottom-0 -left-1 rounded-t-sm rounded-b-lg shadow-inner"></div> <!-- Boot -->
            </div>
        </div>
    </div>
    
    <!-- Text Overlay -->
    <!-- <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-white/70 p-4 rounded-xl shadow-2xl text-center z-30">
        <h1 class="text-3xl font-bold text-gray-800">Electric Solutions: Service On The Move</h1>
        <p class="text-lg text-gray-600">The technician is on a constant loop, ready to fix any issue.</p>
    </div>-->
    
</div>

<!-- script for tailwind css -->
<script src="https://cdn.tailwindcss.com"></script>