// Copy of Blocksy theme's onDocumentLoaded from their helpers package 'blocksy-frontend'
onDocumentLoadedDo = cb => {
	if (/comp|inter|loaded/.test(document.readyState)) {
		cb();
	} else {
		document.addEventListener('DOMContentLoaded', cb, false);
	}
}

onDocumentLoadedDo(() => {
	console.log("Resetar as coisas aqui...");
});

window.ctEvents.default.on('blocksy:frontend:init', () => {
	console.log("Resetar mais coisas aqui...", tainacan_plugin);
    if (tainacan_plugin?.classes?.TainacanMediaGallery) {
        (tainacan_plugin?.tainacan_media_components || []).forEach((component) => {
            new tainacan_plugin.classes.TainacanMediaGallery(
                component.has_media_thumbs ? '#' + component.media_thumbs_id : null,
                component.has_media_main ? '#' + component.media_main_id : null,
                component
            );
        });
    }
});
