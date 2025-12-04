<!DOCTYPE html>
<html>
<head>
    <title>Subscribe to Tube Feed Updates</title>
</head>
<body>
    <h1>Subscribe to SMS Alerts</h1>
    
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form method="POST" action="/subscribe">
        @csrf
        <div>
            <label>Name:</label>
            <input type="text" name="name" required>
        </div>
        <div>
            <label>Phone Number (with country code):</label>
            <input type="text" name="phone_number" placeholder="+12817012625" required>
        </div>
        <button type="submit">Subscribe</button>
    </form>
</body>
</html>