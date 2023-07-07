<?php
include_once "includes/header.php";
include_once "includes/db.php";
$query = "SELECT * FROM content WHERE category = 'debt' ORDER BY name ASC";
$result = $conn->query($query);
//Handle selection errors
if (!$result) {
    $errno = $conn->errno;
    $errmsg = $conn->error;
    echo "Selection failed with: ($errno) $errmsg<br/>\n";
    $conn->close();
    exit;
} else {
?>
<h1 class="text-center m-4">Bakaya</h1>
<div class="container">
    <div class="search-box">
        <input class="p-2 form-control" type="text" id="myInput" placeholder="Search..." onkeyup="search()">
    </div>
</div>
<div class="container">
    <div class="list-card">
    <?php
        $sum = 0;
        while ($result_row = $result->fetch_assoc()) { 
            $id = $result_row['id'];
            $name = $result_row['name'];
            $amount = $result_row['amount'];
            $year = $result_row['year'];
            $month = $result_row['month'];
            $day = $result_row['day'];
            $date = $year ."-" .$month ."-" .$day;
            $date_x =  $day."-" .$month ."-" .$year;
            $sum = $sum + $amount;

            $date1 = new DateTime("$date");
            $date2 = new DateTime("$today");
            $interval = $date1->diff($date2);

            $years = "";
            $months = "";
            $days = "";

            $year_count = $interval->y;
            $month_count = $interval->m;
            $day_count = $interval->d;
            if($year_count > 0) $years = $year_count ." साल";
            if($month_count > 0) $months = $month_count." महीना";
            if($day_count > 0) $days = $day_count." दिन";

            $total_months = $year_count * 12 + $month_count + $day_count/30; 
            $interest = floor($amount / 100 * 5 * $total_months);
            echo "
            <a href='details.php?id=$id' class='list'>
                <span class='i_name'>$name</span>, <span class='i_amount'>$amount ₹</span>, Date - <span class='i_date'>$date_x</span>
                <br/><span class='detail'><span class='time'>समय = $years $months $days</span>, &nbsp;&nbsp;&nbsp;<span class='interest'>ब्याज = $interest ₹</span>
            </a>
            <div class='list'>
            <a href='details.php?id=$id'><span class='i_name'>$name</span>, <span class='i_amount'>$amount ₹</span>, Date - <span class='i_date'>$date_x</span>
              <br/><span class='detail'><span class='time'>समय = $years $months $days</span>, &nbsp;&nbsp;&nbsp;<span class='interest'>ब्याज = $interest ₹</span>
            
            </a>
            </div>
            ";
        } ?>
        
    </div>
</div><hr/>

<?php
$result->close();
}

$query_x = "SELECT * FROM content WHERE category = 'cleared' ORDER BY name ASC";
$result_x = $conn->query($query_x);
//Handle selection errors
if (!$result_x) {
    $errno = $conn->errno;
    $errmsg = $conn->error;
    echo "Selection failed with: ($errno) $errmsg<br/>\n";
    $conn->close();
    exit;
} else {
?>
<h1 class="text-center m-4">Cleared</h1>
<div class="container">
    <div class="search-box">
        <input class="p-2 form-control" type="text" id="mycInput" placeholder="Search..." onkeyup="csearch()">
    </div>
</div>
<div class="container">
    <div class="c_list-card">
    <?php
        while ($result_row_x = $result_x->fetch_assoc()) { 
            $id = $result_row_x['id'];
            $name = $result_row_x['name'];
            $amount = $result_row_x['amount'];
            $year = $result_row_x['year'];
            $month = $result_row_x['month'];
            $day = $result_row_x['day'];
            $date = $year ."-" .$month ."-" .$day;
            $date_x =  $day."-" .$month ."-" .$year;
            $c_date = $result_row_x['cleared_date'];

            $date1 = new DateTime("$date");
            $date2 = new DateTime("$c_date");
            $interval = $date1->diff($date2);

            $years = "";
            $months = "";
            $days = "";

            $year_count = $interval->y;
            $month_count = $interval->m;
            $day_count = $interval->d;
            if($year_count > 0) $years = $year_count ." साल";
            if($month_count > 0) $months = $month_count." महीना";
            if($day_count > 0) $days = $day_count." दिन";

            $total_months = $year_count * 12 + $month_count + $day_count/30; 
            $interest = floor($amount / 100 * 5 * $total_months);
            echo "
            <div class='c_list'>
            <a href='#'><del><span class='i_name'>$name</span>, <span class='i_amount'>$amount ₹</span>, Date - <span class='i_date'>$date_x</span>
              <br/><span class='detail'><span class='time'>समय = $years $months $days</span>, &nbsp;&nbsp;&nbsp;<span class='interest'>ब्याज = $interest ₹</span> <br/><span class='interest'>Cleared on : $c_date </span>
            </del>
            </a>
            </div>
            ";
        } ?>
        
    </div>
</div>


<?php
$result_x->close();
}
$conn->close();

include("includes/footer.php");
?>