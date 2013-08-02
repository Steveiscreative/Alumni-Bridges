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

$('.close').on('click', function(){
	$(this).parent().addClass('hide');
});

  console.log(app);
});