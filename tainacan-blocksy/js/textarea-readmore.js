/**
 * Expand/collapse long textarea / core description metadata previews on the public item page.
 * Labels from wp_localize_script object tainacanBlocksyTextareaReadmore (moreText, lessText).
 */
(function () {
	'use strict';

	var labels =
		typeof tainacanBlocksyTextareaReadmore !== 'undefined'
			? tainacanBlocksyTextareaReadmore
			: {};
	var moreText = labels.moreText || 'Show more';
	var lessText = labels.lessText || 'Show less';

	function setToggleLabel(toggle, expanded) {
		toggle.textContent = (expanded ? lessText : moreText);
		toggle.classList.toggle(
			'tainacan-blocksy-textarea-readmore__toggle--less',
			expanded
		);
		toggle.classList.toggle(
			'tainacan-blocksy-textarea-readmore__toggle--more',
			!expanded
		);
	}

	function toggleReadmore(toggle) {
		var root = toggle.closest('.tainacan-blocksy-textarea-readmore');
		if (!root) {
			return;
		}

		var preview = root.querySelector('.tainacan-blocksy-textarea-readmore__preview');
		var fullId = toggle.getAttribute('aria-controls');
		var full = fullId ? document.getElementById(fullId) : null;
		if (!preview || !full) {
			return;
		}

		var expanded = toggle.getAttribute('aria-expanded') === 'true';

		if (expanded) {
			toggle.setAttribute('aria-expanded', 'false');
			preview.removeAttribute('hidden');
			full.setAttribute('hidden', '');
			setToggleLabel(toggle, false);
		} else {
			toggle.setAttribute('aria-expanded', 'true');
			preview.setAttribute('hidden', '');
			full.removeAttribute('hidden');
			setToggleLabel(toggle, true);
		}
	}

	document.addEventListener('click', function (e) {
		var toggle = e.target.closest('.tainacan-blocksy-textarea-readmore__toggle');
		if (!toggle) {
			return;
		}
		e.preventDefault();
		toggleReadmore(toggle);
	});

	document.addEventListener('keydown', function (e) {
		if (e.key !== ' ') {
			return;
		}
		var toggle = e.target.closest('.tainacan-blocksy-textarea-readmore__toggle');
		if (!toggle) {
			return;
		}
		e.preventDefault();
		toggleReadmore(toggle);
	});
})();
