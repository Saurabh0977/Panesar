<div class="content-wrapper">
    <div class="content">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Generate Reports</h5>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload"></a></li>
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>
            </div>
            <div class="panel-body">
                <table class="table datatable-show-all">
                    <tr>
                        <th class="text-center" width="10%">Type</th>
                        <th class="text-center" width="30%">Select</th>
                        <th class="text-center" width="20%">Duration</th>
                        <th class="text-center" width="20%">Options</th>
                    </tr>
                    <tr>
                        <form method="POST" target="_blank" id="form1" action="<?php echo base_url(); ?>/Report/create_report/1">
                            <td class="text-center">ITEM</td>
                            <td class="text-center">
                                <select class="select form-control" name="id" required>
                                    <option value="">--Select an Item--</option>
                                    <?php
																																			foreach ($items as $item) {
																																				?>
                                    <option value="<?php echo $item->ID; ?>">
                                        <?php echo $item->NAME; ?>
                                    </option>
                                    <?php

																																		}
																																		?>
                                </select>
                            </td>
                            <td class="text-center">
                                <p><input type="date" name="fdate" class="form-control"></p>
                                <p class="text-center">To</p>
                                <p><input type="date" name="tdate" class="form-control"></p>
                            </td>
                            <td class="text-center">
                                <button type="submit" class="btn btn-primary" name="preview" id="preview"><i class="icon-eye"></i></button>
                                <button type="button" class="btn btn-primary" onclick="submit(1)" name="download" value="download"><i
                                        class="icon-download4"></i></button>
                            </td>
                        </form>
                    </tr>
                    <tr>
                        <form method="POST" target="_blank" id="form2" action="<?php echo base_url(); ?>/Report/create_report/2">
                            <td class="text-center">LOTS</td>
                            <td class="text-center">
                                <select class="select form-control" name="id" required>
                                    <option value="">--Select a Lot--</option>
                                    <?php
																																			foreach ($lots as $lot) {
																																				?>
                                    <option value="<?php echo $lot->ID; ?>">
                                        <?php echo $lot->NAME; ?>
                                    </option>
                                    <?php

																																		}
																																		?>
                                </select>
                            </td>
                            <td class="text-center">
                                <p>Time Period Not Required</p>
                            </td>
                            <td class="text-center">
                                <button type="submit" class="btn btn-primary" name="preview"><i class="icon-eye"></i></button>
                                <button type="button" class="btn btn-primary" onclick="submit(2)" name="download" value="download"><i
                                        class="icon-download4"></i></button>
                            </td>
                        </form>
                    </tr>

                    <tr>
                        <form method="POST" target="_blank" id="form3" action="<?php echo base_url(); ?>/Report/create_report/3">
                            <td class="text-center">SALES</td>
                            <td class="text-center">
                                <select class="select form-control" name="id" required>
                                    <option value="">--Select a Sale--</option>
                                    <?php
																																			foreach ($sales as $sale) {
																																				?>
                                    <option value="<?php echo $sale->ID; ?>">
                                        <?php echo $sale->NAME; ?>
                                    </option>
                                    <?php

																																		}
																																		?>
                                </select>
                            </td>
                            <td class="text-center">
                                <p><input type="date" name="fdate" class="form-control"></p>
                                <p class="text-center">To</p>
                                <p><input type="date" name="tdate" class="form-control"></p>
                            </td>
                            <td class="text-center">
                                <button type="submit" class="btn btn-primary" name="preview"><i class="icon-eye"></i></button>
                                <button type="button" class="btn btn-primary" onclick="submit(3)" name="download" value="download"><i
                                        class="icon-download4"></i></button>
                            </td>
                        </form>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    // $("#preview").click(function() {
    //     var selected_option = $('#id option:selected');
    //     alert("hello");
    //     exit;

    // });


    function submit(id) {
        switch (id) {
            case 1:
                $('#form1').submit();
                break;

            case 2:
                $('#form2').submit();
                break;

            case 3:
                $('#form3').submit();
                break;
        }
    }
</script>