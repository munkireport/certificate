var format_certificate_relative_expiration_date = function(colNumber, row){

    // Format relative expiration date
    var col = $('td:eq('+colNumber+')', row),
        checkin = parseInt(col.text());

    var date = new Date(checkin * 1000);
    var diff = moment().diff(date, 'days');
    var cls = diff > 0 ? 'danger' : (diff > -30 ? 'warning' : 'success');
    col.html('<span class="label label-'+cls+'"><span title="'+date+'">'+moment(date).fromNow()+'</span>');
}

var format_certificate_expiration_date = function(colNumber, row){
    
    var col = $('td:eq('+colNumber+')', row),
        checkin = parseInt(col.text());
    var date = new Date(checkin * 1000);
    col.html('<span title="'+moment(date).format('LLLL')+'">'+date+'</span>');
}