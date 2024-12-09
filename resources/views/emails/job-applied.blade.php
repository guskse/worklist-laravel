<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workopia Job Application</title>
</head>
<body>
    <p>There has been a new job application to your workopia {{$job->title}} application listing.</p>

    <p><strong>Job title:</strong> {{$job->title}}</p>

    <p><strong>Application details:</strong></p>

    <p><strong>Full name:</strong> {{$application->full_name}}</p>
    <p><strong>Contact phone:</strong> {{$application->contact_phone}}</p>
    <p><strong>Contact email:</strong> {{$application->contact_email}}</p>
    <p><strong>Message:</strong> {{$application->message}}</p>
    <p><strong>Location:</strong> {{$application->location}}</p>

    <hr>
    <p>Login to your workopia account to view the job application</p>
</body>
</html>
