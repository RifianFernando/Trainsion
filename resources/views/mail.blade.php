<!DOCTYPE html>
<html>

<head>
    <title>New Contact Us Email</title>
</head>

<body>
    <h2>Payment</h2>
    <p><strong>Name:</strong> {{ $data['name'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Subject:</strong> {{ $data['subject'] }}</p>
    <p><strong>Message:</strong></p>
    <p>{{ $data['message'] }}</p>
</body>

</html>
