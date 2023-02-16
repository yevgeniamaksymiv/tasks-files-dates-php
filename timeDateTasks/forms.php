<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Document</title>
</head>
<body>
  <?php
session_start();

// check leap year

if (isset($_POST['year']) && !empty($_POST['year'])) {
    if (!preg_match("/^[0-9]{4}$/", $_POST['year'])) {
        $_SESSION['err-msg'] = 'Enter correct year';
        $_SESSION['msg'] = '';
    } else {
        $_SESSION['err-msg'] = '';
        $daysInFeb = cal_days_in_month(CAL_GREGORIAN, 2, (int) $_POST['year']);
        if ($daysInFeb === 29) {
            $_SESSION['msg'] = "{$_POST['year']} is a leap year";
        } else {
            $_SESSION['msg'] = "{$_POST['year']} is not a leap year";
        }
    }
}

// get day of week by date

$regex = "/^([0-2][0-9]|(3)[0-1])(.)(((0)[0-9])|((1)[0-2]))(.)\d{4}$/i";

if (isset($_POST['date']) && !empty($_POST['date'])) {
    if (!preg_match($regex, $_POST['date'])) {
        $_SESSION['err-msg-date'] = 'Enter correct date';
        $_SESSION['msg-date'] = '';
    } else {
        $_SESSION['err-msg-date'] = '';
        $date = explode('.', $_POST['date']);
        $_SESSION['msg-date'] = date('l', mktime(0, 0, 0, (int) $date[1], (int) $date[0], (int) $date[2]));
    }
}

// get month by date

$regexYearFirst = "/^\d{4}(\-)(((0)[0-9])|((1)[0-2]))(\-)([0-2][0-9]|(3)[0-1])$/i";

if (isset($_POST['date-2']) && !empty($_POST['date-2'])) {
    if (!preg_match($regexYearFirst, $_POST['date-2'])) {
        $_SESSION['err-msg-date-2'] = 'Enter correct date';
        $_SESSION['msg-date-2'] = '';
    } else {
        $_SESSION['err-msg-date-2'] = '';
        $date = explode('-', $_POST['date-2']);
        $_SESSION['msg-date-2'] = date('F', mktime(0, 0, 0, (int) $date[1], (int) $date[2], (int) $date[0]));
    }
}

// check which date bigger

if (isset($_POST['date1']) && !empty($_POST['date1']) && isset($_POST['date2']) && !empty($_POST['date2'])) {
    if (!preg_match($regexYearFirst, $_POST['date1'])
        || !preg_match($regexYearFirst, $_POST['date2'])
    ) {
        $_SESSION['err-msg-twoDates'] = 'Enter correct dates';
        $_SESSION['msg-twoDates'] = '';
    } else {
        $_SESSION['err-msg-twoDates'] = '';
        if ($_POST['date1'] > $_POST['date2']) {
            $_SESSION['msg-twoDates'] = 'First date bigger than second';
        }
        if ($_POST['date1'] < $_POST['date2']) {
            $_SESSION['msg-twoDates'] = 'Second date bigger than first';
        }
        if ($_POST['date1'] === $_POST['date2']) {
            $_SESSION['msg-twoDates'] = 'Dates are equal';
        }
    }
}

//  change format date / time

$regexDateTime =
    "/^\d{4}(\-)(((0)[0-9])|((1)[0-2]))(\-)([0-2][0-9]|(3)[0-1])(T)(((0)[0-9])|((1)[0-2]))(:)([0-5][0-9]|(6)[0])(:)([0-5][0-9]|(6)[0])$/i";

if (isset($_POST['date-time']) && !empty($_POST['date-time'])) {
    if (!preg_match($regexDateTime, $_POST['date-time'])) {
        $_SESSION['err-msg-dateTime'] = 'Enter correct date and time';
        $_SESSION['msg-dateTime'] = '';
    } else {
        $_SESSION['err-msg-dateTime'] = '';
        $_SESSION['msg-dateTime'] = date('h:i:s d.m.Y', strtotime($_POST['date-time']));
    }
}

// get Fridays 13

function getFridays13($year)
{
    $fridays = [];
    for ($i = 1; $i <= 12; $i++) {
        if (date('w', strtotime("{$year}-{$i}-13")) == 5) {
            $fridays[] = date('l, Y-m-d', strtotime("{$year}-{$i}-13"));
        }
    }
    return $fridays;
}

if (isset($_POST['year-fri13']) && !empty($_POST['year-fri13'])) {
    if (!preg_match("/^[0-9]{4}$/", $_POST['year-fri13'])) {
        $_SESSION['err-msg-fri13'] = 'Enter correct year';
        $_SESSION['msg-fri13'] = [];
    } else {
        $_SESSION['err-msg-fri13'] = '';
        $_SESSION['msg-fri13'] = getFridays13($_POST['year-fri13']);
    }
}
?>

  <div class="container">

    <form class="mt-4" action="" method="post">
      <label for="year" class="text-success">Enter year</label>
      <input type="text" class="form-control" id="year" name="year" placeholder="2023"/>
      <button class="btn btn-outline-success mt-3">Submit</button>
    </form>

    <p class="text-danger">
      <?php
if (isset($_SESSION['err-msg'])) {
    echo $_SESSION['err-msg'];
}
?>
    </p>
    <p class="text-success">
      <?php
if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
}
?>
    </p>
<hr>

    <form class="mt-4" action="" method="post">
      <label for="date" class="text-primary">Enter date</label>
      <input type="text" placeholder="31.12.2025" class="form-control" id="date" name="date"/>
      <button class="btn btn-outline-primary mt-3">Submit</button>
    </form>

    <p class="text-danger">
      <?php
if (isset($_SESSION['err-msg-date'])) {
    echo $_SESSION['err-msg-date'];
}
?>
    </p>
    <p class="text-primary">
      <?php
if (isset($_SESSION['msg-date'])) {
    echo $_SESSION['msg-date'];
}
?>
    </p>
<hr>
<form class="mt-4" action="" method="post">
      <label for="date-2" class="text-secondary">Enter date</label>
      <input type="text" placeholder="2025-12-31" class="form-control" id="date-2" name="date-2"/>
      <button class="btn btn-outline-secondary mt-3">Submit</button>
    </form>

    <p class="text-danger">
      <?php
if (isset($_SESSION['err-msg-date-2'])) {
    echo $_SESSION['err-msg-date-2'];
}
?>
    </p>
    <p class="text-secondary">
      <?php
if (isset($_SESSION['msg-date-2'])) {
    echo $_SESSION['msg-date-2'];
}
?>
    </p>
<hr>

<form class="mt-4" action="" method="post">
      <label for="date1" class="text-warning">Enter first date</label>
      <input type="text" placeholder="2025-12-31" class="form-control" id="date1" name="date1"/>
      <label for="date2" class="text-warning">Enter second date</label>
      <input type="text" placeholder="2025-12-31" class="form-control" id="date1" name="date2"/>
      <button class="btn btn-outline-warning mt-3">Submit</button>
    </form>

    <p class="text-danger">
      <?php
if (isset($_SESSION['err-msg-twoDates'])) {
    echo $_SESSION['err-msg-twoDates'];
}
?>
    </p>
    <p class="text-warning">
      <?php
if (isset($_SESSION['msg-twoDates'])) {
    echo $_SESSION['msg-twoDates'];
}
?>
    </p>
<hr>
<form class="mt-4" action="" method="post">
      <label for="date-time" class="text-dark">Enter date and time</label>
      <input type="text" placeholder="2025-12-31T12:13:59" class="form-control" id="date-time" name="date-time"/>
      <button class="btn btn-outline-dark mt-3">Submit</button>
    </form>

    <p class="text-danger">
      <?php
if (isset($_SESSION['err-msg-dateTime'])) {
    echo $_SESSION['err-msg-dateTime'];
}
?>
    </p>
    <p class="text-dark">
      <?php
if (isset($_SESSION['msg-dateTime'])) {
    echo $_SESSION['msg-dateTime'];
}
?>
    </p>
  <hr>
  <form class="mt-4" action="" method="post">
      <label for="year-fri13" class="text-success">Enter year</label>
      <input type="text" class="form-control" id="year-fri13" name="year-fri13" placeholder="2023"/>
      <button class="btn btn-outline-success mt-3">Submit</button>
    </form>

    <p class="text-danger">
      <?php
if (isset($_SESSION['err-msg-fri13'])) {
    echo $_SESSION['err-msg-fri13'];
}
?>
    </p>
    <p class="text-success">
      <?php
if (isset($_SESSION['msg-fri13']) && !empty($_SESSION['msg-fri13'])) {
    print_r($_SESSION['msg-fri13']);
}
?>
    </p>
  </div>
</body>
</html>