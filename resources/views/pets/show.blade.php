<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pet->name }} | Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #fbfbf9; }
        .zoo-green { color: #2d5a27; }
        .bg-zoo-green { background-color: #2d5a27; }
        .bg-zoo-sand { background-color: #f4f1ea; }
    </style>
</head>
<body class="p-6 md:p-12">

    <div class="max-w-5xl mx-auto">
        <!-- Navigation -->
        <div class="mb-8 flex justify-between items-center">
            <a href="{{ route('pets.index') }}" class="text-gray-400 hover:text-zoo-green transition flex items-center gap-2 font-medium">
                <i class="fa-solid fa-arrow-left-long"></i> Back to Sanctuary
            </a>
            <a href="{{ route('pets.edit', $pet) }}" class="bg-white border border-gray-200 px-5 py-2 rounded-xl text-sm font-bold uppercase tracking-wider hover:bg-gray-50 transition shadow-sm">
                <i class="fa-regular fa-pen-to-square mr-2"></i> Edit Profile
            </a>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-xl shadow-gray-200/50 overflow-hidden border border-gray-100 flex flex-col md:flex-row">
            
            <!-- Left Side: Visual Identity -->
            <div class="md:w-2/5 relative bg-zoo-sand overflow-hidden">
                <img src="https://images.unsplash.com/photo-1543466835-00a7907e9de1?auto=format&fit=crop&q=80&w=800" 
                     alt="{{ $pet->name }}" 
                     class="w-full h-full object-cover min-h-[400px]">
                
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent flex flex-col justify-end p-8 text-white">
                    <span class="bg-white/20 backdrop-blur-md px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest w-fit mb-3">
                        ID: #{{ $pet->id }}
                    </span>
                    <h1 class="text-5xl font-bold mb-2">{{ $pet->name }}</h1>
                    <p class="text-white/80 flex items-center gap-2">
                        <i class="fa-solid fa-location-dot"></i> {{ $pet->shelter->name ?? 'Main Sanctuary' }}
                    </p>
                </div>
            </div>

            <!-- Right Side: Fact Sheet -->
            <div class="md:w-3/5 p-8 md:p-12">
                <div class="flex items-center gap-4 mb-8">
                    <span class="px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest bg-green-100 text-green-800">
                        ● {{ $pet->status }}
                    </span>
                    <span class="text-gray-300">|</span>
                    <span class="text-gray-500 font-medium italic">Registered Resident</span>
                </div>

                <div class="grid grid-cols-2 gap-y-8 gap-x-4 mb-10">
                    <div>
                        <h4 class="text-[10px] uppercase tracking-widest text-gray-400 font-bold mb-1">Species</h4>
                        <p class="text-lg font-semibold text-gray-800 capitalize">{{ $pet->type }}</p>
                    </div>
                    <div>
                        <h4 class="text-[10px] uppercase tracking-widest text-gray-400 font-bold mb-1">Breed</h4>
                        <p class="text-lg font-semibold text-gray-800">{{ $pet->breed ?? 'Mixed / Unknown' }}</p>
                    </div>
                    <div>
                        <h4 class="text-[10px] uppercase tracking-widest text-gray-400 font-bold mb-1">Age</h4>
                        <p class="text-lg font-semibold text-gray-800">{{ $pet->age_display }}</p>
                    </div>
                    <div>
                        <h4 class="text-[10px] uppercase tracking-widest text-gray-400 font-bold mb-1">Gender</h4>
                        <p class="text-lg font-semibold text-gray-800 capitalize">{{ $pet->gender }}</p>
                    </div>
                    <div>
                        <h4 class="text-[10px] uppercase tracking-widest text-gray-400 font-bold mb-1">Coloration</h4>
                        <p class="text-lg font-semibold text-gray-800">{{ $pet->color ?? 'Natural' }}</p>
                    </div>
                </div>

                <hr class="border-gray-100 mb-8">

                <!-- Behavioral Traits -->
                <div class="flex flex-wrap gap-3 mb-10">
                    <div class="flex items-center gap-2 px-4 py-2 bg-gray-50 border border-gray-100 rounded-xl">
                        <i class="fa-solid {{ $pet->is_vaccinated ? 'fa-circle-check text-green-600' : 'fa-circle-xmark text-gray-300' }}"></i>
                        <span class="text-sm font-semibold text-gray-700">Vaccinated</span>
                    </div>
                    <div class="flex items-center gap-2 px-4 py-2 bg-gray-50 border border-gray-100 rounded-xl">
                        <i class="fa-solid {{ $pet->is_neutered ? 'fa-circle-check text-green-600' : 'fa-circle-xmark text-gray-300' }}"></i>
                        <span class="text-sm font-semibold text-gray-700">Neutered</span>
                    </div>
                    <div class="flex items-center gap-2 px-4 py-2 bg-gray-50 border border-gray-100 rounded-xl">
                        <i class="fa-solid {{ $pet->good_with_kids ? 'fa-face-smile text-amber-600' : 'fa-circle-xmark text-gray-300' }}"></i>
                        <span class="text-sm font-semibold text-gray-700">Family Friendly</span>
                    </div>
                </div>

                <div class="bg-zoo-sand/50 p-6 rounded-2xl">
                    <h4 class="text-[10px] uppercase tracking-widest text-gray-400 font-bold mb-3">About {{ $pet->name }}</h4>
                    <p class="text-gray-600 leading-relaxed italic text-sm">
                        "{{ $pet->description ?? 'No biography available for this resident yet.' }}"
                    </p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>