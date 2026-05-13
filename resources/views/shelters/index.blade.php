<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Your Perfect Companion</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans p-8">

    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Find Your Perfect Companion</h1>
                <p class="text-gray-500">Browse {{ $shelters->count() }} shelters available for partnership</p>
            </div>
            <button class="flex items-center gap-2 border rounded-md px-4 py-2 hover:bg-gray-100 transition">
                <i class="fa-regular fa-heart"></i>
                Favorites (0)
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-10">
            <div class="relative">
                <input type="text" placeholder="Search shelters..." class="w-full border rounded-md py-2 px-10 focus:ring-2 focus:ring-blue-500 outline-none">
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-gray-400"></i>
            </div>
            <select class="border rounded-md p-2 bg-white"><option>All Species</option></select>
            <select class="border rounded-md p-2 bg-white"><option>All Ages</option></select>
            <select class="border rounded-md p-2 bg-white"><option>All Genders</option></select>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-md mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($shelters as $shelter)
                <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100 hover:shadow-md transition-shadow relative">
                    <button class="absolute top-3 right-3 bg-white/80 p-2 rounded-full text-gray-600 hover:text-red-500">
                        <i class="fa-regular fa-heart"></i>
                    </button>

                    <img src="https://via.placeholder.com/300x200" alt="Shelter Image" class="w-full h-48 object-cover">

                    <div class="p-5">
                        <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $shelter->name }}</h3>
                        <p class="text-sm text-gray-500 mb-3">
                            {{ $shelter->city }} • {{ $shelter->email }}
                        </p>
                        <p class="text-sm text-gray-600 line-clamp-2 mb-4">
                            Contact: {{ $shelter->phone ?? 'N/A' }}
                        </p>

                        <div class="space-y-2">
                            <a href="{{ route('shelters.show', $shelter) }}" class="block w-full bg-black text-white text-center py-2 rounded-md font-semibold hover:bg-gray-800 transition">
                                View Details
                            </a>
                            <div class="flex gap-2">
                                <a href="{{ route('shelters.edit', $shelter) }}" class="flex-1 text-center text-sm py-1 border rounded hover:bg-gray-50">Edit</a>
                                <form action="{{ route('shelters.destroy', $shelter) }}" method="POST" class="flex-1">
                                    @csrf @method('DELETE')
                                    <button type="submit" onclick="return confirm('Delete?')" class="w-full text-sm py-1 border rounded text-red-500 hover:bg-red-50">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20 bg-white rounded-lg border">
                    <p class="text-gray-500">No shelters found.</p>
                    <a href="{{ route('shelters.create') }}" class="text-blue-500 underline">+ Add your first shelter</a>
                </div>
            @endforelse
        </div>
    </div>

</body>
</html>