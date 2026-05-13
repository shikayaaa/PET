<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sanctuary Residents | Zoo Manager</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .zoo-green { color: #2d5a27; }
        .bg-zoo-green { background-color: #2d5a27; }
        .bg-zoo-sand { background-color: #f4f1ea; }
        .border-zoo-soft { border-color: #e8e4d9; }
    </style>
</head>
<body class="bg-[#fbfbf9] text-gray-800 p-6 md:p-12">

    <div class="max-w-7xl mx-auto">

        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
            <div>
                <h1 class="text-4xl font-bold tracking-tight text-gray-900">Sanctuary Residents</h1>
                <p class="text-gray-500 mt-2 text-lg">
                    Currently caring for
                    <span class="font-semibold zoo-green">{{ $pets->count() }} unique souls</span>
                </p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('pets.create') }}"
                   class="bg-zoo-green hover:opacity-90 text-white px-6 py-3 rounded-xl font-semibold transition flex items-center gap-2 shadow-md">
                    <i class="fa-solid fa-plus text-sm"></i> Register New Pet
                </a>
                <button class="bg-white border border-gray-200 px-5 py-3 rounded-xl font-semibold flex items-center gap-2 hover:bg-gray-50 transition">
                    <i class="fa-regular fa-heart"></i> Saved
                </button>
            </div>
        </div>

        <!-- Filter Bar -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-12">
            <div class="relative md:col-span-1">
                <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input type="text" placeholder="Search by name..."
                    class="w-full pl-11 pr-4 py-3 bg-white border border-gray-200 rounded-2xl focus:ring-2 focus:ring-[#2d5a27]/20 focus:border-zoo-green outline-none transition-all shadow-sm">
            </div>
            <select class="bg-white border border-gray-200 rounded-2xl px-4 py-3 outline-none focus:ring-2 focus:ring-[#2d5a27]/20 shadow-sm">
                <option>All Species</option>
                <option value="dog">Dog</option>
                <option value="cat">Cat</option>
                <option value="bird">Bird</option>
                <option value="rabbit">Rabbit</option>
                <option value="other">Other</option>
            </select>
            <select class="bg-white border border-gray-200 rounded-2xl px-4 py-3 outline-none focus:ring-2 focus:ring-[#2d5a27]/20 shadow-sm">
                <option>Life Stage</option>
                <option value="baby">Baby (0–6 mo)</option>
                <option value="young">Young (6–24 mo)</option>
                <option value="adult">Adult (2+ yrs)</option>
            </select>
            <select class="bg-white border border-gray-200 rounded-2xl px-4 py-3 outline-none focus:ring-2 focus:ring-[#2d5a27]/20 shadow-sm">
                <option>Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="unknown">Unknown</option>
            </select>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-50 border border-green-100 text-green-800 px-6 py-4 rounded-2xl mb-10 flex items-center gap-3">
                <i class="fa-solid fa-circle-check text-green-500"></i>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Pet Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-10">
            @forelse($pets as $pet)
                <div class="group bg-white rounded-[2rem] border border-gray-100 overflow-hidden hover:shadow-2xl hover:shadow-gray-200/50 transition-all duration-500 flex flex-col">

                    <!-- Image Container -->
                    <div class="relative h-72 overflow-hidden">
                        <button class="absolute top-5 right-5 z-10 bg-white/80 backdrop-blur-md p-2.5 rounded-full text-gray-400 hover:text-red-500 transition-colors">
                            <i class="fa-regular fa-heart"></i>
                        </button>

                        <img src="https://images.unsplash.com/photo-1543466835-00a7907e9de1?auto=format&fit=crop&q=80&w=600"
                             alt="{{ $pet->name }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">

                        <!-- FIXED: status comparison now uses lowercase to match DB values -->
                        <div class="absolute bottom-4 left-4">
                            <span class="px-4 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-widest backdrop-blur-md
                                {{ $pet->status === 'available' ? 'bg-green-500/90 text-white' :
                                   ($pet->status === 'pending'  ? 'bg-yellow-500/90 text-white' :
                                   ($pet->status === 'adopted'  ? 'bg-blue-500/90 text-white'  :
                                                                   'bg-gray-500/90 text-white')) }}">
                                ● {{ ucfirst($pet->status) }}
                            </span>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6 flex-grow flex flex-col">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-2xl font-bold text-gray-900 leading-tight">{{ $pet->name }}</h3>
                            <span class="text-xs font-semibold bg-zoo-sand px-2 py-1 rounded text-amber-800 uppercase">
                                {{ $pet->type }}
                            </span>
                        </div>

                        <p class="text-sm text-gray-500 font-medium mb-4">
                            {{ $pet->breed ?? 'Mixed Breed' }} •
                            {{-- FIXED: Use the model's age display accessor if available, else fallback --}}
                            {{ $pet->age_months ? $pet->age_months . ' months' : 'Age unknown' }}
                        </p>

                        <div class="flex items-center text-xs text-gray-400 mb-6 bg-gray-50 p-2 rounded-lg">
                            <i class="fa-solid fa-location-dot mr-2 zoo-green"></i>
                            {{ $pet->shelter->name ?? 'Main Sanctuary' }}
                        </div>

                        <!-- Buttons -->
                        <div class="mt-auto space-y-3">
                            <a href="{{ route('pets.show', $pet) }}"
                               class="block w-full bg-zoo-green text-white text-center py-4 rounded-2xl font-bold hover:brightness-110 transition shadow-lg shadow-green-900/10">
                                View Full Profile
                            </a>

                            <div class="flex gap-2">
                                <a href="{{ route('pets.edit', $pet) }}"
                                   class="flex-1 text-center py-2.5 text-xs font-bold uppercase tracking-wider text-gray-400 hover:text-zoo-green border border-transparent hover:border-zoo-soft rounded-xl transition">
                                    Edit
                                </a>
                                <form action="{{ route('pets.destroy', $pet) }}" method="POST" class="flex-1">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                            onclick="return confirm('Remove {{ $pet->name }} from the sanctuary?')"
                                            class="w-full py-2.5 text-xs font-bold uppercase tracking-wider text-gray-400 hover:text-red-500 border border-transparent hover:border-red-50 rounded-xl transition">
                                        Remove
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-24 text-center bg-white rounded-[3rem] border border-dashed border-gray-200">
                    <div class="bg-zoo-sand w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fa-solid fa-paw text-4xl zoo-green opacity-40"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Quiet in the dens...</h2>
                    <p class="text-gray-500 mt-2">No animals currently match your search criteria.</p>
                    <a href="{{ route('pets.create') }}"
                       class="inline-block mt-6 bg-zoo-green text-white px-6 py-3 rounded-xl font-semibold hover:opacity-90 transition">
                        Register First Pet
                    </a>
                </div>
            @endforelse
        </div>

    </div>

</body>
</html>