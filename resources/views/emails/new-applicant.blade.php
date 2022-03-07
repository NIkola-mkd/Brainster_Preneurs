<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Applicant</title>
</head>

<body>
    <h1>You have a new applicant</h1>

    <p>
        Student <b>{{$name}}</b> has applied for <b>{{$title}}</b>
        <br>
        Skills:

    <ul style="list-style-type: square;">
        @foreach($skills as $skill)
        <li>{{$skill}}</li>
        @endforeach
    </ul>
    </p>
    <hr>
    <p>
        <i>
            Student message:
        </i>
        {{$msg}}
    </p>

</body>

</html>