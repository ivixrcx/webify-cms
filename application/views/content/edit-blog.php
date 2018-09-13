<link rel="stylesheet" href="assets/css/gallery.css">
<div class="row">
	<form>
	<div class="col-md-7">
		<div class="panel panel-headline" style="height:413px">
			<div class="panel-heading">
        <small>Automatically saved as <b class="text-success">draft</b> when <b >touched</b>.</small>
        <a id="preview" href="" class="pull-right" target="_blank">Preview</a>
      </div>
			<div class="panel-body">
        <input type="hidden" name="blogid" value="" />
        <input type="hidden" name="url" value="" />
				<input class="form-control input-lg" name="title" placeholder="Title" type="text" value="" required autocomplete="off">
        <h4 class="permalink" style="font-size: .8em;">
          <span title="Permalink">
            <span class="fa fa-link"></span>&nbsp;
            <span id="url" class="text-primary" style="border: 1px solid;"></span>
          </span>
        </h4>

				<textarea class="form-control input-lg" rows="5"  name="description" placeholder="Short description" required style="display:none"></textarea>

				<h3 style="border-width: 3px;border-top-style: dashed;border-top-color: #ccc;padding-top: 20px;margin-top: 25px;">Link <small>(optional)</small></h3>
				<input type="text" name="link_name" class="form-control input-lg" placeholder="Link name">
				<input type="text" name="link_url" class="form-control input-lg" placeholder="https://yourlink.com">
			</div>
		</div>
	</div>
	<div class="col-md-5">
		<div class="panel">
			<div class="panel-body">
				<h3 class="">Featured Image</h3>
        <div class="col-md-12 wrapper-img" style="background:#e9e9e9">
          <div class="row">
          	<img id="img-uploader" class="img-responsive" src="" style="display:block;margin:auto;height: 204.78px;max-height: 204.78px"/>
          </div>
          <a href="#" data-toggle="modal" data-target="#dialogFilemanager">
	          <div class="overlay"><span align="center"><span class="fa fa-cloud-upload" style="font-size: 45px;"></span><br/><br/><span style="display: block">Choose from File Manager <br>(1200w x 628h)</span></span></div>
	          <input type="hidden" name="image" value="" />
          </a>
        </div>
        <sub>Ideal image size (1200w x 628h)</sub>
			</div>
		</div>
        <div class="panel" style="margin-top:-20px">
            <div class="panel-body">
                <h1 style="margin-top:10px">Publish
                    <label class="switch">
                        <input type="checkbox">
                        <span class="slider round"></span>
                    </label>
                </h1>
            </div>
        </div>
	</div>
	<div class="col-md-12">
		<div class="panel" id="drop-area" style="margin-top:-20px;">
				<div class="panel-body">
						<h1 style="margin-top:10px">Gallery</h1>
						<p>Upload multiple files with the file dialog or by dragging and dropping images onto the dashed region</p>
						<input type="file" id="fileElem" multiple accept="image/*" onchange="handleFiles(this.files)">
		        <label class="button" for="fileElem">Select some files</label>
						<progress id="progress-bar" max=100 value=0 style="width:100%"></progress>
						<input type="hidden" id="gallery_dir" hidden>
						<div id="gallery"></div>
				</div>
		</div>
	</div>
	<div class="col-md-12">
        <textarea id="editor" name="content" required></textarea>
	</div>
	</form>
</div>


<div class="modal fade" id="dialogFilemanager" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <button id="modal-close" class="btn btn-danger" data-dismiss="modal" style="position: absolute;top:10px;right:10px;z-index:1"><span style="font-size: 18px;">&times;</span></button>
    <div class="modal-dialog modal-lg" role="document">
  		<div class="row">
            <br/>
            <br/>
			<div class="col-md-12">
				<div id="elfinder"></div>
			</div>
		</div>
    </div>
</div>


<!-- scripts -->
<script type="text/javascript" src="<?php echo base_url() ?>assets/scripts/gallery.js"></script>
<script type="text/javascript">

    // tinymce
    tinymce.init({
      selector: 'textarea#editor',
      height: 500,
      theme: 'modern',
      menubar: 'insert table',
      plugins: 'autosave autolink directionality image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern',
      toolbar: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
      content_style: `
        @import url('https://fonts.googleapis.com/css?family=Ubuntu:400,500');
        body {
            font-family: 'Ubuntu', sans-serif;
            font-size: .95em;
        }`
    }).then(function(editors){
			// console.log(editors)
		});

    function tinymceDirty(){
        if(tinymce.activeEditor != ''){
            if(tinymce.activeEditor.isDirty()){
                tinymce.activeEditor.save()
                dirtyForm()
            }
        }
    }

    setInterval(function(){
        tinymceDirty()
    },3000)

    // get serialized form to check changes from the form
    var form_original_data = $("form").serialize()

    title = ""

    function dirtyForm(){

        if($('input[name=title]').val() == '') return false

        // change url without reloading the page
        if(title != ''){
            history.pushState(null, '', '<?php echo base_url()?>my/blog/edit/' + title);
        }

        if($("form").serialize() != form_original_data){
            // update new edits
						form_original_data = $("form").serialize();
						var new_form_data = $("form").serializeArray();
						content = new_form_data[7].value;
						content = content.replace(/<\/p>\r\n<p>&nbsp;<\/p>\r\n<p>/g, '</p>\n<p>')
						// content
						new_form_data[7].value = content
						// description
						new_form_data[3].value = new_form_data[7].value.substring(0,100)
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>' + 'my/blog/draft/',
                data: $.param(new_form_data),
                dataType: 'json',
                crossDomain: true,
                headers: {'X-Requested-With': 'XMLHttpRequest'},
                error: function(res){
                    console.log('error')
                    console.log(res)
                },
                beforeSend: function(){
                    $('#status').html('<span class="text-info">Saving to drafts...</span>')
                },
                success: function(res){
                    // UNAUTHORIZED
                    if(res.status.code == 401){
                        _UNAUTHORIZED()
                    }

                    if(res.data.message == 'success'){

                        if(res.data.blogid != ''){
                            $('input[name=blogid]').val(res.data.blogid)
                        }

                        setTimeout(function(){
                            $('#status span').switchClass('text-info', 'text-success').html('~Draft');
                            $('input[type="checkbox"]').prop('checked', false)

                            new Noty({
                                theme: 'nest',
                                text: 'Saved to drafts.',
                                type: 'success',
                                timeout: 1800,
                                layout: 'topRight',
                                killer: true,
                            }).show()
                        }, 800)
                    }
                    else{
                        $('#status span').switchClass('text-info', 'text-danger').html('[error]')
                    }
                }
            })
        }
    }

    $('input[type=text], textarea, select').on('change blur',function(){
        dirtyForm();
    })

    $('input[type=checkbox]').change(function(e){
        if (this.checked == true){
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>' + 'my/blog/publish/',
                data: { blogid: $('input[name=blogid]').val() },
                dataType: 'json',
                crossDomain: true,
                headers: {'X-Requested-With': 'XMLHttpRequest'},
                error: function(res){
                    console.log('error')
                    console.log(res)
                },
                beforeSend: function(){
                    $('#status').html('<span class="text-info">Publishing...</span>')
                },
                success: function(res){
                    // UNAUTHORIZED
                    if(res.status.code == 401){
                        _UNAUTHORIZED()
                    }

                    if(res.data.message == 'success'){
                        setTimeout(function(){
                            $('#status span').switchClass('text-info', 'text-success').html('Published');

                            swal({
                                title: "Your post is now published!",
                                text: "",
                                type: "success",
                                showCancelButton: true,
                                cancelButtonText: "No, Thanks!",
                                confirmButtonClass: "btn-success",
                                confirmButtonText: "Preview",
                                closeOnConfirm: true
                            },
                            function(){
                                window.open($('input[name=url]').val(), '_blank')
                            });

                        }, 2500)
                    }
                    else{
                        $('#status span').switchClass('text-info', 'text-danger').html('[error]')
                    }
                }
            })

        }else{
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>' + 'my/blog/unpublish/',
                data: { blogid: $('input[name=blogid]').val() },
                dataType: 'json',
                crossDomain: true,
                headers: {'X-Requested-With': 'XMLHttpRequest'},
                error: function(res){
                    console.log('error')
                    console.log(res)
                },
                beforeSend: function(){
                    $('#status').html('<span class="text-info">Unpublishing...</span>')
                },
                success: function(res){
                    // UNAUTHORIZED
                    if(res.status.code == 401){
                        _UNAUTHORIZED()
                    }

                    if(res.data.message == 'success'){
                        setTimeout(function(){
                            $('#status span').switchClass('text-info', 'text-danger').html('Unpublished');

                            new Noty({
                                theme: 'nest',
                                text: 'Successfully Unpublished!',
                                type: 'info',
                                timeout: 1800,
                                layout: 'topRight',
                                killer: true,
                            }).show()
                        }, 2500)
                    }
                    else{
                        $('#status span').switchClass('text-info', 'text-danger').html('[error]')
                    }
                }
            })

        }
    })

    $('#preview, input[type=checkbox]').click(function(){

        if($('input[name=title]').val() == '') {
            swal({
                title: "Preview Unavailable!",
                text: "Give for post a title!",
                type: "error",
                showConfirmButton: false,
                timer: 2000,
            },
            function(){
                swal.close()
            });
        }
    })

    // load edit blog
    $.ajax({
      type: 'post',
      url: '<?php echo base_url() ?>' + 'blog/search_json/<?php echo $blog ?>',
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

          $('#preview').attr('href', '<?php echo base_url() ?>preview/blog/' + res.data.Url)
          $('#gallery_dir').val(res.data.BlogId)
          $('input[name=blogid]').val(res.data.BlogId)
          $('input[name=url]').val(res.data.Url)
          $('input[name=title]').val(res.data.Title)
          $('#img-uploader').prop('src', '<?php echo base_url() ?>filemanager/files/' + res.data.Image)
          $('input[name=image]').val(res.data.Image)
          $('textarea[name=description]').val(res.data.Description)
          $('input[name=link_name]').val(res.data.LinkName)
          $('input[name=link_url]').val(res.data.LinkURL)
          $('textarea[name=content]').val(res.data.Content)
          $('#url').text('<?php echo base_url() ?>blog/' + res.data.Url)

          if(res.data.StatusId == 4){
              $('label.switch input[type=checkbox]').prop('checked','checked')
              $('#status').html('<span class="text-success">Published</span>')
          }
          else{
              $('#status').html('<span class="text-success">~Draft</span>')
          }

					// load gallery
					$.ajax({
		        type: 'post',
		        url: '<?php echo base_url() ?>' + 'gallery_files/' + res.data.BlogId,
		        dataType: 'json',
		        crossDomain: true,
		        headers: {'X-Requested-With': 'XMLHttpRequest'},
		        error: function(res){
		          console.log('error')
		          console.log(res)
		        },
		        success: function(res){
							console.log(res)
		          // UNAUTHORIZED
		          if(res.status.code == 401){
		              _UNAUTHORIZED()
		          }
							$.each(res.data, function(key, data){
								let div = document.createElement('div')
						    div.id = data.filename
						    div.style = 'width: 200px; margin: 5px;'
						    div.className = 'thumbnail pull-left'

						    let span = document.createElement('span')
						    span.style = 'position: absolute'
						    span.className = 'close'
						    span.innerHTML = '&times'
								span.onclick = function(e){
						      document.getElementById(data.filename).remove();

						      let url = base_url + 'delete_photo/' + data.foldername + '/' + data.filename
						      let xhr = new XMLHttpRequest()
						      xhr.open('POST', url, true)
						      xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest')
						      xhr.addEventListener('readystatechange', function(e) {
						        if (xhr.readyState == 4 && xhr.status == 200) {
						          console.log(xhr.response)
						        }
						        else if (xhr.readyState == 4 && xhr.status != 200) {
						          // Error. Inform the user
						          console.log('error')
						          console.log(xhr.response)
						        }
						      })
						      xhr.send()
						    }

								let img = document.createElement('img')
						    img.src = data.path
						    img.style = 'width: 100%'
						    img.className = 'img-responsive'

								div.append(span)
						    div.append(img)

						    document.getElementById('gallery').appendChild(div)
							})
						}
					})
        }
    })

    $('input[name=title]').on('keyup',function(){

        url = $('input[name=title]').val().trim().replace(/[^a-z0-9+]+/gi, '-').toLowerCase()
        $('input[name=url]').val(url)
        $('#preview').attr('href', '<?php echo base_url()?>preview/blog/' + url)
        $('#url').text('<?php echo base_url() ?>blog/' + url)
        title = url
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

<script type="text/javascript" src="assets/scripts/require-2.3.2.min.js"></script>
<script type="text/javascript">
    function imgReplacer(url){
        $('#img-uploader').attr('src',url)
        dirtyForm();
    }

    define('elFinderConfig', {
        // elFinder options (REQUIRED)
        // Documentation for client options:
        // https://github.com/Studio-42/elFinder/wiki/Client-configuration-options
        defaultOpts : {
            url : '<?php echo $connector ?>' // connector URL (REQUIRED)
            ,commandsOptions : {
                edit : {
                    extraOptions : {
                        // set API key to enable Creative Cloud image editor
                        // see https://console.adobe.io/
                        creativeCloudApiKey : '',
                        // browsing manager URL for CKEditor, TinyMCE
                        // uses self location with the empty value
                        managerUrl : ''
                    }
                }
                ,quicklook : {
                    // to enable preview with Google Docs Viewer
                    googleDocsMimes : ['application/pdf', 'image/tiff', 'application/vnd.ms-office', 'application/msword', 'application/vnd.ms-word', 'application/vnd.ms-excel', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']
                }
            }
            ,getFileCallback: function(file){
                $('#dialogFilemanager').click();
                $('input[name=image]').val(file.url.replace(file.baseUrl, ''));
                imgReplacer(file.url);
            }
            // bootCalback calls at before elFinder boot up
            ,bootCallback : function(fm, extraObj) {
                /* any bind functions etc. */
                fm.bind('init', function() {
                    // any your code
                });
                // for example set document.title dynamically.
                var title = document.title;
                fm.bind('open', function() {
                    var path = '',
                        cwd  = fm.cwd();
                    if (cwd) {
                        path = fm.path(cwd.hash) || null;
                    }
                    document.title = path? path + ':' + title : title;
                }).bind('destroy', function() {
                    document.title = title;
                });
            }
        },
        managers : {
            // 'DOM Element ID': { /* elFinder options of this DOM Element */ }
            'elfinder': {}
        }
    });
    define('returnVoid', void 0);
    (function(){
        var // elFinder version
            elver = '<?php echo elFinder::getApiFullVersion()?>',
            // jQuery and jQueryUI version
            jqver = '3.2.1',
            uiver = '1.12.1',

            // Detect language (optional)
            lang = (function() {
                var locq = window.location.search,
                    fullLang, locm, lang;
                if (locq && (locm = locq.match(/lang=([a-zA-Z_-]+)/))) {
                    // detection by url query (?lang=xx)
                    fullLang = locm[1];
                } else {
                    // detection by browser language
                    fullLang = (navigator.browserLanguage || navigator.language || navigator.userLanguage);
                }
                lang = fullLang.substr(0,2);
                if (lang === 'ja') lang = 'jp';
                else if (lang === 'pt') lang = 'pt_BR';
                else if (lang === 'ug') lang = 'ug_CN';
                else if (lang === 'zh') lang = (fullLang.substr(0,5).toLowerCase() === 'zh-tw')? 'zh_TW' : 'zh_CN';
                return lang;
            })(),

            // Start elFinder (REQUIRED)
            start = function(elFinder, editors, config) {
                // load jQueryUI CSS
                elFinder.prototype.loadCss('//cdnjs.cloudflare.com/ajax/libs/jqueryui/'+uiver+'/themes/smoothness/jquery-ui.css');

                $(function() {
                    var optEditors = {
                            commandsOptions: {
                                edit: {
                                    editors: Array.isArray(editors)? editors : []
                                }
                            }
                        },
                        opts = {};

                    // Interpretation of "elFinderConfig"
                    if (config && config.managers) {
                        $.each(config.managers, function(id, mOpts) {
                            opts = Object.assign(opts, config.defaultOpts || {});
                            // editors marges to opts.commandOptions.edit
                            try {
                                mOpts.commandsOptions.edit.editors = mOpts.commandsOptions.edit.editors.concat(editors || []);
                            } catch(e) {
                                Object.assign(mOpts, optEditors);
                            }
                            // Make elFinder
                            $('#' + id).elfinder(
                                // 1st Arg - options
                                $.extend(true, { lang: lang }, opts, mOpts || {}),
                                // 2nd Arg - before boot up function
                                function(fm, extraObj) {
                                    // `init` event callback function
                                    fm.bind('init', function() {
                                        // Optional for Japanese decoder "extras/encoding-japanese.min"
                                        delete fm.options.rawStringDecoder;
                                        if (fm.lang === 'jp') {
                                            require(
                                                [ 'encoding-japanese' ],
                                                function(Encoding) {
                                                    if (Encoding.convert) {
                                                        fm.options.rawStringDecoder = function(s) {
                                                            return Encoding.convert(s,{to:'UNICODE',type:'string'});
                                                        };
                                                    }
                                                }
                                            );
                                        }
                                    });
                                }
                            );
                        });
                    } else {
                        alert('"elFinderConfig" object is wrong.');
                    }
                });
            },

            // JavaScript loader (REQUIRED)
            load = function() {
                require(
                    [
                        'elfinder'
                        , 'extras/editors.default'       // load text, image editors
                        , 'elFinderConfig'
                    //  , 'extras/quicklook.googledocs'  // optional preview for GoogleApps contents on the GoogleDrive volume
                    ],
                    start,
                    function(error) {
                        alert(error.message);
                    }
                );
            },

            // is IE8? for determine the jQuery version to use (optional)
            ie8 = (typeof window.addEventListener === 'undefined' && typeof document.getElementsByClassName === 'undefined');

        // config of RequireJS (REQUIRED)
        require.config({
            baseUrl : '//cdnjs.cloudflare.com/ajax/libs/elfinder/'+elver+'/js',
            paths : {
                'jquery'   : '//cdnjs.cloudflare.com/ajax/libs/jquery/'+(ie8? '1.12.4' : jqver)+'/jquery.min',
                'jquery-ui': '//cdnjs.cloudflare.com/ajax/libs/jqueryui/'+uiver+'/jquery-ui.min',
                'elfinder' : 'elfinder.min',
                'encoding-japanese': '//cdn.rawgit.com/polygonplanet/encoding.js/master/encoding.min'
            },
            waitSeconds : 10 // optional
        });

        // load JavaScripts (REQUIRED)
        load();
    })();

</script>
