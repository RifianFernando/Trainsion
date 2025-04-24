<!DOCTYPE html>
 <html>
 <head>
     <title>New Contact Us Email</title>
 </head>
 <body>
     <h2>Contact Form Submission</h2>
     <p><strong>Name:</strong> {{ $contactData['name'] }}</p>
     <p><strong>Email:</strong> {{ $contactData['email'] }}</p>
     <p><strong>Subject:</strong> {{ $contactData['subject'] }}</p>
     <p><strong>Message:</strong></p>
     <p>{{ $contactData['message'] }}</p>
 </body>
 </html>