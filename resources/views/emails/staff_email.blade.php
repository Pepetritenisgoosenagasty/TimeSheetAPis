<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>
</head>
<body>
    <h4>Hi {{ $staff['firstname'] . " " . $staff['lastname'] }}</h4>
    <p>Kindly Clock in using the id below</p>
    <h5>StaffID: {{ $staff['staff_id'] }}</h5>
   
    <p>Thank you</p>
</body>
</html>