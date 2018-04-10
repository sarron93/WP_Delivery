// @codekit-prepend "_skrollr.js"

document.addEventListener('DOMContentLoaded', function() {
	
	var doInit = false;
	var elements = document.querySelectorAll('.gambit_row_scroll');
	Array.prototype.forEach.call(elements, function( el ) {
		
		// Disable in mobile because Skrollr doesn't play well in them
		if ( navigator.userAgent.match(/Mobi/)) {
			el.parentNode.removeChild( el );
			return;
		}
		
		doInit = true;
		
		// Find the parent row
		var row = el.parentNode;
		while ( ! row.classList.contains('vc_row') && ! row.classList.contains('wpb_row') ) {
			if ( row.tagName === 'HTML' ) {
				row = false;
				break;
			}
			row = row.parentNode;
		}
		// If vc_row & wpb_row have been removed/renamed, find a suitable row
		if ( row === false ) {
			row = el.parentNode;
			var found = false;
			while ( ! found ) {
				Array.prototype.forEach.call( row.classList, function(className, i) { 
					if ( found ) {
						return;
					}
					if ( className.match(/row/g) ){
						found = true;
						return;
					}
				})
				if ( found || row.tagName === 'HTML' ) {
					break;
				}
				row = row.parentNode;
			}
		}
		if ( row === false ) {
			row = el.parentNode;
		}
		row.classList.add('gambit_row_scroll_parent');
		
		// If body overflow was checked, add a class to the body
		if ( el.getAttribute( 'data-body-overflow' ) === 'true' ) {
			document.querySelector('body').classList.add('gambit_row_scroll_overflow');
		}
		
		var animatedEl = row;
		
		// Move the data attribtues
		var newDiv = null;
		if ( el.getAttribute('data-row-exit') ) {
			if ( rowScrollParams.content_manipulators.indexOf( el.getAttribute('data-row-exit') ) !== -1 ) {
				newDiv = document.createElement('DIV');
				[].forEach.call(el.attributes, function(attr) {
					if ( attr.name.match(/^data-/) && attr.name.match(/-exit$/) ) {
						var attrName = attr.name;
						if ( attrName !== 'data-row-exit' ) {
							attrName = attrName.replace( '-exit', '' );
						}
						newDiv.setAttribute( attrName, attr.value );
					}
				});
			} else {
				[].forEach.call(el.attributes, function(attr) {
					if ( attr.name.match(/^data-/) && attr.name.match(/-exit$/) ) {
						var attrName = attr.name;
						if ( attrName !== 'data-row-exit' ) {
							attrName = attrName.replace( '-exit', '' );
						}
						animatedEl.setAttribute( attrName, attr.value );
					}
				});
			}
		}
		if ( el.getAttribute( 'data-row-entrance' ) ) {
			if ( rowScrollParams.content_manipulators.indexOf( el.getAttribute('data-row-entrance') ) !== -1 ) {
				if ( newDiv === null ) {
					newDiv = document.createElement('DIV');
				}
				[].forEach.call(el.attributes, function(attr) {
					if ( attr.name.match(/^data-/) && attr.name.match(/-entrance$/) ) {
						var attrName = attr.name;
						if ( attrName !== 'data-row-entrance' ) {
							attrName = attrName.replace( '-entrance', '' );
						}
						newDiv.setAttribute( attrName, attr.value );
					}
				});
			} else {
				[].forEach.call(el.attributes, function(attr) {
					if ( attr.name.match(/^data-/) && attr.name.match(/-entrance$/) ) {
						var attrName = attr.name;
						if ( attrName !== 'data-row-entrance' ) {
							attrName = attrName.replace( '-entrance', '' );
						}
						animatedEl.setAttribute( attrName, attr.value );
					}
				});
			}
		}
		if ( newDiv !== null ) {
			newDiv.classList.add('gambit_row_scroll_wrapper');
			newDiv.classList.add('gambit_row_scroll_parent');
			while ( row.firstChild ) {
			    newDiv.appendChild( row.firstChild );
			}
			row.appendChild( newDiv );
		}
		
		// Move the Skrollr data attributes to the row
		// [].forEach.call(el.attributes, function(attr) {
		// 	if ( attr.name.match(/^data-/) ) {
		// 		var attrName = attr.name;
		// 		if ( attrName.match( /-exit$/ ) ) {
		// 			attrName = attrName.replace( '-exit', '' );
		// 		} else if ( attrName.match( /-entrance$/ ) ) {
		// 			attrName = attrName.replace( '-entrance', '' );
		// 		}
		// 		animatedEl.setAttribute( attrName, attr.value );
		// 	}
		// });
		
		// var title, titleColor, titleBgColor;
// 		title = el.getAttribute( 'data-title' );
// 		console.log(title);
//
// 		if ( title ) {
// 			titleColor = animatedEl.getAttribute( 'data-title-color' );
// 			titleBgColor = animatedEl.getAttribute( 'data-title-bg-color' );
//
// 			var titleDiv = document.createElement('H2');
// 			titleDiv.innerHTML = title;
// 			titleDiv.style.color = titleColor;
// 			titleDiv.style.background = titleBgColor;
// 			titleDiv.classList.add('gambit_row_scroll_title');
// 			titleDiv.setAttribute('data-bottom-top', 'opacity: 1');
// 			titleDiv.setAttribute('data-15p-center-top', 'opacity: 1');
// 			titleDiv.setAttribute('data-center-top', 'opacity: 0');
//
// 			row.insertBefore(titleDiv, row.firstChild);
// 		}
		
		// Remove our placeholder so that it can't animate
		el.parentNode.removeChild( el );
	});
	
	// Visual Composer messes us up, so only initialize Skroller after a short delay
	if ( doInit ) {
		setTimeout( function() {
			// Initialize Skrollr
			skrollr.init({
				forceHeight: false
			});
		}, 1000 );
	}
	
});
	
	
/**
 * Fix when resizing
 */
window.addEventListener( 'resize', function() {
	setTimeout( function() {
		if ( ! document.querySelectorAll('.skrollr') ) {
			return;
		}
		var s = skrollr.get();
		if ( typeof s !== 'undefined' ) {
			// Doing a skrollr.refresh() doesn't work, but targetting the elements does
			s.refresh(document.querySelectorAll('.skrollr'));
		}
	}, 1 );
} );