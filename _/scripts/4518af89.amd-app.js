/**
 * Calendar addon
 */
$( 'input[type=date]' ).pickadate({
	format: 'yyyy-mm-dd',
	formatSubmit: 'yyyy-mm-dd'
});

/**
 * Admin Panel Layout
 */

$('.app-panel-view-tog').on('click', function(e) {
	e.preventDefault();
	if($.cookie('sidebarClose') === 'open') {
		$.removeCookie('sidebarClose');
		$.cookie('sidebarClose', 'closed', { expires: 7, path: '/'});
		closeSidebar();
	} else {
		$.removeCookie('sidebarClose');
		$.cookie('sidebarClose', 'open', { expires: 7,path: '/' });
		openSidebar();
	}
	console.log($.cookie('sidebarClose'));
});

// If Cookie = closed
function closeSidebar() {
	$('#sidebar').addClass('app-mini-sidebar');
	$('#main').addClass('app-full-view');
	$('.full-width-nav-item').addClass('hide');
	$('.mini-nav-item').removeClass('hide');
	$(this).find('i').addClass('icon-chevron-right');
}

function openSidebar(){
	$('#sidebar').removeClass('app-mini-sidebar');
	$('#main').removeClass('app-full-view');
	$('.full-width-nav-item').removeClass('hide');
	$('.mini-nav-item').addClass('hide');
	$(this).find('i').removeClass('icon-chevron-right');
}

if($.cookie('sidebarClose') === 'open') {
	openSidebar();
} else {
	closeSidebar();
}

/**
 * Advanced Search
 */

$('#advancedSearch').on('click', function(e){
	e.preventDefault();
	$('.app-advanced-search').toggleClass('hide');
});

$('.close').on('click', function(){
	$(this).parent().addClass('hide');
});



/**
 * Form Validation
 */

(function($,W,D)
{
    var BRIDGES = {};

    BRIDGES.UTIL =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $("#add_admin").validate({
                rules: {
                    first_name: "required",
                    last_name: "required",
                    email: {
                        required: true,
                        email: true
                    }
                },
                messages: {
                    first_name: "Please enter first name",
                    last_name: "Please enter last name",
                    email: "Please enter a valid email address"
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
			
            $("#add_donations").validate({
                rules: {
					student_id: "required",
                    first_name: "required",
                    last_name: "required",
					donation_amount: {
						required: true
					},
					donation_date: "required"
                },
                messages: {
                    first_name: "Please enter first name",
                    last_name: "Please enter last name"
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });

			$("#add_alumni").validate({
                rules: {
					student_id: "required",
                    first_name: "required",
                    last_name: "required",
					zip_code: 'digits',
					email: {
						email: true,
						required: true
					},

                },
                messages: {
                    first_name: "Please enter first name",
                    last_name: "Please enter last name"
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        }
    },

    //when the dom has loaded setup form validation rules
    $(D).ready(function($) {
        BRIDGES.UTIL.setupFormValidation();
    });

})(jQuery, window, document);




