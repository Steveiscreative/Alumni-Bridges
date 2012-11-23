

$('.app-panel-view-tog').on('click', function(e) {
	e.preventDefault();
	$('#sidebar').toggleClass('app-mini-sidebar');
	$('#main').toggleClass('app-full-view');
	$('.full-width-nav-item').toggleClass('hide');
	$('.mini-nav-item').toggleClass('hide');
	$(this).find('i').toggleClass('icon-chevron-right','icon-chevron-right');

});

$('#advancedSearch').on('click', function(e){
	e.preventDefault(); 
	$('.app-advanced-search').toggleClass('hide');
});