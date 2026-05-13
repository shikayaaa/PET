<!DOCTYPE html>
<html>
<head><title>Edit Application</title></head>
<body>

<h1>Edit Application</h1>
<a href="{{ route('adoption-applications.index') }}">← Back</a>
<br><br>

<form action="{{ route('adoption-applications.update', $adoptionApplication) }}" method="POST">
    @csrf
    @method('PUT')

    Status:
    <select name="status">
        <option value="pending" {{ $adoptionApplication->status == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="under_review" {{ $adoptionApplication->status == 'under_review' ? 'selected' : '' }}>Under Review</option>
        <option value="approved" {{ $adoptionApplication->status == 'approved' ? 'selected' : '' }}>Approved</option>
        <option value="rejected" {{ $adoptionApplication->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
        <option value="cancelled" {{ $adoptionApplication->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
    </select><br><br>

    Reviewer Notes:<br>
    <textarea name="reviewer_notes" rows="4" cols="40">{{ $adoptionApplication->reviewer_notes }}</textarea><br><br>

    <button type="submit">Update</button>
</form>

</body>
</html>