<div class="col-lg-4 col-md-6">
	<div class="card" id="certificate-group-widget">
		<div class="card-header" data-container="body" >
			<i class="fa fa-certificate"></i>
            <span data-i18n="certificate.cert_groups"></span>
            <a href="/show/listing/certificate/certificate" class="pull-right"><i class="fa fa-list"></i></a>
		</div>
		<div class="list-group scroll-box"></div>
	</div><!-- /card -->
</div><!-- /col -->

<script>
$(document).on('appUpdate', function(e, lang) {
	
	var box = $('#certificate-group-widget div.scroll-box');
	
	$.getJSON( appUrl + '/module/certificate/get_certificates', function( data ) {
		
		box.empty();
		if(data.length){
			$.each(data, function(i,d){
				var badge = '<span class="badge badge-light pull-right">'+d.count+'</span>';
                box.append('<a href="'+appUrl+'/show/listing/certificate/certificate/#'+d.cert_cn+'" class="list-group-item">'+d.cert_cn+badge+'</a>')
			});
		}
		else{
			box.append('<span class="list-group-item">'+i18n.t('certificate.nocertificate')+'</span>');
		}
	});
});	
</script>

