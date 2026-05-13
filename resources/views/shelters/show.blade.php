<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $shelter->name }} | Shelter Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 text-gray-800 font-sans p-6 md:p-12">

    <div class="max-w-4xl mx-auto">
        <a href="{{ route('shelters.index') }}" class="inline-flex items-center text-gray-500 hover:text-black mb-8 transition-colors">
            <i class="fa-solid fa-arrow-left mr-2"></i>
            Back to all pets
        </a>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            
            <div class="h-32 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-gray-100"></div>

            <div class="p-8 -mt-16">
                <div class="flex flex-col md:flex-row gap-8 items-start">
                    
                    <div class="w-32 h-32 bg-white rounded-2xl shadow-md border-4 border-white flex items-center justify-center overflow-hidden">
                        <i class="fa-solid fa-house-chimney text-4xl text-blue-400"></i>
                    </div>

                    <div class="flex-1">
                        <div class="flex flex-wrap justify-between items-start gap-4">
                            <div>
                                <h1 class="text-3xl font-extrabold text-gray-900 leading-tight">
                                    {{ $shelter->name }}
                                </h1>
                                <p class="text-gray-500 flex items-center mt-1">
                                    <i class="fa-solid fa-location-dot mr-2"></i>
                                    {{ $shelter->city }}{{ $shelter->province ? ', ' . $shelter->province : '' }}
                                </p>
                            </div>
                            
                            <div class="flex gap-3">
                                <a href="{{ route('shelters.edit', $shelter) }}" 
                                   class="px-5 py-2 border border-gray-200 rounded-lg font-semibold hover:bg-gray-50 transition">
                                   Edit Profile
                                </a>
                                <button class="px-5 py-2 bg-black text-white rounded-lg font-semibold hover:bg-gray-800 transition">
                                   Contact Shelter
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-8 border-gray-100">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                    
                    <div>
                        <h2 class="text-lg font-bold mb-4">About Shelter</h2>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            This shelter is dedicated to finding loving homes for pets in the {{ $shelter->city }} area. 
                            Currently managing ID #{{ $shelter->id }}.
                        </p>
                        
                        <div class="space-y-4">
                            <div class="flex items-center text-gray-700">
                                <div class="w-10 h-10 bg-gray-50 rounded-lg flex items-center justify-center mr-4">
                                    <i class="fa-solid fa-map-pin text-gray-400"></i>
                                </div>
                                <span>{{ $shelter->address }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-6">
                        <h2 class="text-sm font-bold uppercase tracking-wider text-gray-400 mb-4">Contact Information</h2>
                        
                        <div class="space-y-6">
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase">Email Address</label>
                                <a href="mailto:{{ $shelter->email }}" class="text-blue-600 font-medium hover:underline">
                                    {{ $shelter->email }}
                                </a>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase">Phone Number</label>
                                <p class="text-gray-900 font-medium">
                                    {{ $shelter->phone ?? 'Not provided' }}
                                </p>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase">Location ID</label>
                                <p class="text-gray-900 font-medium">#{{ $shelter->id }}</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        
        <p class="text-center text-gray-400 text-sm mt-8">
            Created for the Pet Adoption System &bull; 2026
        </p>
    </div>

</body>
</html>