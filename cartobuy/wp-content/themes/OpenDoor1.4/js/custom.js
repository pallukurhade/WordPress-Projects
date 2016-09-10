
/* <![CDATA[ */  
$(document).ready(function() {

  $('#carousel').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
    itemWidth: 100,
    itemMargin: 5,
    asNavFor: '#slider2'
  });
   
  $('#slider2').flexslider({
    animation: "fade",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
    sync: "#carousel"
  });
  
$('.textwidget').fitVids();

$('.dropdown-toggle').dropdown();

/* force nth of type to work on old IE */
$.expr[':']['nth-of-type'] = function(elem, i, match) {
    var parts = match[3].split("+");
    return (i + 1 - (parts[1] || 0)) % parseInt(parts[0], 10) === 0;
};


$('.detailpagebigimage').hover(function() {
	$(this).stop().animate({"opacity" : .8});
	$('.imagehover').stop().animate({"opacity" : .8});
}, function(){
	$(this).stop().animate({"opacity" : 1});
	$('.imagehover').stop().animate({"opacity" : 0});
});


$('#secondaryheadermenu > li:nth-child(1)').before($('#login > li').show());


$('div#form form').attr('name', 'form');
$('div.textwidget iframe').attr('frameborder', '0');
$('div.textwidget iframe').attr('scrolling', 'no');
$('div.textwidget iframe').attr('marginheight', '0');
$('div.textwidget iframe').attr('marginwidth', '0');

$('.dsidx-search-button input[type=submit]').addClass('btn btn-large btn-block btn-inverse');

$('ul.wp-tag-cloud').addClass('menu-sub');
$('ul.wp-tag-cloud li a').addClass('menu-subbutton');
$('ul.wp-tag-cloud li a').wrapInner('<span class="menu-label" />');



$('.personresultblock:odd').after('<div style="clear: both;"></div>');
$('.personresultblock:even').addClass('alpha');
$('.personresultblock:odd').addClass('omega');

$('.homepageblogitem:nth-of-type(4n+1)').addClass('alpha');
$('.homepageblogitem:nth-of-type(4n+4)').addClass('omega');
$('.homepageblogitem:nth-of-type(4n+4)').after('<div style="clear: both;"></div>');

$('.blogpageblogitem:nth-of-type(3n+1)').addClass('alpha');
$('.blogpageblogitem:nth-of-type(3n+3)').addClass('omega');
$('.blogpageblogitem:nth-of-type(3n+3)').after('<div style="clear: both;"></div>');

$('.specslist.fourcolumns li.four.columns:nth-child(3n+1) ').addClass('alpha');
$('.specslist.fourcolumns li.four.columns:nth-child(3n+3) ').addClass('omega');

$('.listingblockgrid:nth-of-type(3n+1)').addClass('alpha');
$('.listingblockgrid:nth-of-type(3n+3)').addClass('omega');
//$('.listingblockgrid:nth-of-type(3n+3)').after('<div style="clear: both;"></div>');




$('h2.bar, h3.bar, h4.bar').wrapInner('<span />');
// $('.wp-post-image, img.border').wrap('<div class="imgborder" />');
$('#slider i').addClass('icon-white');

$('.wpcf7 input[type=submit]').addClass('btn btn-large');
$('.agentbox .wpcf7 input[type=submit]').addClass('btn-block btn-colorscheme');

$('.dsidx-search-button br').addClass('hide');

$('.mc-button, .dsidx-contact-form-submit').addClass('btn');

$('input[type=submit]').addClass('btn');

$('.reduced, .servicehistoryicon, #socialheader a, .qtrans_language_chooser a, a.tt, a.printbutton').tooltip();
$('.servicehistoryicon, .reduced').click(function() {
	return false;
});

$("a[rel^='prettyPhoto']").prettyPhoto();




$('#rentorbuy select').change(function() {

	var value = $(this).val();
	if (value == "rent") {
		$('#buyprices').hide();
		$('#rentprices').show();
	} 
	
	if (value == "buy" || value == "") {
		$('#buyprices').show();
		$('#rentprices').hide();
	} 
	
});


$('#customsearch input[type=submit]').click(function() {
	var value = $('#rentorbuy select').val();
	if (value == "rent") {
		$('#buyprices').hide();
		$('#rentprices').show();
	} 
	
	if (value == "buy" || value == "") {
		$('#buyprices').show();
		$('#rentprices').hide();
	} 

});


$('#loancalculator_cars button').click(function() {
	LoanAmount = $('#LoanAmount').val();
	DownPayment= $('#DownPayment').val();

	
	
	if ($('#InterestRate').val() == "0") {
		AnnualInterestRate = "0.0001";
	} else {
		AnnualInterestRate = ($('#InterestRate').val())/100;
	}
	Years =  $('#NumberOfYears').val();
	MonthRate = AnnualInterestRate/12;
	NumPayments = Years * 12;
	Prin = LoanAmount - DownPayment;
	MonthPayment=Math.floor((Prin*MonthRate)/(1-Math.pow((1+MonthRate),(-1*NumPayments)))*100)/100;
	$('#NumberOfPayments').val(NumPayments);
	$('#MonthlyPayment').val(MonthPayment);
	$('#MonthlyPayment').addClass('calculatorresult');
	return false;
});

//$("#sliderimage").preloadify({ imagedelay:300 });



$('.calltoactionblock img').hover(function() {
	$('.imagehover').show();
	$(this).stop().animate({"opacity" : 1});									
}, function(){
	$('.imagehover').hide();
	$(this).stop().animate({"opacity" : .8});	
});


$("#contactagent").insertAfter('#agentcontainer');


$('.comment-body').append("<div class='comment_pointer' />");

  $("ul.sf-menu").supersubs({ 
	minWidth:    17,   // minimum width of sub-menus in em units 
	maxWidth:    25,   // maximum width of sub-menus in em units 
	extraWidth:  1     // extra width can ensure lines don't sometimes turn over 
					   // due to slight rounding differences and font-family 
}).superfish();  // call supersubs first, then superfish, so that subs are 
				 // not display:none when measuring. Call before initialising 
				 // containing tabs for same reason. 


function remember( selector ){
$(selector).each(
function(){
//if this item has been cookied, restore it
var name = $(this).attr('name');
if( $.cookie( name ) ){
$(this).val( $.cookie(name) );
}
//assign a change function to the item to cookie it
$(this).change(
function(){
$.cookie(name, $(this).val(), { path: '/', expires: 365 });
}
);
}
);
}
remember( '[name=manufacturer_level2]' );
});

/* ]]> */
