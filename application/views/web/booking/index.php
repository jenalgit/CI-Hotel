<div class="col-md-12">
    <div class="row">
        <div class="col-xs-12">
            <ul class="nav nav-pills nav-justified thumbnail">
                <li class="active"><a href="#">
                        <h4 class="list-group-item-heading">Step 1</h4>
                        <p class="list-group-item-text">Pilih Kamar</p>
                    </a></li>
                <li class="disabled"><a href="#">
                        <h4 class="list-group-item-heading">Step 2</h4>
                        <p class="list-group-item-text">Informasi Tamu</p>
                    </a></li>
                <li class="disabled"><a href="#">
                        <h4 class="list-group-item-heading">Step 3</h4>
                        <p class="list-group-item-text">Pembayaran</p>
                    </a></li>
            </ul>
        </div>
    </div>
</div>
<div class="page-header">
    <h1>Kamar tersedia</h1>
    <?php if ($this->session->userdata('from') && $this->session->userdata('to')) : ?>
        <p><?php echo 'Rooms tersedia tgl ' . $this->session->userdata('from') . ' s/d ' . $this->session->userdata('to'); ?></p>
    <?php endif; ?>
    <?php echo form_open('booking/guest'); ?>
    <div class="form-group">
        <label for="exampleInputEmail1">Check In</label>
        <input type="text" value="<?php echo $this->session->userdata('from') ? $this->session->userdata('from') : date('Y/m/d', now()); ?>" class="form-control datepicker" id="from" placeholder="Enter date" name="from">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Check Out</label>
        <input type="text" value="<?php echo $this->session->userdata('to') ? $this->session->userdata('to') : date('Y/m/d', now()); ?>" class="form-control datepicker" id="to" placeholder="Enter date" name="to">
    </div>
</div>
<table class="table table-hover table-responsive">
    <thead>
        <tr class="success">
            <th></th>
            <th></th>
            <th>Rooms</th>
            <th>Harga</th>    
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($rooms): ?>
            <?php
            $i = 1;
            foreach ($rooms as $p) :
                ?>
                <tr>
                    <?php
                    $radio = array(
                        'name' => 'idclass',
                        'value' => $p->idclass,
                        'checked' => $p->idclass == 1 ? TRUE : FALSE,
                    );
                    ?>
                    <td><?php echo form_radio($radio); ?></td>
                    <td class="col-md-3"><a href="<?php echo ($p->image == '' ? 'http://placehold.it/180x150&text=Belum+ada+gambar' : base_url($p->image) ); ?>" class="thumbnail fancybox">
                            <img class="img-responsive" src='<?php echo ($p->thumb == '' ? 'http://placehold.it/180x150&text=Belum+ada+gambar' : base_url($p->thumb) ); ?>'></a></td>
                    <td><?php echo $p->title; ?></td>
                    <td><?php echo $p->net; ?></td>
                </tr>
                <?php
                $i++;
            endforeach;
            ?>
        <?php else: ?>
            <tr><td>Belum ada data !</td></tr> 
<?php endif; ?>
    </tbody>
</table>
<div class="col-md-12">
    <input type="submit" class="btn btn-primary btn-sm pull-right" value="Next" name="next"></button>
</div>
<?php echo form_close(); ?>
<!-- Modal -->

<script>
    $(function() {
        var today = new Date();
        $("#from").datepicker({
            defaultDate: today,
            changeMonth: true,
            changeYear: true,
            minDate: today,
            numberOfMonths: 1,
            dateFormat: "yy/mm/dd",
            onClose: function(selectedDate) {
                $("#to").datepicker("option", "minDate", selectedDate);
            }
        });
        $("#to").datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            changeYear: true,
            numberOfMonths: 1,
            dateFormat: "yy/mm/dd",
            onClose: function(selectedDate) {
                $("#from").datepicker("option", "maxDate", selectedDate);
            }
        });
    });
</script>