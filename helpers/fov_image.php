//generate field of view image2wbmp(// Define parameters for the image
			$size = 150; // The height & width of the image 
			$arcwidth = 100; // The number of degrees the arc should span
			$min = 0; // Opacity of the field of view icon at its vertex (0-127 scale, 0=opaque, 127=transparent)
			$max = 127; // Opacity at edge
			$color = array('red'=>0, 'green'=>0, 'blue'=>255);
			
		// Start the image
			$image = imageCreate($size, $size);
			
		// Set and fill a background color
			$bgColor = imageColorAllocate($image, 0, 192, 192);
			imageFilledRectangle($image, 0, 0, $size - 1, $size - 1, $bgColor);
			
		// Set blending type
			imageAlphaBlending($image, 0);
			
		// Define other arc-related parameters	
			$startdeg = $_GET['yaw']-90-($arcwidth/2);
			$enddeg = $startdeg+$arcwidth;
			$increment = ($max - $min) / ($size-1); // Incremental change in opacity for each arc drawn		
			
		// This draws (size-1) arcs, each being 1 pixel smaller and 1 increment of opacity less than the previous
		// i.e. The first arc drawn is (size-1)px with (max) opacity, and the last arc is 1px with (min) opacity
		
			for($i=$size-1; $i>0; $i--){
				$settings = imageColorAllocateAlpha($image, $color['red'], $color['green'], $color['blue'], $max-($increment*($size-$i)));
				imageFilledArc($image, $size/2, $size/2, $i, $i, $startdeg, $enddeg, $settings, gdArc);
			}
			
		// Set content type
			header("Content-type:  image/png");
			
		// Interlaced image
			imageInterlace($image, 1);
			
		// Set background color to be transparent
			imageColorTransparent($image, $bgColor);
			
		// Finalize & send image
			imagePNG($image);