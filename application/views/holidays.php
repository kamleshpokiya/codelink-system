<div class="card-body">
    <div class="table-responsive" style="margin-top: 40px;">
        <h4 class="card-title md-5" style=" margin-bottom:30px;">Holidays</h4>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th> Srno.</th>
                                        <th> Date</th>
                                        <th> Title </th>
                                        <th> Description</th>
                                        <th> Image</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($data['data'])) {
                                        $records = array_values($data['data']);
                                        foreach ($records as $key) {
                                    ?>
                                            <tr>
                                                <td><?php echo $key->id; ?></td>
                                                <td><?php echo $key->date; ?></td>
                                                <td><?php echo $key->title; ?></td>
                                                <td><?php echo $key->description; ?></td>
                                                <td><img class="img-xs rounded-circle" style="height:100px; width:200px; border-radius: 5% !important;" src="<?php echo site_url; ?>images/holiday_img/<?php echo $key->image; ?>" alt="<?php echo $key->image; ?>"></td>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        ?> <tr>
                                            <td style="color:white; font-size:large;">No record found</td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
    </div>
</div>
 