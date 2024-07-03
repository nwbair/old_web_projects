    <?php foreach ($info as $row): ?>
    <div class="row">
        <div class="col-md-2">
            <div class="btn-group-vertical">
                <a href="<?php echo base_url(); ?>" class="btn btn-default" role="button">Home</a>
                <button type="button" class="btn btn-default">Belt Holsters</button>
                <button type="button" class="btn btn-default">IWB Holsters</button>
                <button type="button" class="btn btn-default">Exotic Holsters</button>
                <button type="button" class="btn btn-default">Red Nichols</button>
                <button type="button" class="btn btn-default">Belts</button>
                <button type="button" class="btn btn-default">Magazine Carriers</button>
                <button type="button" class="btn btn-default">Pocket Holsters</button>
                <button type="button" class="btn btn-default">Shoulder Rigs</button>
                <button type="button" class="btn btn-default">Paddle Holsters</button>
                <button type="button" class="btn btn-default">Misc</button>
                <button type="button" class="btn btn-default">Close Outs</button>
            </div>
        </div>

        <div class="col-md-1"></div>
        <div class="col-md-9">
            <div class="row">
                <div class="jumbotron">
                    <h2><?php echo $row->name; ?></h2>
                    <img src="<?php echo base_url(); ?>assets/products/full/<?php echo $row->full_size; ?>">
                </div>
            </div>

            <div class="row">
                <div class="row marketing">
                    <div class="col-lg-6">
                        <h4>Price</h4>
                        <p>$<?php echo $row->price; ?>&nbsp; &nbsp;<a href="" class="btn btn-warning" role="button">Add to Cart</a></p>

                        <h4>Description</h4>
                        <p><?php echo $row->description; ?></p>

                        <h4>The <?php echo $row->name; ?> is available for</h4>
                        <p><?php echo $row->compatibility; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php endforeach; ?>