/**
 * Marquee Widget JavaScript
 *
 * Handles the seamless looping animation for marquee content
 */
( function() {
	'use strict';

	const initMarquee = function() {
		const marquees = document.querySelectorAll( '.orivo-marquee-blocks__inner' );

		marquees.forEach( function( marqueeInner ) {
			const wrapper = marqueeInner.closest( '.orivo-marquee-blocks' );
			if ( ! wrapper ) return;

			const speed = wrapper.getAttribute( 'data-speed' );
			if ( speed ) {
				marqueeInner.style.animationDuration = speed + 's';
			}

			// Clone items for seamless looping
			// Only clone if there are items and they haven't been cloned yet
			const items = marqueeInner.querySelectorAll( '.orivo-marquee-blocks__item' );
			if ( items.length > 0 && ! marqueeInner.hasAttribute( 'data-cloned' ) ) {
				// Clone all items to create seamless loop
				items.forEach( function( item ) {
					const clone = item.cloneNode( true );
					marqueeInner.appendChild( clone );
				} );

				marqueeInner.setAttribute( 'data-cloned', 'true' );
			}
		} );
	};

	// Initialize on load
	window.addEventListener( 'load', initMarquee );

	// Initialize on Elementor preview changes (for editor)
	if ( window.elementorFrontend ) {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/global', initMarquee );
	}

} )();

// =====================
// VIDEO POPUP FUNCTIONALITY
// =====================
( function() {
	'use strict';

	// Create popup HTML structure
	const createPopupHTML = function() {
		if ( document.querySelector( '.orivo-marquee-video-popup' ) ) {
			return; // Already exists
		}

		const popupHTML = `
			<div class="orivo-marquee-video-popup" id="orivoMarqueeVideoPopup">
				<div class="orivo-marquee-video-popup__overlay"></div>
				<div class="orivo-marquee-video-popup__content">
					<button class="orivo-marquee-video-popup__close" aria-label="Close popup">&times;</button>
					<div id="orivoMarqueeVideoContainer"></div>
				</div>
			</div>
		`;
		document.body.insertAdjacentHTML( 'beforeend', popupHTML );
	};

	// Open video popup
	const openVideoPopup = function( videoUrl ) {
		console.log( 'Opening video popup with URL:', videoUrl );
		const popup = document.getElementById( 'orivoMarqueeVideoPopup' );
		const container = document.getElementById( 'orivoMarqueeVideoContainer' );

		if ( ! popup ) {
			console.error( 'Popup element not found' );
			return;
		}
		if ( ! container ) {
			console.error( 'Container element not found' );
			return;
		}

		// Clear any existing content
		container.innerHTML = '';

		// Create video element with proper attributes
		const video = document.createElement( 'video' );
		video.controls = true;
		video.autoplay = true;
		video.playsInline = true;
		video.style.width = '100%';
		video.style.height = 'auto';
		video.style.display = 'block';
		video.style.borderRadius = '8px';
		video.style.boxShadow = '0 10px 40px rgba(0, 0, 0, 0.5)';

		const source = document.createElement( 'source' );
		source.src = videoUrl;
		source.type = 'video/mp4';

		video.appendChild( source );
		container.appendChild( video );

		console.log( 'Video element created:', video );

		// Show popup
		popup.classList.add( 'orivo-marquee-video-popup--active' );
		document.body.style.overflow = 'hidden'; // Prevent background scrolling

		console.log( 'Popup is now active:', popup.classList.contains( 'orivo-marquee-video-popup--active' ) );

		// Try to play the video
		video.play().then( function() {
			console.log( 'Video started playing successfully' );
		} ).catch( function( error ) {
			console.log( 'Autoplay prevented:', error );
		} );
	};

	// Close video popup
	const closeVideoPopup = function() {
		console.log( 'Closing video popup' );
		const popup = document.getElementById( 'orivoMarqueeVideoPopup' );
		const container = document.getElementById( 'orivoMarqueeVideoContainer' );

		if ( ! popup ) {
			console.error( 'Popup element not found for closing' );
			return;
		}

		popup.classList.remove( 'orivo-marquee-video-popup--active' );
		document.body.style.overflow = ''; // Restore scrolling

		console.log( 'Popup closed' );

		// Clear video after animation
		setTimeout( function() {
			if ( container ) {
				container.innerHTML = '';
				console.log( 'Video container cleared' );
			}
		}, 300 );
	};

	// Initialize popup functionality
	const initVideoPopup = function() {
		// Create popup if it doesn't exist
		createPopupHTML();

		// Remove existing event listeners to avoid duplicates
		const videoItems = document.querySelectorAll( '.orivo-marquee-blocks--popup-mode' );
		videoItems.forEach( function( item ) {
			// Clone the item to remove all event listeners
			const newItem = item.cloneNode( true );
			item.parentNode.replaceChild( newItem, item );

			// Add new click handler
			newItem.addEventListener( 'click', function( e ) {
				e.preventDefault();
				e.stopPropagation();
				const videoUrl = this.getAttribute( 'data-video-url' );
				console.log( 'Video URL:', videoUrl );
				if ( videoUrl ) {
					openVideoPopup( videoUrl );
				}
			} );
		} );

		// Close button handler - remove old and add new
		const closeBtn = document.querySelector( '.orivo-marquee-video-popup__close' );
		if ( closeBtn ) {
			const newCloseBtn = closeBtn.cloneNode( true );
			closeBtn.parentNode.replaceChild( newCloseBtn, closeBtn );
			newCloseBtn.addEventListener( 'click', function( e ) {
				e.preventDefault();
				e.stopPropagation();
				closeVideoPopup();
			} );
		}

		// Overlay click handler - remove old and add new
		const overlay = document.querySelector( '.orivo-marquee-video-popup__overlay' );
		if ( overlay ) {
			const newOverlay = overlay.cloneNode( true );
			overlay.parentNode.replaceChild( newOverlay, overlay );
			newOverlay.addEventListener( 'click', function( e ) {
				e.preventDefault();
				e.stopPropagation();
				closeVideoPopup();
			} );
		}

		// ESC key handler - only add once
		if ( ! window.videoPopupEscHandler ) {
			window.videoPopupEscHandler = true;
			document.addEventListener( 'keydown', function( e ) {
				if ( e.key === 'Escape' ) {
					closeVideoPopup();
				}
			} );
		}
	};

	// Initialize on load
	window.addEventListener( 'load', initVideoPopup );

	// Re-initialize on Elementor preview changes
	if ( window.elementorFrontend ) {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/global', initVideoPopup );
	}
} )();
