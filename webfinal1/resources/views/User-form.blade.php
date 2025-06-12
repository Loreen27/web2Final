<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Management</title>
</head>
<body>
    <h2>Add New User</h2>

    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <label>Name:</label>
        <input type="text" name="name" required><br>

        <label>Email:</label>
        <input type="email" name="email" required><br>

        <label>Age:</label>
        <input type="number" name="age" required><br>

        <button type="submit">Add User</button>
    </form>

    <h2>All Users</h2>
    <ul>
        @foreach($users as $user)
            <li>
                {{ $user->name }} - {{ $user->email }} - {{ $user->age }}
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>