/* Handles updating Media Items component when reloading page from customizer */
if (window.ctEvents && window.ctEvents.default) {
    window.ctEvents.default.on('blocksy:frontend:init', () => {
        if (tainacan_plugin?.classes?.TainacanMediaGallery && tainacan_plugin?.tainacan_media_components) {
            (Object.values(tainacan_plugin.tainacan_media_components) || []).forEach((component) => {
                new tainacan_plugin.classes.TainacanMediaGallery(
                    component.has_media_thumbs ? '#' + component.media_thumbs_id : null,
                    component.has_media_main ? '#' + component.media_main_id : null,
                    component
                );
            });
        }
        document.dispatchEvent(new Event('TainacanReloadItemsListComponent'));
    });
}