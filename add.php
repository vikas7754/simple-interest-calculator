<?php
  include_once "includes/header.php";
  require_once "includes/db.php";

  if(isset($_POST['submit'])){
    $name = trim($_POST['name']);
    $amount = trim($_POST['amount']);
    $day = trim($_POST['day']);
    $month = trim($_POST['month']);
    $year = trim($_POST['year']);


    $query = "INSERT INTO `content`(`id`, `name`, `amount`, `category`, `day`, `month`, `year`, `cleared_date`) VALUES (null,'$name', '$amount', 'debt', '$day', '$month', '$year','NA')";
    $result = @$conn->query($query);
    if (!$result) {
        $errno = $conn->errno;
        $errmsg = $conn->error;
        echo "Uploading failed with: ($errno) $errmsg<br/>\n";
        $conn->close();
        exit;
    } else {?>
    <div class="alert alert-success mt-3">
        <strong>Success!</strong> Data Added sucessfully.
    </div>
    <script>
        setTimeout(function() {
        window.location.href = 'index.php';
        }, 2000);
    </script>
    <?php
    header("location: ./details.php?id=$id");
    }

  }
?>

<h1 class="text-center">Add Data</h1>
<div class="container">
    <div >
        <form method="post" action="">
            <div class="mt-3">
                <label for="name">Name :</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name"/>
            </div>
            <div class="mt-3">
                <label for="name">Amount :</label>
                <input type="number" class="form-control" id="amount" name="amount" placeholder="Enter Amount"/>
            </div>
            <div class="mt-3 row">
                <label for="name">Date :</label>
                <div class="col-4">
                    <select class="form-control" name="day" id="day" >
                        <option value="0">Day</option>
                        <option value="01">1</option>
                        <option value="02">2</option>
                        <option value="03">3</option>
                        <option value="04">4</option>
                        <option value="05">5</option>
                        <option value="06">6</option>
                        <option value="07">7</option>
                        <option value="08">8</option>
                        <option value="09">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>
                    </select>
                </div>
                <div class="col-4">
                    <select class="form-control" name="month" id="month">
                        <option value="0">Month</option>
                        <option value="01">1 / January</option>
                        <option value="02">2 / February</option>
                        <option value="03">3 / March</option>
                        <option value="04">4 / April</option>
                        <option value="05">5 / May</option>
                        <option value="06">6 / June</option>
                        <option value="07">7 / July</option>
                        <option value="08">8 / August</option>
                        <option value="09">9 / September</option>
                        <option value="10">10 / October</option>
                        <option value="11">11 / November</option>
                        <option value="12">12 / December</option>
                    </select>
                </div>
                <div class="col-4">
                <select class="form-control" name="year" id="year">
                        <option value="0">Year</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                        <option value="2026">2026</option>
                        <option value="2027">2027</option>
                        <option value="2028">2028</option>
                        <option value="2029">2029</option>
                        <option value="2030">2030</option>
                    </select>
                </div>
            </div>
            <div class="mt-4">
                <input type="submit" name="submit" value="Submit" class="btn btn-success form-control" />
            </div>
        </form>
    </div>
</div>
<div style="height:200px"></div>
<?php
  include_once "includes/footer.php";
?>