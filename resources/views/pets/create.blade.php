<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Resident | Zoo Manager</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2d5a27;
            --bg: #f8f9fa;
            --card-bg: #ffffff;
            --text: #333;
            --border: #e0e0e0;
            --accent: #f0f4f0;
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
            padding: 40px 20px;
        }
        .container {
            background: var(--card-bg);
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.04);
            max-width: 600px;
            width: 100%;
        }
        .header-section { margin-bottom: 30px; }
        .badge {
            background: var(--accent);
            color: var(--primary);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        h1 { font-weight: 600; font-size: 1.8rem; margin: 15px 0 5px 0; color: var(--text); }
        .back-link { text-decoration: none; color: #888; font-size: 0.9rem; transition: color 0.2s; }
        .back-link:hover { color: var(--primary); }
        .error-alert {
            background: var(--error-bg);
            border: 1px solid var(--error-border);
            color: var(--error-text);
            padding: 14px 18px;
            border-radius: 10px;
            margin-bottom: 24px;
            font-size: 0.9rem;
        }
        .error-alert ul { margin: 0; padding-left: 20px; }
        .error-alert li { margin-bottom: 4px; }
        .form-group { margin-bottom: 1.5rem; }
        label {
            display: block;
            font-weight: 600;
            font-size: 0.8rem;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #777;
        }
        input[type="text"], input[type="number"], select, textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            font-size: 1rem;
            box-sizing: border-box;
            background-color: #fff;
            transition: all 0.2s ease;
        }
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(45,90,39,0.05);
        }
        input.is-invalid, select.is-invalid { border-color: #ef4444; }
        .field-error { color: #ef4444; font-size: 0.78rem; margin-top: 5px; font-weight: 500; }
        textarea { height: 120px; resize: vertical; }
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .shelter-row { display: flex; gap: 10px; align-items: flex-start; }
        .shelter-row select { flex: 1; }
        .btn-add-shelter {
            flex-shrink: 0;
            padding: 12px 16px;
            background-color: var(--accent);
            color: var(--primary);
            border: 1.5px solid #c8dac5;
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            white-space: nowrap;
            transition: background-color 0.2s, transform 0.1s;
        }
        .btn-add-shelter:hover { background-color: #daebd7; transform: translateY(-1px); }
        .checkbox-container {
            background: var(--bg);
            padding: 20px;
            border-radius: 12px;
            margin-top: 25px;
            border: 1px dashed var(--border);
        }
        .checkbox-item { display: flex; align-items: center; margin-bottom: 10px; cursor: pointer; font-size: 0.95rem; }
        .checkbox-item:last-child { margin-bottom: 0; }
        .checkbox-item input { margin-right: 12px; accent-color: var(--primary); width: 18px; height: 18px; }
        button[type="submit"] {
            width: 100%;
            padding: 16px;
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            margin-top: 30px;
            transition: transform 0.2s, background-color 0.2s;
        }
        button[type="submit"]:hover { background-color: #244a1f; transform: translateY(-1px); }

        /* Modal */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.45);
            backdrop-filter: blur(3px);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }
        .modal-overlay.active { display: flex; }
        .modal {
            background: #fff;
            border-radius: 16px;
            padding: 36px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
            animation: slideUp 0.25s ease;
        }
        @keyframes slideUp {
            from { transform: translateY(20px); opacity: 0; }
            to   { transform: translateY(0);    opacity: 1; }
        }
        .modal h2 { font-size: 1.3rem; font-weight: 600; color: var(--primary); margin: 0 0 6px 0; }
        .modal p { color: #888; font-size: 0.85rem; margin: 0 0 24px 0; }
        .modal .form-group { margin-bottom: 1.2rem; }
        .modal-footer { display: flex; gap: 10px; margin-top: 24px; }
        .btn-cancel {
            flex: 1; padding: 12px;
            background: var(--bg);
            border: 1.5px solid var(--border);
            border-radius: 10px;
            font-size: 0.95rem; font-weight: 600; color: #666;
            cursor: pointer; transition: background 0.2s;
        }
        .btn-cancel:hover { background: #eee; }
        .btn-save-shelter {
            flex: 1; padding: 12px;
            background: var(--primary);
            border: none; border-radius: 10px;
            font-size: 0.95rem; font-weight: 600; color: #fff;
            cursor: pointer; transition: opacity 0.2s;
        }
        .btn-save-shelter:hover { opacity: 0.88; }
        .btn-save-shelter:disabled { opacity: 0.5; cursor: not-allowed; }
        .toast {
            display: none;
            position: fixed;
            bottom: 30px; right: 30px;
            background: var(--primary);
            color: #fff;
            padding: 14px 20px;
            border-radius: 12px;
            font-size: 0.9rem; font-weight: 600;
            box-shadow: 0 8px 24px rgba(45,90,39,0.3);
            z-index: 2000;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header-section">
        <a href="{{ route('pets.index') }}" class="back-link">← Return to Inventory</a>
        <h1>Add New Resident</h1>
        <span class="badge">Registration Form</span>
    </div>

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

    <form action="{{ route('pets.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g. Barnaby"
                   class="{{ $errors->has('name') ? 'is-invalid' : '' }}">
            @error('name') <div class="field-error">{{ $message }}</div> @enderror
        </div>

        <div class="grid-2">
            <div class="form-group">
                <label>Species / Type</label>
                <select name="type" class="{{ $errors->has('type') ? 'is-invalid' : '' }}">
                    <option value="">-- Select --</option>
                    <option value="dog"    {{ old('type') == 'dog'    ? 'selected' : '' }}>Dog</option>
                    <option value="cat"    {{ old('type') == 'cat'    ? 'selected' : '' }}>Cat</option>
                    <option value="bird"   {{ old('type') == 'bird'   ? 'selected' : '' }}>Bird</option>
                    <option value="rabbit" {{ old('type') == 'rabbit' ? 'selected' : '' }}>Rabbit</option>
                    <option value="other"  {{ old('type') == 'other'  ? 'selected' : '' }}>Other</option>
                </select>
                @error('type') <div class="field-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label>Breed</label>
                <input type="text" name="breed" value="{{ old('breed') }}" placeholder="Unknown">
            </div>
        </div>

        <div class="grid-2">
            <div class="form-group">
                <label>Gender</label>
                <select name="gender" class="{{ $errors->has('gender') ? 'is-invalid' : '' }}">
                    <option value="">-- Select --</option>
                    <option value="male"    {{ old('gender') == 'male'    ? 'selected' : '' }}>Male</option>
                    <option value="female"  {{ old('gender') == 'female'  ? 'selected' : '' }}>Female</option>
                    <option value="unknown" {{ old('gender') == 'unknown' ? 'selected' : '' }}>Unknown</option>
                </select>
                @error('gender') <div class="field-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label>Age (months)</label>
                <input type="number" name="age_months" value="{{ old('age_months') }}" placeholder="0" min="0">
            </div>
        </div>

        <div class="form-group">
            <label>Coloration</label>
            <input type="text" name="color" value="{{ old('color') }}" placeholder="e.g. Golden, Spotted">
        </div>

        <div class="form-group">
            <label>Biography and Temperament</label>
            <textarea name="description" placeholder="Describe the animal's personality and history...">{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="status" class="{{ $errors->has('status') ? 'is-invalid' : '' }}">
                <option value="">-- Select Status --</option>
                <option value="available"   {{ old('status') == 'available'   ? 'selected' : '' }}>Available</option>
                <option value="pending"     {{ old('status') == 'pending'     ? 'selected' : '' }}>Pending</option>
                <option value="adopted"     {{ old('status') == 'adopted'     ? 'selected' : '' }}>Adopted</option>
                <option value="unavailable" {{ old('status') == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
            </select>
            @error('status') <div class="field-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label>Assigned Shelter</label>
            <div class="shelter-row">
                <select name="shelter_id" id="shelterSelect"
                        class="{{ $errors->has('shelter_id') ? 'is-invalid' : '' }}">
                    <option value="">No Shelter / Unassigned</option>
                    @foreach($shelters as $shelter)
                        <option value="{{ $shelter->id }}"
                            {{ old('shelter_id') == $shelter->id ? 'selected' : '' }}>
                            {{ $shelter->name }}
                        </option>
                    @endforeach
                </select>
                <button type="button" class="btn-add-shelter" onclick="openShelterModal()">
                    + New
                </button>
            </div>
            @error('shelter_id') <div class="field-error">{{ $message }}</div> @enderror
        </div>

        <div class="checkbox-container">
            <label style="margin-bottom: 14px; display:block;">Medical and Behavior</label>
            <label class="checkbox-item">
                <input type="checkbox" name="is_vaccinated" value="1" {{ old('is_vaccinated') ? 'checked' : '' }}>
                Medical: Vaccinated
            </label>
            <label class="checkbox-item">
                <input type="checkbox" name="is_neutered" value="1" {{ old('is_neutered') ? 'checked' : '' }}>
                Medical: Neutered
            </label>
            <label class="checkbox-item">
                <input type="checkbox" name="good_with_kids" value="1" {{ old('good_with_kids') ? 'checked' : '' }}>
                Behavior: Good with children
            </label>
        </div>

        <button type="submit">Complete Registration</button>
    </form>
</div>

{{-- Add New Shelter Modal --}}
<div class="modal-overlay" id="shelterModal">
    <div class="modal">
        <h2>Add New Shelter</h2>
        <p>The new shelter will be saved and auto-selected in the dropdown.</p>

        <div class="form-group">
            <label>Shelter Name *</label>
            <input type="text" id="newShelterName" placeholder="e.g. Happy Paws Shelter">
            <div class="field-error" id="shelterNameError" style="display:none;">Shelter name is required.</div>
        </div>
        <div class="form-group">
            <label>Location / Address</label>
            <input type="text" id="newShelterLocation" placeholder="e.g. 123 Main St, City">
        </div>
        <div class="form-group">
            <label>Contact Number</label>
            <input type="text" id="newShelterContact" placeholder="e.g. 09XX-XXX-XXXX">
        </div>

        <div class="modal-footer">
            <button type="button" class="btn-cancel" onclick="closeShelterModal()">Cancel</button>
            <button type="button" class="btn-save-shelter" id="saveShelterBtn" onclick="saveShelter()">Save Shelter</button>
        </div>
    </div>
</div>

<div class="toast" id="toast"></div>

<script>
    function openShelterModal() {
        document.getElementById('shelterModal').classList.add('active');
        document.getElementById('newShelterName').focus();
    }

    function closeShelterModal() {
        document.getElementById('shelterModal').classList.remove('active');
        document.getElementById('newShelterName').value     = '';
        document.getElementById('newShelterLocation').value = '';
        document.getElementById('newShelterContact').value  = '';
        document.getElementById('shelterNameError').style.display = 'none';
    }

    document.getElementById('shelterModal').addEventListener('click', function(e) {
        if (e.target === this) closeShelterModal();
    });

    document.getElementById('newShelterName').addEventListener('keydown', function(e) {
        if (e.key === 'Enter') { e.preventDefault(); saveShelter(); }
    });

    function saveShelter() {
        const nameInput = document.getElementById('newShelterName');
        const name      = nameInput.value.trim();
        const location  = document.getElementById('newShelterLocation').value.trim();
        const contact   = document.getElementById('newShelterContact').value.trim();

        if (!name) {
            document.getElementById('shelterNameError').style.display = 'block';
            nameInput.focus();
            return;
        }
        document.getElementById('shelterNameError').style.display = 'none';

        const btn = document.getElementById('saveShelterBtn');
        btn.disabled    = true;
        btn.textContent = 'Saving...';

        fetch('{{ route("shelters.store") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
            body: JSON.stringify({ name, location, contact })
        })
        .then(res => res.json())
        .then(data => {
            if (data.id) {
                const select = document.getElementById('shelterSelect');
                const option = new Option(data.name, data.id, true, true);
                select.appendChild(option);
                select.value = data.id;
                closeShelterModal();
                showToast('Shelter "' + data.name + '" added and selected!');
            } else {
                const msg = data.errors
                    ? Object.values(data.errors).flat().join(' ')
                    : 'Something went wrong.';
                alert(msg);
            }
        })
        .catch(() => alert('Network error. Please try again.'))
        .finally(() => {
            btn.disabled    = false;
            btn.textContent = 'Save Shelter';
        });
    }

    function showToast(msg) {
        const toast = document.getElementById('toast');
        toast.textContent   = msg;
        toast.style.display = 'block';
        setTimeout(() => { toast.style.display = 'none'; }, 3000);
    }
</script>

</body>
</html>