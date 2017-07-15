<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title><?php echo $title; ?> | Coro della Joska</title>
<meta name="description" content="<?php echo $description; ?>">
<meta name="author" content="Coro della Joska">
<meta name="keywords" content="coro,joska,rovigo,liceo,<?php echo $title; ?>">
<link rel="canonical" href="<?php echo $canonical; ?>">

<!-- Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<?php $this->view('opengraph', $_variables); ?>
