(function( $, undefined ) {
	
	// var progressAnim;
	/*
	 * Slider object.
	 */
	$.Slider = function( options, element ) {
	
		this.$el	= $( element );
		
		this._init( options );
		
	};
	
	$.Slider.defaults 		= {
		current		: 0, 	// index of current slide
		autoplay	: false,// slideshow on / off
		interval	: 7000  // time between transitions
    };
	
	$.Slider.prototype 	= {
		_init 				: function( options ) {
			
			this.options 		= $.extend( true, {}, $.Slider.defaults, options );
			
			this.$slides		= this.$el.children('div.da-slide');
			this.slidesCount	= this.$slides.length;
			
			this.current		= this.options.current;
			
			if( this.current < 0 || this.current >= this.slidesCount ) {
			
				this.current	= 0;
			
			}
			
			this.$slides.eq( this.current ).addClass( 'da-slide-current' );
			
			// var $navigation		= $( '<nav class="da-dots"/>' );
			// for( var i = 0; i < this.slidesCount; ++i ) {
			
			// 	$navigation.append( '<span/>' );
			
			// }
			// $navigation.appendTo( this.$el );
			
			// this.$pages			= this.$el.find('nav.da-dots > span');
			this.$navNext		= this.$el.find('div.da-arrows-next');
			this.$navPrev		= this.$el.find('div.da-arrows-prev');
			
			this.isAnimating	= false;
			
			this.bgpositer		= 0;


			
			// this._updatePage();
			
			// load the events
			this._loadEvents();
			
			// slideshow
			if( this.options.autoplay ) {
			
				this._startSlideshow();
			
			}
			
		},
		_navigate			: function( page, dir ) {
			
			var $current	= this.$slides.eq( this.current ), $next, _self = this;
			
			if( this.current === page || this.isAnimating ) return false;
			
			this.isAnimating	= true;
			
			// check dir
			var classTo, classFrom, d;
			
			if( !dir ) {
			
				( page > this.current ) ? d = 'next' : d = 'prev';
			
			}
			else {
			
				d = dir;
			
			}
				
			
				
				if( d === 'next' ) {
				
					classTo		= 'da-slide-toleft';
					classFrom	= 'da-slide-fromright';
					++this.bgpositer;
				
				}
				else {
				
					classTo		= 'da-slide-toright';
					classFrom	= 'da-slide-fromleft';
					--this.bgpositer;
				
				}
				
			
			
			
			this.current	= page;
			
			$next			= this.$slides.eq( this.current );
			
			
			
				var rmClasses	= 'da-slide-toleft da-slide-toright da-slide-fromleft da-slide-fromright';
				$current.removeClass( rmClasses );
				$next.removeClass( rmClasses );
				
				$current.addClass( classTo );
				$next.addClass( classFrom );
				
				$current.removeClass( 'da-slide-current' );
				$next.addClass( 'da-slide-current' );
				
			
	
			
			// this._updatePage();
			
		},
		// _updatePage			: function() {
		
		// 	this.$pages.removeClass( 'da-dots-current' );
		// 	this.$pages.eq( this.current ).addClass( 'da-dots-current' );
		
		// },
		_startSlideshow		: function() {
		
			var _self	= this;

			if( _self.options.autoplay ) {

				// progressAnim = TweenMax.to(daProgress, 6, { ease: Power0.easeNone, xPercent: 100, clearProps:"xPercent"  });
				$('.da-progress').addClass('progressing');
			}
			
			this.slideshow	= setTimeout( function() {
				
				var page = ( _self.current < _self.slidesCount - 1 ) ? page = _self.current + 1 : page = 0;
				_self._navigate( page, 'next' );
				
				if( _self.options.autoplay ) {
				
					_self._startSlideshow();
					// CHANGE USE TWEENMAX + TRANSLATE INSTEAD OF WIDTH
					// progressAnim.repeat(-1);
					// daProgress.removeClass('progressing');
					// daProgress.addClass('progressing');
					// console.log('iter');
				
				}
			
			}, this.options.interval );
		
		},
		page				: function( idx ) {
			
			if( idx >= this.slidesCount || idx < 0 ) {
			
				return false;
			
			}
			
			if( this.options.autoplay ) {
			
				clearTimeout( this.slideshow );
				this.options.autoplay	= false;
				// TweenMax.set(daProgress, {xPercent: 0});
				$('.da-progress').removeClass('progressing').addClass('no-will-change');

			
			}
			
			this._navigate( idx );
			
		},
		_loadEvents			: function() {
			
			var _self = this;
			
			// this.$pages.on( 'click.cslider', function( event ) {
				
			// 	_self.page( $(this).index() );
			// 	return false;
				
			// });
			
			this.$navNext.on( 'click.cslider', function( event ) {
				
				if( _self.options.autoplay ) {
				
					clearTimeout( _self.slideshow );
					_self.options.autoplay	= false;
					// TweenMax.set(daProgress, {xPercent: 0});
					$('.da-progress').removeClass('progressing').addClass('no-will-change');

				
				}
				
				var page = ( _self.current < _self.slidesCount - 1 ) ? page = _self.current + 1 : page = 0;
				_self._navigate( page, 'next' );
				return false;
				
			});
			
			this.$navPrev.on( 'click.cslider', function( event ) {
				
				if( _self.options.autoplay ) {
				
					clearTimeout( _self.slideshow );
					_self.options.autoplay	= false;
					// TweenMax.set(daProgress, {xPercent: 0});
					$('.da-progress').removeClass('progressing').addClass('no-will-change');

				
				}
				
				var page = ( _self.current > 0 ) ? page = _self.current - 1 : page = _self.slidesCount - 1;
				_self._navigate( page, 'prev' );
				return false;
				
			});
			
			
				
				this.$el.on( 'webkitAnimationEnd.cslider animationend.cslider OAnimationEnd.cslider', function( event ) {
					
					if( event.originalEvent.animationName === 'toRightAnim4' || event.originalEvent.animationName === 'toLeftAnim4' ) {
						
						_self.isAnimating	= false;
					
					}	
					
				});
			
			
			
		}
	};
	
	var logError 			= function( message ) {
		if ( this.console ) {
			console.error( message );
		}
	};
	
	$.fn.cslider			= function( options ) {
	
		if ( typeof options === 'string' ) {
			
			var args = Array.prototype.slice.call( arguments, 1 );
			
			this.each(function() {
			
				var instance = $.data( this, 'cslider' );
				
				if ( !instance ) {
					logError( "cannot call methods on cslider prior to initialization; " +
					"attempted to call method '" + options + "'" );
					return;
				}
				
				if ( !$.isFunction( instance[options] ) || options.charAt(0) === "_" ) {
					logError( "no such method '" + options + "' for cslider instance" );
					return;
				}
				
				instance[ options ].apply( instance, args );
			
			});
		
		} 
		else {
		
			this.each(function() {
			
				var instance = $.data( this, 'cslider' );
				if ( !instance ) {
					$.data( this, 'cslider', new $.Slider( options, this ) );
				}
			});
		
		}
		
		return this;
		
	};
	
})( jQuery );