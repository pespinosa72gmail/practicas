jQuery.noConflict();
jQuery(document).ready(function($) {
	
	"use strict";
  
	//SKILL BARS...
	animateSkillBars();
	$(window).scroll(function(){ 
		animateSkillBars(); 
	});
  
	//TABS...
	if($('ul.tabs').length > 0) {
		$('ul.tabs').tabs('> .dt-sc-tabs_content');
	}
	
	if($('ul.dt-sc-tabs-frame').length > 0){
		$('ul.dt-sc-tabs-frame').tabs('> .dt-sc-tabs-frame-content');
	}
	
	if($('ul.tabs').length > 0) {
		$('ul.tabs').tabs('> .dt-sc-tabs_content');
	}
	
	if($('ul.dt-sc-tabs').length > 0){
		$('ul.dt-sc-tabs').tabs('> .dt-sc-tabs-content');
	}
  
	if($('.dt-sc-tabs-vertical-frame').length > 0){
	
		$('.dt-sc-tabs-vertical-frame').tabs('> .dt-sc-tabs-vertical-frame-content');
		
		$('.dt-sc-tabs-vertical-frame').each(function(){
			$(this).find("li:first").addClass('first').addClass('current');
			$(this).find("li:last").addClass('last');
		});
		
		$('.dt-sc-tabs-vertical-frame li').click(function(){
			$(this).parent().children().removeClass('current');
			$(this).addClass('current');
		});
		
	}
  
	//Custom tab jquery works...
	if($('.tabs-framed').length > 0){
	
		$('.custom-tabs-frame').tabs('> .custom-tabs-content').parent();
		
		$('.custom-tabs-frame').each(function(){
			$(this).find("li:first").addClass('first').addClass('current');
			$(this).find("li:last").addClass('last');
		});
		
		$('.custom-tabs-frame li').click(function(){
			$(this).parent().children().removeClass('current');
			$(this).addClass('current');
		});
	
	}
  

});

function animateSkillBars(){
	"use strict";
	
	var applyViewPort = ( jQuery("html").hasClass('csstransforms') ) ? ":in-viewport" : "";
	jQuery('.dt-sc-progress'+applyViewPort).each(function(){
		var progressBar = jQuery(this),
		progressValue = progressBar.find('.dt-sc-bar').attr('data-value');
		
		progressBar.find('.dt-sc-bar').css('background-color', progressBar.find('.dt-sc-bar').attr('data-bg-color'));
		
		if (!progressBar.hasClass('animated')) {
			progressBar.addClass('animated');
			progressBar.find('.dt-sc-bar').animate({width: progressValue + "%"},600,function(){ progressBar.find('.dt-sc-bar-text').fadeIn(400); });
		}
	});
}
