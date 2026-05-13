<!DOCTYPE html>
<html>
<head><title>Edit Shelter</title></head>
<body>

<h1>Edit Shelter</h1>
<a href="{{ route('shelters.index') }}">← Back</a>
<br><br>

<form action="{{ route('shelters.update', $shelter) }}" method="POST">
    @csrf
    @method('PUT')
    Name: <input type="text" name="name" value="{{ $shelter->name }}"><br><br>
    Email: <input type="email" name="email" value="{{ $shelter->email }}"><br><br>
    Phone: <input type="text" name="phone" value="{{ $shelter->phone }}"><br><br>
    Address: <input type="text" name="address" value="{{ $shelter->address }}"><br><br>
    City: <input type="text" name="city" value="{{ $shelter->city }}"><br><br>
    Province: <input type="text" name="province" value="{{ $shelter->province }}"><br><br>
    <button type="submit">Update Shelter</button>
</form>

</body>
</html>