var PlayAjax = {

    ajaxref : null,
	$loader : null,
	animation : function( status ) {
		$loader = $("#progressPanel");
		$listContainer = $("#dataListCotnainer");
		$progreeHolder = $("#progreeHolder");
		if( status && $listContainer.length>0 ) {
			$loader.css( {'height': $listContainer.height(),'width': $listContainer.width() , 'top':$listContainer.offset().top, 'left':$listContainer.offset().left});
			$progreeHolder.css( {'top':($loader.height()-$progreeHolder.height())/2, 'left':($loader.width()-$progreeHolder.width())/2});
			$loader.show();
		} else {
			$loader.hide();
		}
	},
	call : function( _url, _result, _fault, _dataType, _data ) {
		PlayAjax.animation( true );
		
		_data = _data || null;
        _dataType = _dataType || 'json' ; // in case of place search it should be 'jsonp'
        this.ajaxref = $.ajax({
		  url : _url,
		  data : _data,
		  dataType : _dataType,
          type : 'POST',
		  success : function( response ) {
              PlayAjax.animation( false );
			_result( response );
		  },
		  error : function(response) {
              PlayAjax.animation( false );
			_fault( response );
		  }
		});
	},
    abort : function() {
        if(this.ajaxref)
            this.ajaxref.abort();
    }
	
}