<div class="card-body">
    <div class="table-responsive" style="margin-top: 40px;">
        <h4 class="card-title">Daily ( In / Out )</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>Sno.</th>
                    <th>Time - In </th>
                    <th>Time - Out</th>
                    <th>Total ( Hours )</th>
                    <th>Date</th>
                    <th>Option</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $all_days = [];
                $per_day = [];
                foreach ($data['workingHours'] as $key => $value) {

                    if (!in_array($value['date'], $all_days)) {
                        array_push($all_days, $value['date']);
                    }

                    if (!in_array($value['date'], $per_day)) {
                        array_push($per_day, $value['date']);
                    }

                    if (in_array($value['date'], $all_days)) {
                        $indx = array_search($value['date'], $all_days);
                        $all_days[$indx] = [];
                        array_push($all_days[$indx], $value['time_in'], $value['time_out'], $value['date']);
                    }
                }

                $particular_date_in_out = [];
                foreach ($all_days as $key => $value) {
                    for ($i = 0; $i < count($per_day); $i++) {
                        if ($value[2] == $per_day[$i]) {
                            $particular_date_in_out[$value[2]][] = $value;
                        }
                    }
                }
                echo '<pre>';
                print_r($particular_date_in_out);


                foreach ($per_day as $key => $value) {

                ?>
                    <tr>
                        <td><?php echo $key + 1 ?></td>
                        <td><?php echo $particular_date_in_out[$value][0][0]; ?></td>
                        <td><?php echo end($particular_date_in_out[$value])[1]; ?></td>
                        <td>
                            <?php echo end($particular_date_in_out[$value])[1]; ?>
                        </td>
                        <td>
                            <?php
                            $total_hours = [];
                            $hour = [];
                            $minute = [];
                            $second = [];
                            foreach ($particular_date_in_out[$value] as $key => $val) {
                                $time_out = date_create($val[1]);
                                $time_in = date_create($val[0]);

                                // Calculating the difference between DateTime objects
                                $interval = date_diff($time_out, $time_in);
                                // echo $interval-> h .' :'. $interval->i.' : '. $interval->s;
                                array_push($hour, $interval ->h);
                                array_push($minute, $interval ->i);
                                array_push($second, $interval ->s);
                                // echo '<pre>';
                                // print_r($val[0]);
                                // print_r($val[1]);
                                // break;
                            }
                            echo '<pre>';
                            print_r($hour)
                            ?>
                        </td>
                        <td><button type='button' class='btn btn-outline-secondary btn-icon-text'> View <i class='mdi mdi-file-check btn-icon-append'></i>
                            </button></td>
                    </tr>

                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>