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
            <h3>Popular Products</h3>
            <?php foreach ($popular as $row): ?>
            <div class="col-md-3">
                <a href="<?php echo base_url(); ?>products/holsters/<?php echo $row->id; ?>">
                <div class="thumbnail">
                    <img src="<?php echo base_url(); ?>assets/products/thumbnails/<?php echo $row->thumbnail; ?>">
                    <div class="caption">
                        <h4><?php echo $row->name; ?></h4>
                        <p>price $<?php echo $row->price; ?></p>
                    </div>
                </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="row">
            <h3>Recommended Products</h3>
            <?php foreach ($recommended as $row): ?>
            <div class="col-md-3">
                <div class="thumbnail">
                    <img src="<?php echo base_url(); ?>assets/products/thumbnails/<?php echo $row->thumbnail; ?>">
                    <div class="caption">
                        <h3><?php echo $row->name; ?></h3>
                        <p>price $<?php echo $row->price; ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>