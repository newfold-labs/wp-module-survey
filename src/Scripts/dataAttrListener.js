import domReady from '@wordpress/dom-ready';
import apiFetch from '@wordpress/api-fetch';
import { eventsAPI } from '../constants';

domReady( () => {
	// Function to handle click events.
	const handleClick = ( e ) => {
		if ( e.target.getAttribute( 'data-survey-option' ) !== null ) {
			apiFetch( {
				url: eventsAPI,
				method: 'POST',
				data: {
					action: e.currentTarget.getAttribute(
						'data-survey-action'
					),
					category: e.currentTarget.getAttribute(
						'data-survey-category'
					),
					data: {
						...JSON.parse(
							e.currentTarget.getAttribute( 'data-survey-data' )
						),
						value: e.target.getAttribute( 'data-survey-option' ),
					},
				},
			} );
		}
	};

	// Attach event listeners to already existing elements in the DOM.
	document.querySelectorAll( '[data-survey-action]' ).forEach( ( ele ) => {
		ele.addEventListener( 'click', handleClick );
	} );

	// Function to handle newly added elements to the DOM.
	const handleNewElements = ( mutationList ) => {
		for ( const mutation of mutationList ) {
			if ( mutation.type === 'childList' ) {
				mutation.addedNodes.forEach( ( addedNode ) => {
					if ( addedNode.nodeType === Node.ELEMENT_NODE ) {
						addedNode
							.querySelectorAll( '[data-survey-action]' )
							.forEach( ( ele ) => {
								ele.addEventListener( 'click', handleClick );
							} );
					}
				} );
			}
		}
	};

	// Create and start a MutationObserver
	const domObserver = new MutationObserver( handleNewElements );
	domObserver.observe( document.body, { childList: true, subtree: true } );
} );
