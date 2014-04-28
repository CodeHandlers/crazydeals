<?php
function createThumbs( $pathToImages, $pathToThumbs, $thumbWidth, $fileName) 
{
  // open the directory
  $dir = opendir( $pathToImages );

  // loop through it, looking for any/all JPG files:
  //while (false !== ($fname = readdir( $dir ))) {
    // parse path for the extension
	$fname = $fileName;
    $info = pathinfo($pathToImages . $fname);
    // continue only if this is a JPEG image
	////////////////JPEG IMAGE///////////////
    if ( strtolower($info['extension']) == 'jpg' || strtolower($info['extension']) == 'jpeg' || strtolower($info['extension']) == 'jpe') 
    {
      //echo "Creating thumbnail for {$fname} <br />";

      // load image and get image size
      $img = imagecreatefromjpeg( "{$pathToImages}{$fname}" );
      $width = imagesx( $img );
      $height = imagesy( $img );

      // calculate thumbnail size
      $new_width = $thumbWidth;
      $new_height = floor( $height * ( $thumbWidth / $width ) );

      // create a new temporary image
      $tmp_img = imagecreatetruecolor( $new_width, $new_height );

      // copy and resize old image into new image 
      imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

      // save thumbnail into a file
      imagejpeg( $tmp_img, "{$pathToThumbs}{$fname}" );
    }
	/////////GIF IMAGE///////////////
	else
	if ( strtolower($info['extension']) == 'gif' ) 
    {
      //echo "Creating thumbnail for {$fname} <br />";

      // load image and get image size
      $img = imagecreatefromgif( "{$pathToImages}{$fname}" );
      $width = imagesx( $img );
      $height = imagesy( $img );

      // calculate thumbnail size
      $new_width = $thumbWidth;
      $new_height = floor( $height * ( $thumbWidth / $width ) );

      // create a new temporary image
      $tmp_img = imagecreatetruecolor( $new_width, $new_height );

      // copy and resize old image into new image 
      imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

      // save thumbnail into a file
      imagegif( $tmp_img, "{$pathToThumbs}{$fname}" );
    }
	else
	if ( strtolower($info['extension']) == 'png' ) 
    {
      //echo "Creating thumbnail for {$fname} <br />";

      // load image and get image size
      $img = imagecreatefrompng( "{$pathToImages}{$fname}" );
      $width = imagesx( $img );
      $height = imagesy( $img );

      // calculate thumbnail size
      $new_width = $thumbWidth;
      $new_height = floor( $height * ( $thumbWidth / $width ) );

      // create a new temporary image
      $tmp_img = imagecreatetruecolor( $new_width, $new_height );

      // copy and resize old image into new image 
      imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

      // save thumbnail into a file
      imagepng( $tmp_img, "{$pathToThumbs}{$fname}" );
    }
 // }
  // close the directory
  closedir( $dir );
}
function createThumbsHeight( $pathToImages, $pathToThumbs, $thumbWidth, $fileName) 
{
  // open the directory
  $dir = opendir( $pathToImages );

  // loop through it, looking for any/all JPG files:
  //while (false !== ($fname = readdir( $dir ))) {
    // parse path for the extension
	$fname = $fileName;
    $info = pathinfo($pathToImages . $fname);
    // continue only if this is a JPEG image
	////////////////JPEG IMAGE///////////////
    if ( strtolower($info['extension']) == 'jpg' || strtolower($info['extension']) == 'jpeg' || strtolower($info['extension']) == 'jpe') 
    {
      //echo "Creating thumbnail for {$fname} <br />";

      // load image and get image size
      $img = imagecreatefromjpeg( "{$pathToImages}{$fname}" );
      $width = imagesx( $img );
      $height = imagesy( $img );

      // calculate thumbnail size
	  $new_height = $thumbWidth;
      $new_width = floor( $width * ( $thumbWidth / $height ) );
	  
      // create a new temporary image
      $tmp_img = imagecreatetruecolor( $new_width, $new_height );

      // copy and resize old image into new image 
      imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

      // save thumbnail into a file
      imagejpeg( $tmp_img, "{$pathToThumbs}{$fname}" );
    }
	/////////GIF IMAGE///////////////
	else
	if ( strtolower($info['extension']) == 'gif' ) 
    {
      //echo "Creating thumbnail for {$fname} <br />";

      // load image and get image size
      $img = imagecreatefromgif( "{$pathToImages}{$fname}" );
      $width = imagesx( $img );
      $height = imagesy( $img );

      // calculate thumbnail size
      $new_height = $thumbWidth;
      $new_width = floor( $width * ( $thumbWidth / $height ) );

      // create a new temporary image
      $tmp_img = imagecreatetruecolor( $new_width, $new_height );

      // copy and resize old image into new image 
      imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

      // save thumbnail into a file
      imagegif( $tmp_img, "{$pathToThumbs}{$fname}" );
    }
	else
	if ( strtolower($info['extension']) == 'png' ) 
    {
      //echo "Creating thumbnail for {$fname} <br />";

      // load image and get image size
      $img = imagecreatefrompng( "{$pathToImages}{$fname}" );
      $width = imagesx( $img );
      $height = imagesy( $img );

      // calculate thumbnail size
      $new_height = $thumbWidth;
      $new_width = floor( $width * ( $thumbWidth / $height ) );

      // create a new temporary image
      $tmp_img = imagecreatetruecolor( $new_width, $new_height );

      // copy and resize old image into new image 
      imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

      // save thumbnail into a file
      imagepng( $tmp_img, "{$pathToThumbs}{$fname}" );
    }
 // }
  // close the directory
  closedir( $dir );
}
// call createThumb function and pass to it as parameters the path 
// to the directory that contains images, the path to the directory
// in which thumbnails will be placed and the thumbnail's width. 
// We are assuming that the path will be a relative path working 
// both in the filesystem, and through the web for links
?>