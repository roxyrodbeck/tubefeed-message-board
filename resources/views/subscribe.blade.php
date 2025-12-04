<!DOCTYPE html>
<html>
<head>
    <title>Subscribe to Tube Feed Updates</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 500px; margin: 50px auto; padding: 20px; }
        input { width: 100%; padding: 10px; margin: 10px 0; }
        button { background: #4CAF50; color: white; padding: 10px 20px; border: none; cursor: pointer; }
        .success { color: green; padding: 10px; background: #d4edda; border-radius: 5px; }
    </style>
</head>
<body>
    <h1>Subscribe to SMS Alerts</h1>
    
    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    <form method="POST" action="/subscribe">
        @csrf
        <div>
            <label>Name:</label>
            <input type="text" name="name" required>
        </div>
        <div>
            <label>Phone Number (include country code):</label>
            <input type="text" name="phone_number" placeholder="+12817012625" required>
        </div>
        <button type="submit">Subscribe</button>
    </form>
</body>
</html>