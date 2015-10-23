<?PHP
App::uses('Component', 'Controller');
App::import('Vendor','Thumbnail' ,array('file'=>'thumbnail.class.php'));

class ThumbComponent extends Component {

	/**
	 * Processes the payment
	 */
    public function createthumb( $source, $destination, $width, $height = 0 , $removThumb ) {

		$pic=new Thumbnail();
		$pic->filename = $source;
		$pic->filename2 = $destination;
		$pic->maxW = $width;

		if( $height )
			$pic->maxH = $height;
				
		$pic->SetNewWH();
		$pic->MakeNew();
		$pic->FinirPImage();
		if( !preg_match( "/fbcdn/", $removThumb, $match ) ){
			$removePic=WWW_ROOT.'provider_team\\'.$removThumb;
			$removThumb= WWW_ROOT.'provider_team\\thumb\\'.$removThumb;
			unlink($removThumb);
			unlink($removePic);
		}
	}
	
	 public function createthumbProvider( $source, $destination, $width, $height = 0 , $removThumb ) {

		$pic=new Thumbnail();
		$pic->filename = $source;
		$pic->filename2 = $destination;
		$pic->maxW = $width;

		if( $height )
			$pic->maxH = $height;
				
		$pic->SetNewWH();
		$pic->MakeNew();
		$pic->FinirPImage();
		if( !preg_match( "/fbcdn/", $removThumb, $match ) ){
			$removePic=WWW_ROOT.'provider_portfolio\\'.$removThumb;
			$removThumb= WWW_ROOT.'provider_portfolio\\thumb\\'.$removThumb;
			unlink($removThumb);
			unlink($removePic);
		}
	}
	
	 public function createthumbMarketer( $source, $destination, $width, $height = 0 , $removThumb ) {

		$pic=new Thumbnail();
		$pic->filename = $source;
		$pic->filename2 = $destination;
		$pic->maxW = $width;

		if( $height )
			$pic->maxH = $height;
				
		$pic->SetNewWH();
		$pic->MakeNew();
		$pic->FinirPImage();
		if( !preg_match( "/fbcdn/", $removThumb, $match ) ){
			$removePic=WWW_ROOT.'marketer\\'.$removThumb;
			$removThumb= WWW_ROOT.'marketer\\thumb\\'.$removThumb;
			unlink($removThumb);
			unlink($removePic);
		}
	}
	
	 public function createthumbs( $source, $destination, $width, $height = 0  ) {

		$pic=new Thumbnail();
		$pic->filename = $source;
		$pic->filename2 = $destination;
		$pic->maxW = $width;

		if( $height )
			$pic->maxH = $height;
				
		$pic->SetNewWH();
		$pic->MakeNew();
		$pic->FinirPImage();
	}
}
?>