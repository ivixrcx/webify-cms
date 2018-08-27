<div class="row">
	<form>
	<div class="col-md-7">
		<div class="panel panel-headline" style="height:314px">
			<div class="panel-heading">
                <small>Automatically saved as <b class="text-success">draft</b> when <b >touched</b>.</small>
                <a id="preview" href="" class="pull-right" target="_blank">Preview</a>
            </div>
			<div class="panel-body">
                <input type="hidden" name="pageid" value="" />
                <input type="hidden" name="url" value="" />
				<input class="form-control input-lg" name="title" placeholder="Title" type="text" value="" required autocomplete="off">
                <h4 class="permalink">
                    <span title="Permalink">
                        <span class="fa fa-link"></span>&nbsp;
                        <span id="url" class="text-primary" style="border: 1px solid;"></span>
                    </span> 
                </h4>
                <h4><span class="fa fa-file"></span>&nbsp;&nbsp;Choose Template</h4>
                <select id="templates" class="form-control input-lg" name="template"></select>
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
<script type="text/javascript">

    // tinymce
    tinymce.init({
      selector: 'textarea#editor',
      height: 500,
      theme: 'modern',
      menubar: 'insert table',
      plugins: 'autosave autolink directionality image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern',
      toolbar: 'mybutton | formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
      content_style: `
        @import url('https://fonts.googleapis.com/css?family=Ubuntu:400,500');
        body {
            font-family: 'Ubuntu', sans-serif;
            font-size: .95em;
        }`,
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
    form_original_data = $('form').serialize()

    title = ""

    function dirtyForm(){

        if($('input[name=title]').val() == '') return false

        // change url without reloading the page
        if(title != ''){
            history.pushState(null, '', '<?php echo base_url()?>my/page/edit/' + title);
        }

        if($("form").serialize() != form_original_data){
            // update new edits
            form_original_data = $("form").serialize()
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>' + 'my/page/draft/',
                data: $("form").serialize(),
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

                        if(res.data.pageid != ''){
                            $('input[name=pageid]').val(res.data.pageid)
                        }

                        setTimeout(function(){
                            $('#status span').switchClass('text-info', 'text-success').html('~Draft')

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

    $('#status').html('<?php echo $status ?>')

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

    // load templates
    $.ajax({
        type: 'post',
        url: '<?php echo base_url() ?>' + 'themes/templates/',
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

            html = ''
            if(res.data != ''){
                html += '<option value="">None</option>'
                $.each(res.data, function(key, data){
                    html += '<option value="' + data + '">' + data.split('.')[0] + '</option>'
                })
            }
            $('#templates').html(html)
        }
    })

    // load edit page
    $.ajax({
        type: 'post',
        url: '<?php echo base_url() ?>' + 'page/search_json/<?php echo $page ?>',
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

            $('#preview').attr('href', '<?php echo base_url() ?>preview/' + res.data.Url)
            $('input[name=pageid]').val(res.data.PageId)
            $('input[name=url]').val(res.data.Url)
            $('input[name=title]').val(res.data.Title)

            if(res.data.Image != ''){
                $('#img-uploader').prop('src', '<?php echo base_url() ?>filemanager/files/' + res.data.Image)
            }
            
            $('input[name=image]').val(res.data.Image)
            $('textarea[name=content]').val(res.data.Content)
            $('#url').text('<?php echo base_url() ?>' + res.data.Url)

            if(res.data.Template != ''){
                $('option[value="' + res.data.Template + '"]').prop('selected','selected')
            }
        }
    })

    $('input[name=title]').on('keyup',function(){
        if($(this).val() == ''){
            return false
        }

        url = $('input[name=title]').val().trim().replace(/[^a-z0-9+]+/gi, '-').toLowerCase()
        $('input[name=url]').val(url)
        $('#preview').attr('href', '<?php echo base_url()?>preview/' + url)
        $('#url').text('<?php echo base_url() ?>' + url)
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