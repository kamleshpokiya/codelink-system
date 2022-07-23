
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
                if(!$data['workingHours']== null){
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
                            if ($hours < 9) {
                                $hours =  '0' . $hours;
                            }
                            if ($minutes < 9) {
                                $minutes =  '0' . $minutes;
                            }
                            if ($seconds < 9) {
                                $seconds =  '0' . $seconds;
                            }
                            if($out != '00:00:00'){
                                echo $hours . ' : ' . $minutes . ' : ' . $seconds;
                            }else {
                                echo '--';
                            }
                            ?>
                        </td>
                        <td>
                            <?php echo $value; ?>
                        </td>
                        <td>
                            <?
                            ?>
                            <button type='button' class="btn btn-outline-secondary btn-icon-text show_user_inout_onThisDate data-bs-toggle='modal' data-bs-target='#exampleModal'" id="user_inout_onThisDate" value='<?php echo json_encode($particular_date_in_out[$value]); ?>'> View <i class='mdi mdi-file-check btn-icon-append'></i>
                            </button>
                        </td>
                    </tr>
                <?php
                } }
                ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function() {
        $(document).on('click', '.show_user_inout_onThisDate', function() {
            $content = '';
            $date = $(this).val();
            $date = JSON.parse($date);
            $content += "<table class='table'>"
            $content += "<thead >";
            $content += "<tr>";
            $content += "<th>Sno.</th>";
            $content += "<th>Time - In </th>";
            $content += "<th>Time - Out</th>";
            $content += "</thead>";
            $content += "<tbody>";
            $.each($date, function(i, value) {
            console.log(value);
                $heading = 'Date : '+ value[3] +'';
                $content += '<tr><td>' + ++i + '</td>';
                $content += '<td>' + value[1] + '</td>';
                $content += '<td>' + value[2] + '</td>';
            });
            $content += "</tbody>";
            $content += "</table>";
            $('#exampleModalLabel').text($heading);
            $(".myModal_content").html($content);
            $("#myModal").modal('show');
        })
    });
</script>