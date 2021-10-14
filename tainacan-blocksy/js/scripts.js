// Scripts that run on document load need to be manually refreshed when inside the customizer
if (window.ctEvents) {

    if ( window.ctEvents.default )
        window.ctEvents.default.on('blocksy:frontend:init', onBlocksyFrontendInit);
    else
        window.ctEvents.on('blocksy:frontend:init', onBlocksyFrontendInit);

    function onBlocksyFrontendInit() {

        /* Handles updating Media Items component */
        if (tainacan_plugin?.classes?.TainacanMediaGallery && tainacan_plugin?.tainacan_media_components) {
            (Object.values(tainacan_plugin.tainacan_media_components) || []).forEach((component) => {
                new tainacan_plugin.classes.TainacanMediaGallery(
                    component.has_media_thumbs ? '#' + component.media_thumbs_id : null,
                    component.has_media_main ? '#' + component.media_main_id : null,
                    component
                );
            });
        }

        /* Handles reloading the Items list */
        document.dispatchEvent(new Event('TainacanReloadItemsListComponent'));
        
        /* Handles updating Items carousel */
        document.dispatchEvent(new Event('TainacanReloadCarouselItemsListBlock'));

        /* Handles Dynamic Items lists */
        document.dispatchEvent(new Event('TainacanReloadDynamicItemsBlock'));

    }
}