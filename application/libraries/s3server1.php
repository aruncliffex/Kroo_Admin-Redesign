<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Image_Moo library
 *
 * Written due to image_lib not being so nice when you have to do multiple things to a single image!
 *
 * @license		MIT License
 * @author		Matthew Augier, aka Mat-Moo
 * @link		http://www.dps.uk.com
 * @docu		http://todo :)
 * @email		matthew@dps.uk.com
 *
 * @file		image_moo.php
 * @version		0.9.9
 * @date		2010 Oct 1
 *
 * Copyright (c) 2010 Matthew Augier
 *
 * Requires PHP 5 and GD2!
 *
 * Example usage
 *    $this->image_moo->load("file")->resize(64,40)->save("thumb")->resize(640,480)->save("medium");
 *    if ($this->image_moo->errors) print $this->image_moo->display_errors();
 *
 * COLOURS!
 * Any function that can take a colour as a parameter can take "#RGB", "#RRGGBB" or an array(R,G,B)
 *
 * image manipulation functions
 * -----------------------------------------------------------------------------
 * load($x) - Loads an image file specified by $x - JPG, PNG, GIF supported
 * save($x) - Saved the manipulated image (if applicable) to file $x - JPG, PNG, GIF supported
 * save_pa($prepend="", $append="", $overwrite=FALSE) - Saves using the original image name but with prepend and append text, e.g. load('moo.jpg')->save_pa('pre_','_app') would save as filename pre_moo_app.jpg
 * save_dynamic($filename="") - Saves as a stream output, use filename to return png/jpg/gif etc., default is jpeg
 * resize($x,$y,$pad=FALSE) - Proportioanlly resize original image using the bounds $x and $y, if padding is set return image is as defined centralised using BG colour
 * resize_crop($x,$y) - Proportioanlly resize original image using the bounds $x and $y but cropped to fill dimensions
 * stretch($x,$y) - Take the original image and stretch it to fill new dimensions $x $y
 * crop($x1,$y1,$x2,$y2) - Crop the original image using Top left, $x1,$y1 to bottom right $x2,y2. New image size =$x2-x1 x $y2-y1
 * rotate($angle) - Rotates the work image by X degrees, normally 90,180,270 can be any angle.Excess filled with background colour
 * load_watermark($filename, $transparent_x=0, $transparent_y=0) - Loads the specified file as the watermark file, if using PNG32/24 use x,y to specify direct positions of colour to use as index
 * make_watermark_text($text, $fontfile, $size=16, $colour="#ffffff", $angle=0) - Creates a text watermark
 * watermark($position, $offset=8, $abs=FALSE) - Use the loaded watermark, or created text to place a watermark. $position works like NUM PAD key layout, e.g. 7=Top left, 3=Bottom right $offset is the padding/indentation, if $abs is true then use $positiona and $offset as direct values to watermark placement
 * border($width,$colour="#000") - Draw a border around the output image X pixels wide in colour specified
 * border_3d($width,$rot=0,$opacity=30) - Draw a 3d border (opaque) around the current image $width wise in 0-3 rot positions, $opacity allows you to change how much it effects the picture
 * filter($function, $arg1=NULL, $arg2=NULL, $arg3=NULL, $arg4=NULL) -Runs the standard imagefilter GD2 command, see http://www.php.net/manual/en/function.imagefilter.php for details
 * round($radius,$invert=FALSE,$corners(array[top left, top right, bottom right, bottom left of true or False)="") default is all on and normal rounding
 * shadow($size=4, $direction=3, $colour="#444") - Size in pixels, note that the image will increase by this size, so resize(400,400)->shadoe(4) will give an image 404 pixels in size, Direction works on teh keypad basis like the watermark, so 3 is bottom right, $color if the colour of the shadow.
 * -----------------------------------------------------------------------------
 * image helper functions
 * display_errors($open = '<p>', $close = '</p>') - Display errors as Ci standard style
 * set_jpeg_quality($x) - quality to wrte jpeg files in for save, default 75 (1-100)
 * set_watermark_transparency($x) - the opacity of the watermark 1-100, 1-just about see, 100=solid
 * check_gd() - Run to see if you server can use this library
 * clear_temp() - Call to clear the temp changes using the master image again
 * clear() - Clears all images in memory
 * -----------------------------------------------------------------------------
 *
 * KNOWN BUGS
 * make_watermark_text does not deal with rotation angle correctly, box is cropped
 *
 * TO DO
 *
 * HACK
 * Using imagecopymerge PNG32 and PNG24 do not work as it doesn't use alpha blending.
 * I've written a small have to check for transparency and add as needed in the watermark load but needs improving
 *
 * THANKS
 * Matjaž for poiting out the save_pa bug (should of tested it!)
 *
 */
require str_replace('\\','/',FCPATH).'aws/aws-autoloader.php';
use Aws\S3\S3Client;
	use Aws\CacheInterface;
	use Aws\S3\Exception;
class s3server
{
	// image vars

	//require '/aws/aws-autoloader.php';
	

	public function uploadons3($filepath,$thumb_image_name,$upload_dir="newsimages"){
		$s3 = S3Client::factory(array(
		    'region' => 'us-east-1',
			'version' => 'latest',
			'scheme' => 'http',
			'credentials' => array(
                        'key' => $this->key,
                        'secret'  => $this->secret,
                    )  
		));        

		// Upload a file.
		$result = $s3->putObject(array(
		   'Bucket'       => $this->bucket,
		   'Key'          => $upload_dir.'/'.$thumb_image_name,
		   'SourceFile'   => $filepath,            
		   'ACL'          => 'public-read'                       
		));
		/* end of bucket programming */
		if($_SERVER['HTTP_HOST']!='localhost' && $_SERVER['HTTP_HOST']!='test.krooadmin.com'){
			unlink($large_image_location);
			unlink($thumb_image_location);
		}
	}

}
/* End of file image_moo.php */
/* Location: .system/application/libraries/image_moo.php */
