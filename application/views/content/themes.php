
<link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/codemirror/theme/monokai.css">
<link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/codemirror/lib/codemirror.css">

<script src="<?php echo base_url()?>assets/vendor/codemirror/lib/codemirror.js"></script>

<script src="<?php echo base_url()?>assets/vendor/codemirror/addon/edit/matchbrackets.js"></script>
<script src="<?php echo base_url()?>assets/vendor/codemirror/addon/comment/comment.js"></script>

<!-- FOLDING -->
<script src="<?php echo base_url()?>assets/vendor/codemirror/addon/fold/foldcode.js"></script>
<script src="<?php echo base_url()?>assets/vendor/codemirror/addon/fold/foldgutter.js"></script>
<script src="<?php echo base_url()?>assets/vendor/codemirror/addon/fold/brace-fold.js"></script>

<!-- SEARCH -->
<script src="<?php echo base_url()?>assets/vendor/codemirror/addon/dialog/dialog.js"></script>
<script src="<?php echo base_url()?>assets/vendor/codemirror/addon/search/searchcursor.js"></script>
<script src="<?php echo base_url()?>assets/vendor/codemirror/addon/search/search.js"></script>

<!-- MODES -->
<script src="<?php echo base_url()?>assets/vendor/codemirror/mode/htmlmixed/htmlmixed.js"></script>
<script src="<?php echo base_url()?>assets/vendor/codemirror/mode/xml/xml.js"></script>
<script src="<?php echo base_url()?>assets/vendor/codemirror/mode/javascript/javascript.js"></script>
<script src="<?php echo base_url()?>assets/vendor/codemirror/mode/css/css.js"></script>
<script src="<?php echo base_url()?>assets/vendor/codemirror/mode/clike/clike.js"></script>
<script src="<?php echo base_url()?>assets/vendor/codemirror/mode/php/php.js"></script>
<script src="<?php echo base_url()?>assets/vendor/codemirror/keymap/sublime.js"></script>

<style type="text/css">
	.CodeMirror {
		font-size: .7em; 
		height: 700px;
	}

	@media screen and (max-width: 360px and ) {
		#note {
			display: none
		}

		[class*='theme-files-'] li a {
			font-size: .8em;
		}

		.CodeMirror {
			font-size: .5em; 
		}
	}

	@media screen and (max-width: 640px) {
		#note {
			display: none;
		}
	}
</style>

<div class="row">
	<div class="container-fluid">
		<div class="panel">
			<div class="panel-body">
				<div class="dash-tab-content">
					<input id="tab1" type="radio" name="dash-tab" checked>
					<label for="tab1"><span class="icon fa fa-file"></span>Themes<span id="tab-themes"></span></label>
					<input id="tab2" type="radio" name="dash-tab">
					<label for="tab2"><span class="icon fa fa-pencil"></span>Editor<span id="tab-editor"></span></label>

					<section id="content1">
						<div class="row" id="themes-container"></div>
					</section>

					<section id="content2">
						<div class="row">
							<div class="col-md-12">
								<small id="note" class="alert alert-info col-md-12">It is advisable to copy the current code to a text editor/notepad because after saving, changes will not revert to last version.</small>
							</div>
							<div class="col-md-8">
								<textarea id="editor" wrap="off" class="form-control" rows="30" placeholder="" style="font-size: .7em;"></textarea>
							</div>
							<div class="col-md-4">
								<div class="panel panel-default">
									<div class="panel-body">
										<small>Stylesheets (.css)</small>
										<ul class="theme-files-css"></ul>
										<hr/>
										<ul class="theme-files-php"></ul>
									</div>
								</div>

								<button type="button" class="btn btn-primary btn-lg btn-block" name="save">Save changes</button>
							</div>
						</div>
					</section>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="upload" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title">Upload Theme</h3>
      </div>
      <div class="modal-body">
        <form id="frmUploadTheme" action="" method="post">
	        <h4 class="">Featured Image</h4>
	        <div class="col-md-12 wrapper-img" style="background:#e9e9e9">
	            <div class="row">
	            <img id="img-uploader" class="img-responsive" src="<?php echo base_url()?>assets/img/no-image.jpg" style="display:block;margin:auto;height: 204.78px;max-height: 204.78px"/>
	            </div>
	            <a href="#" data-toggle="modal" data-target="#dialogFilemanager">
	                <div class="overlay"><span align="center"><span class="fa fa-cloud-upload" style="font-size: 45px;"></span><br/><br/><span class="text-center" style="display: block">Choose from File Manager <br>(1200w x 628h)</span></span></div>
	                <input type="hidden" name="image"/>
	            </a>
	        </div>
	        <div class="row">
	        	<div class="col-md-12">
	        		<br/>
		        	<input type="text" name="name" class="form-control input-lg" placeholder="Theme name" required/>
		        	<br/>
		        	<h4>Compressed Theme(.zip) max: 30mb</h4>
		        	<input type="file" name="userfile" class="form-control input-lg" accept=".zip" required/>
		        	<br/>
		        	<textarea name="description" rows="3" class="form-control input-lg" placeholder="Short Description"></textarea>
		        	<br/>
		        	<button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
	        	</div>
        	</div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="dialogFilemanager" style="z-index: 9999">
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

<script type="text/javascript">

	display_themes = function(){

		$('#themes-container').html('')

		$.ajax({
			type: 'post',
			url: '<?php echo base_url() ?>' + 'themes/get/',
			dataType: 'json',
			crossDomain: true,
			headers: {'X-Requested-With': 'XMLHttpRequest'},
			error: function(res){
				console.log('error')
				console.log(res)
			},
			success: function(res){
				html = '<h2 class="col-md-12 text-center">-------------- No themes yet --------------</h2>';

				if(res.data.data != ""){
					html = '';

					$.each(res.data.data, function(key, data){
						html += '<div class="square" style="background-image:url(<?php echo base_url() ?>filemanager/files/' + data.Image + ')">'
						html += '<ul class="action">'

						html += data.IsUsed == 1
						? '<li><span class="fa fa-check-circle fa-lg text-success"></span></li>'
						: '<li><button type="button" class="btn btn-default" onclick="use_theme(this)" data-id="' + data.ThemeId + '">Use theme</button></li>'

						// html += '<li><button type="button" class="btn btn-primary"><span class="fa fa-pencil fa-lg"></span></button></li>'
						html += '</ul>'
						html += '<p class="description">' + data.Name + '</p>'
						html += '</div>'
					})
				}

				$('#themes-container').html(html)
			}
		})
	}


	load_files = function(){

		$('#theme-files').html('')

		$.ajax({
			type: 'post',
			url: '<?php echo base_url() ?>' + 'themes/load_files/',
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

				_css = '';
				_php = '';

				css = [];
				php = [];

				$.each(res.data, function(key, file){
					~file.toLowerCase().indexOf('.css')
					? css.push(file)
					: php.push(file)
				})

				if(css != ''){
					$.each(css, function(key, file){
						_css += '<li><a href="#" onclick="get_file(this, event)" class="get-file" data-filename="' + file + '">' + file + '</a></li>'

					})
					$('.theme-files-css').html(_css)
				}

				if(php != ''){
					$.each(php, function(key, file){
						_php += '<li><a href="#" onclick="get_file(this, event)" class="get-file" data-filename="' + file + '">' + file + '</a></li>'

					})
					$('.theme-files-php').html(_php)
				}

			}
		})
	}

	display_themes()
	load_files()

	function use_theme(elem){

		themeid = $(elem).data('id')

		$.ajax({
			type: 'post',
			url: '<?php echo base_url() ?>' + 'themes/use_theme/' + themeid,
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

				if(res.data.message == 'success'){
					display_themes()
					load_files()
				}
			}
		})
	}

	$('#frmUploadTheme').submit(function(e){
		e.preventDefault()

		formdata = new FormData(this)

		$.ajax({
			type: 'post',
			url: '<?php echo base_url() ?>' + 'themes/upload/',
			data: formdata,
			dataType: 'json',
			processData: false,
			contentType: false,
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

				// display all themes
				display_themes()

				// hide #upload modal
				$('#upload').click()

				swal({
	                title: "Successfully Added",
	                text: "New theme has been added!",
	                type: "success",
	                showConfirmButton: false,
	                timer: 1200,
	            },
	            function(){
	            	swal.close()
	            })
			}
		})
	})


	get_file = function(elem, e){
		e.preventDefault()

		filename = $(elem).data('filename')

		ext = filename.split('.')
		ext = ext[ext.length - 1]

		$.ajax({
			type: 'post',
			url: '<?php echo base_url() ?>' + 'themes/read/' + filename,
			dataType: 'text',
			contentType: 'text/plain',
			crossDomain: true,
			headers: {'X-Requested-With': 'XMLHttpRequest'},
			success: function(res){
				$('textarea#editor').data('filename', filename)
				$('textarea#editor').val(res)

				config = {
					lineNumbers: true,
					matchBrackets: true,
					indentUnit: 4,
					indentWithTabs: true,
					theme: "monokai",
					keyMap: "sublime",
				}

	  			// remove existing CodeMirror editor
				$('.CodeMirror').remove()

				if( filename.indexOf('.php') >= 0 ){
					config['mode'] = "application/x-httpd-php"				
				}
				else if( filename.indexOf('.css') >= 0 ){
					config['mode'] = "css" 
				}
				else if( filename.indexOf('.js') >= 0 ){
					config['mode'] = "javascript" 
				}

				CodeMirror.fromTextArea( document.getElementById("editor"), config )
				.on('change', editor => {
				    editor.save()
				})
			}
		})
	}

	$('button[name=save]').click(function(){
		filename = $('textarea#editor').data('filename')
		text 	 = $('textarea#editor').val()

		$.ajax({
			type: 'post',
			url: '<?php echo base_url() ?>' + 'themes/write',
			data: { file: filename, text: text },
			crossDomain: true,
			headers: {'X-Requested-With': 'XMLHttpRequest'},
			error: function(error){
				console.log('error')
				console.log(error)
			},
			success: function(res){
				// UNAUTHORIZED
				if(res.status.code == 401){
					_UNAUTHORIZED()
				}
				else {
					swal({
		                title: "Changes Saved!",
		                text: "",
		                type: "success",
		                showConfirmButton: false,
		                timer: 1000,
		            },
		            function(){
		            	swal.close()
		            })
				}
			}
		})

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
        return false
	}
</script>

<script type="text/javascript" src="<?php echo base_url()?>assets/scripts/require-2.3.2.min.js"></script>
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
            	$('input[name=image]').val(file.name);
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