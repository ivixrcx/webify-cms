
<div class="row">
	<form action="" method="POST">
	<div class="col-md-12">
		<div class="row">
		<div class="col-md-7">
		</div>
		<div class="col-md-6">
		</div>
		</div>
	</div>
	<div class="col-md-7">
		<p>Help <b class="text-info">search engines</b> find your website.<sup><a href="https://searchenginewatch.com/2018/04/04/a-quick-and-easy-guide-to-meta-tags-in-seo/" title="Know how SEO works" target="_blank">[?]</a></sup></p>

		<div class="panel">
			<div class="panel-body">
				<small>Site Title</small>
				<input type="text" class="form-control input-lg" name="title" value="<?php echo $settings->SiteTitle ?>" placeholder="Title" required/>
				<br>
				<small>Site Description</small>
				<input type="text" class="form-control input-lg" name="description" value="<?php echo $settings->SiteDescription ?>" placeholder="Description" required/>
				<br>
				<!-- <small>Site Tags (eg: travel, nature, forest) </small> -->
				<!-- <div data-tags-input-name="taggone" id="tag" data-no-spacebar="true" placeholder="test"><?php echo $settings->SiteTags ?></div> -->
				<!-- <br> -->
				<small>Default Homepage</small>
				<select class="form-control input-lg" name="homepage">
					<option value="">Select a page</option>
                    <?php
                    if($settings->HomePage == 'blog'){
                    	echo '<option value="blog" selected >Blog list</option>';
                    }
                    else{
                    	echo '<option value="blog" >Blog list</option>';
                    }

                    foreach($pages as $page) {
                    $url = explode('/',$page->Url);
                    $url = $url[count($url)-1];

	                    if($settings->HomePage == $url){
							echo '<option value="'.$url.'" selected>'.$page->Title.'</option>';
	                    }
	                    else{
							echo '<option value="'.$url.'">'.$page->Title.'</option>';
	                    }
                    }
                    ?>
				</select>
				<br>
			</div>
		</div>
	</div>
	<div class="col-md-5">
		<p>Don't forget to hit "<b class="text-info">Save changes</b>".</p>

		<div class="panel panel-headline">
			<div class="panel-heading">
				<h3 class="panel-title">Logo <small>(130w &times; 30h)</small></h3>
			</div>
			<div class="panel-body">
				<div class="col-md-12 wrapper-img" style="background:#e9e9e9">
                    <div class="row">
                    <img id="img-uploader-logo" class="img-responsive" src="<?php echo base_url() . 'filemanager/files/' . $settings->Logo ?>" style="display:block;margin:auto;height: 120px;max-height: 120px"/>
                    </div>
                    <a href="#" data-toggle="modal" data-target="#dialogFilemanager" onclick="$('#elfinder').data('action','logo')">
                        <div class="overlay"><span class="text-center"><span class="fa fa-cloud-upload" style="font-size: 30px;margin-top: 15px"></span><br/><br/><span style="display: block">Choose from File Manager <br>( 100w &times; 30h )</span></span></div>
                        <input type="hidden" name="logo" value="<?php echo $settings->Logo ?>" />
                    </a>
                </div>
			</div>

			<div class="panel-heading">
				<h3 class="panel-title">Favicon <small>(32w &times; 32h)</small></h3>
			</div>
			<div class="panel-body">
				<div class="col-md-12 wrapper-img" style="background:#e9e9e9;">
                    <div class="row">
                    <img id="img-uploader-favicon" class="img-responsive" src="<?php echo base_url() . 'filemanager/files/' . $settings->Favicon ?>" style="display:block;margin:auto;height: 64px;max-height: 64px"/>
                    </div>
                    <a href="#" data-toggle="modal" data-target="#dialogFilemanager" onclick="$('#elfinder').data('action','favicon')">
                        <div class="overlay"><span class="text-center"><span class="fa fa-cloud-upload" style="font-size: 20px;margin-top: 30px"></span><br/><br/><span style="display: block;font-size: 14px">Choose from File Manager <br>( 32w &times; 32h )</span></span></div>
                        <input type="hidden" name="favicon" value="<?php echo $settings->Favicon ?>" />
                    </a>
                </div>
			</div>
		</div>

		<button class="btn btn-primary btn-block btn-lg"><span>Save changes</span></button>
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
				<div id="elfinder" data-action=""></div>
			</div>
		</div>
    </div>
</div>



<!-- scripts -->


<script type="text/javascript">
	(function( $, window, document, undefined ) {
	    $( document ).ready(function() {
	        // var t = $( "#tag" ).tagging();
	        // t[0].addClass( "form-control" );

	        $('form').submit(function(e){
	        	e.preventDefault()

		        formdata = $('form').serialize()

	        	$.ajax({
					type: 'post',
					url: '<?php echo base_url()?>' + 'my/settings/update',
					data: formdata,
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
	                        swal({
	                            title: 'Changes saved!',
	                            text: '',
	                            type: "success",
	                            timer: 800,
	                            showConfirmButton: false,
	                        }, function(){
                                window.location.reload(true)
                            })
	                    }
	                    else{
	                        swal({
	                            title: 'Oops',
	                            text: 'Something went wrong!',
	                            type: 'error',
	                            timer: 800,
	                            showConfirmButton: false,
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
            }
	    })
	})( window.jQuery, window, document );


</script>

<script type="text/javascript" src="<?php echo base_url()?>assets/scripts/require-2.3.2.min.js"></script>
<script type="text/javascript">

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
            	action = $('#elfinder').data('action')
            	if(action == 'logo'){
	        		$('#img-uploader-logo').attr('src',file.url)
                    $('input[name=logo]').val(file.url.replace(file.baseUrl, ''));

	            }
	            else{
	        		$('#img-uploader-favicon').attr('src',file.url)
                    $('input[name=favicon]').val(file.url.replace(file.baseUrl, ''));
	            }

                $('#dialogFilemanager').click();
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
