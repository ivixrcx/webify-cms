
<div class="panel">
	<div class="panel-body">
		<ul class="list-unstyled all check-list">
		</ul>
	</div>
</div>

<script type="text/javascript">

$.ajax({
	type: 'post',
	url: '<?php echo base_url()?>' + 'my/page/get',
	dataType: 'json',
	crossDomain: true,
	headers: {'X-Requested-With': 'XMLHttpRequest'},
	error: function(res){
		console.log('error')
		console.log(res)
	},
	success: function(res){
		// UNAUTHORIZED
		if(res.status.code == 401){
			_UNAUTHORIZED()
		}

		if(res.data.message == "success" && res.data.data !== ''){
			$('#tab-all').html(function(){
				return res.data.data.length > 0 
				? '(' + res.data.data.length + ')' : ''
			})

			html = ""
			$('ul.all.check-list').html(html)
			$.each(res.data.data, function(key, page){
				
				url = page.Url.split('/')
				url = url[url.length-1]

				html += '<li>'
				html += '<span style="top: 15px;left: 20px;"></span>'
				html += '</label>'
				html += '<p>'
				html += '<span class="title" title="Edit">'
				html += '<a href="<?php echo base_url().'my/page/edit/'?>' + url + '">' + page.Title + '<span class="fa fa-pencil"></span></a>'
				html += '</span>'
				html += '</p>'
				html += '</li>'

				$('ul.all.check-list').append(html)
				// reset
				html = ''
				
			})
		}
	},
})

function _UNAUTHORIZED(){
	swal({
        title: "ACCESS DENIED",
        text: "UNAUTHORIZED",
        type: "error",
        confirmButtonText: "Sign In",
        confirmButtonClass: "btn-success",
        closeOnConfirm: true,
    },
    function(){
        window.location.href='<?php echo base_url() ?>' + 'admin'
    });
}

</script>