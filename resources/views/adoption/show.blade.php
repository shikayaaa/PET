<!DOCTYPE html>
<html>
<head><title>Application Details</title></head>
<body>

<h1>Application Details</h1>
<a href="{{ route('adoption-applications.index') }}">← Back</a>
<br><br>

<p>ID: {{ $adoptionApplication->id }}</p>
<p>Pet: {{ $adoptionApplication->pet->name ?? 'N/A' }}</p>
<p>Shelter: {{ $adoptionApplication->shelter->name ?? 'N/A' }}</p>
<p>Status: {{ $adoptionApplication->status }}</p>
<p>Reason: {{ $adoptionApplication->reason }}</p>
<p>Home type: {{ $adoptionApplication->home_type }}</p>
<p>Has yard: {{ $adoptionApplication->has_yard ? 'Yes' : 'No' }}</p>
<p>Has other pets: {{ $adoptionApplication->has_other_pets ? 'Yes' : 'No' }}</p>
<p>Has children: {{ $adoptionApplication->has_children ? 'Yes' : 'No' }}</p>
<br>
<a href="{{ route('adoption-applications.edit', $adoptionApplication) }}">Edit</a>

</body>
</html>