<div class="panel">
	<div class="panel-body">
		<div class="dash-tab-content">
			<input id="tab1" type="radio" name="dash-tab" checked>
			<label for="tab1">All<span class="tab-title"></span><span id="tab-all"></span></label>

			<input id="tab2" type="radio" name="dash-tab">
			<label for="tab2"><span class="icon fa fa-pencil"></span><span class="tab-title">Drafts</span><span id="tab-draft"></span></label>

			<input id="tab3" type="radio" name="dash-tab">
			<label for="tab3"><span class="icon fa fa-file"></span><span class="tab-title">Published</span><span id="tab-published"></span></label>

			<section id="content1">
				<ul class="list-unstyled all check-list"></ul>
			</section>

			<section id="content2">
				<ul class="list-unstyled draft check-list"></ul>
			</section>

			<section id="content3">
				<ul class="list-unstyled published check-list"></ul>
			</section>
		</div>
	</div>
</div>

<script type="text/javascript">
	function all(){
		$.ajax({
			type: 'post',
			url: '<?php echo base_url()?>' + 'my/blog/get/all',
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
					$.each(res.data.data, function(key, blog){
						html += '<li>'
						html += '<p>'

						status = blog.Status == 'draft' 
						? '<span class="status bg-primary" onclick="$(\'label[for=tab2]\').click()"><b class="fa fa-pencil">&nbsp;</b>' + blog.Status + ' </span>'
						: '<span class="status bg-success" onclick="$(\'label[for=tab3]\').click()"><b class="fa fa-check">&nbsp;</b>' + blog.Status + ' </span>'

						description = blog.Description.length > 250 
						? blog.Description.substr(0,250) + ' ...' 
						: blog.Description

						url = blog.Url.split('/')
						url = url[url.length-1]

						html += '<span class="title" title="Edit"><a href="<?php echo base_url().'my/blog/edit/'?>' + url + '">' + blog.Title + '<span class="fa fa-pencil"></span></a></span>'
						html += '<span class="short-description">' + description + ' </span>'

						date = blog.DateModified !== ''
						? blog.DateModified + ' (modified)' 
						: blog.DateCreated 

						html += '<span class="date">' + date + '</span>'
						html += status
						html += '<span class="status bg-danger" onclick="remove(this)" data-id="' + blog.BlogId + '"><b class="fa fa-remove">&nbsp;</b>delete</span>'
						html += '</p>'
						html += '</li>'

						$('ul.all.check-list').append(html)
						// reset
						html = ''
					})
				}
			},
		})
	}

	function draft(){
		$.ajax({
			type: 'post',
			url: '<?php echo base_url()?>' + 'my/blog/get/draft',
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
					$('#tab-draft').html(function(){
						return res.data.data.length > 0 
						? '(' + res.data.data.length + ')' : ''
					})

					html = ""
					$('ul.draft.check-list').html(html)
					$.each(res.data.data, function(key, blog){
						html += '<li>'
						html += '<p>'

						description = blog.Description.length > 250 
						? blog.Description.substr(0,250) + ' ...' 
						: blog.Description

						url = blog.Url.split('/')
						url = url[url.length-1]

						html += '<span class="title" title="Edit"><a href="<?php echo base_url().'my/blog/edit/'?>' + url + '">' + blog.Title + '<span class="fa fa-pencil"></span></a></span>'
						html += '<span class="short-description">' + description + ' </span>'

						date = blog.DateModified !== ''
						? blog.DateModified + ' (modified)' 
						: blog.DateCreated 

						html += '<span class="date">' + date + '</span>'
						html += '<span class="status bg-danger" onclick="remove(this)" data-id="' + blog.BlogId + '"><b class="fa fa-remove">&nbsp;</b>delete</span>'
						html += '</p>'
						html += '</li>'

						$('ul.draft.check-list').append(html)
						// reset
						html = ''
					})
				}
			},
		})
	}

	function published(){
		$.ajax({
			type: 'post',
			url: '<?php echo base_url()?>' + 'my/blog/get/published',
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
					$('#tab-published').html(function(){
						return res.data.data.length > 0 
						? '(' + res.data.data.length + ')' : ''
					})

					html = ""
					$('ul.published.check-list').html(html)
					$.each(res.data.data, function(key, blog){
						html += '<li>'
						html += '<p>'

						description = blog.Description.length > 250 
						? blog.Description.substr(0,250) + ' ...' 
						: blog.Description

						url = blog.Url.split('/')
						url = url[url.length-1]

						html += '<span class="title" title="Edit"><a href="<?php echo base_url().'my/blog/edit/'?>' + url + '">' + blog.Title + '<span class="fa fa-pencil"></span></a></span>'
						html += '<span class="short-description">' + description + ' </span>'

						date = blog.DateModified !== ''
						? blog.DateModified + ' (modified)' 
						: blog.DateCreated 

						html += '<span class="date">' + date + '</span>'
						html += '<span class="status bg-danger" onclick="remove(this)" data-id="' + blog.BlogId + '"><b class="fa fa-remove">&nbsp;</b>delete</span>'
						html += '</p>'
						html += '</li>'

						$('ul.published.check-list').append(html)
						// reset
						html = ''
					})
				}
			},
		})
	}

	function remove(elem){
		swal({
          title: "Are you sure?",
          text: "This item will be deleted.",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Yes, delete it!",
          cancelButtonText: "No",
          closeOnConfirm: false,
          closeOnCancel: false
        },
        function(isConfirm) {
          if (isConfirm) {
          	blogid = $(elem).data('id')
			$.ajax({
				type: 'post',
				url: '<?php echo base_url() ?>' + 'my/blog/delete/' + blogid,
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

					if(res.data.message == "success"){
						all()
						draft()
						published()

						swal({
			                title: "Deleted!", 
			                text: "Post deleted.", 
			                type: "success",
			                timer: 800,
			                showConfirmButton: false
			            });
					}
				}
			})

          } else {
            swal.close()
          }
        });
	}

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

	all()
	draft()
	published()

</script>