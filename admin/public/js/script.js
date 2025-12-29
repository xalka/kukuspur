/*
Author		:	Joshua Musyoka
Date 		: 	31st July 2025
Title   	: 	BabuTalk
Company   	: 	Techxal ( techxal.com )
Customer    :   BabuTalk
*/

"use strict";

var loader = $('.loader'),
	babu = {

	toggleMenu : function(){
		$('.mobile-menu-toggle').on('click',function(){
			$('.mobile-menu').toggleClass('-translate-x-full translate-x-0');
		});
	},

	redirect : function(page=null){
		if(page==null){ location.reload();
		} else { window.location.replace(page); }
	},

	loading : function(show=1){
		if(show){ loader.removeClass('invisible').addClass('visible')
		} else { loader.removeClass('visible').addClass('invisible')};
	},

	pageload : function(){
		babu.loading(0);
		$('body').removeClass("invisible").addClass("visible");
	},

	history : function(page,url){
		var obj = { page: page, url: url };
		history.pushState(obj, obj.page, obj.url);
	},

	popstate : function(){
		$(window).on('popstate',function(e){
	        var state = e.originalEvent.state,
	        	url = location.pathname+location.search;

	        if(state !== null){
				$.ajax({
					url : url,
					headers: {"X-Header-xaltype": "precise"},
					beforeSend: function(){
						xal.loading(1);
					},
					success : function(results){
						// console.log(results);
						$('section#content').html(results);
					},
					error : function(){
						console.log('error');
						// alert('Hello');
						xal.redirect(window.location.pathname);
					}
				});
	        } else {
				xal.redirect(window.location.pathname);
	        }
		});



		$(window).on('popstate',function(e){
	        var state = e.originalEvent.state,
	        	url = location.pathname+location.search;
	        if(state !== null){
				// $('section').html(state.page);
				HMS.loading(1);
				$.get(url,function(resp,status){
					$('section').html(resp);
					HMS.loading(0);
				});
	        } else {
				HMS.redirect(window.location.pathname);
	        }
		});
	},

	ajaxPage : function(url){
		$.ajax({
			url : url,
			// headers: {"X-Loadtype": "precise"},
			beforeSend: function(){
				babu.loading(1);
				$('.loadingOverlay').removeClass('hidden');
			},
			success : function(results,textStatus,xhr){
				if(results.includes('action="/login"') && url != '/login'){
					window.location.reload();
				}

				let $mainContent = $('section.main-content');
				setTimeout(() => {
					$mainContent.html(results);
					babu.history(results,url);
					babu.plugins();
				},150);	
				
				$("html, body").animate({ scrollTop: 0 }, "fast");
				setTimeout(()=>{
					$('.loadingOverlay').addClass('hidden');
				},3000);
				// babu.history(results,url);
				// babu.plugins();
			},
			error : function(){
				console.log('error');
			},
			complete : function(){
				$('.loadingOverlay').addClass('hidden');
			}
		});
	},

	quickLoad : function(){
		// $(document).on('click','aside#sidebar a[data-href]',function(evt){
		// $(document).on('click','*[data-href]',function(evt){
		$(document).on('click','a',function(evt){
			evt.preventDefault();
			var de = $(this),
				url = de.attr('href');
			if(de.attr('data-refresh')){
				window.location.href = de.attr('href');
			}				
			if(url=='/logout'){
				window.location.href = '/logout';
				return true;
			}
			if(de.attr('data-tab')){
				return false;
			}
			babu.ajaxPage(url);
		});
	},

	checkboxToggleAll : function(event,closest='table'){
		var target = $(event.target);
		target.closest(closest).find('input[name="perms[]"]').prop("checked",target.prop("checked"));
	},

	passwordEyeToggle : function(){
		$(document).on('click','.password-toggle',function(){ // console.log('hello');
			var toggler = $(this),
				password = toggler.closest('.relative').find('input[name="password"]');
			toggler.toggleClass('fa-eye-slash fa-eye');
			password.attr('type',password.attr('type')=='password'?'text':'password');
		});
	},

	modal : function(){
		$(document).on('click','*[data-modal-href]',function(evt){
			var de = $(this),
				modal = $('#modal'),
				size = de.attr('data-modal-size') ?? 'max-w-xl',
				height = de.attr('data-modal-h') ?? '',
				title = de.attr('data-modal-title');

			modal.removeClass('hidden');

			$.ajax({
				url : de.attr('data-modal-href'),
				type : 'GET',
				beforeSend: function(){
					modal.find('.modal-title').text(title);
				},
				success : function(dom){ 
					if(dom.includes('action="/login"')){
						window.location.reload();
					}
					setTimeout(() => {
						modal.find('> div').removeClass('max-w-xl').addClass(`${size} ${height}`);
						modal.find('.modal-content').html(dom);
						babu.plugins();
					},300);
				},
				error : function(){
					console.log('error');
				},
			});		

			// Trigger to close the modal
			modal.find('.closeModal').click(function(){
				babu.modalclose(modal);
			});				

		});		
	},

	modalclose : function(modal=null){
		if(modal==null){
			modal = $('#modal');
		}
		modal.addClass('hidden');
		modal.find('> div').removeClass('max-w-3xl h-screen').addClass('max-w-xl');
		modal.find('.modal-content').html('<div class="flex items-center justify-center mt-10"> \
                <div class="animate-spin rounded-full h-12 w-12 border-4 border-gray-500 border-t-transparent"></div> \
            </div> \
            <p class="text-gray-700 text-sm text-center mt-6 mb-10">Loading, please wait...</p>');
	},

	tabs : function(){
		$(".tab-button").on("click",function(){
			let de = $(this),
				tabId = de.data("tab"),
				content = $(".tab-content");

			de.siblings().removeClass("btn-tab-active");
			de.addClass("btn-tab-active"); 
			content.find('form').addClass('hidden');
			content.find('form[id="'+tabId+'"]').removeClass('hidden');

			// if(content.find('form').length){
			// 	content.find('form').removeClass('hidden');
			// }



			// $(".tab-button").removeClass("active").addClass("inactive");
			// $(this).removeClass("inactive").addClass("active");

			// $(".tab-content").addClass("hidden");
			// $("#" + tabId).removeClass("hidden");
		});

		// Nested Tabs Functionality
		$(".tab-button-nested").on("click", function() {
			let nestedTabId = $(this).data("nested-tab");
			$(".tab-button-nested").removeClass("active").addClass("inactive");
			$(this).removeClass("inactive").addClass("active");

			$(".tab-content-nested").addClass("hidden");
			$("#" + nestedTabId).removeClass("hidden");
		});		
	},

	modalloadingdom : function(){
		return '<div class="d-flex justify-content-center m-5"> \
					<div class="spinner-border" role="status"> \
						<span class="visually-hidden">Loading...</span> \
					</div> \
				</div>';
	},

	numberFormat : function(){
		$.each($('.money'),function(key,value){
			var de = $(this);
			// console.log( parseInt( de.text()) );
			de.text(Number(de.text()).toLocaleString('en'));
		});
	},

	tagsinput: function(){
		var input = document.querySelector('input[data-role=tagsinput]');
		//var input = $('input[data-role="tagsinput"]');
		new Tagify(input);
	},

	plugins : function(){
		this.textareaEditor();

		var tabButtons = $(".tab-button"),
			tabPanes = $(".tab-pane");
			
		tabButtons.on("click", function () {
			var tabId = $(this).data("tab");
			tabButtons.removeClass("active");
			tabPanes.removeClass("active");
			$(this).addClass("active");
			$("#"+tabId).addClass("active");
		});


		// $('input[date-plugin="datetime"]').datetimepicker({
		//     format: 'yyyy-mm-dd'
		// // });
		// $('input[date-plugin="datetime"]').datetimepicker({
		// 	container: 'body',
		// 	language: 'en',
		// 	pickerPosition: 'bottom-right',
		// 	// initialDate: new date(),
		// 	format: 'mm/dd/yyyy',
		// });

	   	// $('input[data-date="datetimepicker"]').datetimepicker();
		// this.tagsinput();

	   		// format: 'HH:mm DD-MM-YYYY',
	   		// initialDate: Date.now(),
	 //        format: "dd MM yyyy - hh:ii",
	 //        autoclose: true,
	 //        todayBtn: true,
	 //        startDate: "2013-02-14 10:00",
	 //        minuteStep: 10
		// });
			// .val( $(this).val().format('HH:mm DD-MM-YYYY') );
			// .val( moment().format('HH:mm DD-MM-YYYY') );


		// $('input[data-date="datepicker"]').datepicker()

		// //babu.numberFormat();
		// var location = window.location.pathname;
		// // console.log(location);
		// // ?action=select&activity=users&naming=fname&id=providerId
		// babu.ajaxSelectSearch('select-guarantor',location+'?action=guarator&view=json','guarantorId','member','phone');
		// babu.ajaxSelectSearch('select-bank',location+'?action=bank&view=json','bankId','bank');

		if($('.datepicker').length){
			flatpickr(".datepicker", {
				dateFormat: "Y-m-d",
				enableTime: false,
				theme: "light"
			});
		}

		if($('.datetimepicker').length){
			flatpickr(".datetimepicker", {
				dateFormat: "Y-m-d H:i",
				enableTime: true,
				time_24hr: true,
				theme: "light",
				defaultDate: (() => {
					let now = new Date();
					now.setMinutes(now.getMinutes()+30);
					return now;
				})()
				// defaultDate: function(selectedDates, dateStr, instance) {
				// 	// Use the value from the input if it exists, otherwise set +30 minutes
				// 	let inputVal = instance.element.value;
				// 	if (inputVal) {
				// 		return inputVal;
				// 	} else {
				// 		let now = new Date();
				// 		now.setMinutes(now.getMinutes() + 30);
				// 		return now;
				// 	}
				// }				
			});
		}

		babu.dashboard();
		babu.tabs();
		babu.formNotificationDom();
		babu.autoselect();
		// babu.passwordEyeToggle();
	},

	submitstatus : function(event,value){
		var target = $(event.target),
			form = target.closest('form');
		form.find('input[name="statusId"]').val(value);
	},

	formloading : function(form,show=1,text=null){
		if(show){ text = '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Loading...' };
		form.find('*[type="submit"]').html(text);
	},
	
	submitForm: function () {
		$(document).on('submit','form',function(evt){
			evt.preventDefault();

			const form = $(this),
				  notification = form.find('div[data-class="form-notification"]'),
				  submitButton = form.find('button[type="submit"]'),
				  btnText = submitButton.html();

			let data;
			
			// Check for specific form handling
			if (form.hasClass("contacts-personalized")) {
				const group = {
					title: form.find('input[name="title"]').val(),
					contacts: form.find('tbody tr').map(function () {
						const de = $(this);
						return {
							phone: de.find('input[name="phone"]').val(),
							names: de.find('input[name="names"]').val(),
						};
					}).get(),
				};

				data = JSON.stringify(group);

			} else if (form.attr("enctype") == "multipart/form-data") {
				data = new FormData(this);

			} else {
				data = form.serialize();
			}

			// AJAX request
			$.ajax({
				url: form.attr('action'),
				type: form.attr('method'),
				// dataType: 'json',
				data: data,		
				beforeSend: function(){
					if(!form.attr('data-loading')) babu.formloading(form,1);
				},
				success: function (results){
					if(results.status != 200){
						if(typeof results === 'string' && results.includes('/auth.php?action=login')){
							window.location.reload();
						}						
					}
					if(form.attr('data-filter') === 'true') {
						$('.table-div').html(results);
						// pushState
					} else {
						babu.handleFormSuccess(results, form, notification);
					}
				},
				error: function () {
					notification.removeClass('hidden').addClass('danger').find('p').text('Technical problems, try again');
				},
				complete: function () {
					babu.formloading(form, 0, btnText);
					submitButton.prop('disabled', false);
					babu.plugins();
				},
				...(form.find('input[type="file"]').length > 0 ? { contentType: false, processData: false } : {})
			});
		});
	},

    handleFormSuccess: function (results, form, notification) {
        if ([200,201].includes(results?.status)){
            if(results?.delay){
				notification.removeClass('hidden').addClass('form-alert-success').text('Successful');
                setTimeout(() => {
                    if (results.url) {
                        babu.ajaxPage(results.url);
                    } else {
                        location.reload(true);
                    }
                }, results?.delay);
            } 
			if (results.url !== undefined) {
                babu.redirect(results.url);
            }

		} else if ([400,401,402,403].includes(results?.status)) {  
            notification.removeClass('hidden').addClass('form-alert-error').text(results.message);
			if (results?.replenish !== undefined && results.replenish) {
				// show payment div on the right
				$('.message-form').addClass('md:w-3/5');
				$('.replenish').removeClass('hidden').addClass('md:w-2/5');
				var modalsize = form.closest('.modal-size');
				modalsize.addClass('w-4/6, lg:w-1/2').removeClass('lg:w-1/3');
				modalsize.animate({
					scrollTop: $('.replenish').first().offset().top
				}, 800);
			}

        } else {
            notification.removeClass('hidden').addClass('form-alert-error').text('Technical problems, try again');
            if (results.errors) {
                $.each(results.errors, function (key, value) {
                    form.find(`*[data-error="${key}"]`).removeClass('hidden').text(value);
                });
            }
        }
    },

	dashboard : function(){
		let lineChart = $('#lineChart');
		if(lineChart.length){
			if(chartInstance){
				chartInstance.destroy();
			};

			$.get('/?action=data', function(results) {
				chartInstance = new Chart(lineChart[0].getContext('2d'), {
					type: 'line',
					data: {
						labels: results.map(item => item.month),
						datasets: [
							{
								label: 'SMS Sent',
								data: results.map(item => item.sms),
								borderColor: '#10B981',
								backgroundColor: 'rgba(16, 185, 129, 0.2)',
								tension: 0.4,
								fill: true,
							},
							{
								label: 'Payments Done ($)',
								data: results.map(item => item.amount),
								borderColor: '#334b32',
								backgroundColor: 'rgba(16, 185, 129, 0.2)',
								tension: 0.4,
								fill: true,
							} 
						]
					},
					options: {
						responsive: true,
						maintainAspectRatio: false,
						fullSize: true,
						// animations: {
						// 	tension: {
						// 	  	duration: 1000,
						// 	  	easing: 'linear',
						// 	  	from: 1,
						// 	  	to: 0,
						// 	  	loop: true
						// 	}
						// },					
						scales: {
							x: {
								grid: { display: false }
							},
							y: {
								grid: { color: '#E5E7EB' }
							}
						}
					},
					plugins: {
						legend: {
							position: 'top'
						}
					}
				});
			});
		}
	},

	asideActiveLink : function(){
		$(document).on('click', 'aside a > .aside-link', function(){
			// Apply fade-out effect to the current active link
			$('.aside-link.active').removeClass('active').addClass('opacity-0');
			
			// Wait for the fade-out to complete (500ms), then reset opacity and remove class
			// setTimeout(() => {
				$('.aside-link').removeClass('opacity-0');
			//}, 500);
			
			// Add the active class to the clicked link with a fade-in effect
			$(this).addClass('active').removeClass('opacity-0').addClass('opacity-100');
		});
		
	},

	formNotificationDom : function(){
		$(document).ready(function(){
			$("form").each(function(){
				var form = $(this);		
				if (form.find('div[data-class="form-notification"]').length===0){
					form.prepend('<div data-class="form-notification" class="form-alert hidden" role="alert"></div>');
				}
			});
		});
	},

	export : function(){
		$(document).on('click', '.export-btn', function (event) {
			event.preventDefault();
			$(".export-dropdown").toggleClass("opacity-100 scale-y-100").toggleClass("opacity-0 scale-y-0");
		});

		// Close dropdown when clicking outside
		$(document).click(function (event) {
			if (!$(event.target).closest(".export-btn, .export-dropdown").length) {
				$(".export-dropdown").addClass("opacity-0 scale-y-0").removeClass("opacity-100 scale-y-100");
			}
		});		
	},

	drawer : function(){
		$(document).on('click', 'button.barger', function(evt){
			evt.preventDefault();
			let aside = $('aside');
			aside.toggleClass('lg:w-[300px]');
			// $('main').toggleClass('w-full');
			aside.find('.text-aside-link, .btn-compose span, .btn-setting span').toggleClass('lg:hidden');
			aside.find('.logo a').toggleClass('lg:hidden');

			if(aside.hasClass('lg:w-[300px]')){
				$('canvas#lineChart').css('width','calc(100% - 310px)');
			}
		});
	},
	
	autoselect: function(){
		if(!$("select[data-auto=true]").length) return;
		$("select[data-auto=true]").each(function(){
			var de = $(this),
				valueField = de.attr("data-val") || "_id",
				labelField = de.attr("data-label") || "title",
				searchField = de.attr("data-search") || "title",
				url = de.attr('data-url');
	
			new TomSelect(de, {
				valueField: valueField,
				labelField: labelField,
				searchField: searchField,
				create: false,
				load: function(query,callback){
					if(!query.length) return callback();
					fetch(`${url}${encodeURIComponent(query)}`)
						.then(response => response.json())
						.then(results => callback(results))
						.catch(() => callback());
				},
				onChange: function(value) {
					if(de.attr('data-name') && de.attr('data-name').length > 0){
						const selectedOption = this.options[value];
						if (selectedOption && typeof selectedOption === 'object' && Object.keys(selectedOption).length > 0) {
							var form = de.closest('form');
							// form.find('input[name="title"]').val(value);
							form.find('textarea[name="message"]').val(value);
						}
					};
				}
			});
		});
	},

	previewImage: function () {
		$(document).on('change', 'input[name="image"]', function() {
			const file = $(this)[0].files[0];
			if (file.type.startsWith('image/')){
				let reader = new FileReader();
				reader.onload = function(e){
					if($('.featured_image').length>0){
						$('.featured_image')
							.attr('src', e.target.result)
							.show();
					} else {
						$('label[for="featured_image"]').html('<img src="'+e.target.result+'" class="w-full featured_image">');
					}
				};
				reader.readAsDataURL(file);				
			}
		});
	},

	// authForm : function(){
	// 	$('#show-register').on('click', function () {
	// 		$('#form-container').css('transform', 'translateX(-50%)');
	// 	});
	  
	// 	$('#show-login').on('click', function () {
	// 		$('#form-container').css('transform', 'translateX(0)');
	// 	});		
	// },

	textareaEditor : function(){
		if($('#editor').length){
			const form = $('#editor').closest('form');
			const quill = new Quill('#editor', {
				theme: 'snow'
			});
			$(document).on('keyup','#editor',function(){
				form.find('textarea[name="content"]').val(quill.root.innerHTML);
			});
			if(quill.root.innerHTML.length){
				form.find('textarea[name="content"]').val(quill.root.innerHTML);
			};
		};
	},

	init : function(){
		// this.authForm();
		this.quickLoad();
        this.submitForm();
		this.previewImage();
		


		// // this.popstate();
		this.toggleMenu();
		// // this.accounting();
		this.plugins();
		// // this.pageload();
		this.modal();
		this.tabs();
		// // this.modalDomGenerator();
        // this.submitform();
		this.passwordEyeToggle();
		// this.loanschedule();
		// this.stkpushconfirm();
		// this.stkpush();
		// this.guarantor();
		// this.dashboard();
		// this.asideActiveLink();
		// this.export();
		// this.drawer();
		// this.selectTemplate();
		// this.messageCounter();
		// this.addContactRow();
		// this.removeContactRow();
		// this.scheduleRecurringMessage();
		// this.toggleRecurrenceFields();
		// this.ExportTable();
		// this.noRightClick(); disable on production
	}

}

$(function(){
	babu.init();
});