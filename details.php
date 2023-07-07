<?php
  include_once "includes/header.php";
  include_once "includes/db.php";
  $id = $_GET['id'];
  $today = date('Y-m-d');
  $query = "SELECT * FROM content WHERE id = '$id'";
$result = $conn->query($query);
//Handle selection errors
if (!$result) {
    $errno = $conn->errno;
    $errmsg = $conn->error;
    echo "Selection failed with: ($errno) $errmsg<br/>\n";
    $conn->close();
    exit;
} else {
    $result_row = $result->fetch_assoc();
    $name = $result_row['name'];
            $amount = $result_row['amount'];
            $year = $result_row['year'];
            $month = $result_row['month'];
            $day = $result_row['day'];
            $date = $year ."-" .$month ."-" .$day;
            $date_x =  $day."-" .$month ."-" .$year;

            $date1 = new DateTime("$date");
            $date2 = new DateTime("$today");
            $interval = $date1->diff($date2);

            $years = "";
            $months = "";
            $days = "";

            $year_count = $interval->y;
            $month_count = $interval->m;
            $day_count = $interval->d;
            if($year_count > 0) $years = $year_count ." साल ";
            if($month_count > 0) $months = $month_count." महीना ";
            if($day_count > 0) $days = $day_count." दिन";

            $total_months = $year_count * 12 + $month_count + $day_count/30; 
            $interest = floor($amount / 100 * 5 * $total_months);
    ?>
    <?php
      if(isset($_POST['deletedata']))
      {
          $query_str = "UPDATE `content` SET `category`='cleared', `cleared_date`='$today' WHERE id='$id'";
          $result_x = $conn->query($query_str);
      
          if(!$result_x){
            $errno = $conn->errno;
            $errmsg = $conn->error;
            echo "Selection failed with: ($errno) $errmsg<br/>\n";
            $conn->close();
            exit;
          }else{
            echo '<script> alert("Data Deleted"); </script>';
            header("Location:index.php");
          }
      }
    ?>
    <div class="container">
        <div class="text-center">
            <h3 class="text-center mt-3"><?php echo $name;?></h3>
            <p>Amount : <span class="i_amount"><?php echo $amount;?> ₹</span><br/>Date : <span class="i_date"><?php echo $result_row['day']."-".$result_row['month']."-".$result_row['year'];?></span></p>
            <p>समय = <span class="i_time"><?php echo $years, $months, $days ;?></span> <br/>ब्याज = <span class="interest_x"><?php echo $interest ;?> ₹</p>
        </div>
        <div class="text-center mt-5">
            <button type="button" class="btn btn-danger deletebtn"> DELETE </button>
        </div>
    </div>

    <!-- DELETE POP UP FORM (Bootstrap MODAL) -->
    <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Delete Student Data </h5>
                    <button type="button" class="btn btn-danger close close_window" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="details.php?id=<?php echo $id; ?>" method="POST">
                    <div class="modal-body">

                        <input type="hidden" name="delete_id" id="delete_id">

                        <h4> Do you want to Clear this Data ??</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close_window" data-dismiss="modal"> NO </button>
                        <button type="submit" name="deletedata" class="btn btn-primary"> Yes !! Clear. </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

<?php
}
  $conn->close();
  include_once "includes/footer.php";
?>