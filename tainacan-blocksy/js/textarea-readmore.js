/**
 * Expand/collapse long textarea / core description metadata previews on the public item page.
 * Labels from wp_localize_script object tainacanBlocksyTextareaReadmore (moreText, lessText).
 */
(function () {
	'use strict';

	const labels =
		typeof tainacanBlocksyTextareaReadmore !== 'undefined'
			? tainacanBlocksyTextareaReadmore
			: {};
	const moreText = labels.moreText || 'Show more';
	const lessText = labels.lessText || 'Show less';

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
		const root = toggle.closest('.tainacan-blocksy-textarea-readmore');
		if (!root) {
			return;
		}

		const preview = root.querySelector('.tainacan-blocksy-textarea-readmore__preview');
		const fullId = toggle.getAttribute('aria-controls');
		const full = fullId ? document.getElementById(fullId) : null;
		if (!preview || !full) {
			return;
		}

		const expanded = toggle.getAttribute('aria-expanded') === 'true';

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
		const toggle = e.target.closest('.tainacan-blocksy-textarea-readmore__toggle');
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
		const toggle = e.target.closest('.tainacan-blocksy-textarea-readmore__toggle');
		if (!toggle) {
			return;
		}
		e.preventDefault();
		toggleReadmore(toggle);
	});
})();
