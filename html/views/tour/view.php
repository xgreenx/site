<body>
<?php include ("header.htm"); ?>
	<div class="slider">
		<div class="next"></div>
		<div class="prev"></div>
		<div class="slides">
			<?php $imgPath=Tour::getImages($tour['id_tour']);?>
			<?php foreach ($imgPath as $path):?>
			<div class="slide">
				<img src='<?php echo $path; ?>' />
			</div>
			<?php endforeach;?>
		</div>
	</div>
                    	<div>
                                        <h2><?php echo $tour['value']; ?></h2>
                                        <p>
                                                <?php echo $tour['country']; ?>
                                                <?php echo $tour['name']; ?>
                                    	</p>
                        </div>                              
</body>
<?php include ("footer.htm"); ?>