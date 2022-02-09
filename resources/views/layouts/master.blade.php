<!DOCTYPE html>
<html>

<head>
    <title>{{$title ?? 'Brainster Preneurs'}}</title>
    <meta charset="utf-8" />
    <meta name="keywords" content="brainster preneurs, Brainster Preneurs, brainster" />
    <meta name="description" content="Оваа платформа служи за соработка помеѓу студентите на академиите
            во Брејнстер и поттикнување на претприемачкиот дух помеѓу нив.Секој студент ќе може да се регистрира, да си направи профил, и доколку
            има идеја за проект кој што сака да го реализира, но му требаат луѓе со
            различен профил (пр. маркетер, дизајнер…), ќе може да „креира понуда“
            за проект во која ќе даде детален опис на неговата идеја заедно со типот
            на профили на соработници кои би му биле потребни. На оваа понуда ќе
            може да аплицираат останати регистрирани студенти на кои им се
            допаѓа идејата и би сакале да бидат дел од нејзината реализација." />
    <meta name="author" content="Nikola Domazetovikj" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Latest compiled and minified Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://www.dafontfree.net/embed/bW9udHNlcnJhdC1zZW1pLWJvbGQmZGF0YS8xNi9tLzc4NjM3L01vbnRzZXJyYXQtU2VtaUJvbGQub3Rm" rel="stylesheet" type="text/css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300&display=swap" rel="stylesheet">
    <link href=" {{ asset('css/custom.css') }} " rel="stylesheet">
    @yield('css')
</head>

<body>

    @include('layouts.navbar')

    @yield('content')

    @include('layouts.footer')

    @yield('js');

</body>

</html>