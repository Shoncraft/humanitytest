<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
</head>

<?php
require 'src/shiftplanning.php';
$shiftplanning = new shiftplanning(
    array(
        'key' => '2034b257a60d77e9881b4c9a172a7edeeb269486'
    )
);
// Login and start the session
$session = $shiftplanning->getSession();
if(!$session)
{
    $response = $shiftplanning->doLogin(
    array(
        'username' => 'nenad.vaskovic@gmail.com',
        'password' => '05011981',
    )
  );
  }
// Make an API call to get shifts
$shifts = $shiftplanning->setRequest(
    array(
        'module' => 'schedule.shifts',
        'start_date' => 'today',
        'start_date' => 'today',
        'mode' => 'overview'
    )
);
// Get Employees and schedules using Quick Access methods
$get_schedules = $shiftplanning->getResponse();
$employees = $shiftplanning->getEmployees();

$thor = $employees['data'][1]['name'];
$wonderwoman = $employees['data'][2]['name'];
$wonder_start_time = $get_schedules['data'][1]['start_time']['time'];
$wonder_end_time = $get_schedules['data'][1]['end_time']['time'];
$thor_start_time = $get_schedules['data'][2]['start_time']['time'];
$thor_end_time = $get_schedules['data'][2]['end_time']['time'];
$wonder_position = $get_schedules['data'][1]['location']['name'];
$thor_position = $get_schedules['data'][2]['location']['name'];
?>

<body>
<table class="table">
  <thead class="thead-inverse">
    <tr>
      <th>Name</th>
      <th>Position</th>
      <th>Time</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><?php echo $wonderwoman ?></td>
      <td><?php echo $wonder_position ?></td>
      <td><?php echo $wonder_start_time ?> - <?php echo $wonder_end_time ?></td>
    </tr>
    <tr>
      <td><?php echo $thor ?></td>
      <td><?php echo $thor_position ?></td>
      <td><?php echo $thor_start_time ?> - <?php echo $thor_end_time ?></td>
    </tr>
  </tbody>
</table>
</body>
</html>