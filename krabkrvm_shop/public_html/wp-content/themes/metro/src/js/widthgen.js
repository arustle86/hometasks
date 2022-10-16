function widthgen(){
	
      /*!
      * Uses Example: class="elementwidth elwidth-480"
      * As a result a new class elmaxwidth-480 will be added when screen size is 480px or lower
      */
     
	$(window).on('load resize', elementWidth);

	function elementWidth(){
		$('.elementwidth').each(function() {
			var $container = $(this),
			width = $container.outerWidth(),
            classes = $container.attr("class").split(' '); // get all class

            var classes1 = startWith(classes,'elwidth'); // class starting with "elwidth"
            classes1 = classes1[0].split('-'); // "elwidth" classnames into array
            classes1.splice(0, 1); // remove 1st element "elwidth"

            var classes2 = startWith(classes,'elmaxwidth'); // class starting with "elmaxwidth"
            classes2.forEach(function(el){
            	$container.removeClass(el);
            });

            classes1.forEach(function(el){
            	var maxWidth = parseInt(el);

            	if (width <= maxWidth) {
            		$container.addClass('elmaxwidth-'+maxWidth);
            	}
            });
        });
	}

	function startWith(item, stringName){
		return $.grep(item, function(elem) {
			return elem.indexOf(stringName) == 0;
		});
	}
}

export default widthgen;