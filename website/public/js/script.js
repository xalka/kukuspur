/*
Author		:	Joshua Musyoka
Date 		: 	27th July 2025
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
			headers: {"X-Loadtype": "precise"},
			beforeSend: function(){
				babu.loading(1);
				$('.loadingOverlay').removeClass('hidden');
			},
			success : function(results,textStatus,xhr){
				if(results.includes('action="/login"') && url != '/login'){
					window.location.reload();
				}
				
				// $('section.main-content').html(results);

				let $mainContent = $('main.main-content');
				// $mainContent.addClass('opacity-0 scale-95 transition-all duration-300 ease-out');
				setTimeout(() => {
					$mainContent.html(results);
				 	// $mainContent.removeClass('opacity-0 scale-95').addClass('opacity-100 scale-100 transition-all duration-300 ease-in');
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
				// modal = $(de.attr('data-modal-target')),
				modal = $('#modal'),
				// url = de.attr('data-modal-href'),
				size = de.attr('data-size') ?? '',
				title = de.attr('data-title');

			modal.removeClass('hidden'); // console.log(size); return false;

			$.ajax({
				url : de.attr('data-modal-href'),
				type : 'GET',
				headers: {"X-Header-Type": "modal"},
				beforeSend: function(){
					modal.find('.modal-title').text(title);
					// modal.find('.modal-content').addClass('opacity-0 scale-90 transition-all duration-300');
					// modal.find('.modal-dialog').addClass('modal-'+trigger.attr('data-modal-size'));
					// modal.find('.modal-dialog').removeClass('modal-sm modal-lg modal-xl');
					// modal.find('h3.modal-title').text(title);
					// modal.find('.modal-header').removeClass('invisible');
				},
				success : function(dom){ 
					// if(dom.includes('action="/login"')){
					// 	window.location.reload();
					// }					
					setTimeout(() => {
						// modal.find('.modal-dialog').addClass('modal-'+size);
						// modal.find('.modal-body').html(results);
						// modal.find('.modal-footer').removeClass('invisible');
						modal.find('.modal-content').removeClass('opacity-0 scale-90').addClass('opacity-100 scale-100 transition-all duration-300');
						if(size.length) modal.find('.modal-size').addClass(size).removeClass('lg:w-1/3');
						modal.find('.modal-content').html(dom);
						babu.plugins();
					},300);
				},
				error : function(){
					console.log('error');
				},
			});		

			// Trigger to close the modal
			modal.find('button[data-close="true"]').click(function(){
				babu.modalclose(modal);
			});				

		});		
	},

	modalclose : function(modal=null){
		if(modal==null) modal = $('#modal');
		modal.addClass('hidden');
		modal.find('.modal-size').removeClass('lg:w-1/2').addClass('lg:w-1/3');
		modal.find('.modal-content').html(this.modalloadingdom());
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
		return '<div class="flex items-center justify-center mt-10"> \
                	<div class="animate-spin rounded-full h-12 w-12 border-4 border-gray-500 border-t-transparent"></div> \
            	</div> \
            	<p class="text-gray-700 text-sm text-center mt-6 mb-10">Loading, please wait...</p>';
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
			});
		}

		babu.dashboard();
		babu.tabs();
		babu.formNotificationDom();
		babu.calcAmountSMS();
		babu.autoselect();
		// babu.passwordEyeToggle();
	},

	submitstatus : function(event,name='status',value=0){
		var target = $(event.target),
			form = target.closest('form'); // console.log(form.find('input[name="status"]').val());
		// $(form+' input[name="'+name+'"]').val(value);
		form.find('button[type="submit"]').attr('type',null);
		form.find('input[name="statusId"]').val(value);
		form.find('button[data-type="'+value+'"]').attr('type','submit');
		// $(form+' input[data-type="'+value+'"]').attr('type','submit');
		// $(form+' input[name="'+value+'"]').val(status);
	},

	sms : function(){
		// send
		$(document).on('input','form.form-compose-sms textarea[name="message"]',function(){
			var de = $(this);
			de.closest('form').find('span.sms-count').text(Math.ceil(parseInt(de.val().length)/160));
		});

		// select template
		$(document).on('change','select[data-name="template"]',function(evt){
			var de = $(this),
				textarea = de.closest('form').find('textarea[name="message"]'); console.log(de.val());
			textarea.val(de.val());
			textarea.trigger('input');
		});

		// group

		// payment

	},

	formloading : function(form,show=1,text=null){
		if(show){ text = '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Loading...' };
		form.find('*[type="submit"]').html(text);
	},
	
	submitForm: function () {
		$(document).on('submit', 'form', function (evt) {
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
						// if(results.includes('action="/login"')){
						// 	window.location.reload();
						// }
						if(typeof results === 'string' && results.includes('action="/login"')){
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
        if (results?.confirm !== undefined) { console.log(results);
            form.find('input[name="paymentId"]').val(results.paymentId);
			let btnSubmit = form.find('button[type="submit"]');
			notification.removeClass('hidden').addClass('form-alert-info').html('Processing  <span class="dots"></span>');
			// form.find('input[name="phone"], input[name="amount"]').prop('disabled', true);
			// btnSubmit.addClass('disabled:opacity-50 disabled:cursor-not-allowed');
			btnSubmit.prop('disabled', true);
			babu.confirmMpesaPayment(results.paymentId,notification,btnSubmit);

        } else if ([200,201].includes(results?.status)){
			// let delayTime = results?.delay ?? 2000;
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

	confirmMpesaPayment : function(paymentId,notification,btnSubmit){
		var trials = 0;
		let interval = setInterval(function(){
			let req = {'action' : 'status','paymentId' : paymentId};
			$.get('/subscribe', req, function(results){ console.log(trials);
				if(results.status=='approved'){  console.log(results);
					notification.removeClass('form-alert-info').addClass('form-alert-success').text('Successful');
					clearInterval(interval);
					babu.ajaxPage('/subscribe');
					babu.modalclose();
				} else if(results.status=='processing'){
					if(trials>10){
						notification.removeClass('form-alert-info').addClass('form-alert-error').text('Technical problems, try again');
						clearInterval(interval);
						btnSubmit.removeClass('hidden');
					}
					trials++;
				} else {
					notification.removeClass('form-alert-info').addClass('form-alert-error').text('Technical problems, try again');
					clearInterval(interval);
					btnSubmit.removeClass('hidden');
				}
			})
		},4000);
	},

	mpesastatusresubmit : function(){
		return '<span class="btn btn-success p-2" data-submit="confirm">Confirm</span> \
				<span class="btn-babuaccount text-white border border-warning p-3" data-submit="stkpush">Re-Mpesa</span>';
	},

	// confirm mpesa payment
	stkpushconfirm : function(){
		$(document).on('click','span[data-submit="confirm"]',function(){
			var form = $(this).closest('form'),
				notification = form.find('p[data-class="form-notification"]'),
				data = {
					'view' : 'json',
					'phone' : form.find('input[name="phone"]').val(),
					'MerchantRequestID' : form.find('input[name="MerchantRequestID"]').val(),
					'CheckoutRequestID' : form.find('input[name="CheckoutRequestID"]').val()
				};

			babu.formloading(form,1);

			$.get('/payment',data,function(results,status){
				if($.isArray(results) && results.length === 0){
					notification.text('Please re-try the payment').addClass('alert alert-warning');

					console.log(status);
					console.log(results);

					// notification.empty().removeClass();
					babu.formloading(form,0);
				} else {
					console.log(results[0]);
					if(results[0].status=='approved'){
						notification.text('Successful').addClass('alert alert-success');
						setTimeout(function(){
							babu.redirect(window.location.pathname);
						},2000);						
					} else {
						notification.text('The payment is '+results[0].status).addClass('alert alert-info');
					}
				}
			});
				
		});
	},

	// remove
	stkpush : function(){
		$(document).on('click','span[data-submit="stkpush"]',function(evt){
			evt.preventDefault();
			var de = $(this),
				form = de.closest('form'),
				notification = form.find('p[data-class="form-notification"]');

			var data = {
				'contributionId' : form.find('input[name="contributionId"]').val(),
				'phone' : form.find('input[name="phone"]').val(),
				'amount' : form.find('input[name="amount"]').val(),
				'userId' : form.find('select[name="userId"]').val(), 
				'description' : form.find('textarea[name="description"]').val()
			}; 

			$.ajax({
				dataType: "json",
				url : '/contribution?action=re-mpesa',
				type : 'POST',
				// headers: {
				// 	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
				// },
				data : data,
				beforeSend: function(){				
					notification.empty().removeClass();
					babu.formloading(form,1);
				},
				success : function(results){
					if(results.code==201){
						form.find('input[name="MerchantRequestID"]').val(results.MerchantRequestID);
						form.find('input[name="CheckoutRequestID"]').val(results.CheckoutRequestID);
						notification.text(results.message).addClass('alert alert-info');
					} else {
						notification.text(results.message).addClass('alert alert-warning');
					}
				},
				error : function(){
					notification.text('Technical problems, try again').addClass('alert alert-danger');
					// xal.loading(0);
				},
				complete : function(){
					// babu.formloading(form,0,btnText);
					// form.find('button[type="submit"],button[type="null"]').prop('disabled',false);
					babu.plugins();
				}				
			});

		});
	},

	stkstatus : function(form){ // console.log(form);
		var loop = true;
		//while(loop){
			var data = {
				'view' : 'json',
				'phone' : form.find('input[name="phone"]').val(),
				'MerchantRequestID' : form.find('input[name="MerchantRequestID"]').val(),
				'CheckoutRequestID' : form.find('input[name="CheckoutRequestID"]').val()
			};

			setInterval(function(){
				$.get('/payment',data,function(results,status){
					if($.isArray(results) && results.length === 0){
						console.log('failed, re-initiate stk push');
						// $("span").html(result);
						
					} else {
						console.log(results);
						console.log(status);
						loop = false;
						return true;
					}
				});
			},5000);
		//}
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

	calcAmountSMS : function() {
		// $(document).on('input', '#amount', function() {
		$(document).on('input', 'input[name="amount"]', function() {
			let amount = parseFloat($(this).val()) || 0;
			let pricingTable = [
				{ from: 1, to: 100000, price: 0.5 },
				{ from: 100001, to: 500000, price: 0.4 },
				{ from: 500001, to: 1000000, price: 0.35 }
			];
	
			let pricePerSMS = 0.35;
	
			// Find the applicable price per SMS
			for (let i = 0; i < pricingTable.length; i++) {
				if (amount >= pricingTable[i].from && amount <= pricingTable[i].to) {
					pricePerSMS = pricingTable[i].price;
					break;
				}
			}
	
			// Calculate and return the number of SMS
			$('.sms-units').text(amount > 0 ? Math.floor(amount / pricePerSMS) : "0");
		});

		$(document).on('input', 'input[name="rate"]',function(){
			let rate = parseFloat($(this).val()) || 0.35;
			let amount = parseFloat($('input[name="amount"]').val()) || 0;
			let pricePerSMS = rate;
			$('.sms-units').text(amount > 0 ? Math.floor(amount / pricePerSMS) : "0");
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

	selectTemplate: function(){
		// remove
		$(document).on('change','select[data-name="template"]', function(evt){
			evt.preventDefault();
			let de = $(this),
				templateId = de.val();
			$.get("/template?view=json&id="+templateId,function(resp) {
				let form = de.closest('form'),
					title = form.find('input[name="title"]'); console.log(title);
					
				form.find('textarea[name="message"]').val(resp.message).trigger("input");
				if(title.val().length==0) title.val(resp.title);
				title.val(resp.title);
			});
		});
	},

	messageCounter : function(){
		$(document).on('input', 'textarea[name="message"]', function(){
			let de = $(this), 
				message = de.val();
			de.parent().find('.message-counter').text(Math.ceil(message.length/smsChar));
			de.parent().find('.message-characters').text(message.length);
		});
	},

	addContactRow : function(){
		$(document).on('click', '.addContactRow', function(){
			let de = $(this),
				tr = de.closest('tr'),
				clone = tr.clone();
			if(tr.find('input[name="phone"]').val().length==0) return;
			tr.find('.removeContactRow').removeClass('hidden');
			de.addClass('hidden');
			tr.after(clone);
			clone.find('input').val('');
		});
	},

	removeContactRow : function(){
		$(document).on('click', '.removeContactRow', function(){
			let de = $(this),
				tbody = de.closest('tbody');
			de.closest('tr').remove();
			let tr = tbody.find('tr:last');
			tr.find('.removeContactRow').addClass('hidden');
			tr.find('.addContactRow').removeClass('hidden');
		});
	},

	draftMessage : function(evt){
		let form = $(evt.target).closest('form');
		form.find('input[name="status"]').val(1);

		if (form[0].checkValidity()) {
			form.submit();
		} else {
			form.find(':input[required]').each(function () {
				let input = $(this);
				if (!input.val().trim()) {
					input.addClass('border-red-500');
				} else {
					input.removeClass('border-red-500');
				}
			});
			form[0].reportValidity();
		}
	},

	scheduleRecurringMessage : function(){
		$(document).on('click','.schedule-trigger',function(){
			let schedule = $('.schedule-section'),
				recurring = $('.recurring-message');

			recurring.addClass('hidden');
			schedule.toggleClass('hidden');
			if (schedule.hasClass('hidden')) {
				schedule.find('input[name="scheduled"]').val('');
			}
		});
		$(document).on('click','.recurring-trigger',function(){
			let schedule = $('.schedule-section'),
				recurring = $('.recurring-message');
				
			schedule.addClass('hidden');
			recurring.toggleClass('hidden');
			// if (schedule.hasClass('hidden')) {
			// 	schedule.find('input[name="scheduled"]').val('');
			// }
		});
	},

	formStatus : function(evt,status){
		$(evt.target).closest('form').find('input[name="status"]').val(status);
	},

	messageMode : function(evt,mode){
		let de = $(evt.target),
			form = de.closest('form');
		form.find('input[name="mode"]').val(mode);
		form.find('.btn-message-mode span').toggleClass('active');
		if(mode) form.find('select[name="groupId"]').removeAttr('required');
		else form.find('select[name="groupId"]').attr('required','required');
	},

	toggleRecurrenceFields : function() {
		$(document).on('change','select[name="recurrence"]',function(){
			let de = $(this),
				recurrence = de.val(),
				form = de.closest('form');

			form.find('.recurrence-options > div').addClass('hidden');
			
			if(recurrence == 1){
				de.closest('form').find('.time-field').removeClass('hidden');
			} else if(recurrence == 2){
				de.closest('form').find('.time-field').removeClass('hidden');
				de.closest('form').find('.days-field').removeClass('hidden');
			} else if(recurrence == 3 || recurrence == 4){
				de.closest('form').find('.date-field').removeClass('hidden');
			} else {
				de.closest('form').find('.recurrence-fields').removeClass('hidden');
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
		$(document).on('change', 'input[name="profile-pic"]', function() {
			const file = $(this)[0].files[0];
			if (file.type.startsWith('image/')){
				let reader = new FileReader();
				reader.onload = function (e) {
					$('.profile-pic')
					  .attr('src', e.target.result)
					  .show();
				  };
				reader.readAsDataURL(file);				
			}
		});
	},	
	
	ExportTable : function(){
		$(document).on('click','span[data-export]',function(){
			let de = $(this),
				type = de.attr('data-export'),
				section = de.closest('section'),
				title = section.find('h1').text(),
				table = section.find('.table-div > table'),
				downloadFile = title+'.'+type;
				

			switch(type){
				case 'csv':
					let csv = [];
					for (let row of table[0].rows) {
						let rowData = [];
						for (let cell of row.cells) {
						rowData.push(cell.innerText);
						}
						csv.push(rowData.join(","));
					}
					let csvFile = new Blob([csv.join("\n")], { type: "text/csv" });
					saveAs(csvFile,downloadFile);
					break;

				case 'pdf':
					const { jsPDF } = window.jspdf;
					const doc = new jsPDF();

					console.log(table); // return false;
				
					let rows = [];
					table.find('tr').each(function(){
					  	let row = [];
					  	$(this).find('th, td').each(function () {
							row.push($(this).text());
					  	});
					  	rows.push(row);
					});
				
					// Simple manual table rendering
					let y = 10;
					rows.forEach(row => {
					  	doc.text(row.join("    "), 10, y);
					  	y += 10;
					});
				
					doc.save(downloadFile);
					break;

				case 'xlsx':
					let wb = XLSX.utils.table_to_book(table[0], { sheet: "Sheet1" });
					XLSX.writeFile(wb,downloadFile);
					break;
			}
		

		});
	},

	noRightClick : function(){
		$(document).on('contextmenu', 'body', function(evt){
			evt.preventDefault();
		});
		// $(document).on("contextmenu", function(e) {
		// 	e.preventDefault();
		// });		
	},

	init : function(){
		this.quickLoad();
        this.submitForm();
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
		// this.previewImage();
		// this.ExportTable();
		// this.noRightClick(); disable on production
	}

}

$(function(){
	babu.init();
});