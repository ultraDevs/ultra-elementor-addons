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
