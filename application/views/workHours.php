<div class="card-body">
    <div class="table-responsive" style="margin-top: 40px;">
        <h4 class="card-title md-5" style=" margin-bottom:30px;">Daily ( In / Out )</h4>
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
                        array_push($all_days[$indx], $value['id'], $value['time_in'], $value['time_out'], $value['date']);
                    }
                }
                
                $particular_date_in_out = [];
                foreach ($all_days as $key => $value) {
                    for ($i = 0; $i < count($per_day); $i++) {
                        if ($value[3] == $per_day[$i]) {
                            $particular_date_in_out[$value[3]][] = $value;
                        }
                    }
                }
               
                // echo '<pre>';
                // print_r($particular_date_in_out);


                foreach ($per_day as $key => $value) {

                ?>
                    <tr>
                        <td><?php echo $key + 1 ?></td>
                        <td><?php echo $particular_date_in_out[$value][0][1]; ?></td>
                        <td><?php echo end($particular_date_in_out[$value])[2]; ?></td>

                        <td>
                            <?php
                            $hours = 0;
                            $minutes = 0;
                            $seconds = 0;


                            $in = $particular_date_in_out[$value][0][1];
                            $out = end($particular_date_in_out[$value])[2];
                            $time1 = new DateTime($in);
                            $time2 = new DateTime($out);
                            $time_diff = $time1->diff($time2);
                            $hours = $time_diff->h;
                            $minutes = $time_diff->i;
                            $seconds = $time_diff->s;

                            // foreach ($particular_date_in_out[$value] as $key => $val) {
                            //     $time_out = date_create($val[2]);
                            //     $time_in = date_create($val[1]);
                            //     // Calculating the difference between DateTime objects
                            //     // $interval = date_diff($time_out, $time_in);
                            //     // $hours  +=   $interval->h;
                            //     // $minutes +=  $interval->i;
                            //     // $seconds +=  $interval->s;
                            // }
                            // echo "<pre>";
                            // print_r($hours);
                // echo round($minutes / 60,2). " minute";
                           
                            if ($hours < 9) {
                                $hours =  '0' . $hours;
                            }
                            if ($minutes < 9) {
                                $minutes =  '0' . $minutes;
                            }
                            if ($seconds < 9) {
                                $seconds =  '0' . $seconds;
                            }

                            echo $hours . ' : ' . $minutes . ' : ' . $seconds;
                            ?>
                        </td>
                        <td>
                            <?php echo $value; ?>
                        </td>
                        <td>
                            <button type='button' class="btn btn-outline-secondary btn-icon-text show_user_inout_onThisDate data-bs-toggle='modal' data-bs-target='#exampleModal'" id="user_inout_onThisDate" value="<?php print_r($particular_date_in_out[$value]); ?>"> View <i class='mdi mdi-file-check btn-icon-append'></i>
                            </button>
                        </td>
                    </tr>

                <?php
                }   
                ?>
            </tbody>
        </table>
    </div>
</div>


<script>
    $(document).ready(function() {

        $(document).on('click', '.show_user_inout_onThisDate', function() {
               $heading = 'Show User in/out';
        //        $content = '
        //        <table class='table'>
        //   <thead>
        //     <tr>
        //       <th>Sno.</th>
        //       <th>Time - In </th>
        //       <th>Time - Out</th>
        //       <th>Option</th>
        //     </tr>
        //   </thead>
        //   <tbody>
        //     <tr>
        //       <td>efrsf</td>
        //       <td>efrsf</td>
        //       <td>efrsf</td>
        //       <td><button type='button' class='btn btn-primary'>Update</button></td>
             
        //     </tr>
        //   </tbody>
        // </table>
        // ';
                $('#exampleModalLabel').text($heading);
                $(".myModal_content").text($content);
                $("#myModal").modal('show');


            $('#modal-title').html($heading);
            $('#myModal_content').html($content);
            $KKDD = $(this).val();
            // console.log($KKDD);
            // console.log($.type($KKDD));
            $.each($KKDD, function(index, value) {
                console.log('kdfklsf');
            });

        })

    });
</script>