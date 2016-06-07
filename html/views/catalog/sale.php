<head>
	<link rel="stylesheet" type="text/css" href="/style1.css">
</head>
<body>
<?php include ("header.htm"); ?>
                    <?php foreach ($tours as $tour): ?>
                                        <h2><?php echo $tour['value']; ?></h2>
                                        <p>
                                                <?php echo $tour['country']; ?>
                                                <?php echo $tour['name']; ?>
                                    	</p>
                    <?php endforeach; ?>                              
<?php include ("footer.htm"); ?>
</body>