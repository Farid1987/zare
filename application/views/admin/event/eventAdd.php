<form action="<?= site_url('admin/addEvent')?>" method="POST">
  <div class="row">
    <div class="col-md-8 col-12">
      <div class="card mb-4">
        <div class="card-header">
          <strong>Event Information</strong>
        </div>
        <div class="card-body">
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Event Title</label>
            <div class="col-sm-9">
              <input class="form-control" type="text" name="title" value="<?= set_value('title'); ?>" required>
              <span class="help-block text-danger"><?php echo form_error('title'); ?></span>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Event Type</label>
            <div class="col-sm-9">
              <select name="type_project" class="form-control" required>
              <?php foreach ($allType as $type) { ?>
                  <option value="<?= $type->id_type_project?>" ><?= $type->type_project?></option>
                <?php } ?>
              </select>
              <span class="help-block text-danger"><?php echo form_error('type_project'); ?></span>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Date Event</label>
            <div class="col-sm-9">
              <div class="input-group">
                <input name="deadline" type="text" class="form-control datetimepicker-input" value="<?= set_value('deadline'); ?>" required readonly data-toggle="datetimepicker" data-target="#deadline" id="deadline">
                <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
              </div>
              <span class="help-block text-danger"><?php echo form_error('deadline'); ?></span>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Registration Start</label>
            <div class="col-sm-4">
              <div class="input-group">
                <input name="start_regis" type="text" class="form-control datetimepicker-input" value="<?= set_value('start_regis'); ?>" required readonly data-toggle="datetimepicker" data-target="#regis-start" id="regis-start">
                <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
              </div>
              <span class="help-block text-danger"><?php echo form_error('start_regis'); ?></span>
            </div>
                
            <label class="col-sm-2 col-form-label text-center">Registration End</label>
            <div class="col-sm-3">
              <div class="input-group">
                <input name="end_regis" type="text" class="form-control datetimepicker-input" value="<?= set_value('end_regis'); ?>" required readonly data-toggle="datetimepicker" data-target="#regis-end" id="regis-end">
                <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
              </div>
              <span class="help-block text-danger"><?php echo form_error('end_regis'); ?></span>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Registration Link (optional)</label>
            <div class="col-sm-9">
              <input type="url" class="form-control" name="regis_link" value="<?= set_value('regis_link'); ?>">
              <span class="help-block text-danger"><?php echo form_error('regis_link'); ?></span>
            </div>
          </div>
          
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Short Description</label>
            <div class="col-sm-9">
              <textarea name="short_desc" rows="3" class="form-control" required><?= set_value('short_desc'); ?></textarea>
              <span class="help-block text-danger"><?php echo form_error('short_desc'); ?></span>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Description</label>
            <div class="col-sm-9">
              <textarea name="desc" id="ckeditor" rows="4" class="form-control" required><?= set_value('desc'); ?></textarea>
              <span class="help-block text-danger"><?php echo form_error('desc'); ?></span>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Notes</label>
            <div class="col-sm-9">
              <textarea name="note" rows="3" class="form-control" required><?= set_value('note'); ?></textarea>
              <span class="help-block text-danger"><?php echo form_error('note'); ?></span>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Location</label>
            <div class="col-sm-9">
              <textarea name="location" rows="2" class="form-control" required><?= set_value('location'); ?></textarea>
              <span class="help-block text-danger"><?php echo form_error('location'); ?></span>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Longitude</label>
            <div class="col-sm-4">
              <input name="long" type="text" class="form-control" value="<?= set_value('long'); ?>" required>
              <span class="help-block text-danger"><?php echo form_error('long'); ?></span>
            </div>

            <label class="col-sm-2 col-form-label text-center">Latitude</label>
            <div class="col-sm-3">
              <input name="lat" type="text" class="form-control" value="<?= set_value('lat'); ?>" required>
              <span class="help-block text-danger"><?php echo form_error('lat'); ?></span>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Price</label>
            <div class="col-sm-9">
              <div class="input-group">
                <div class="input-group-append bg-custom b-0"><span class="input-group-text" style="font-size: 14px">Rp.</span></div>
                <input type="text" class="form-control currency-format" name="price" required value="<?= set_value('price'); ?>">
              </div>
              <span class="help-block text-danger"><?php echo form_error('price'); ?></span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card mb-4">
        <div class="card-header">
          <strong>Status</strong>
        </div>
        <div class="card-body">
          <select name="status" class="form-control" required>
            <option value="process">Process</option>
            <option value="complete">Complete</option>
            <option value="draft">Draft</option>
          </select>
          <span class="help-block text-danger"><?php echo form_error('status'); ?></span>
        </div>
        <div class="card-footer" id="submit-footer">
          <div class="text-right">
            <a href="<?= site_url('admin/event')?>" class="btn btn-outline-secondary waves-effect">Cancel</a>
            <button type="submit" class="btn btn-outline-dark waves-effect waves-light" id="submit-form">Submit</button>
          </div>
        </div>
      </div>

      <div class="card mb-4">
        <div class="card-header">
          <strong>Featured Image</strong>
        </div>
        <div class="card-body">
          <div class="dropzone mb-1" id="featured_img">
            <div class="fallback">
              <input name="files" type="file" multiple/>
            </div>
          </div>

          <span class="help-block text-danger"><?php echo form_error('featured_img'); ?></span>
        </div>
      </div>
      <div class="card mb-4">
        <div class="card-header">
          <strong>Event Photos</strong>
        </div>
        <div class="card-body">
          <div class="dropzone" id="gallery">
            <div class="fallback">
              <input name="files" type="file" multiple/>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
    
<script type="text/javascript">
$(document).ready(function() {
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });

  //ckeditor
  let desc = CKEDITOR.replace('ckeditor', {
    toolbarGroups: [
      { name: 'styles', groups: [ 'styles' ] },
    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
    { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
    { name: 'links', groups: [ 'links' ] },
    { name: 'insert', groups: [ 'insert' ] },
  ],
  removeButtons: 'RemoveFormat,Subscript,Superscript,Strike,CreateDiv,JustifyLeft,JustifyCenter,JustifyRight,JustifyBlock,BidiLtr,BidiRtl,Language,Anchor,Flash,Table,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe,Styles,Format,Font,TextColor,BGColor,Maximize,ShowBlocks,About'
  });

  desc.on( 'required', function( evt ) {
    alert( 'Description is required.' );
    evt.cancel();
  } );

  // currency
  $(document).on('keyup', '.currency-format', function() {
    let amount = $(this).val().replace(/\D/g,'');
    $(this).val(accounting.formatMoney(amount, "", 0, "."));
  });

  // datetimepicker
  $.fn.datetimepicker.Constructor.Default = $.extend({}, $.fn.datetimepicker.Constructor.Default, {
    icons: {
        time: 'ti-time',
        date: 'ti-calendar',
        up: 'ti-angle-up',
        down: 'ti-angle-down',
        previous: 'ti-angle-left',
        next: 'ti-angle-right',
        today: 'ti-calendar',
        clear: 'ti-trash',
        close: 'ti-close'
    } 
  });
  var currentDate = new Date();
  $('#deadline').datetimepicker({
    useCurrent: false,
    collapse: false,
    sideBySide: true,
    format: 'YYYY-MM-DD HH:mm',
    ignoreReadonly: true,
    minDate: currentDate,
  })
  $('#regis-start').datetimepicker({
    useCurrent: false,
    collapse: false,
    sideBySide: true,
    format: 'YYYY-MM-DD HH:mm',
    ignoreReadonly: true,
  })
  $('#regis-end').datetimepicker({
    useCurrent: false,
    collapse: false,
    sideBySide: true,
    format: 'YYYY-MM-DD HH:mm',
    ignoreReadonly: true,
  })
  
  var deadlineVal = '<?= set_value('deadline')?>';
  if ($('#deadline').val() == '' && !deadlineVal) {
    $('#deadline').datetimepicker('date', new Date(currentDate.getTime() + 3600000));
  }
  if ($('#deadline').val() != '') {
    if ($('#regis-end').val() == '') {
      $('#regis-start').datetimepicker('maxDate', $('#deadline').val())
    } 

    $('#regis-end').datetimepicker('maxDate', $('#deadline').val())
  } 
  
  
  if ($('#regis-end').val() != '') {
    $('#regis-start').datetimepicker('maxDate', $('#regis-end').val());
  }
  if ($('#regis-start').val() != '') {
    $('#regis-end').datetimepicker('minDate', $('#regis-start').val());
  }

  $('#regis-start').on('change.datetimepicker', function(e) {
    if (Date.parse(this.value) > Date.parse( $('#regis-end').val()) &&  $('#regis-end').val() != '') {
      $('#regis-end').datetimepicker('date', this.value);
    } else if (this.value != '') {
      $('#regis-end').datetimepicker('minDate', e.date);
      $('#deadline').datetimepicker('minDate', e.date);
    }
  });
  $('#regis-end').on('change.datetimepicker', function(e) {
    if (Date.parse(this.value) < Date.parse( $('#regis-start').val()) &&  $('#regis-start').val() != '') {
      $('#regis-start').datetimepicker('date', this.value);
    } else if (this.value != '') {
      $('#regis-start').datetimepicker('maxDate', e.date);
      $('#deadline').datetimepicker('minDate', e.date);
    }
  });
  $('#deadline').on('change.datetimepicker', function(e) {
    if ($('#regis-end').val() == '') {
      $('#regis-start').datetimepicker('maxDate', e.date)
    } 
    $('#regis-end').datetimepicker('maxDate', e.date)
  })

  Dropzone.autoDiscover = false;

  let featuredImg = new Dropzone("#featured_img", { 
    url: "<?= site_url('admin/uploadImg')?>",
    acceptedFiles: 'image/jpeg, image/png, image/webp, image/gif',
    addRemoveLinks: true,
    uploadMultiple: true,
    maxFiles: 1,
    maxFilesize: 1,
    thumbnailWidth: null,
    thumbnailHeight: null,
    paramName: 'files',
    dictDefaultMessage: 'Upload one featured image',
    success: successDz,
    removedfile: removeFileDz,
    sendingmultiple: disabledSubmit,
    completemultiple: enabledSubmit,
    canceledmultiple: enabledSubmit,
  });

  let galleryDropzone = new Dropzone("#gallery", { 
    url: "<?= site_url('admin/uploadImg')?>",
    acceptedFiles: 'image/jpeg, image/png, image/webp, image/gif',
    addRemoveLinks: true,
    uploadMultiple: true,
    thumbnailWidth: 100,
    thumbnailHeight: 100,
    maxFilesize: 1,
    paramName: 'files',
    successmultiple: successDz,
    removedfile: removeFileDz,
    sendingmultiple: disabledSubmit,
    completemultiple: enabledSubmit,
    canceledmultiple: enabledSubmit,
  });

  function successDz(files, res) {
    res = $.parseJSON(res);
    let length = res.img.length;
    if (Array.isArray(files)) {
      files.forEach(file => {
        for (let i = 0; i < length; i++) {
          if (file.name == res.img[i].name && file.size == res.img[i].size) {
            file.previewElement.dataset.url = res.img[i].link;
          }
        }
      });
    } else {
      let previewElement = files.previewElement;
      previewElement.dataset.url = res.img[0].link;
    }
  }

  function removeFileDz(file) {
    let url = "<?= site_url('admin/removeImg')?>";
    let imgLink = file.previewElement.dataset.url;

    if (file.status != 'error') {
      $.ajax({
        url,
        type: 'POST',
        data: {imgLink},
        // success: function(res) {
        //   console.log(res);
        // },
        // error: function(err) {
        //   console.log(err);
        // }
      })
    }
    
    let _ref;
    return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
  }

  function disabledSubmit() {
    $('#submit-footer').addClass('disabled');
  }
  function enabledSubmit() {
    $('#submit-footer').removeClass('disabled');
  }

  $('#submit-form').on('click', function(e) {
    e.preventDefault();
    
    let $featured = $('#featured_img').find('.dz-preview');
    let $form = $(this).parents('form');
    let inputFeatured = document.createElement('input');

    if ($form.find('input[name=featured_img]').length <= 0) {
      inputFeatured.setAttribute('name', 'featured_img');
      inputFeatured.setAttribute('hidden', true);
      inputFeatured.value = ($featured.data('url')) ? $featured.data('url'):'';
      
      $form.append(inputFeatured);
    }

    let $gallery = $('#gallery').find('.dz-preview');
    if ($gallery.length > 0) {
      let lengthGallery = $gallery.length
      for (let i = 0; i < lengthGallery; i++) {
        if ($gallery[i].dataset.url) {
          let inputGallery = document.createElement('input');
          inputGallery.setAttribute('name', 'gallery[]');
          inputGallery.setAttribute('hidden', true);
          inputGallery.value = $gallery[i].dataset.url;
          $form.append(inputGallery);
        }
      }
    }
    
    if ($form[0].reportValidity()) {
      $form.submit();
    }
  })
})
</script>