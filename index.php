<!DOCTYPE html>
<html lang="en">

<head>
    <title>Omnilytics Programming Challenge</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Include css files */ -->
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-bootgrid/1.3.1/jquery.bootgrid.css" />

    <!-- Include js files -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-bootgrid/1.3.1/jquery.bootgrid.js"></script>
    <script type="text/javascript" src="script/script.js"></script>
</head>

<body>

<?php 

//these lines are used to detect errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// This function will return an alphanumeric random
function random_alphanumeric($random_lenght) 
{ 
    // String of all alphanumeric random (only small letters)
    $alphabetical_string = 'abcdefghijklmnopqrstuvwxyz0123456789'; 
  
    // Shufle the $alphabetical_string, starts from first position and returns substring of given length 
    return substr(str_shuffle($alphabetical_string), 0, $random_lenght); 
} 
// lenght of 17
$alphanumeric = random_alphanumeric(17);


// This function will return an alphabetical random
function alphabetical($random_lenght) 
{ 
    // String of all alphabet  (only small letters)
    $alphabetical_string = 'abcdefghijklmnopqrstuvwxyz'; 
  
    // Shufle the $alphabetical_string, starts from first position and returns substring of given length 
    return substr(str_shuffle($alphabetical_string), 0, $random_lenght); 
} 
//lenght of 15
$alphanbetical_result = alphabetical(15);


// The below line generates integer randoms
$int_result = mt_rand();

//The below function returns float random number starting from 0 and max of 1000000 with 3 decimal. 
function rand_real_num($min_no=0,$max_no=1000000,$decimal_no=1000){
    if ($min_no>$max_no) return false;
    return mt_rand($min_no*$decimal_no,$max_no*$decimal_no)/$decimal_no;
    }
    $float_result = rand_real_num(); 


// Now, we create the file (myFile.txt)
$file = 'myFile.txt';
//This piece of code is to get the file size in MB
$file_size = filesize("myFile.txt"); 
$file_size_mb = ($file_size / 1024 / 1024);
$file_size_mb = number_format($file_size_mb, 2);
if($file_size_mb<=10) {
    // we save our randoms to myFile.txt
    $data = array($alphanumeric, $int_result, $alphanbetical_result, $float_result);
    file_put_contents($file, implode(', ',$data).', ',FILE_APPEND | LOCK_EX);
}
else {
    echo "File Size exceeded.";
}

/* After we saved, Now we need to retrieve the randoms-
in the new line with their datatypes
*/
$filecontents = file_get_contents('myFile.txt');
//we break the string $filecontents to array
$words = explode(" ", $filecontents);
?>
    <div class="text-center">
        <h2>Omnilytics Programming Challenge</h2>
        <button id="button" onClick="window.location.reload();"></button>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table id="grid-basic" class="table table-condensed table-hover table-striped">
                    <thead>
                        <tr>
                            <th data-column-id="alphanumeric">Alphanumeric Random</th>
                            <th data-column-id="alphabetical">Alphabetical Random</th>
                            <th data-column-id="integer">Integer Random</th>
                            <th data-column-id="float">Real Number Random</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php print_r($alphanumeric); ?></td>
                            <td><?php echo $alphanbetical_result; ?></td>
                            <td><?php echo $int_result; ?></td>
                            <td><?php echo $float_result; ?></td>
                        </tr>
                    </tbody>
                </table>
                <div class="col-md-12">
                    <h3 class="titles">Expected output</h3>
                    <?php 
                        foreach ($words as $key => $value) {
                            echo $value . "  ";
                        }
                    ?>
                </div>
            </div>

            <div class="col-md-12">
                <div class="file_data">
                    <h3 class="titles">myFile.txt data with size of
                        <?php 
                            echo $file_size_mb . "MB";
                        ?>
                     </h3>
                     <?php 
                        echo ("*Note: At the moment, I could not manage to classify randoms to their specific data types (all displaying string)."); 
                    ?>
                </div>
                <table id="fileResult" class="display">
                        <thead>
                            <tr>
                                <th>Randoms</th>
                                <th>Data Types of Randoms</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                                $words = (str_replace(",", "", $words)); //We remove (,) from our random
                                foreach ($words as $key => $value) {?>
                                    <tr>
                                        <td>
                                            <?php 
                                                echo $value ;
                                            ?>
                                        </td>
                                        <td><?php 
                                            echo gettype($value), "</br/>";
                                        ?></td>
                                    </tr>
                               <?php }
                            ?>
                        </tbody>
                </table>
                <h3 class="titles">Thank You</h3>
            </div>
            
    <script>
        $(document).ready(function() {
            $('#fileResult').DataTable({
                "order": [],
                "columnDefs": [ {
                "targets"  : 'no-sort',
                "orderable": false,
                }]
            });
            $("#grid-basic").bootgrid();
        });
    </script>
</body>

</html>