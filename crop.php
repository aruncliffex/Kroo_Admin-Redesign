<?php
/*
* Copyright (c) 2008 http://www.webmotionuk.com / http://www.webmotionuk.co.uk
* "PHP & Jquery image upload & crop"
* Date: 2008-11-21
* Ver 1.2
* Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
* Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.
*
* THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND 
* ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED 
* WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. 
* IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, 
* INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, 
* PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS 
* INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, 
* STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF 
* THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
*
*/
require 'aws/aws-autoloader.php';
use Aws\S3\S3Client;
use Aws\CacheInterface;
use Aws\S3\Exception;
 
       
/*$bucket = 'thekroo_live_S3_user';
$key = 'AKIAILSLP5MHEPGQGKLQ';
$secret = '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';*/
$bucket = 'thekroo-live-storage';
$key = 'AKIAILSLP5MHEPGQGKLQ';
$secret = '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';

/*
 * THIS SOFTWARE IS ALTERED BY RENALDO PIERRE-LOUIS
 * Date: 2012-04-14
 */
if($_POST['tab_index']=='3')
   $upload_dir = 'articleimage'; 
else
   $upload_dir = 'newsimages';

$upload_path_large = "uploads/"; 				// The directory for the images to be saved in
$upload_path = $upload_path_large.$upload_dir."/";				// The path to where the image will be saved
$large_image_prefix =  	'';		// The prefix name to large image
$thumb_image_prefix = "timg_".time()."_";		// The prefix name to the thumb image
$large_image_name = $large_image_prefix.$_POST['filename'];     // New name of the large image (append the timestamp to the filename)
$thumb_image_name = $thumb_image_prefix.$_POST['filename'];    // New name of the thumbnail image (append the timestamp to the filename)
$thumb_width = "750";						// Width of thumbnail image
$thumb_height = "422";						// Height of thumbnail image

//Image Locations
$large_image_location = $upload_path_large.$large_image_name;
$thumb_image_location = $upload_path.$thumb_image_name;
if (isset($_POST["filename"]) && file_exists($large_image_location)) {
	//Get the new coordinates to crop the image.
	$x1 = $_POST["x1"];
	$y1 = $_POST["y1"];
	$x2 = $_POST["x2"];
	$y2 = $_POST["y2"];
	$w = $_POST["w"];
	$h = $_POST["h"];
	//Scale the image to the thumb_width set above
	$scale = $thumb_width/$w;
	$cropped = resizeThumbnailImage($thumb_image_location, $large_image_location,$w,$h,$x1,$y1,$scale);
        echo $thumb_image_name;

		/* bucket programming */
        //$filepath = $thumb_image_location;
        $filepath = $thumb_image_location;
        //echo $thumb_image_name;
		// Instantiate the client.
		$s3 = S3Client::factory(array(
		    'region' => 'us-east-1',
			'version' => 'latest',
			'scheme' => 'http',
			'credentials' => array(
                        'key' => $key,
                        'secret'  => $secret,
                    )  
		));        

		// Upload a file.
		$result = $s3->putObject(array(
		   'Bucket'       => $bucket,
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



function resizeThumbnailImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale){
	list($imagewidth, $imageheight, $imageType) = getimagesize($image);
	$imageType = image_type_to_mime_type($imageType);
	
	$newImageWidth = ceil($width * $scale);
	$newImageHeight = ceil($height * $scale);
	$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
	switch($imageType) {
		case "image/gif":
			$source=imagecreatefromgif($image); 
			break;
	    case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
			$source=imagecreatefromjpeg($image); 
			break;
	    case "image/png":
		case "image/x-png":
			$source=imagecreatefrompng($image); 
			break;
  	}
	imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
	switch($imageType) {
		case "image/gif":
	  		imagegif($newImage,$thumb_image_name); 
			break;
      	case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
	  		imagejpeg($newImage,$thumb_image_name,90); 
			break;
		case "image/png":
		case "image/x-png":
			imagepng($newImage,$thumb_image_name);  
			break;
    }
	chmod($thumb_image_name, 0777);
	return $thumb_image_name;
}

?>