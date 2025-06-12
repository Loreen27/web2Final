<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Item</title>
</head>
<body>
    <h2>Add New Item</h2>

    @if(session('success'))
        <p style="color: black;">{{ session('success') }}</p>
    @endif

    @if(session('error'))
        <p style="color: blue;">{{ session('error') }}</p>
    @endif

    <form action="{{ route('items.store') }}" method="POST">
        @csrf

        <label for="name">Name:</label><br>
        <input type="text" name="name" value="{{ old('name') }}"><br>
        @error('name')
            <span style="color: blue;">{{ $message }}</span><br>
        @enderror

        <label for="email">Email:</label><br>
        <input type="email" name="email" value="{{ old('email') }}"><br>
        @error('email')
            <span style="color: blue;">{{ $message }}</span><br>
        @enderror

        <label for="age">Age:</label><br>
        <input type="number" name="age" value="{{ old('age') }}"><br>
        @error('age')
            <span style="color: blue;">{{ $message }}</span><br>
        @enderror

        <button type="submit">Add Item</button>
    </form>
</body>
</html>
