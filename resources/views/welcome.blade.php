<!DOCTYPE html>
<html lang="en" x-data="dashboard">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin IoT Dashboard</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-gray-100 font-sans flex h-screen">
    <!-- Sidebar -->
    <nav class="bg-blue-800 text-white w-64 p-4 flex flex-col">
        <div class="text-2xl font-bold mb-8 p-2 border-b border-blue-700">
            IoT Dashboard
        </div>
        <div class="flex-1">
            <a href="#" class="flex items-center p-3 rounded-lg bg-blue-700 mb-2">
                <i class="fas fa-home mr-3"></i> Home
            </a>
            <a href="#" class="flex items-center p-3 rounded-lg hover:bg-blue-700 mb-2">
                <i class="fas fa-microchip mr-3"></i> Manage Devices
            </a>
            <a href="#" class="flex items-center p-3 rounded-lg hover:bg-blue-700 mb-2">
                <i class="fas fa-calendar-alt mr-3"></i> Schedules
            </a>
            <a href="#" class="flex items-center p-3 rounded-lg hover:bg-blue-700">
                <i class="fas fa-cog mr-3"></i> Settings
            </a>
        </div>
        <div class="p-3 text-sm text-blue-200">
            <i class="fas fa-user-circle mr-2"></i> Admin
        </div>
    </nav>

    <!-- Main Content -->
    <div class="flex-1 p-8 overflow-y-auto">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-blue-800">Device Monitoring</h1>
            <div class="flex items-center">
                <span class="mr-2 text-sm text-gray-600">Status:</span>
                <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">
                    <i class="fas fa-circle mr-1"></i> Online
                </span>
            </div>
        </div>

        <!-- Device Info -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-bold text-blue-800">Cooling System - Room 1</h2>
                    <p class="text-gray-600">Device ID: ESP8266-001</p>
                </div>
                <div class="text-right">
                    <span x-text="time" class="text-lg font-bold">00:00:00</span>
                    <span x-text="date" class="text-gray-600 ml-2">Senin, 1 Januari 2024</span>
                </div>
            </div>
        </div>

        <!-- Sensor Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Temperature Card -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-gray-500 uppercase text-sm font-semibold">Temperature</h3>
                        <p class="text-3xl font-bold mt-2 text-blue-800">28.5°C</p>
                        <p class="text-sm mt-1 text-gray-500">Updated 1 minute ago</p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">
                        <i class="fas fa-temperature-high text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Humidity Card -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-gray-500 uppercase text-sm font-semibold">Humidity</h3>
                        <p class="text-3xl font-bold mt-2 text-blue-800">65%</p>
                        <p class="text-sm mt-1 text-gray-500">Updated 1 minute ago</p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">
                        <i class="fas fa-tint text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Manual Control Section -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Manual Control</h3>
            <div class="flex items-center justify-between">
                <div>
                    <span class="text-gray-700">Cooling Fan</span>
                    <p class="text-sm text-gray-500">Control relay manually</p>
                </div>
                <div class="flex items-center">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input 
                            type="checkbox" 
                            class="sr-only peer" 
                            x-model="relayStatus"
                            @change="updateRelayStatus"
                        >
                        <div 
                            class="w-11 h-6 rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all"
                            :class="relayStatus ? 'bg-blue-600' : 'bg-gray-400'"
                        ></div>
                        <span 
                            class="ml-3 text-sm font-medium"
                            :class="relayStatus ? 'text-blue-600' : 'text-gray-500'"
                            x-text="relayStatus ? 'ON' : 'OFF'"
                        >ON</span>
                    </label>
                </div>
            </div>
        </div>

        <!-- Schedule Management -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6" x-data="scheduleManager">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Schedule</h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Start Time</label>
                    <input 
                        type="time" 
                        class="w-full p-2 border border-gray-300 rounded-md"
                        x-model="newSchedule.startTime"
                    >
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">End Time</label>
                    <input 
                        type="time" 
                        class="w-full p-2 border border-gray-300 rounded-md"
                        x-model="newSchedule.endTime"
                    >
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Days</label>
                    <select 
                        multiple 
                        class="w-full p-2 border border-gray-300 rounded-md h-[42px]"
                        x-model="newSchedule.days"
                    >
                        <option value="Mon">Monday</option>
                        <option value="Tue">Tuesday</option>
                        <option value="Wed">Wednesday</option>
                        <option value="Thu">Thursday</option>
                        <option value="Fri">Friday</option>
                        <option value="Sat">Saturday</option>
                        <option value="Sun">Sunday</option>
                    </select>
                </div>
            </div>
            <button 
                @click="addSchedule"
                class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition"
            >
                <i class="fas fa-plus mr-2"></i> Add Schedule
            </button>

            <!-- Active Schedules List -->
            <div class="mt-6 border-t pt-4">
                <h4 class="font-medium text-gray-700 mb-2">Active Schedules</h4>
                <div id="schedule-list" class="space-y-2">
                    <!-- Default schedule example -->
                    <template x-for="(schedule, index) in schedules" :key="index">
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-md">
                            <div>
                                <span class="font-medium" x-text="`${schedule.startTime} - ${schedule.endTime}`"></span>
                                <span class="text-sm text-gray-500 ml-2" x-text="`(${schedule.days.join(', ')})`"></span>
                            </div>
                            <button @click="removeSchedule(index)" class="text-red-600 hover:text-red-800">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        <!-- Chart Placeholder -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Temperature & Humidity History</h3>
            <div class="h-64 bg-gray-100 rounded flex items-center justify-center text-gray-400">
                <p>Chart will appear here (Integrate with Chart.js later)</p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            // Main dashboard component
            Alpine.data('dashboard', () => ({
                time: '00:00:00',
                date: 'Senin, 1 Januari 2024',
                relayStatus: true,
                
                init() {
                    // Initialize real-time clock
                    this.updateTime();
                    setInterval(() => this.updateTime(), 1000);
                },
                
                updateTime() {
                    const now = new Date();
                    this.time = now.toLocaleTimeString();
                    this.date = now.toLocaleDateString('id-ID', { 
                        weekday: 'long', 
                        year: 'numeric', 
                        month: 'long', 
                        day: 'numeric' 
                    });
                },
                
                updateRelayStatus() {
                    // Here you would typically make an API call to update the actual device
                    console.log('Relay status changed to:', this.relayStatus ? 'ON' : 'OFF');
                }
            }));
            
            // Schedule manager component
            Alpine.data('scheduleManager', () => ({
                newSchedule: {
                    startTime: '',
                    endTime: '',
                    days: []
                },
                
                schedules: [
                    {
                        startTime: '07:00',
                        endTime: '09:00',
                        days: ['Mon', 'Wed', 'Fri']
                    }
                ],
                
                addSchedule() {
                    if (!this.newSchedule.startTime || !this.newSchedule.endTime || this.newSchedule.days.length === 0) {
                        alert('Harap isi semua field!');
                        return;
                    }
                    
                    this.schedules.push({
                        startTime: this.newSchedule.startTime,
                        endTime: this.newSchedule.endTime,
                        days: [...this.newSchedule.days]
                    });
                    
                    // Reset form
                    this.newSchedule = {
                        startTime: '',
                        endTime: '',
                        days: []
                    };
                },
                
                removeSchedule(index) {
                    this.schedules.splice(index, 1);
                }
            }));
        });
    </script>
</body>
</html>