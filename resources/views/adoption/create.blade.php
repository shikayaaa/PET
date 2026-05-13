<!DOCTYPE html>
<html>
<head><title>New Application</title></head>
<body>

<h1>New Adoption Application</h1>
<a href="{{ route('adoption-applications.index') }}">← Back</a>
<br><br>

<form action="{{ route('adoption-applications.store') }}" method="POST">
    @csrf

    Pet:
    <select name="pet_id">
        <option value="">-- Select Pet --</option>
        @foreach($pets as $pet)
            <option value="{{ $pet->id }}">{{ $pet->name }} ({{ $pet->type }})</option>
        @endforeach
    </select><br><br>

    Shelter:
    <select name="shelter_id">
        <option value="">-- Select Shelter --</option>
        @foreach($shelters as $shelter)
            <option value="{{ $shelter->id }}">{{ $shelter->name }}</option>
        @endforeach
    </select><br><br>

    Reason for adopting:<br>
    <textarea name="reason" rows="4" cols="40"></textarea><br><br>

    Home type: <input type="text" name="home_type" placeholder="house, apartment, condo"><br><br>
    Has yard: <input type="checkbox" name="has_yard" value="1"><br><br>
    Has other pets: <input type="checkbox" name="has_other_pets" value="1"><br><br>
    Has children: <input type="checkbox" name="has_children" value="1"><br><br>

    <button type="submit">Submit Application</button>
</form>

</body>
</html>