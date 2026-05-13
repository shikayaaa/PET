<!DOCTYPE html>
<html>
<head><title>Adoption Applications</title></head>
<body>

<h1>Adoption Applications</h1>
<a href="{{ route('adoption-applications.create') }}">+ New Application</a>
<br><br>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Pet</th>
        <th>Shelter</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
    @forelse($applications as $app)
    <tr>
        <td>{{ $app->id }}</td>
        <td>{{ $app->pet->name ?? 'N/A' }}</td>
        <td>{{ $app->shelter->name ?? 'N/A' }}</td>
        <td>{{ $app->status }}</td>
        <td>
            <a href="{{ route('adoption-applications.show', $app) }}">View</a> |
            <a href="{{ route('adoption-applications.edit', $app) }}">Edit</a> |
            <form action="{{ route('adoption-applications.destroy', $app) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Delete?')">Delete</button>
            </form>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="5" style="text-align:center">No applications found.</td>
    </tr>
    @endforelse
</table>

</body>
</html>