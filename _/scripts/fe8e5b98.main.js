require.config({
  shim: {
  },

  paths: {
    hm: 'vendor/hm',
    esprima: 'vendor/esprima',
    jquery: 'vendor/jquery.min'
  }
});
 
require(['app'], function(app) {


$('.app-panel-view-tog').on('click', function(e) {
	e.preventDefault();

	// Set Cookie 
	
	$cookie = $.cookie('sidebarClose');
	// If Cookie = closed
	if($cookie != "closed") {
		$.cookie('sidebarClose', 'closed', { expires: 7 });
		$('#sidebar').addClass('app-mini-sidebar');
		$('#main').addClass('app-full-view');
		$('.full-width-nav-item').addClass('hide');
		$('.mini-nav-item').removeClass('hide');
		$(this).find('i').addClass('icon-chevron-left');
	} else {
		$.removeCookie('sidebarClose');
		$('#sidebar').removeClass('app-mini-sidebar');
		$('#main').removeClass('app-full-view');
		$('.full-width-nav-item').removeClass('hide');
		$('.mini-nav-item').addClass('hide');
		$(this).find('i').removeClass('icon-chevron-right');
	}

});

if($.cookie('sidebarClose') == "closed") {
	$('#sidebar').addClass('app-mini-sidebar');
	$('#main').addClass('app-full-view');
	$('.full-width-nav-item').addClass('hide');
	$('.mini-nav-item').removeClass('hide');
	$(this).find('i').addClass('icon-chevron-left');
}

$( 'input[type=date]' ).pickadate({
	formatSubmit: 'yyyy-mm-dd',
})

$('#advancedSearch').on('click', function(e){
	e.preventDefault(); 
	$('.app-advanced-search').toggleClass('hide');
});

$('.close').on('click', function(){
	$(this).parent().addClass('hide');
});





  console.log(app);
});