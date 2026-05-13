<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pet | Zoo Manager</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2d5a27;
            --bg: #f8f9fa;
            --card-bg: #ffffff;
            --text: #333;
            --border: #e0e0e0;
            --accent: #f4f1ea;
            --error-bg: #fee2e2;
            --error-text: #991b1b;
            --error-border: #fca5a5;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg);
            color: var(--text);
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            background: var(--card-bg);
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            max-width: 600px;
            width: 100%;
        }

        h1 {
            font-weight: 600;
            font-size: 1.5rem;
            margin-bottom: 8px;
            color: var(--primary);
        }

        .back-link {
            text-decoration: none;
            color: #888;
            font-size: 0.9rem;
            display: inline-block;
            margin-bottom: 25px;
            transition: color 0.2s;
        }

        .back-link:hover { color: var(--primary); }

        /* FIXED: Error alert */
        .error-alert {
            background: var(--error-bg);
            border: 1px solid var(--error-border);
            color: var(--error-text);
            padding: 14px 18px;
            border-radius: 10px;
            margin-bottom: 24px;
            font-size: 0.9rem;
        }

        .error-alert ul {
            margin: 0;
            padding-left: 20px;
        }

        .error-alert li { margin-bottom: 4px; }
        .error-alert li:last-child { margin-bottom: 0; }

        .form-group { margin-bottom: 1.5rem; }

        label {
            display: block;
            font-weight: 600;
            font-size: 0.85rem;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #666;
        }

        input[type="text"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 1rem;
            box-sizing: border-box;
            background-color: #fff;
            transition: border-color 0.2s;
        }

        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: var(--primary);
        }

        input.is-invalid, select.is-invalid, textarea.is-invalid {
            border-color: #ef4444;
        }

        .field-error {
            color: #ef4444;
            font-size: 0.78rem;
            margin-top: 5px;
            font-weight: 500;
        }

        textarea {
            height: 100px;
            resize: vertical;
        }

        .checkbox-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            background: var(--accent);
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            font-size: 0.9rem;
            cursor: pointer;
        }

        .checkbox-item input {
            margin-right: 10px;
            accent-color: var(--primary);
            width: 18px;
            height: 18px;
        }

        button {
            width: 100%;
            padding: 14px;
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            margin-top: 30px;
            transition: opacity 0.2s;
        }

        button:hover { opacity: 0.9; }

        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <a href="{{ route('pets.index') }}" class="back-link">← Back to Sanctuary</a>
    <h1>Edit Resident Profile</h1>
    <p style="color: #888; font-size: 0.9rem; margin-bottom: 30px;">Update the details for the animal in your care.</p>

    {{-- FIXED: Show validation errors --}}
    @if ($errors->any())
        <div class="error-alert">
            <strong>Please fix the following errors:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pets.update', $pet) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name"
                   value="{{ old('name', $pet->name) }}"
                   class="{{ $errors->has('name') ? 'is-invalid' : '' }}">
            @error('name') <div class="field-error">{{ $message }}</div> @enderror
        </div>

        <div class="grid-2">
            <div class="form-group">
                <label>Species</label>
                <select name="type" class="{{ $errors->has('type') ? 'is-invalid' : '' }}">
                    <option value="dog"    {{ old('type', $pet->type) == 'dog'    ? 'selected' : '' }}>Dog</option>
                    <option value="cat"    {{ old('type', $pet->type) == 'cat'    ? 'selected' : '' }}>Cat</option>
                    <option value="bird"   {{ old('type', $pet->type) == 'bird'   ? 'selected' : '' }}>Bird</option>
                    <option value="rabbit" {{ old('type', $pet->type) == 'rabbit' ? 'selected' : '' }}>Rabbit</option>
                    <option value="other"  {{ old('type', $pet->type) == 'other'  ? 'selected' : '' }}>Other</option>
                </select>
                @error('type') <div class="field-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label>Breed</label>
                <input type="text" name="breed" value="{{ old('breed', $pet->breed) }}">
            </div>
        </div>

        <div class="grid-2">
            <div class="form-group">
                <label>Gender</label>
                <select name="gender" class="{{ $errors->has('gender') ? 'is-invalid' : '' }}">
                    <option value="male"    {{ old('gender', $pet->gender) == 'male'    ? 'selected' : '' }}>Male</option>
                    <option value="female"  {{ old('gender', $pet->gender) == 'female'  ? 'selected' : '' }}>Female</option>
                    <option value="unknown" {{ old('gender', $pet->gender) == 'unknown' ? 'selected' : '' }}>Unknown</option>
                </select>
                @error('gender') <div class="field-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label>Age (months)</label>
                <input type="number" name="age_months"
                       value="{{ old('age_months', $pet->age_months) }}"
                       min="0">
            </div>
        </div>

        <div class="form-group">
            <label>Color</label>
            <input type="text" name="color" value="{{ old('color', $pet->color) }}">
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea name="description">{{ old('description', $pet->description) }}</textarea>
        </div>

        <div class="grid-2">
            <div class="form-group">
                <label>Status</label>
                <select name="status" class="{{ $errors->has('status') ? 'is-invalid' : '' }}">
                    {{-- FIXED: comparison uses lowercase to match DB values --}}
                    <option value="available"   {{ old('status', $pet->status) == 'available'   ? 'selected' : '' }}>Available</option>
                    <option value="pending"     {{ old('status', $pet->status) == 'pending'     ? 'selected' : '' }}>Pending</option>
                    <option value="adopted"     {{ old('status', $pet->status) == 'adopted'     ? 'selected' : '' }}>Adopted</option>
                    <option value="unavailable" {{ old('status', $pet->status) == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                </select>
                @error('status') <div class="field-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label>Shelter Location</label>
                <select name="shelter_id" class="{{ $errors->has('shelter_id') ? 'is-invalid' : '' }}">
                    @foreach($shelters as $shelter)
                        <option value="{{ $shelter->id }}"
                            {{ old('shelter_id', $pet->shelter_id) == $shelter->id ? 'selected' : '' }}>
                            {{ $shelter->name }}
                        </option>
                    @endforeach
                </select>
                @error('shelter_id') <div class="field-error">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="checkbox-grid">
            <label class="checkbox-item">
                <input type="checkbox" name="is_vaccinated" value="1"
                       {{ old('is_vaccinated', $pet->is_vaccinated) ? 'checked' : '' }}>
                Vaccinated
            </label>
            <label class="checkbox-item">
                <input type="checkbox" name="is_neutered" value="1"
                       {{ old('is_neutered', $pet->is_neutered) ? 'checked' : '' }}>
                Neutered
            </label>
            <label class="checkbox-item">
                <input type="checkbox" name="good_with_kids" value="1"
                       {{ old('good_with_kids', $pet->good_with_kids) ? 'checked' : '' }}>
                Kid Friendly
            </label>
        </div>

        <button type="submit">Update Resident Profile</button>
    </form>
</div>

</body>
</html>