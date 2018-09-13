<link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/icon-picker/css/bootstrap-iconpicker.min.css">

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-headline">
            <div class="panel-body">
                <br/>
                <form id="frmEdit">
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control input-lg item-menu" name="text" placeholder="Enter title and select icon (optional)">
                        <div class="input-group-btn">
                            <button type="button" id="myEditor_icon" class="btn btn-info btn-lg" data-iconset="fontawesome"></button>
                            <input type="hidden" name="icon" class="item-menu">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <select class="form-control input-lg item-menu" name="page">
                        <option value="" selected>Select a page</option>
                        <option value="blog">Blog list</option>
                        <?php
                        foreach($pages as $page) {
                        $url = explode('/',$page->Url);
                        $url = $url[count($url)-1];
                        ?>
                        <option value="<?php echo $url?>"><?php echo $page->Title?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <select class="form-control input-lg item-menu" name="target">
                        <option value="_self">Self</option>
                        <option value="_blank">Blank</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" name="tooltip" class="form-control input-lg item-menu" placeholder="Tooltip (appears when hovered)">
                </div>
                <div class="form-group pull-right">
                    <button type="button" id="btnUpdate" class="btn btn-primary btn-lg"><span class="fa fa-pencil"></span>&nbsp;&nbsp;Update</button>
                    <button type="button" id="btnAdd" class="btn btn-success btn-lg"><span class="fa fa-plus"></span>&nbsp;&nbsp;Add</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel">
            <div class="panel-body">
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <h4>Note: Don't forget to hit "<span class="text-primary">Save changes</span>".</h4>
                        <ul id="myEditor" class="sortableLists list-group"></ul>

                        <button id="btnSave" type="button" class="col-md-12 btn btn-primary btn-lg">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url()?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src='<?php echo base_url()?>assets/vendor/jquery-menu-editor.js'></script>
<script src='<?php echo base_url()?>assets/vendor/icon-picker/iconset/iconset-fontawesome-4.7.0.min.js'></script>
<script src='<?php echo base_url()?>assets/vendor/icon-picker/js/bootstrap-iconpicker.js'></script>
<script>
    $(document).ready(function () {
        var iconClass = 'fa '

        //icon picker options
        var iconPickerOptions = {searchText: 'Search', labelHeader: '{0} de {1} Pags.'}

        //sortable list options
        var sortableListOptions = {
            placeholderCss: {'background-color': 'rgb(43, 51, 62)'}
        }

        var editor = new MenuEditor('myEditor', {listOptions: sortableListOptions, iconPicker: iconPickerOptions, labelEdit: 'Edit'});
        editor.setForm($('#frmEdit'))
        editor.setUpdateButton($('#btnUpdate'));

        $("#btnUpdate").click(function(){
            editor.update()
            $('.btnIn').hide()

        })

        $('#btnAdd').click(function(){
            editor.add()
            $('.btnIn').hide()
        })

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url()?>' + 'menu/get/',
            dataType: 'json',
            crossDomain: true,
            headers: {'X-Requested-With': 'XMLHttpRequest'},
            error: function(res){
                console.log('error')
                console.log(res)
            },
            success: function(json){
                editor.setData(json);
                $('.btnIn').hide()
            }
        })

        $('#btnSave').click(function(){
            output = editor.getString()
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()?>' + 'menu/save/',
                data: { 'sequence': output },
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
</script>
