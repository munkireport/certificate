<div class="col-lg-4 col-md-6">
    <div class="card" id="certificate-expiration-widget">
        <div class="card-header" data-container="body" title="">
            <i class="fa fa-certificate"></i>
            <span data-i18n="certificate.title"></span>
            <a href="show/listing/certificate/certificate" class="pull-right"><i class="fa fa-list"></i></a>
        </div>
		<div class="card-body text-center"></div>
    </div><!-- /panel -->
</div><!-- /col -->

<script>
$(document).on('appUpdate', function(e, lang) {

    $.getJSON( appUrl + '/module/certificate/get_stats', function( data ) {
        
    	if(data.error){
    		//alert(data.error);
    		return;
    	}
		
		var panel = $('#certificate-expiration-widget div.card-body'),
			baseUrl = appUrl + '/show/listing/certificate/certificate';
		panel.empty();

		// Set statuses
        if(data.expired){
			panel.append(' <a href="'+baseUrl+'" class="btn btn-danger"><span class="bigger-150">'+data.expired+'</span><br>'+i18n.t('certificate.expired')+'</a>');
		}
		if(data.soon){
			panel.append(' <a href="'+baseUrl+'" class="btn btn-warning"><span class="bigger-150">'+data.soon+'</span><br>'+i18n.t('certificate.soon')+'</a>');
		}
		if(data.ok){
			panel.append(' <a href="'+baseUrl+'" class="btn btn-success"><span class="bigger-150">'+data.ok+'</span><br>'+i18n.t('certificate.ok')+'</a>');
		}
    });
});
</script>
