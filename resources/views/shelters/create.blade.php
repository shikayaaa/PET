<!DOCTYPE html>
<html>
<head><title>Add Shelter</title></head>
<body>

<h1>Add Shelter</h1>
<a href="{{ route('shelters.index') }}">← Back</a>
<br><br>

<form action="{{ route('shelters.store') }}" method="POST">
    @csrf
    Name: <input type="text" name="name"><br><br>
    Email: <input type="email" name="email"><br><br>
    Phone: <input type="text" name="phone"><br><br>
    Address: <input type="text" name="address"><br><br>
    City: <input type="text" name="city"><br><br>
    Province: <input type="text" name="province"><br><br>
    User ID: <input type="number" name="user_id"><br><br>
    <button type="submit">Save Shelter</button>
</form>

</body>
</html>